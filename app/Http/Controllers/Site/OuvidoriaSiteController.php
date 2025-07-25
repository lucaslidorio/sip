<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOuvidoriaSite;
use App\Models\AnexoOuvidoria;
use App\Models\AssuntoOuvidoria;
use App\Models\Link;
use App\Models\Menu;
use App\Models\OrgaoOuvidoria;
use App\Models\Ouvidoria;
use App\Models\PerfilOuvidoria;
use App\Models\RespostaOuvidoria;
use App\Models\Tenant;
use App\Models\TipoOvidoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OuvidoriaSiteController extends Controller
{
    private $tenant, $tipos_ouvidorias,
        $perfis_ouvidoria,
        $orgaos_ouvidoria,
        $assuntos_ouvidoria,
        $respostas_ouvidoria,
        $menu,
        $link,
        $repository;

    public function __construct(
        Tenant $tenant,
        TipoOvidoria $tipo_ouvidoria,
        PerfilOuvidoria $perfis_ouvidoria,
        OrgaoOuvidoria $orgao_ouvidoria,
        AssuntoOuvidoria $assunto_ouvidoria,
        RespostaOuvidoria $respostas_ouvidoria,
        Ouvidoria $repository,
        Menu $menu,
        Link $link,
    ) {
        $this->tenant = $tenant;
        $this->tipos_ouvidorias = $tipo_ouvidoria;
        $this->perfis_ouvidoria = $perfis_ouvidoria;
        $this->orgaos_ouvidoria = $orgao_ouvidoria;
        $this->assuntos_ouvidoria = $assunto_ouvidoria;
        $this->respostas_ouvidoria = $respostas_ouvidoria;
        $this->menu = $menu;
        $this->link = $link;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $tenant = $this->tenant->first();
    //     $menus = Menu::getMenusByPosition(1);
    //     $menusSuperior = Menu::getMenusByPosition(2);
    //     $servicosOnline = $this->link->where('tipo', 2)->get();
    //     $linksDireita = $this->link
    //         ->where('posicao', 3)
    //         ->where('tipo', 1) //Tipo = Banner
    //         ->orderby('ordem', 'ASC')
    //         ->orderby('created_at')
    //         ->take(6)
    //         ->get();
    //     $linksUteis = $this->link
    //         ->where('tipo', 2) //Tipo = Links Úteis
    //         ->orderby('ordem', 'ASC')
    //         ->orderby('created_at')
    //         ->get();



    //     $cliente = $this->tenant->first();
    //     $tipos_ouvidoria = $this->tipos_ouvidorias->get();



    //     return view('site.legislativo.ouvidoria.index', [
    //         'cliente' => $cliente,
    //         'tenant' =>  $tenant,
    //         'tipos_ouvidoria' => $tipos_ouvidoria,
    //         'menus' => $menus,
    //         'linksDireita' => $linksDireita,
    //         'linksUteis' => $linksUteis,
    //         'menusSuperior' => $menusSuperior,
    //     ]);
    // }

   

    public function create($id_ouvidoria)
    {

        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();
        $tipo_ouvidoria = $this->tipos_ouvidorias->findOrfail($id_ouvidoria);
        $perfis_ouvidoria = $this->perfis_ouvidoria->where('situacao', true)->get();
        $orgaos_ouvidoria = $this->orgaos_ouvidoria->where('situacao', true)->get();
        $assuntos_ouvidoria = $this->assuntos_ouvidoria->where('situacao', true)->get();

        return view(
            "public_templates.$template.includes.ouvidoria.form",
            compact(
                'tenant',
                'menus',
                'tipo_ouvidoria',
                'perfis_ouvidoria',
                'orgaos_ouvidoria',
                'assuntos_ouvidoria'

            )
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateOuvidoriaSite $request)
    {

        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();

        //captura e percorre o array de anexo para fazer os registro e upload
        $codigo = Str::upper(Str::random(8));
        $existe_codigo = $this->repository->where('codigo', $codigo)->first();
        if ($existe_codigo != null) {
            $codigo = Str::upper(Str::random(8));
        }
        $request->merge(['codigo' => $codigo]);

        $ouvidoria = $this->repository->create($request->all());


        $anexo = $request->only('anexo');
        if ($request->hasFile('anexo')) {
            for ($i = 0; $i < count($anexo['anexo']); $i++) {
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $anexoOuvidoria = new AnexoOuvidoria();
                $anexoOuvidoria->ouvidoria_id = $ouvidoria->id;
                $anexoOuvidoria->anexo = $file->store('attachments_ombudsman');
                $anexoOuvidoria->nome_original = $nome_original;
                $anexoOuvidoria->save();
                unset($anexoOuvidoria);
            }
        }
        return view(
            "public_templates.$template.includes.ouvidoria.confirmacao",
            compact(
                'tenant',
                'menus',
                'ouvidoria'

            )
        );
    }

    public function acompanhamento(Request $request)
    {
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();
        $ouvidoria = $this->repository->where('codigo', $request->codigo)->first();

        if ($ouvidoria) {
            //Ler mensagem
            $respostas_nao_lida = $this->respostas_ouvidoria
                ->where('ouvidoria_id', $ouvidoria->id)
                ->where('visualizado', false)
                ->get();

            for ($i = 0; $i < count($respostas_nao_lida); $i++) {
                $respostas_nao_lida[$i]->visualizado = true;
                $respostas_nao_lida[$i]->save();
            }
        }

        return view(
            "public_templates.$template.includes.ouvidoria.acompanhamento",
            compact(
                'tenant',
                'menus',
                'ouvidoria'
            )
        );
    }

    public function duvidas()
    {
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();

            return view(
                "public_templates.$template.includes.ouvidoria.duvidas",
                compact(
                    'tenant',
                    'menus',                    
                )
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
