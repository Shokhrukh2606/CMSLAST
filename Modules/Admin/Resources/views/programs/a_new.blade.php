@extends('admin/index')
@section('css')
    <link rel="stylesheet" href="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}">
@stop
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{route('assigns_create')}}">
    @csrf
    <div class="form-group">
        <label for="usr">Типичный день</label>
        <select class="form-control" name="slot_id">
            <option disabled selected>Выберите</option>
            @foreach($slots as $slot)
                <option value="{{$slot->id}}">({{$slot->id}})=>{{getDayOfProgram($slot->day)}}</option>
            @endforeach 
        </select>
    </div>
    <div class="form-group">
        <label for="usr">Дата</label>
        <input type="text" name="p_date" class="form-control datepicker" id="date">
    </div>
    <button type="submit" class="btn btn-success pull-right">Сохранить</button>
</form>
@stop
@section('js')
    <script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({"format":"dd.mm.yyyy", "autoclose":true}).datepicker("setDate",'now');
    })
</script>
@stop