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
    <h1>Передачи <a href="{{route('programs_create')}}" class="btn btn-success pull-right">Добавить</a></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-info" href="{{route('programs_list')}}">Все</a>
            <a class="btn btn-success" href="{{route('programs_list', ['status'=> 'active'])}}">Активный </a>
            <a class="btn btn-warning" href="{{route('programs_list', ['status'=> 'inactive'])}}">Неактивный </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Заголовок</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($programs as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{getLangSpec($item->title, 'ru')}}</td>
                    <td><?=($item->status == 'active') ? '<span class="label label-success">Активный</span>' : '<span class="label label-warning">Неактивный</span>'?></td>
                    <td>
                        <a href="{{route('programs_edit', $item->id)}}" class="btn btn-info">Редактировать</a>
                        <button class="btn btn-danger deleteAction" data-direct="/posts/delete/{{$item->id}}">Удалить
                        </button>
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
