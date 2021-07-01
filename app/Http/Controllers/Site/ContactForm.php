<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Controller
{
    private $nome, $email, $assunto, $mensagem;
    public function __construct(Request $request)
    {
        $this->nome = $request->name;
        $this->email = $request->email;
        $this->assunto = $request->assunto;
        $this->mensagem = $request->mensagem;        
    }

    public function sendMail(){
        
        $data = array(
            'name' => $this->nome,
            'email' => $this->email,
            'assunto' => $this->assunto,
            'mensagem' => $this->mensagem,
        );

        Mail::to(config('mail.from.address'))
        ->send(new contato($data));

    }

}
