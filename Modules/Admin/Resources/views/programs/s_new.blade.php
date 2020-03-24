@extends('admin/index')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/timepicker/jquery.timepicker.css ') }}">
    <style>
        .btn.btn-danger {
            margin-top: 25px;
        }
    </style>
@stop
@section('content_header')
    @include('admin/programs/index_top')
    {{--    <h1>Передачи <a href="{{route('slots_edit')}}" class="btn btn-success pull-right">Добавить</a></h1>--}}
@stop
@section('content')
    <form action="{{route('slots_create')}}" method="POST" id="sendedForm">
        @csrf
        <div class="form-group">
            <label for="">День</label>
            <select class="form-control" name="day">
                <option disabled selected>Выберите</option>
                <option value="1">Понедельник</option>
                <option value="2">Вторник</option>
                <option value="3">Среда</option>
                <option value="4">Четверг</option>
                <option value="5">Пятница</option>
                <option value="6">Суббота</option>
                <option value="7">Воскресенье</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success pull-right">Сохранить</button>
        <div class="clearfix"></div>
        <div class="form-element row">
            <div class="form-group col-md-2 col-sm-6">
                <label for="usr">Начинается в:</label>
                <input type="text" name="starts[]" class="form-control timepickerStart">
            </div>
            <div class="form-group col-md-2 col-sm-6">
                <label for="usr">Заканчивается в:</label>
                <input type="text" name="finishes[]" class="form-control timepickerFinish">
            </div>
            <div class="form-group col-md-5 col-sm-4">
                <label for="sel1">Название передача:</label>
                <select class="form-control" name="program[]">
                    @foreach($programs as $item)
                        <option value="{{$item->id}}">{{getLangSpec($item->title, 'ru')}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 col-sm-2">
                <button class="btn btn-danger deleteElement"><i class="fas fa-trash-alt"></i></button>
                <div class="clearfix"></div>
            </div>
        </div>
    </form>
    <button id="elementAdder" class="btn btn-info">Добавить время</button>
@stop
@section('js')
    <script src="{{ asset('plugins/timepicker/jquery.timepicker.js') }}"></script>
    <script>
        $(document).ready(function () {
            var baseFinish = $(".timepickerFinish")
            baseFinish.timepicker({
                timeFormat: 'H:mm',
                maxTime: '23:59',
                interval: 10,
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });
            $('.timepickerStart').timepicker({
                timeFormat: 'H:mm',
                minTime: '00:00',
                maxTime: '23:59',
                defaultTime: '00:00',
                interval: 10,
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                change: function () {
                    self = $(this)
                    baseFinish.val(self.val())
                }
            });
            $("#elementAdder").click(function (e) {
                e.preventDefault()
                var oldElement = $(".form-element").last()
                var newElement = oldElement.clone();
                newElement.appendTo("#sendedForm");
                var oldFinish = oldElement.find(".timepickerFinish")
                var newStart = newElement.find(".timepickerStart")
                var newFinish = newElement.find(".timepickerFinish")
                var deleteButton = newElement.find(".deleteElement")
                deleteButton.click(function (e) {
                    e.preventDefault()
                    $(this).parent().parent().remove()
                })
                newStart.timepicker({
                    timeFormat: 'H:mm',
                    minTime: oldFinish.val(),
                    maxTime: '23:59',
                    defaultTime: oldFinish.val(),
                    interval: 10,
                    startTime: oldFinish.val(),
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true,
                    change: function () {
                        self = $(this)
                        newFinish.val(self.val())
                    }
                })
                newFinish.timepicker({
                    timeFormat: 'H:mm',
                    maxTime: '23:59',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true,
                });
            })
        })
    </script>
@stop