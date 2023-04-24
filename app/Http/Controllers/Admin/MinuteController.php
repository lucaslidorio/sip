<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUpdateMinuteController;
use App\Models\AttachmentMinute;
use App\Models\Councilor;
use App\Models\Legislature;
use App\Models\Minute;
use App\Models\Period;
use App\Models\TypeMinutes;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MinuteController extends Controller
{
    private $repository, $type, $legislature, $section, $period, $councilor ;

    public function __construct(
        Minute $minute,
        TypeMinutes $type,
        Legislature $legislature,
        Section $section,
        Period $period,
        Councilor $councilor,
        )
    {
        $this->repository = $minute;
        $this->type = $type;
        $this->legislature = $legislature;
        $this->section = $section;
        $this->period = $period;
        $this->councilor = $councilor;
    }

    public function index()
    {
        $minutes = $this->repository->paginate(3);
        return view('admin.pages.minutes.index', compact('minutes'));
    }
    
    public function create()
    {
        $types = $this->type->get();
        $legislatures = $this->legislature->get();
        $sections = $this->section->get();
        $periods = $this->period->get();
        //retorna os vereadores da legislatura atual
        $councilors = $this->councilor->where('atual', 1)->get();

        return view('admin.pages.minutes.create',[
            'types' => $types,
            'legislatures' => $legislatures,
            'sections' => $sections,
            'periods' => $periods,
            'councilors' => $councilors,
        ]);
    }

    public function store(StoreUpdateMinuteController $request)
    {
    
        $dadosMinute = new Minute();
        $dadosMinute = $request->except('anexo', 'councilors');
        $user = auth()->user();
        $dadosMinute['user_id'] = $user->id;
        //Insere os dados na tabela minute e retorna o id do registro
        $dadosMinute = $this->repository->create($dadosMinute);

        //pega os checkbox de vereadores marcados e grava tabela
        $request->only('councilors');       
        if($request->councilors){
           for ($i=0; $i < count($request->councilors) ; $i++) { 
               $councilorMinute = ($request->councilors[$i]);
               $dadosMinute->councilors()->attach($councilorMinute);
           }
        }  
       //Grava os anexos na tabela attachment_minutes 
       $anexo =  $request->only('anexo');
       if($request->hasFile('anexo')){
           for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
               $file= $anexo['anexo'][$i];
               $nome_original =Str::upper($anexo['anexo'][$i]->getClientOriginalName()) ;
               $anexoMinute = new AttachmentMinute();
               $anexoMinute->minute_id = $dadosMinute->id;
               $anexoMinute->anexo= $file->store('minutes');
               $anexoMinute->nome_original = $nome_original;
               $anexoMinute->save();
               unset($anexoMinute);       
                   }                   
       }

        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();

    }

    
    public function show($id)
    {
        $minute = $this->repository->where('id', $id)->first();
        $councilors = $this->councilor->where('atual', 1)->get();

        if(!$minute){
            return redirect()->back();
        }

        
        return view('admin.pages.minutes.show',[
            'minute' =>$minute,
            'councilors' =>$councilors
        ]);
    }

    
    public function edit($id)
    {
        if(!$minute = Minute::find($id))
        {
            return redirect()->back();

        }
         //recupera o post pelo id 
         $minute = $this->repository->where('id', $id)->first();
         $types = $this->type->get();
         $legislatures = $this->legislature->get();
         $sections = $this->section->get();
         $periods = $this->period->get();
         //retorna os vereadores da legislatura atual
         $councilors = $this->councilor->where('atual', 1)->get();
 
         return view('admin.pages.minutes.edit',[
             'minute' => $minute,
             'types' => $types,
             'legislatures' => $legislatures,
             'sections' => $sections,
             'periods' => $periods,
             'councilors' => $councilors,
         ]);
    }

    
    public function update(StoreUpdateMinuteController $request, $id)
    {
        //recupera o post pelo id 
        $minute  = $this->repository->where('id', $id)->first();
        if(!$minute){
            redirect()->back();
        }      
        
        
        $dadosMinute = $request->except('anexo', 'councilors');
        $user = auth()->user();
        $dadosMinute['user_id'] = $user->id;
        //Atualiza os dados na tabela minute e retorna o id do registro
        
        $minute->update($dadosMinute);
        
        
       //Captura os checkbox de vereadores marcados e grava tabela
       $request->only('councilors');       
       if($request->councilors){
          for ($i=0; $i < count($request->councilors) ; $i++) { 
              $councilorMinute[] = ($request->councilors[$i]);
              $minute->councilors()->sync($councilorMinute);
          }
       }  
        //Grava os anexos na tabela attachment_minutes 
       $anexo =  $request->only('anexo');
       if($request->hasFile('anexo')){
           for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
               $file= $anexo['anexo'][$i];
               $nome_original =Str::upper($anexo['anexo'][$i]->getClientOriginalName()) ;
               $anexoMinute = new AttachmentMinute();
               $anexoMinute->minute_id = $minute->id;
               $anexoMinute->anexo= $file->store('minutes');
               $anexoMinute->nome_original = $nome_original;
               $anexoMinute->save();
               unset($anexoMinute);       
            }                   
       }
        toast('Cadastro atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('minutes.index');   

    }
    public function deleteAttachment($id)
    {
        //Recupera a anexo pelo id
        $anexo = AttachmentMinute::where('id', $id)->first();
        //Verifica se pelo nome, se ela existe o storage, e deleta do storage
        if(Storage::disk('s3')->exists($anexo->anexo)){
            Storage::disk('s3')->delete($anexo->anexo);
        }
        //deleta a referência do banco
        $anexo->delete();  
        toast('Anexo  removido com sucesso!','success')->toToast('top') ;        
        return redirect()->back();
    }


    
    public function destroy($id)
    {
       
        //recupera o post pelo id
        $minute  = $this->repository->where('id', $id)->first();
        if(!$minute){
            redirect()->back();
        }                       

        $minute->delete();
        toast('Ata excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('minutes.index');       
    }



    //metodo de pesquisa
    public function search(Request $request)
    {
         $pesquisar = $request->except('_token');
         $minutes = $this->repository->search($request->pesquisa);

        return view('admin.pages.minutes.index', [
            'minutes' => $minutes,
            'pesquisar' => $pesquisar
        ]);
    }


}
