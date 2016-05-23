@extends('layout.default')
@section('title')
独白列表
@stop

@section('content') 

<div class="row" style="margin-top: 1em;"> 
    <div class="col-lg-12">   
        <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
                <tr> 
                    <th>标题  </th> 
                    <th>操作 </th>
                </tr>
            </thead>
            <tbody>
                @if(count($works)!=0) 
                @foreach ($works as $work)
                <tr> 
                    <td><a href="{{ URL::route('works.show', $work->id) }}">{{$work->title}}</a></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">操作<span class="caret"></span></button>
                            <ul class="dropdown-menu">  
                                <li>{{ Form::open(array('route' => array('works.destroy', $work->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
                                    <button type="submit" class="btn btn-link">删除</button>
                                    {{ Form::close() }}</li> 
                            </ul>
                        </div> 
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>  
        {{$works->links()}} 
    </div>  

</div><!-- /.row --> 
@stop

@section('scripts')
<!-- Page Specific Plugins -->
<script src="{{asset('public/plugins/tablesorter/jquery.tablesorter.js')}}"></script>
<script src="{{asset('public/plugins/tablesorter/tables.js')}}"></script>
<script>
    $('#btn_mulitDelete').click(function(e) {
    e.preventDefault();
    var _ids = new Array();
    var _url = $(this).attr('data-href'),
    _btn = $(this),
    _token = $(this).attr('data-token');
    //获得选中的input 
    $('input[type="checkbox"][name="ids[]"]:checked').each(function() {
    _ids.push($(this).val());
    });
    if (_ids.length == 0) {
    alert("未选择独白");
    return false;
    }
    if (confirm('您确定要执行此操作吗？请慎重！') == true) {
    _btn.attr("disabled", true);
    $.ajax({
    type: 'POST',
    url: _url,
    data: {'_token': _token, 'ids': _ids},
    dataType: 'json',
    beforeSend: function() {
    _btn.attr("disabled", true);
    },
    success: function(data) {
    location.reload();
    _btn.attr("disabled", false);
    },
    error: function(e, a, b) {
    if (e.status == 200) {
    location.reload();
    } else {
    alert('出错了，请稍候再试....');
    }
    _btn.attr("disabled", false);
    }
    });
    }
    return false;
    });
</script>
@stop