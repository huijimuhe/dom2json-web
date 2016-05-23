@extends('layout.default')
@section('title')
新建或编辑文章
@stop

@section('content')

<div class="row ">  
    {{ Form::open(['route' => 'articles.store', 'method' => 'post', 'files' => true]) }} 
    <div class="col-lg-12">    
        <div class="box">
            <div class="box-header">  
            </div><!-- /.box-header -->
            <div class="box-body pad">    
                <div class="form-group">
                    {{ Form::label('title','标题',array('class' => 'sr-only' )) }} 
                    {{ Form::text('title',null,array('class' => 'form-control','placeholder'=>'请输入标题' )) }}
                </div>
                <div class="form-group">
                    <script type="text/plain" id="myEditor" name="text" style="width:1000px;height:240px;">
                        <p>text1</p>
                    </script> 
                </div> 

            </div>
            <div class="box-footer">
                {{ Form::submit('确定', array('class' => 'btn btn-lg btn-primary btn-block')) }} 
            </div>
        </div>
        <!-- general form elements --> 
        {{Form::close()}} 
    </div>
    @stop
    @section('scripts') 
    <!-- umeditor-->
    <script src="{{asset('public/plugins/umeditor/umeditor.config.js')}}"></script>   
    <script src="{{asset('public/plugins/umeditor/umeditor.min.js')}}"></script>   
    <script type="text/javascript">
        $(function() {
        var um = UM.getEditor('myEditor', {
        toolbar: ['undo redo | bold italic underline | image']
        });
        });
    </script>
    @stop