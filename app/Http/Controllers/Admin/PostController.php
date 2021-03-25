<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Post;
use App\Models\PostImg;
use App\Models\Secretary;
use App\Models\User;
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
       //pega usuário autenticado        
        
        
        $dadosPost = new Post();
        //Pega os dados dos input especificos do post
        $dadosPost = $request->only('titulo','data_publicacao','data_expiracao','secretary_id', 'conteudo', 'img_destaque');
       
        $user = auth()->user();
        $dadosPost['user_id'] = $user->id;  
              
       
        //Upload de da imagem de destaque
        if($request->hasFile('img_destaque') && $request->img_destaque->isValid()){
            $dadosPost['img_destaque'] = $request->img_destaque->store('posts');
        }        
        //Grava os dados na tabela post
        $dadosPost = $this->repository->create($dadosPost);
      
          //pega os checkbox de categoria marcados e grava tabela post_category
       $request->only('categories');       
       if($request->categories){
           for ($i=0; $i < count($request->categories) ; $i++) { 
               $categoryPost = ($request->categories[$i]);
               $dadosPost->categories()->attach($categoryPost);
           }
       }  
       
      //Grava as imagens da galeria na tabela post_img
        $imgGaleria =  $request->only('img_galeria');
        if($request->hasFile('img_galeria')){
            for ($i=0; $i < count($imgGaleria['img_galeria']) ; $i++) { 
                $file= $imgGaleria['img_galeria'][$i];
                $postImg = new PostImg();
                $postImg->post_id = $dadosPost->id;
                $postImg->img= $file->store('posts');
                $postImg->save();
                unset($postImg);       
                    }                   
        }          
      
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
        $post = $this->repository->where('id', $id)->first();

        if(!$post)
            return redirect()->back();

        return view('admin.pages.posts.show',[
            'post' =>$post
        ]);
    }
  
    public function edit($id)
    {
        $post = $this->repository->where('id', $id)->first();
        $secretaries = $this->secretary->all();
        $categories = $this->category->all();

        

        if(!$post){
            return redirect()->back();                       
        }                       
        return view('admin.pages.posts.edit',[
            'post' => $post,
            'categories'=> $categories,
            'secretaries' => $secretaries
            
        ]);
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
        if($request->hasFile('image') && $request->img_destaque->isValid()){
            $dadosPost['img_destaque'] = $request->img_destaque->store('posts');

        }
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
