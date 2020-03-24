<?php
$spec_langs = ['ru', 'uz', 'oz', 'en'];
$title = getLang($post->title);
$short_content = getLang($post->short_content);
$content = getLang($post->content);
$content_html = getLang($post->content_html);

?>
@extends('admin/index')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dist/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/selectize/css/selectize.css') }}">
    <style>
        .selectize-control.multi .selectize-input > div {
            background: #f39c12 !important;
            color: #fff;
        }
    </style>
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
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mediaModal">Медиа
            </button>
        </li>
    </ul>
    <form method="POST" action="{{route('posts.update', [$post->id, $post->group])}}">
        @csrf
        <div class="tab-content">
            @foreach($spec_langs as $lg)
                <div id="{{$lg}}" class="tab-pane fade in {{($lg=='ru')?'active':''}}">
                    <input type="hidden" name="group" value="{{$post->group}}">
                    <div class="form-group">
                        <label for="usr">Заголовок</label>
                        <input type="text" name="title[{{$lg}}]" class="form-control" value="{{$title->$lg}}"
                               id="title_{{$lg}}">
                    </div>
                    <div class="form-group">
                        <label for="short_content_{{$lg}}">Время</label>
                        <input class="form-control" rows="5" name="short_content[{{$lg}}]"
                                  id="short_content_{{$lg}}" value="{{$short_content->$lg}}">
                    </div>
                    <div class="form-group">
                        <label for="content_html_{{$lg}}">День</label>
                        <input class="form-control" rows="5" name="content_html[{{$lg}}]"
                                  id="content_html_{{$lg}}" value="{{$content_html->$lg}}">
                    </div>
                    <div class="form-group">
                        <label for="content_{{$lg}}">Контент</label>
                        <textarea name="content[{{$lg}}]" cols="30" rows="10"
                                  id="content_{{$lg}}">{{$content->$lg}}</textarea>
                    </div>
                </div>
                {{--                <div id="{{$lg}}" class="tab-pane fade in {{($lg=='ru')?'active':''}}">--}}
                {{--                    <textarea name="title[{{$lg}}]" cols="30" rows="10" id="ru_form">{{$title->$lg}}</textarea>--}}
                {{--                </div>--}}
            @endforeach

        </div>
        <div class="form-group">
            <label for="usr">Удобство</label>
            <input type="text" name="tags" class="selectized" style="display: none;" tabindex="-1"
                   id="tags" value="{{$post->tags}}">
        </div>
        <div class="form-group">
            <label for="usr">Сумма</label>
            <input type="number" name="options" class="form-control"
                   id="options" placeholder="{{$post->options? $post->options:'0'}}">
        </div>
        <div class="form-group">
            <label for="usr">Слаг</label>
            <input type="text" name="alias" class="form-control"
                   id="alias" value="{{$post->alias}}">
        </div>
        <div class="form-group">
            <label for="usr">Дата</label>
            <input type="text" name="inserted_at" class="form-control datepicker"
                   id="inserted_at" value="{{date('d.m.Y', strtotime($post->inserted_at))}}">
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" id="status" name="status">
                {{-- <option disabled selected>Выберите</option> --}}
                <option selected value="active">Активный</option>
                <option value="inactive">Неактивный</option>
            </select>
        </div>
        <button class="btn btn-info pull-right">Сохранить</button>
        <div class="clearfix"></div>
    </form>
@stop
@include('admin/partials/footer')
@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('plugins/dropzone/dist/dropzone.js') }}"></script>
    <script src="{{ asset('vendor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.synctranslit.min.js') }}"></script>
    <script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/microplugin/microplugin.js') }}"></script>
    <script src="{{ asset('plugins/sifter/sifter.js') }}"></script>
    <script src="{{ asset('plugins/selectize/js/selectize.js') }}"></script>
    <script>
        var tags =
                {!! json_encode( \App\Post::where(array('group'=>'tags'))->get(['id','title'])) !!}
        var customizedTags = tags.map(function (item) {
                return {
                    id: item.id,
                    title: jQuery.parseJSON(item.title).ru
                }
            })
        $("#tags").selectize({
            valueField: 'id',
            labelField: 'title',
            placeholder: 'Выберите',
            options: customizedTags,
            create: false,
            preload: true,
            render: {
                option: function (item, escape) {
                    return '<div>' +
                        '<span class="title">' +
                        '<span class="name">' + escape(item.title) + '</span>' +
                        '</span>' +
                        '</div>';
                }
            },

        });
        $('.datepicker').datepicker({"format": "dd.mm.yyyy", "autoclose": true}).datepicker();
        var pID = '{{$post->id}}'
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
            url: '{{ route('posts.mediaAdd', ['id'=>$post->id, 'group'=>$post->group]) }}',
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
