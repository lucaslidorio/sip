<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\TipoOvidoria;
use Illuminate\Http\Request;

class OuvidoriaSiteController extends Controller
{
    private $tenant, $tipos_ouvidorias;
    public function __construct(Tenant $tenant, TipoOvidoria $tipo_ouvidoria)
    {
        $this->tenant = $tenant;
        $this->tipos_ouvidorias = $tipo_ouvidoria;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $tenants = $this->tenant->where('id', 3)->get();
            $cliente = $this->tenant->first();
            $tipos_ouvidoria = $this->tipos_ouvidorias->get();

                     
              
            return view('site.layouts..ouvidoria.index', [
                'cliente' => $cliente,
                'tenants' =>  $tenants,
                'tipos_ouvidoria' =>$tipos_ouvidoria,
            ]);
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_ouvidoria)
    {  
        
        $tenants = $this->tenant->where('id', 3)->get();
        $cliente = $this->tenant->first();
        $tipo_ouvidoria = $this->tipos_ouvidorias->findOrfail($id_ouvidoria);
        
        return view('site.layouts..ouvidoria.form', compact('cliente',  'tenants', 'tipo_ouvidoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
