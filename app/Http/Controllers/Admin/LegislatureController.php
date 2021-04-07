<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Legislature;
use App\Models\Section;
use Illuminate\Http\Request;

class LegislatureController extends Controller
{
    private $repository;

    public function __construct(Legislature $legislature)
    {
        $this->repository = $legislature;
        

       
        
    }
    public function index()
    {
        $legislatures = $this->repository->orderBy('ordem', 'DESC')->get();
    
      


        $sect = Section::Where('id', 10 )->get();
        //$legislatura = $sect->legislature;
        // foreach ($sect->legislature as $legislatura) {
        //     dd($legislatura);
        // }

       
        
        return view('admin.pages.legislatures.index',[
            'legislatures' => $legislatures,            
             ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
