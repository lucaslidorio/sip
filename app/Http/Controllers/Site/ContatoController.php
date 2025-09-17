<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address as MailAddress;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContatoMail;
use App\Models\Menu;
use App\Models\Tenant;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Address; // se usar envelope()
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContatoController extends Controller
{

    private $menu, $tenant;
   
    public function __construct(Menu $menu, Tenant $tenant){
        $this->menu = $menu;
        $this->tenant = $tenant;

    }
    /**
     * Exibe a página de contato
     */
    public function index()
    {
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();
        $menus3 = $this->menu::whereNull('menu_pai_id')
            ->where('posicao', '3')
            ->orderBy('ordem')
            ->get();  
           
        return view("public_templates.$template.includes.contatos.contato", compact('tenant', 'menus', 'menus3'));
    }
    
    /**
     * Processa o envio do formulário de contato
     */

public function enviar(Request $request)
{
    try {
        // validação + montagem dos dados...
        $validator = $this->validarFormulario($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()
                ->with('error', 'Por favor, corrija os erros abaixo e tente novamente.');
        }

        $dados   = $validator->validated();
        $tenant  = $this->getTenant();

        if (!$tenant || !$tenant->email) {
            return back()->withInput()
                ->with('error', 'Email de contato não configurado. Entre em contato por telefone.');
        }

        $dadosEmail = [
            'nome'       => $dados['nome'],
            'email'      => $dados['email'],
            'telefone'   => $dados['telefone'] ?? null,
            'assunto'    => $dados['assunto'] ?? 'Contato via Site',
            'mensagem'   => $dados['mensagem'],
            'tenant'     => $tenant,
            'data_envio' => now()->format('d/m/Y H:i:s'),
            'ip_origem'  => $request->ip(),
            'user_agent' => $request->userAgent(),
        ];

        // Envio
        Mail::to($tenant->email)->send(new \App\Mail\ContatoMail($dadosEmail));

        // opcional: log de sucesso
        Log::info('Contato enviado', ['to' => $tenant->email, 'nome' => $dados['nome']]);

        return back()->with('success', 'Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.');
    }
    catch (TransportExceptionInterface $e) {
        // Erros do transporte (SMTP/Auth/Conexão)
        Log::error('Erro de transporte de email', [
            'to'     => $tenant->email ?? null,
            'msg'    => $e->getMessage(),
            'debug'  => method_exists($e, 'getDebug') ? $e->getDebug() : null,
            'trace'  => $e->getTraceAsString(),
        ]);

        $msg = config('app.debug') ? $e->getMessage() : 'Falha no envio de e-mail. Tente novamente mais tarde.';
        return back()->withInput()->with('error', $msg);
    }
    catch (Throwable $e) {
        // Qualquer outro erro
        Log::error('Erro ao enviar contato', [
            'msg'       => $e->getMessage(),
            'tenant_id' => $this->getTenant()->id ?? null,
            'trace'     => $e->getTraceAsString(),
        ]);

        $msg = config('app.debug') ? $e->getMessage() : 'Ocorreu um erro ao enviar sua mensagem. Tente novamente ou entre em contato por telefone.';
        return back()->withInput()->with('error', $msg);
    }
}

    
    /**
     * Validação do formulário de contato
     */
    private function validarFormulario(Request $request)
    {
        $rules = [
            'nome' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/' // Apenas letras e espaços
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255'
            ],
            'telefone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[\(\)\d\s\-\+]+$/' // Formato de telefone
            ],
            'assunto' => [
                'nullable',
                'string',
                'max:100',
                'in:Informações Gerais,Serviços Públicos,Reclamação,Sugestão,Elogio,Transparência,Outros'
            ],
            'mensagem' => [
                'required',
                'string',
                'min:10',
                'max:2000'
            ],
            'aceito_termos' => [
                'required',
                'accepted'
            ]
        ];
        
        $messages = [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 2 caracteres.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'nome.regex' => 'O nome deve conter apenas letras e espaços.',
            
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'telefone.regex' => 'Digite um telefone válido.',
            
            'assunto.max' => 'O assunto não pode ter mais de 100 caracteres.',
            'assunto.in' => 'Selecione um assunto válido.',
            
            'mensagem.required' => 'A mensagem é obrigatória.',
            'mensagem.min' => 'A mensagem deve ter pelo menos 10 caracteres.',
            'mensagem.max' => 'A mensagem não pode ter mais de 2000 caracteres.',
            
            'aceito_termos.required' => 'Você deve aceitar os termos para continuar.',
            'aceito_termos.accepted' => 'Você deve aceitar os termos para continuar.'
        ];
        
        return Validator::make($request->all(), $rules, $messages);
    }
    
    /**
     * Log do contato para auditoria (opcional)
     */
    private function logContato($dados)
    {
        try {
            // Você pode criar uma tabela de logs de contato se desejar
            // ou usar o sistema de logs do Laravel
            \Log::info('Contato enviado via site', [
                'nome' => $dados['nome'],
                'email' => $dados['email'],
                'assunto' => $dados['assunto'],
                'tenant_id' => $dados['tenant']->id ?? null,
                'ip' => $dados['ip_origem'],
                'data' => $dados['data_envio']
            ]);
        } catch (\Exception $e) {
            // Se falhar o log, não interrompe o processo
            \Log::error('Erro ao fazer log do contato: ' . $e->getMessage());
        }
    }
    
    /**
     * Obter tenant atual
     */
    private function getTenant()
    {
        // Assumindo que você tem um método para obter o tenant
        // Adapte conforme sua implementação
        return \App\Models\Tenant::first(); // ou sua lógica específica
    }
    
    /**
     * Obter template atual
     */
    private function getTemplate()
    {
        // Assumindo que você tem um método para obter o template
        // Adapte conforme sua implementação
        $tenant = $this->getTenant();
        return $tenant->template ?? 'gov';
    }
    
    /**
     * Página de política de privacidade (se não existir)
     */
    public function politicaPrivacidade()
    {
        $tenant = $this->getTenant();
        
        return view('public_templates.' . $this->getTemplate() . '.politica-privacidade', compact('tenant'));
    }
}

