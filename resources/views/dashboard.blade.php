@extends('adminlte::page')

@section('title', 'Inicio - ')

@section('content_header')
@stop



@section('content')

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$posts}}</h3>

            <p>Posts</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('posts.index')}}" class="small-box-footer">Detalhar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$councilors}}<sup style="font-size: 20px"></sup></h3>

            <p>Vereadores Cadastrados</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{route('councilors.index')}}" class="small-box-footer">Detalhar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$sesssions}}</h3>

            <p>Sessões publicadas</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('sessions.index')}}" class="small-box-footer">Detalhar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$ouvidorias}}</h3>
            <p>Manifestações da ouvidoria</p>
          </div>                    
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('ouvidorias.index')}}" class="small-box-footer">Detalhar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
</div>


@stop
