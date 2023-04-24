<!doctype html>
<html class="no-js" lang="zxx">
    @include('site.executivo.includes.head')
    <style>
        .img-mini{
            max-width:40px;
            max-height:40px;
            width: auto;
            height: auto;
        }

    </style>
<body>
    <header>
        <div class="header-area">
            <div class="main-header ">
                @include('site.executivo.includes.header-top')
                @include('site.executivo.includes.menu')                
            </div>
        </div>
    </header>
  <main>
    <!-- Hero area Start-->
    <div class="slider-area">
      <div class="slider-height2 slider-bg6 hero-overly02 d-flex align-items-center">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-6">
              <div class="hero-caption hero-caption2 text-center">
                <h2>{{$post->titulo}}</h2>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    <!--  Hero area End -->
    <!-- Blog Area Start -->
    <section class="blog_area single-post-area section-padding">
     <div class="container">
      <div class="row">
       <div class="col-lg-8 posts-list">
        <div class="single-post">
         <div class="feature-img">
          <img class="img-fluid" src="{{config('app.aws_url')."{$post->img_destaque}" }}" alt="">
        </div>
        <div class="blog_details">
          <h2 style="color: #2d2d2d;">{{$post->titulo}}
         </h2>
         <ul class="blog-info-link mt-3 mb-4">
           <li><a href="#"><i class="fa fa-user"></i> {{$post->user->name}}</a></li>
           <li><a href="#"><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($post->data_publicacao)->format('d/m/Y')}}</a></li>
         </ul>
         <div>
            @isset($post)
                <p>{!!$post->conteudo!!}</p>  
                @endisset
         </div>
         
        
     </div>
   </div>
   <div class="navigation-top">
     <div class="d-sm-flex justify-content-between text-center">
      {{-- <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span> Lily and 4
      people like this</p> --}}
      <div class="col-sm-4 text-center my-2 my-sm-0">
      </div>
      <ul class="social-icons">
        <li><a href="" id="whatsapp-share-btt" rel="nofollow" target="_blank"><i class="fab fa-whatsapp fa-2x text-success"></i></a></li>
       <li><a href="" id="facebook-share-btt" rel="nofollow" target="_blank" class="facebook-share-button"><i class="fab fa-facebook fa-2x"></i></a></li>
        </ul>
   </div>
   <div class="navigation-area">
    <div class="row">
     <div
     class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
     <div class="thumb">
       <a href="#">
        <img class="img-fluid" src="assets/img/post/preview.jpg" alt="">
      </a>
    </div>
    <div class="arrow">
     <a href="#">
      <span class="lnr text-white ti-arrow-left"></span>
    </a>
  </div>
  <div class="detials">
   <p>Anterior</p>
   <a href="#">
    <h4 style="color: #2d2d2d;">{{$post->noticiaAnterior($post->id)->titulo}}Space The Final Frontier</h4>
  </a>
</div>
</div>
<div
class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
<div class="detials">
 <p>Next Post</p>
 <a href="#">
  <h4 style="color: #2d2d2d;">Telescopes 101</h4>
</a>
</div>
<div class="arrow">
 <a href="#">
  <span class="lnr text-white ti-arrow-right"></span>
</a>
</div>
<div class="thumb">
 <a href="#">
  <img class="img-fluid" src="assets/img/post/next.jpg" alt="">
</a>
</div>
</div>
</div>
</div>
</div>
{{-- <div class="blog-author">
 <div class="media align-items-center">
  <img src="assets/img/blog/author.png" alt="">
  <div class="media-body">
   <a href="#">
    <h4>Harvard milan</h4>
  </a>
  <p>Second divided from form fish beast made. Every of seas all gathered use saying you're, he
  our dominion twon Second divided from</p>
</div>
</div>
</div> --}}
<div class="comments-area">

 

<div class="comment-list">
  <div class="single-comment justify-content-between d-flex">
   <div class="user justify-content-between d-flex">
  
   <div class="desc">
    
    {{-- <div class="d-flex justify-content-between">
      <div class="d-flex align-items-center">
       <h5>
        <a href="#">Emilly Blunt</a>
      </h5>
      <p class="date">December 4, 2017 at 3:12 pm </p>
    </div>
    <div class="reply-btn">
     <a href="#" class="btn-reply text-uppercase">reply</a>
   </div>
 </div> --}}
