<footer>
    <div class="footer-wrappper section-img-bg2" data-background="{{asset('img/gallery/footer-bg.jpg')}}" >
       <div class="footer-area footer-padding">
           <div class="container">
               <div class="row justify-content-between">
                   <div class="col-xl-3 col-lg-5 col-md-5 col-sm-6">
                       <div class="single-footer-caption">
                           <div class="single-footer-caption mb-30">
                               <!-- logo -->
                               <div class="footer-logo mb-25">
                                   {{-- <a href="index.html"><img src="{{asset('img/logo/logo2_footer.png')}}" alt=""></a> --}}
                                   <a href="index.html"><img src="{{config('app.aws_url')."{$tenant->brasao}" }}" alt=""></a>
                               </div>
                               <div class="footer-tittle">
                                   <div class="footer-pera">
                                       <p>{{$tenant->email}}</p>
                                   </div>
                               </div>
                               <!-- social -->
                               <div class="footer-social">
                                <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offset-xl-2 col-xl-2 col-lg-3 col-md-4 col-sm-5">
                   <div class="single-footer-caption mb-20">
                       <div class="footer-tittle">
                           <h4>Serviços</h4>
                           <ul>   
                               <li><a href="#">Lawn removal</a></li>
                               <li><a href="#">Landscaping</a></li>
                               <li><a href="#">Planting</a></li>
                               <li><a href="#">Watering</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                   <div class="single-footer-caption mb-20">
                       <div class="footer-tittle">
                           <h4>Navegação</h4>
                           <ul>
                            @foreach ($menus as $menu) 
                                <li><a href="#">{{$menu->nome}}</a></li>
                            @endforeach                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
               <div class="single-footer-caption mb-20">
                   <div class="footer-tittle">
                       <h4>Contato</h4>
                       <ul class="mb-20">
                           <li class="number2"><a href="#">{{$tenant->email}}</a></li>
                           <li><a href="#">{{$tenant->endereco}} , {{$tenant->numero}} -  
                            {{$tenant->bairro}} - 
                            {{$tenant->cidade}}
                            </a></li>
                           <li class="number"><a href="#">{{$tenant->telefone}}</a></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </div> 
</div>