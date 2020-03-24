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
@stop

@section('content') 
{{-- {{print_r($slot)}} --}}
<table class="table">
    <thead>
    <tr>
        <th>Начинается</th>
        <th>Окончание</th>
        <th>Имя программа</th>
    </tr>
    </thead>
    <tbody>

    @foreach($slot as $item)
        <tr>
        <td>{{$item->starts}}</td>
        <td> {{get_program($item->program_id)}}</td>        
        <td>{{$item->ends}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop