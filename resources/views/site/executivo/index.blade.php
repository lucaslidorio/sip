<!doctype html>
<html class="no-js" lang="zxx">
    @include('site.executivo.includes.head')
<body class="">
    <header>
        <div class="header-area">
            <div class="main-header ">
                @include('site.executivo.includes.header-top')
                @include('site.executivo.includes.menu')                
            </div>
        </div>
    </header>
    <main>
        <!-- slider Area Start-->
        @include('site.executivo.includes.slide-area')
        <!-- slider Area End-->
        <!-- Services Area Start -->
       @include('site.executivo.includes.servicos-online')
        <!-- Services Area End -->
        <!-- links-uteis Area Start -->
       @include('site.executivo.includes.links-uteis')
       <!-- links-uteis Area End -->
        <!-- About -->
       
        <div class="about-area section-bg2">
            <div class="container">
                <div class="row align-items-end">
                    <div class="offset-xl-1 offset-lg-1 col-xl-6 col-lg-6 col-md-10">
                        <div class="about-cap-Left">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle2  mb-50">
                                <h2>We have been designing gardens since 1990</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante nisl, non feugiat null fermentum lobortis. Aenean placerat ipsum ut velit elementum, in sodales tellus viverra. Phasellus vestibulum, ex non lobortis faucibus.</p>
                            </div>
                            
                            <img src="{{asset('img/gallery/about1.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-10">
                        <div class="right-caption">
                            <!-- Section Tittle -->
                            <div class="small-tittle mb-50">
                                <h4>Our Mission</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante nisl, non feugiat null fermentum lobortis.</p>
                            </div>
                            <!-- Section Tittle -->
                            <div class="small-tittle mb-50">
                                <h4>Our Mission</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante nisl, non feugiat null fermentum lobortis.</p>
                            </div>
                            <a href="#" class="btn_01 about-btn">Learn More About Us</a>
                            <img src="{{asset('img/gallery/about2.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Area End-->
        <!-- Our Services Start -->
        <section class="our-services2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 p-0">
                        <div class="single-services">
                            <div class="services-ion">
                                <img src="{{asset('img/icon/icon.svg')}}" alt="">
                            </div>
                            <div class="services-cap">
                                <h5><a href="#">We prefer quality first</a></h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante nisl, non feugiat null fermentum lobortis.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 p-0">
                        <div class="single-services">
                            <div class="services-ion">
                                <img src="{{asset('img/icon/icon.svg')}}" alt="">
                            </div>
                            <div class="services-cap">
                                <h5><a href="#">We prefer quality first</a></h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante nisl, non feugiat null fermentum lobortis.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 p-0">
                        <div class="single-services">
                            <div class="services-ion">
                                <img src="{{asset('img/icon/icon.svg')}}" alt="">
                            </div>
                            <div class="services-cap">
                                <h5><a href="#">We prefer quality first</a></h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante nisl, non feugiat null fermentum lobortis.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Our Services End -->
        <!-- location-house start -->
        <div class="location-house fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-11">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-60">
                            <h2>Feature Projects</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row ">
                    <div class="project-active owl-carousel">
                        <!-- Single -->
                        <div class="single-project">
                            <img src="{{asset('img/gallery/project1.jpg')}}" alt="">
                            <div class="project-contents">
                                <h3><a href="#">Lawn removing</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante.</p>
                                <a href="project.html" class="border-btn">View</a>
                            </div>
                        </div>
                        <!-- Single -->
                        <div class="single-project active">
                            <img src="{{asset('img/gallery/project2.jpg')}}" alt="">
                            <div class="project-contents ">
                                <h3><a href="#">Lawn removing</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante.</p>
                                <a href="project.html" class="border-btn">View</a>
                            </div>
                        </div>
                        <!-- Single -->
                        <div class="single-project">
                            <img src="{{asset('img/gallery/project3.jpg')}}" alt="">
                            <div class="project-contents">
                                <h3><a href="#">Lawn removing</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante.</p>
                                <a href="project.html" class="border-btn">View</a>
                            </div>
                        </div>
                        <!-- Single -->
                        <div class="single-project">
                            <img src="{{asset('img/gallery/project4.jpg')}}" alt="">
                            <div class="project-contents">
                                <h3><a href="#">Lawn removing</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante.</p>
                                <a href="project.html" class="border-btn">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- location-hou-->
        <!-- Visit Our Tailor Start -->
        <div class="visit-tailor-area fix">
            <!--Left Contents  -->
            <div class="left-colum"></div>
            <!--Mid Contents -->
            <div class="mid-colum">
                <!--? Testimonial Area Start -->
                <section class="testimonial-area">
                    <div class="h1-testimonial-active">
                        <!-- Single Testimonial -->
                        <div class="single-testimonial position-relative">
                            <div class="testimonial-caption">
                                <img src="{{asset('img/icon/left-quotes-sign.svg')}}" alt="" class="quotes-sign">
                                <h2>Our Commitment</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante nisl, non feugiat null fermentum lobortis. Aenean placerat ipsum ut velit elementum, in sodales tellus viverra. Phasellus vestibulum, ex non lobortis faucibus, odio nibh luctus massa, id volutpat risus nibh ac felis.</p>
                            </div>
                            <!-- founder -->
                            <div class="testimonial-founder d-flex align-items-center">
                                <div class="founder-img">
                                    <img src="{{asset('img/icon/testimonial.png')}}" alt="">
                                </div>
                                <div class="founder-text">
                                    <span>Reuben Sandwich</span>
                                    <p>CEO of Gardening</p>
                                </div>
                            </div>
                        </div>
                        <!-- Single Testimonial -->
                        <div class="single-testimonial position-relative">
                            <div class="testimonial-caption">
                                <img src="{{asset('img/icon/left-quotes-sign.svg')}}" alt="" class="quotes-sign">
                                <h2>Our Commitment</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin ante nisl, non feugiat null fermentum lobortis. Aenean placerat ipsum ut velit elementum, in sodales tellus viverra. Phasellus vestibulum, ex non lobortis faucibus, odio nibh luctus massa, id volutpat risus nibh ac felis.</p>
                            </div>
                            <!-- founder -->
                            <div class="testimonial-founder d-flex align-items-center">
                                <div class="founder-img">
                                    <img src="{{asset('img/icon/testimonial.png')}}" alt="">
                                </div>
                                <div class="founder-text">
                                    <span>Reuben Sandwich</span>
                                    <p>CEO of Gardening</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial End -->
                    <!-- page ling -->
                    <div class="page-links">
                        <a href="#" class="view1">View Services</a>
                    </div>
                </section>
                <!--? Testimonial Area End -->

            </div>
            <!-- Right content -->
            <div class="right-colum">
                <div class="form-wrapper">
                    <div class="form-tittle mb-30">
                        <h2>Get Free Quote</h2>
                    </div>
                    <form id="three-form" action="#" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-box mb-15">
                                    <input type="text" name="name" placeholder="Your name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-box mb-15">
                                    <input type="text" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="single-form">
                                    <div class="select-option">
                                        <select name="select" id="select1">
                                            <option value="">Landscaping</option>
                                            <option value="">Landscaping 1</option>
                                            <option value="">Landscaping 2</option>
                                            <option value="">Landscaping 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-box mb-15">
                                    <textarea name="message" id="message" placeholder="Message"></textarea>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
                <!-- page ling -->
                <div class="page-links">
                    <button class="view2" type="submit">Sent Request</button>
                </div>
            </div>
        </div>
        <!-- Visit Our Tailor End -->
    </main>
    @include('site.executivo.includes.footer')
   <!-- footer-bottom area -->
   <div class="footer-bottom-area">
       <div class="container">
           <div class="footer-border">
               <div class="row d-flex align-items-center">
                   <div class="col-xl-12 ">
                       <div class="footer-copy-right">
                           <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados  <i class="fa fa-heart color-danger" aria-hidden="true"></i> Desenvolvido por <a href="https://fpstecnologia.com.br/" target="_blank" rel="nofollow noopener">FPS Tecnologia</a></p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
</footer>
<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>
<!--? Search model Begin -->
<div class="search-model-box">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-btn">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Searching key.....">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- JS here -->
@include('site.executivo.includes.js')
</body>
</html>