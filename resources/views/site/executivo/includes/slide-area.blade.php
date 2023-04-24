<div class="slider-area">
            <div class="slider-active dot-style">
                <!-- Single Slider -->
                @foreach ($posts as $post)
                <div class="single-slider slider-height hero-overly slider-bg1 d-flex align-items-center">
                    <div class="container justify-content-center">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-caption text-center">
                                    <h1 data-animation="fadeInUp" data-delay=".4s">{{$post->titulo}}</h1>                                                                           
                                    <a href="services.html" class="btn_1 hero-btn"  data-animation="bounceIn" data-delay=".8s">LEIA MAIS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    
                @endforeach
                <!-- Single Slider -->
                {{-- <div class="single-slider slider-height hero-overly slider-bg1 d-flex align-items-center">
                    <div class="container justify-content-center">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-caption text-center">
                                    <h1 data-animation="fadeInUp" data-delay=".4s">We provide best gardening service</h1>
                                    <p data-animation="fadeInUp" data-delay=".4s">Trust The Grounds Guys professionals to take care of your commercial or residential grounds</p>
                                    <a href="services.html" class="btn_1 hero-btn"  data-animation="bounceIn" data-delay=".8s">View Our Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Slider -->
                <div class="single-slider slider-height hero-overly slider-bg1 d-flex align-items-center">
                    <div class="container justify-content-center">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-caption text-center">
                                    <h1 data-animation="fadeInUp" data-delay=".4s">We provide best gardening service</h1>
                                    <p data-animation="fadeInUp" data-delay=".4s">Trust The Grounds Guys professionals to take care of your commercial or residential grounds</p>
                                    <a href="services.html" class="btn_1 hero-btn"  data-animation="bounceIn" data-delay=".8s">View Our Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>