</div>
</div>
</div>
</div>
</div>
<div class="">
{{-- <h4>Leave a Reply</h4>
  <form class="form-contact comment_form" action="#" id="commentForm">
  <div class="row">
   <div class="col-12">
    <div class="form-group">
     <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
     placeholder="Write Comment"></textarea>
   </div>
 </div>
 <div class="col-sm-6">
  <div class="form-group">
   <input class="form-control" name="name" id="name" type="text" placeholder="Name">
 </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
   <input class="form-control" name="email" id="email" type="email" placeholder="Email">
 </div>
</div>
<div class="col-12">
  <div class="form-group">
   <input class="form-control" name="website" id="website" type="text" placeholder="Website">
 </div>
</div>
</div>
<div class="form-group">
 <button type="submit" class="button button-contactForm btn_1 boxed-btn">Post Comment</button>
</div>
</form> --}}
</div>
</div>
<div class="col-lg-4">
  <div class="blog_right_sidebar">
   <aside class="single_sidebar_widget search_widget">
    <form action="#">
     <div class="form-group m-0">
       <div class="input-group">
         <input type="text" class="form-control" placeholder="Pesquisar">
         <div class="input-group-append d-flex">
           <button class="boxed-btn2" type="button">Pesquisar</button>
         </div>
       </div>
     </div>
   </form>
 </aside>
 <aside class="single_sidebar_widget post_category_widget">
  <h4 class="widget_title" style="color: #2d2d2d;">Categoria</h4>
  <ul class="list cat-list">
   @foreach ($categories as $item)
    <li>
        <a href="{{route('site.noticias',$item->url)}}" class="d-flex">
            <p>{{$item->nome}} </p>
            <p>&nbsp({{$item->posts->count()}})</p>
        </a>
        </li>
   @endforeach
</ul>
</aside>
<aside class="single_sidebar_widget popular_post_widget">
  <h3 class="widget_title" style="color: #2d2d2d;">Ultimas Noticias</h3>
  @foreach ($posts as $post)
  <div class="media post_item">
    <img src="{{config('app.aws_url')."{$post->img_destaque}" }}" class="img-mini" alt="post">
    <div class="media-body">
     <a href="{{route('noticia.show', $post->url)}}">
      <h3 style="color: #2d2d2d;">{{$post->titulo}}</h3>
    </a>
    <p>{{\Carbon\Carbon::parse($post->data_publicacao)->format('d/m/Y')}}</p>
     </div>
 </div>
  @endforeach
</aside>
<aside class="single_sidebar_widget tag_cloud_widget">
  <h4 class="widget_title" style="color: #2d2d2d;">Tags</h4>
  <ul class="list">
   @foreach ($post->categories as $item)
   <li>
        <a href="{{route('site.noticias', $item->url)}}">{{$item->nome}}</a>
  </li>
   @endforeach
 
</ul>
{{-- </aside>
<aside class="single_sidebar_widget instagram_feeds">
  <h4 class="widget_title" style="color: #2d2d2d;">Instagram Feeds</h4>
  <ul class="instagram_row flex-wrap">
   <li>
    <a href="#">
     <img class="img-fluid" src="assets/img/post/post_5.jpg" alt="">
   </a>
 </li>
 <li>
  <a href="#">
   <img class="img-fluid" src="assets/img/post/post_6.jpg" alt="">
 </a>
</li>
<li>
  <a href="#">
   <img class="img-fluid" src="assets/img/post/post_7.jpg" alt="">
 </a>
</li>
<li>
  <a href="#">
   <img class="img-fluid" src="assets/img/post/post_8.jpg" alt="">
 </a>
</li>
<li>
  <a href="#">
   <img class="img-fluid" src="assets/img/post/post_9.jpg" alt="">
 </a>
</li>
<li>
  <a href="#">
   <img class="img-fluid" src="assets/img/post/post_10.jpg" alt="">
 </a>
</li>
</ul>
</aside> --}}
{{-- <aside class="single_sidebar_widget newsletter_widget">
  <h4 class="widget_title" style="color: #2d2d2d;">Newsletter</h4>
  <form action="#">
   <div class="form-group">
    <input type="email" class="form-control" onfocus="this.placeholder = ''"
    onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
  </div>
  <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Subscribe</button>
</form>
</aside> --}}
</div>
</div>
</div>
</div>
</section>
<!-- Blog Area End -->
</main>
@include('site.executivo.includes.footer')
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
<!-- Jquery, Popper, Bootstrap -->
@include('site.executivo.includes.js')

<script>
    //Constrói a URL depois que o DOM estiver pronto compartilhamento whatsapp
document.addEventListener("DOMContentLoaded", function() {
    //conteúdo que será compartilhado: Título da página + URL
    var titulo = document.getElementById("titulo").innerHTML;
    var conteudo = encodeURIComponent(titulo + " - "+ document.title + " " + window.location.href);
    //altera a URL do botão
    document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;
    document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
}, false); 


 lc_lightbox('.galeria_post', {
   wrap_class:'lcl_fade_oc',
   gallery:true,
   counter: true,
   fullscreen: true,
   download: true,
 })
</script>

</body>
</html>