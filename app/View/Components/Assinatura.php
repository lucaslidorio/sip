<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Assinatura extends Component
{
    public $assinaturas;
    public $municipio;
    public $codigoverificacao;
    public $iddocumento;
   
    /**
     * Create a new component instance.
     */
    public function __construct( $assinaturas, $municipio, $codigoverificacao, $iddocumento )
    {
        $this->assinaturas = $assinaturas;
        $this->municipio = $municipio;
        $this->codigoverificacao = $codigoverificacao;
        $this->iddocumento = $iddocumento;
       
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.assinatura');
    }
   
}
