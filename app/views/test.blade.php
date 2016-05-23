@extends('layout.default')
@section('title')
TEST
@stop

@section('content')

<div class="row ">  
    {{ Form::open(['route' => 'postTest', 'method' => 'post', 'files' => true]) }} 
    <div class="col-lg-12">    
        <div class="box">
            <div class="box-header">  
            </div><!-- /.box-header -->
            <div class="box-body pad">    
                <div class="form-group">
                    <script type="text/plain" id="myEditor" name="short" style="width:1000px;height:240px;">
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
    <script type="text/javascript" charset="utf-8" src="{{asset('public/plugins/plupload/plupload.full.min.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('public/plugins/plupload/i18n/zh_CN.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('public/plugins/qiniu/qiniu.min.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('public/plugins/qiniu/qiniu.progress2.js?v=1')}}"></script> 
    <!-- umeditor-->
    <script src="{{asset('public/plugins/umeditor/umeditor.config.js')}}"></script>   
    <script src="{{asset('public/plugins/umeditor/umeditor.min.js')}}"></script>   
    <script type="text/javascript">
$(function() {
    var um = UM.getEditor('myEditor', {
        toolbar: ['undo redo | bold italic underline | image']
    });
    //7niu-上传图片
    uploadImg('img', '{{route('oss.token')}}');
});

    </script>
    @stop