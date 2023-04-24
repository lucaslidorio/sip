<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionMembers;
use App\Models\Councilor;
use App\Models\Functions;
use Illuminate\Http\Request;

class CommissionMemberFunction extends Controller
{
   private $repository, $function, $member;

   public function __construct(
     CommissionMemberFunction $CommissionMemberFunction,
       Functions $function,
       Councilor $member
   )
   {
       $this->repository = $CommissionMemberFunction;
       $this->function = $function;
       $this->member = $member;
       
   }


    public function index()
    {
       // dd('chegou aqui');
            $comissao = CommissionMembers::with('members', 'functions')->where('commission_id', 6)->get();
           // dd($comissao);
         
       return view('admin.pages.commissions.members.index', [
             'comissao' => $comissao,
            
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('chegou aqui');
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
