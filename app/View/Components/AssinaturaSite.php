<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AssinaturaSite extends Component
{
    /**
     * Create a new component instance.
     */
    public $assinaturas;
    public $municipio;
    public $codigoverificacao;
    public $iddocumento;
    public function __construct($assinaturas, $municipio, $codigoverificacao, $iddocumento )
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
        return view('components.assinatura-site');
    }
}
