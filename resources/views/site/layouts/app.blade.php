<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="author" content="Grayrids">
  @foreach ($tenants as $tenant)      
  @endforeach
  <title>{{$tenant->nome}}</title>
  @include('site.layouts.css')
  
</head>

<body>
  {{-- Loop para para mostra a legislatura atual --}}
  @foreach ($legislatures as $legislature)

  @endforeach
 
  <!-- Header Section Start -->
  <header id="slider-area">
    <!-- Menu-->
    @include('site.layouts.includes.menu')
    <!-- Fim Menu -->
    @include('site.layouts.includes.slide')
  </header>
  <!-- Header Section End -->

  <!-- Services Section Start -->
  <section id="camara" class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Our
          <span>Services</span></h2>
        <hr class="lines wow zoomIn" data-wow-delay="0.3s">
        <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Lorem ipsum dolor sit
          amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.
        </p>
      </div>
      <div class="row align-items-center">
        <div class="col-md-4 col-sm-6">
          <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
            <div class="icon">
              <i class="lnr lnr-pencil"></i>
            </div>
            <h4>Content Writing</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="item-boxes wow fadeInDown" data-wow-delay="0.4s">
            <div class="icon">
              <i class="lnr lnr-cog"></i>
            </div>
            <h4>Web Development</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="item-boxes wow fadeInDown" data-wow-delay="0.6s">
            <div class="icon">
              <i class="lnr lnr-chart-bars"></i>
            </div>
            <h4>Graphic Design</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="item-boxes wow fadeInDown" data-wow-delay="0.8s">
            <div class="icon">
              <i class="lnr lnr-layers"></i>
            </div>
            <h4>UI/UX Design</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="item-boxes wow fadeInDown" data-wow-delay="1s">
            <div class="icon">
              <i class="lnr lnr-tablet"></i>
            </div>
            <h4>App Development</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="item-boxes wow fadeInDown" data-wow-delay="1.2s">
            <div class="icon">
              <i class="lnr lnr-briefcase"></i>
            </div>
            <h4>Digital Marketing</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Services Section End -->

  <!-- Features Section Start -->
  <section id="features" class="section" data-stellar-background-ratio="0.2">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Amazing <span>Features</span></h2>
        <hr class="lines">
        <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br>
          nibh euismod tincidunt ut laoreet dolore magna.</p>
      </div>
      <div class="row align-items-center">
        <div class="col-lg-4 col-sm-6">
          <div class="content-left text-md-right">
            <div class="box-item left">
              <span class="icon">
                <i class="lnr lnr-rocket"></i>
              </span>
              <div class="text">
                <h4>Bootstrap 4 Based</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
            </div>
            <div class="box-item left">
              <span class="icon">
                <i class="lnr lnr-laptop-phone"></i>
              </span>
              <div class="text">
                <h4>Fully Responsive</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
            </div>
            <div class="box-item left">
              <span class="icon">
                <i class="lnr lnr-cog"></i>
              </span>
              <div class="text">
                <h4>HTML5, CSS3 & LESS</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-none d-lg-flex">
          <div class="show-box">
            <img src="site/img/features/feature.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="content-right text-left">
            <div class="box-item right">
              <span class="icon">
                <i class="lnr lnr-select"></i>
              </span>
              <div class="text">
                <h4>4 Variations</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
              </div>
            </div>
            <div class="box-item right">
              <span class="icon">
                <i class="lnr lnr-magic-wand"></i>
              </span>
              <div class="text">
                <h4>Feature-rich Sections</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
            </div>
            <div class="box-item right">
              <span class="icon">
                <i class="lnr lnr-spell-check"></i>
              </span>
              <div class="text">
                <h4>Ajax Contact Form</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Features Section End -->

  <!-- Start Video promo Section -->
  <section class="video-promo section" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="video-promo-content text-center">
            <h2 class="wow zoomIn" data-wow-duration="1000ms" data-wow-delay="100ms">Our Introductory Video</h2>
            <p class="wow zoomIn" data-wow-duration="1000ms" data-wow-delay="100ms">Learn more about us, its only
              30mins</p>
            <a href="https://www.youtube.com/watch?v=r44RKWyfcFw" class="video-popup"><i
                class="lnr lnr-film-play"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Video Promo Section -->

  @include('site.layouts.includes.sobre')

  <!-- Start Pricing Table Section -->
  <div id="pricing" class="section pricing-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Pricing <span>Plans</span></h2>
        <hr class="lines">
        <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br>
          nibh euismod tincidunt ut laoreet dolore magna.</p>
      </div>

      <div class="row pricing-tables">
        <div class="col-lg-4 col-sm-6">
          <div class="pricing-table table-left mb-4">
            <div class="icon">
              <i class="lnr lnr-rocket"></i>
            </div>
            <div class="pricing-details">
              <h2>Starter Plan</h2>
              <span>Free</span>
              <ul>
                <li>Consectetur adipiscing</li>
                <li>Nunc luctus nulla et tellus</li>
                <li>Suspendisse quis metus</li>
                <li>Vestibul varius fermentum erat</li>
              </ul>
            </div>
            <div class="plan-button">
              <a href="#" class="btn btn-common">Get Plan</a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-sm-6">
          <div class="pricing-table mb-4">
            <div class="icon">
              <i class="lnr lnr-heart"></i>
            </div>
            <div class="pricing-details">
              <h2>Popular Plan</h2>
              <span>$3.99</span>
              <ul>
                <li>Consectetur adipiscing</li>
                <li>Nunc luctus nulla et tellus</li>
                <li>Suspendisse quis metus</li>
                <li>Vestibul varius fermentum erat</li>
              </ul>
            </div>
            <div class="plan-button">
              <a href="#" class="btn btn-common">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-sm-6">
          <div class="pricing-table table-left mb-4">
            <div class="icon">
              <i class="lnr lnr-magic-wand"></i>
            </div>
            <div class="pricing-details">
              <h2>Premium Plan</h2>
              <span>$9.50</span>
              <ul>
                <li>Consectetur adipiscing</li>
                <li>Nunc luctus nulla et tellus</li>
                <li>Suspendisse quis metus</li>
                <li>Vestibul varius fermentum erat</li>
              </ul>
            </div>
            <div class="plan-button">
              <a href="#" class="btn btn-common">Buy Now</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- End Pricing Table Section -->

  <!-- Counter Section Start -->
  <div class="counters section" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="lnr lnr-magic-wand"></i>
            </div>
            <div class="fact-count">
              <h3><span class="counter">100</span>%</h3>
              <h4>Faster</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="lnr lnr-coffee-cup"></i>
            </div>
            <div class="fact-count">
              <h3><span class="counter">700</span></h3>
              <h4>Cup of Coffee</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="lnr lnr-user"></i>
            </div>
            <div class="fact-count">
              <h3><span class="counter">10000</span>+</h3>
              <h4>Active Clients</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="lnr lnr-heart"></i>
            </div>
            <div class="fact-count">
              <h3><span class="counter">1689</span></h3>
              <h4>Peoples Love</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Counter Section End -->

  <!-- testimonial Section Start -->
  <div id="testimonial" class="section">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-10">
          <div class="touch-slider owl-carousel owl-theme">
            <div class="testimonial-item">
              <img src="site/img/testimonial/customer1.png" alt="Client Testimonoal" />
              <div class="testimonial-text">
                <p>Morbi eget dictum enim. Praesent sed quam sit amet lorem tempor rhoncus.
                  <br class="d-none d-lg-block"> In hac habitasse platea dictumst. Vivamus in accumsan ex</p>
                <h3>Johnathan Doe</h3>
                <span>Marketing Head Matrix media</span>
              </div>
            </div>
            <div class="testimonial-item">
              <img src="site/img/testimonial/customer2.png" alt="Client Testimonoal" />
              <div class="testimonial-text">
                <p>Morbi eget dictum enim. Praesent sed quam sit amet lorem tempor rhoncus.
                  <br class="d-none d-lg-block"> In hac habitasse platea dictumst. Vivamus in accumsan ex</p>
                <h3>Oidila Matik</h3>
                <span>President Lexo Inc</span>
              </div>
            </div>
            <div class="testimonial-item">
              <img src="site/img/testimonial/customer3.png" alt="Client Testimonoal" />
              <div class="testimonial-text">
                <p>Morbi eget dictum enim. Praesent sed quam sit amet lorem tempor rhoncus.
                  <br class="d-none d-lg-block"> In hac habitasse platea dictumst. Vivamus in accumsan ex</p>
                <h3>- Alex Dattilo</h3>
                <span>CEO Optima Inc</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- testimonial Section Start -->

  <!-- Download Section Start -->
  <section id="download" class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title"><span>Download</span> Our App</h2>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="download-area text-center">
            <a href="#" class="btn btn-border"><i class="fa fa-apple"></i>Download Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Download Section End -->

  <!-- Team section Start -->
  @include('site.layouts.includes.vereadores')
  <!-- Team section End -->

  <!-- Clients Section -->
  <div id="clients" class="section">
    <!-- Container Ends -->
    <div class="container">
      <!-- Row and Scroller Wrapper Starts -->
      <div class="row" id="clients-scroller">
        <div class="client-item-wrapper">
          <img src="site/img/clients/img1.png" alt="">
        </div>
        <div class="client-item-wrapper">
          <img src="site/img/clients/img2.png" alt="">
        </div>
        <div class="client-item-wrapper">
          <img src="site/img/clients/img3.png" alt="">
        </div>
        <div class="client-item-wrapper">
          <img src="site/img/clients/img4.png" alt="">
        </div>
        <div class="client-item-wrapper">
          <img src="site/img/clients/img5.png" alt="">
        </div>
        <div class="client-item-wrapper">
          <img src="site/img/clients/img6.png" alt="">
        </div>
      </div>
    </div>
  </div>
  <!-- Client Section End -->

  <!-- Blog Section -->
  @include('site.layouts.includes.noticias')
  <!-- blog Section End -->

  <!-- Contact Section Start -->
  <section id="contato" class="section">
    <div class="contact-form">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-9">
            <div class="contact-block">
              <div class="section-header">
                <h2 class="section-title">Contact <span>Us</span></h2>
                <hr class="lines">
              </div>
              <form id="contactForm">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required
                        data-error="Please enter your name">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" placeholder="Your Email" id="email" class="form-control" name="name" required
                        data-error="Please enter your email">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" placeholder="Subject" id="msg_subject" class="form-control" required
                        data-error="Please enter your subject">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" id="message" placeholder="Your Message" rows="11"
                        data-error="Write your message" required></textarea>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="submit-button text-center">
                      <button class="btn btn-common" id="submit" type="submit">Send Message</button>
                      <div id="msgSubmit" class="h3 text-center hidden"></div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </section>
  <!-- Contact Section End -->

  <!-- Subcribe Section Start -->
  <div id="subscribe" class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Subscribe <span>Newsletter</span></h2>
        <hr class="lines">
        <p class="section-subtitle">Subscribe to get all latest news from us.</p>
      </div>
      <div class="row justify-content-md-center">
        <div class="col-md-8">
          <form class="text-center form-inline position-relative">
            <input class="mb-20 form-control" name="email" placeholder="Your Email Address">
            <button class="sub_btn">subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Subcribe Section End -->
  <!-- Rodapé -->
  @include('site.layouts.includes.rodape')
  <!-- Fim Rodapé -->
 
 
  <!-- Go To Top Link -->
  <a href="#" class="back-to-top">
    <i class="lnr lnr-arrow-up"></i>
  </a>

  <div id="loader">
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
    </div>
  </div>


  <!-- jQuery first, then Tether, then Bootstrap JS. -->
  <script src="site/js/jquery-min.js"></script>
  <script src="site/js/popper.min.js"></script>
  <script src="site/js/bootstrap.min.js"></script>
  <script src="site/js/classie.js"></script>
  <script src="site/js/jquery.mixitup.js"></script>
  <script src="site/js/nivo-lightbox.js"></script>
  <script src="site/js/owl.carousel.js"></script>
  <script src="site/js/jquery.stellar.min.js"></script>
  <script src="site/js/jquery.nav.js"></script>
  <script src="site/js/scrolling-nav.js"></script>
  <script src="site/js/jquery.easing.min.js"></script>
  <script src="site/js/wow.js"></script>
  <script src="site/js/menu.js"></script>
  <script src="site/js/jquery.counterup.min.js"></script>
  <script src="site/js/jquery.magnific-popup.min.js"></script>
  <script src="site/js/waypoints.min.js"></script>
  <script src="site/js/form-validator.min.js"></script>
  <script src="site/js/contact-form-script.js"></script>
  <script src="site/js/main.js"></script>

  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHo_WtZ2nIYCgCLf7sINZaqcrpqSDio9o"></script>
  <!-- Google Maps JS Only for Contact Pages -->
  <script type="text/javascript">
    var map;
    var defult = new google.maps.LatLng(44.2072183, -101.3681486);
    var mapCoordinates = new google.maps.LatLng(44.2072183, -101.3681486);


    var markers = [];
    var image = new google.maps.MarkerImage(
      'site/img/map-marker.png',
      new google.maps.Size(84, 70),
      new google.maps.Point(0, 0),
      new google.maps.Point(60, 60)
    );

    function addMarker() {
      markers.push(new google.maps.Marker({
        position: defult,
        raiseOnDrag: false,
        icon: image,
        map: map,
        draggable: false
      }));

    }

    function initialize() {
      var mapOptions = {
        backgroundColor: "#fff",
        zoom: 8,
        disableDefaultUI: true,
        center: mapCoordinates,
        zoomControl: false,
        scaleControl: false,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [{
            "featureType": "landscape.natural",
            "elementType": "geometry.fill",
            "stylers": [{
              "color": "#ffffff"
            }]
          }, {
            "featureType": "landscape.man_made",
            "stylers": [{
              "color": "#ffffff"
            }, {
              "visibility": "off"
            }]
          }, {
            "featureType": "water",
            "stylers": [{
              "color": "#80C8E5"
            }, {
              "saturation": 0
            }]
          }, {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [{
              "color": "#999999"
            }]
          }, {
            "elementType": "labels.text.stroke",
            "stylers": [{
              "visibility": "off"
            }]
          }, {
            "elementType": "labels.text",
            "stylers": [{
              "color": "#333333"
            }]
          }

          , {
            "featureType": "road.local",
            "stylers": [{
              "color": "#dedede"
            }]
          }, {
            "featureType": "road.local",
            "elementType": "labels.text",
            "stylers": [{
              "color": "#666666"
            }]
          }, {
            "featureType": "transit.station.bus",
            "stylers": [{
              "saturation": -57
            }]
          }, {
            "featureType": "road.highway",
            "elementType": "labels.icon",
            "stylers": [{
              "visibility": "off"
            }]
          }, {
            "featureType": "poi",
            "stylers": [{
              "visibility": "off"
            }]
          }

        ]

      };
      map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
      addMarker();

    }
    google.maps.event.addDomListener(window, 'load', initialize);
  </script>

</body>

</html>