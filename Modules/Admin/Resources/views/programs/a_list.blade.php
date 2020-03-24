@extends('admin/index')
{{--@section('title', 'Dunyobo\'ylab')--}}
@section('css')
    <style>
        table tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        table tr:first-child {
            background-color: initial;
        }
    </style>
@stop
@section('content_header')
    @include('admin/programs/index_top')
    <h1>Передачи <a href="{{route('assigns_edit')}}" class="btn btn-success pull-right">Добавить</a></h1>
@stop

@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($assigns as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{date("d.m.Y", strtotime($item->p_date))}}</td>
                    <td><?=($item->status == 'active') ? '<span class="label label-success">Активный</span>' : '<span class="label label-warning">Неактивный</span>'?></td>
                    <td>
                        <a href="{{route('assigns_edit', $item->id)}}" class="btn btn-info">Редактировать</a>
            
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{--            {{$posts->appends(['group'=>$_GET['group']])->links()}}--}}
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $(".deleteAction").click(function (e) {
                e.preventDefault()
                var link = '{{url('/')}}'+$(this).data("direct")
                x = confirm('Вы действительно хотите удалить?');
                if (!x) return false;
                $.ajax({
                    url: link,
                    type: 'POST',
                    data: {"_token": "{{ csrf_token() }}"},
                    success: function (res) {
                        location.reload()
                    },
                    error:function(err){
                        console.log(err)
                    }
                })
            })
        })
    </script>
@stop
