
<section class="categories-area   " style="background-color: #deefe2">
   
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="section-tittle section-tittle3 text-center pb-3 ">
                    <h4>Links Uteís</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($linksUteis as $item)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                <div class="single-cat text-center mb-30">
                    <div class="cat-icon">
                        <img src="{{config('app.aws_url')."{$item->icone}" }}"   alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="{{$item->url}}" target="{{$item->target == 1 ? '_blank' :''}}">{{$item->nome}}</a></h5>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="section-tittle section-tittle3 text-center pt-35">
                    <p>Check out our list of service for your garden and<a href="#"> get free quote</a></p>
                </div>
            </div>
        </div>
    </div>
</section>