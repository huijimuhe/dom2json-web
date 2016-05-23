@extends('layout.default')
@section('title')
文章详情
@stop 
@section('content')  
<div class="row ">
    <div class="col-lg-12">
        <div class="box box-widget"> 
            <div class="box-body">  
                <h2>{{$article->title}}</h2>
                <h3>{{$article->url}}</h3>  
                <p>{{$article->present()->thumbImg}} </p> 
                <h5>{{$article->short}}</h5>  
            </div><!-- /.box-body --> 
        </div>  
    </div>
</div> <!-- /.row -->

@stop

@section('scripts')   
@stop