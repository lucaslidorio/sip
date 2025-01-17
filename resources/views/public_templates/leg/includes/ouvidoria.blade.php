<div class="container col-md-12 col-sm-12">
    <section class="quick-access">
        <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
            <h1>
                <span>
                    Ouvidoria
                </span>
            </h1>
        </div>
       
        <ul class="row lista1">           
            <li class="col-md-3 col-sm-6 col-xs-6 " >
                <a>
                        <i class="fa-solid fa-magnifying-glass"></i> 
                        <form action="{{route('ouvidoria.acompanhamento')}}" method="get">
                          @csrf
                            <input class="form-control form-control-lg" name="codigo" type="text" placeholder="Protocolo" required minlength="5">
                            
                            <button type="submit" class="btn btn-outline-dark btn-lg mt-3"> 
                                Consultar Protocolo                               
                            </button>
                            <br>  
                                               
                             
                        </form>                       
                    </a>
                                   
            </li>
           
            <li class="col-md-3 col-sm-6 col-xs-6">
                <a href="{{route('ouvidoria.create', 1)}}"> {{-- 1 = Reclamação --}} 
                    <i class="fas fa-headset" aria-hidden="true"></i><br />
                    Reclamações
                </a>
            </li>

            <li class="col-md-6 col-sm-6 col-xs-6">
                <a href="{{route('ouvidoria.create',2)}}"> {{-- 2 = Elogio --}} 
                    <i class="fas fa-headphones" aria-hidden="true"></i><br />
                    Elogio
                </a>
            </li>

            <li class="col-md-3 col-sm-6 col-xs-6">
                <a href="{{route('ouvidoria.create', 3)}}"> {{-- 3 = Solicitação --}} 
                    <i class="fas fa-stream" aria-hidden="true"></i> <br />
                    Solicitação
                </a>
            </li>

            <li class="col-md-3 col-sm-6 col-xs-6">
                <a href="{{route('ouvidoria.create', 4)}}"> {{-- 4 = Sugestão --}}
                    <i class="far fa-list-alt" aria-hidden="true"></i><br />
                    Sugestão
                </a>
            </li>            

            <li class="col-md-3 col-sm-6 col-xs-6">
                <a href="{{route('ouvidoria.create', 6)}}">{{-- 6 = Denúncia --}}
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i><br />
                    Denúncia
                </a>
            </li>
            <li class="col-md-3 col-sm-6 col-xs-6">
                <a href="{{route('ouvidoriaSite.duvidas')}}">
                    <i class="fas fa-clipboard-list" aria-hidden="true"></i><br />
                    Dúvidas
                </a>
            </li>
        </ul>
    </section>
</div>
