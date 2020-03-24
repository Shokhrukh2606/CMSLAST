<div id="mediaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Медиа</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route("posts.mediaAdd", [$post->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="document">Documents</label>
                        <div class="needsclick dropzone" id="document-dropzone">
                        </div>
                    </div>
                </form>
{{--                <form method="POST" enctype="multipart/form-data" action="{{route('posts.mediaAdd', [$post->id])}}"--}}
{{--                      class="dropzone"--}}
{{--                      id="my-awesome-dropzone">--}}
{{--                    @csrf--}}
{{--                    <input type="file" name="items[]" multiple/>--}}
{{--                </form>--}}
{{--                <form id="sendM" action="{{route('posts.mediaAdd', [$post->id])}}" enctype="multipart/form-data" method="POST">--}}
{{--                    @csrf--}}
{{--                    <input type="file" name="items[]" multiple id="filesinput" style="display: none;">--}}
{{--                    <input type="hidden" value="{{$post->group}}" name="group">--}}
{{--                    <div class="actions">--}}
{{--                        <button class="btn btn-info" id="addM"><i class="fa fa-plus"></i>&nbsp Добавить</button>--}}
{{--                        <button class="btn btn-warning" id="removeA"><i class="fa fa-minus"></i>&nbsp Удалить все</button>--}}
{{--                        <button class="btn btn-danger" id="removeS"><i class="fa fa-minus"></i>&nbsp Удалить выбранные</button>--}}
{{--                    </div>--}}
{{--                    <div class="info">--}}
{{--                        <ul></ul>--}}
{{--                    </div>--}}
{{--                </form>--}}
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