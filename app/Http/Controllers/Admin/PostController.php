<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Post;
use App\Models\Secretary;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $repository, $secretary, $category;
    
    public function __construct(Post $Post, Secretary $secretary, Categoria $category){
        $this->repository = $Post;
        $this->secretary = $secretary;
        $this->category = $category;
    }
    public function index()
    {
        $posts = $this->repository->latest()->paginate(10);
        return view('admin.pages.posts.index', compact('posts'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $secretaries = $this->secretary->all();      
        $categories = $this->category->all();
        
        
        return view('admin.pages.posts.create', compact('secretaries', 'categories'));
    }
    
    public function store(Request $request)
    {
        dd($request->all());

        $dadosPost = $request->only('titulo','data_publicacao','data_expiracao','secretary_id', 'conteudo');
      //  $post = new Post();
       // $post->fill($dadosPost);
       
      // $dadosPost = $this->repository->create($dadosPost);
    
      // $category->categories()->attach();

       $categories = $request->only('categories[]');
       dd($categories);
        




        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
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
