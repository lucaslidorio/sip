<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
        
    }
    public function index()
    {

       
        $menus = $this->menu->paginate(10);
        return view('admin.pages.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = $this->menu->get();
        return view('admin.pages.menus.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateMenu $request)
    {         
        $dadosMenu = $request->all();
        $identificacao = Str::of($request->nome)->kebab();
        $dadosMenu['slug'] = $identificacao;
       
        $this->menu->create($dadosMenu);

        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('menus.index');
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
        $menus = $this->menu->get();
        $menu = $this->menu->where('id', $id)->first();
        return view('admin.pages.menus.edit', compact('menu', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateMenu $request, $id)
    {
        $menu =  $this->menu->where('id', $id)->first();
        if(!$menu){
            redirect()->back();
        }        

        $dadosMenu = $request->all();  
        $dadosMenu['slug'] = Str::of($request->nome)->kebab();         
        $menu->update($dadosMenu);

        toast('Menu atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('menus.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = $this->menu->where('id', $id)->first();
        if(!$menu){
            return redirect()->back();                      
        }       
        $menu->delete();
        toast('Menu excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('menus.index');
    }
}
