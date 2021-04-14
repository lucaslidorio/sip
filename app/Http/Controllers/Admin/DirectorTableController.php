<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biennium;
use App\Models\DirectorTable;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class DirectorTableController extends Controller
{
    private $repository, $biennium;

    public function __construct(DirectorTable $directorTable, Biennium $biennium)
    {
        $this->repository = $directorTable;
        $this->biennium = $biennium;
    }
    public function index()
    {
        $directorTables = $this->repository->paginate(10);
        return view('admin.pages.directorTables.index', compact('directorTables'));
    }
 
    public function create()
    {
        $bienniuns = $this->biennium->orderBy('id', 'DESC')->get();   
       
        return view('admin.pages.directorTables.create', compact('bienniuns'));
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
