<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Functions;
use App\Models\User;
use App\Models\UserFunction;
use Illuminate\Http\Request;

class UserFunctionController extends Controller
{
    private $repository, $function, $user;

    public function __construct(UserFunction $userFunctions, Functions $function, User $user){        
        $this->repository = $userFunctions;
        $this->function = $function;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver-funcoes');
        $userFunctions = $this->repository->paginate(10);
        return view('admin.pages.userFunctions.index', compact('userFunctions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('nova-funcoes');
        $functions = $this->function->get();
       
        $users = $this->user->get();
        return view('admin.pages.userFunctions.create', compact('functions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
