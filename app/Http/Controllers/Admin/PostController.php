<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePost;
use App\Models\Categoria;
use App\Models\Post;
use App\Models\PostImg;
use App\Models\Secretary;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

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
    
    public function store(StoreUpdatePost $request)
    {
               
        
        $dadosPost = new Post();
        //Pega os dados dos input especificos do post
        $dadosPost = $request->only('titulo','data_expiracao','secretary_id', 'conteudo', 'img_destaque');
        //pega usuário autenticado       
        $user = auth()->user();
        $dadosPost['user_id'] = $user->id;  
        $dadosPost['data_publicacao'] =date('Y/m/d');
 
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

    public function update(StoreUpdatePost $request, $id)
    {       
        //recupera o post pelo id 
        $post  = $this->repository->where('id', $id)->first();
        if(!$post){
            redirect()->back();
        } 

         $dadosPost = $request->only('titulo','data_expiracao','secretary_id', 'conteudo', 'img_destaque');
       
         //verifica se existe um arquivo e se é do tipo image e faz o upload 
         //antes de fazer salvar, remove a imagem já existente    
         if($request->hasFile('img_destaque') && $request->img_destaque->isValid()){
            if(Storage::exists($post->img_destaque)){
               Storage::delete($post->img_destaque);
            }
          
            
            $dadosPost['img_destaque'] = $request->img_destaque->store('posts');
        }
        //Atualila a tabela post
         $post->update($dadosPost);
       
        //Captura os checkbox e atualiza a tabela post_category
        $request->only('categories');               
        if($request->categories){
           for ($i=0; $i < count($request->categories) ; $i++) { 
               $categoryPost[] = ($request->categories[$i]); 
               $post->categories()->sync($categoryPost);            
               
           }      
        }  
        //Grava as imagens da galeria na tabela post_img
        $imgGaleria =  $request->only('img_galeria');
        if($request->hasFile('img_galeria')){
            for ($i=0; $i < count($imgGaleria['img_galeria']) ; $i++) { 
                $file= $imgGaleria['img_galeria'][$i];
                $postImg = new PostImg();
                $postImg->post_id = $post->id;
                $postImg->img= $file->store('posts');
                $postImg->save();
                unset($postImg);       
            }                   
        } 
        toast('Cadastro atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();      
    }
    
    //Metodo para remover a imagem de galeria do post
    public function removeImage($id)
    {
        //Recupera a imagem pelo id
        $imagem = PostImg::where('id', $id)->first();
        //Verifica se pelo nome, se ela existe o storage, e deleta do storage
        if(Storage::disk('s3')->exists($imagem->img)){
            Storage::disk('s3')->delete($imagem->img);
        }
        //deleta a referência do banco
        $imagem->delete();  
        toast('Imagem  removida com sucesso!','success')->toToast('top') ;        
        return redirect()->back();
    }


    public function destroy($id)
    {
        //recupera o post pelo id
        $post  = $this->repository->where('id', $id)->first();
        if(!$post){
            redirect()->back();
        }  
        //recupera as imagens da galeria do post relacionado       
        $imagem = PostImg::where('post_id', $id)->get();               
        for ($i=0; $i < count($imagem) ; $i++) {            
            //delete o arquivo
            Storage::disk('public')->delete($imagem[$i]->img);
            //deleta o registro no banco
            $imagem[$i]->delete();
        }         
         
        //Deleta a imagem de destaque, verifica se pelo nome, se ela existe o storage, e deleta do storage
        if(Storage::exists($post->img_destaque)){
            Storage::delete($post->img_destaque);
        }       

        $post->delete();
        toast('Post excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('posts.index');        
        
    }
}
