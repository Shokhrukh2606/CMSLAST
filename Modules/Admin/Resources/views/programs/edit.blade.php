<?php
$spec_langs = ['ru', 'uz', 'oz', 'en'];
$title = getLang($program->title);
$description = getLang($program->description);
?>
@extends('admin/index')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dist/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}">
@stop
@section('content_header')
    @include('admin/programs/index_top')
    <h1>Передачи <a href="{{route('slots_edit')}}" class="btn btn-success pull-right">Добавить</a></h1>
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
    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#ru">Русские</a></li>
        <li><a data-toggle="pill" href="#uz">Ўзбекча</a></li>
        <li><a data-toggle="pill" href="#oz">O'zbekcha</a></li>
        <li><a data-toggle="pill" href="#en">English</a></li>
        <li class="pull-right">
            <button type="button" class="btn btn-info btn-lg" style="display: none;" data-toggle="modal" data-target="#mediaModal">Медиа
            </button>
        </li>
    </ul>
    <form method="POST" action="{{route('programs_update', $program->id)}}">
        @csrf
        <div class="tab-content">
            @foreach($spec_langs as $lg)
                <div id="{{$lg}}" class="tab-pane fade in {{($lg=='ru')?'active':''}}">
                    <input type="hidden" name="group" value="{{$program->group}}">
                    <div class="form-group">
                        <label for="usr">Заголовок</label>
                        <input type="text" name="title[{{$lg}}]" class="form-control" value="{{$title->$lg}}"
                               id="title_{{$lg}}">
                    </div>
                    <div class="form-group">
                        <label for="description_{{$lg}}">Инфо о передача</label>
                        <textarea class="form-control" rows="5" name="description[{{$lg}}]" cols="30" rows="10"
                                  id="description_{{$lg}}">{{$description->$lg}}</textarea>
                    </div>
                </div>
                {{--                <div id="{{$lg}}" class="tab-pane fade in {{($lg=='ru')?'active':''}}">--}}
                {{--                    <textarea name="title[{{$lg}}]" cols="30" rows="10" id="ru_form">{{$title->$lg}}</textarea>--}}
                {{--                </div>--}}
            @endforeach

        </div>
        <div class="form-group">
            <label for="usr">Дата</label>
            <input type="text" name="inserted_at" class="form-control datepicker"
                   id="alias" value="{{date('d.m.Y', strtotime($program->inserted_at))}}">
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" id="status" name="status">
                <option value="active" selected>Активный</option>
                <option value="inactive">Неактивный</option>
            </select>
        </div>
        <button class="btn btn-info pull-right">Сохранить</button>
        <div class="clearfix"></div>
    </form>
    <div id="mediaModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Медиа</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route("posts.mediaAdd", [$program->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="document">Documents</label>
                            <div class="needsclick dropzone" id="document-dropzone">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <style>
        #mediaModal .modal-body{
            min-height: 75vh;
        }
        #mediaModal .modal-dialog{
            min-width: 70%;
        }
        #mediaModal    .dropzone .dz-preview .dz-image img {
            display: block;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
@stop
@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('plugins/dropzone/dist/dropzone.js') }}"></script>
    <script src="{{ asset('vendor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({"format":"dd.mm.yyyy", "autoclose":true}).datepicker("setDate",'now');
        var pID = '{{$program->id}}'
        var baseUrl = '{{url('/')}}'
        var options = {
            {{--filebrowserImageBrowseUrl: '{{ asset("/filemanager?type=Images") }}',--}}
                    {{--filebrowserImageUploadUrl: '{{ asset("filemanager/upload?type=Images&_token=".csrf_token()) }}',--}}
                    {{--filebrowserBrowseUrl: '{{ asset("filemanager?type=Files") }}',--}}
                    {{--filebrowserUploadUrl: '{{ asset("filemanager/upload?type=Files&_token=").csrf_token() }}',--}}
                    {{--allowedContent: true--}}
            filebrowserImageBrowseUrl: '{{url("/filemanager?type=Images")}}',
            filebrowserImageUploadUrl: '{{url("/filemanager/upload?type=Images&_token=").csrf_token()}}',
            filebrowserBrowseUrl: '{{url("/filemanager?type=Files")}}',
            filebrowserUploadUrl: '{{url("/filemanager/upload?type=Files&_token=").csrf_token()}}'
        };
        @foreach($spec_langs as $lg)
        {{--$('textarea#short_content_{{$lg}}').ckeditor(options);--}}
        $('textarea#content_{{$lg}}').ckeditor(options);
        @endforeach
        $('#title_ru').syncTranslit({destination: 'alias'});
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('posts.mediaAdd', ['id'=>$program->id, 'group'=>$program->group]) }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
            },
            queuecomplete: function () {

            },
            removedfile: function (file) {
                x = confirm('Do you want to delete?');
                if (!x) return false;
                var name = ''
                var uniqueID = file.imgID
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.file_name]
                }
                var removed = $('form').find('input[name="document[]"][value="' + name + '"]');
                $.post(baseUrl + '/posts/mediaDelete', {
                    imgid: uniqueID,
                    "_token": "{{ csrf_token() }}",
                    'post_id': pID
                }).then(function (res) {
                    if (res.success) {
                        file.previewElement.remove()
                        removed.remove()
                    }
                })
            },
            init: function () {
                        @if(isset($mediaItems) && $mediaItems)
                var files =
                {!! json_encode($mediaItems) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    file.previewElement.querySelector("img").src = file.imgPath;

                    $('form').append('<input type="hidden" name="document[]" value="' + file.name + '" imgid="' + file.imgID + '">')
                }
                @endif
            }
        }
        // var ru_t=
        // $('textarea#ru_form').ckeditor(options);
        // // var uz_t=
        // $('textarea#uz_form').ckeditor(options);
        // // var oz_t=
        // $('textarea#oz_form').ckeditor(options);
        // // var en_t=
        // $('textarea#en_form').ckeditor(options);
    </script>

@stop
