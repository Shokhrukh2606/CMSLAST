<?php
$spec_langs = ['ru', 'uz', 'oz', 'en'];
$title = getLang($post->title);
$short_content = getLang($post->short_content);
$content = getLang($post->content);
?>
@extends('admin::index')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dist/dropzone.css') }}">
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
                        <label for="short_content_{{$lg}}">Анонс</label>
                        <textarea class="form-control" rows="5" name="short_content[{{$lg}}]" cols="30" rows="10"
                                  id="short_content_{{$lg}}">{{$short_content->$lg}}</textarea>
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
            <label for="usr">Слаг</label>
            <input type="text" name="alias" class="form-control"
                   id="alias" value="{{$post->alias}}">
        </div>
        <div class="form-group">
            <label for="usr">Дата</label>
            <input type="text" name="inserted_at" class="form-control datepicker"
                   id="alias" value="{{date('d.m.Y', strtotime($post->inserted_at))}}">
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
@include('admin::partials.footer')
@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('plugins/dropzone/dist/dropzone.js') }}"></script>
    <script src="{{ asset('vendor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.synctranslit.min.js') }}"></script>
    <script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({"format":"dd.mm.yyyy", "autoclose":true}).datepicker();
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
                $.post(baseUrl + '/admin/posts/mediaDelete', {
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
                    var activisor=document.createElement("div")
                    var checkboxDiv=document.createElement("div")
                    var checkboxLab=document.createElement("label")
                    var checkbox=document.createElement("input")
                    var checkboxSpan=document.createElement("span")
                    var checkboxI=document.createElement("div")
                    activisor.className="activisor"
                    checkboxDiv.className="checkbox"
                    checkboxSpan.className="cr"
                    checkboxI.className="cr-icon glyphicon glyphicon-ok"
                    checkbox.type = "checkbox";
                    checkbox.value = file.imgID;
                    if(i==0){
                        checkbox.checked=true
                        checkbox.disabled=true
                    }
                    checkboxSpan.append(checkboxI)
                    checkboxLab.append(checkbox)
                    checkboxLab.append(checkboxSpan)
                    checkboxDiv.append(checkboxLab)
                    activisor.append(checkboxDiv)
                    file.previewElement.append(activisor)
                    
                    // <div class="checkbox">
                    // <label>
                    // <input type="checkbox" value="" checked>
                    // <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                    // Option two is checked by default
                    // </label>
                    // </div>
                    file.previewElement.append(activisor)
                    $('form').append('<input type="hidden" name="document[]" value="' + file.name + '" imgid="' + file.imgID + '">')
                }
                 $(":checkbox").on('change', function(event)  {
                    self=$(this)
                    if (event.target.checked) {
                        $.ajax({
                            url: baseUrl+'/admin/posts/mediaActivate',
                            data: {
                                mediaId: self.val()
                            },
                            success: function(response){
                                if(response.success){
                                    $(":checkbox").each( function(){
                                        if($(this).val()===self.val()){
                                            $(this).prop("checked",true)
                                            $(this).prop("disabled",true)
                                        }else{
                                            $(this).prop("checked",false)
                                            $(this).prop("disabled",false)
                                        }
                                    })
                                }
                            }
                        }) 
                    } 
                })
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
