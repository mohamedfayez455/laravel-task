@extends('index')

@section('content')
    <section class="content d-flex align-items-center forms-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 px-0 m-auto">
                    <div class="card card-primary mb-0">

                        <form id="addPostForm" role="form" method="post" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 px-2">
                                        <label for="title">@lang('admin.post_title')</label>
                                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$post->title}}" placeholder="@lang('admin.enter_post_title')">
                                        @error('title')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 px-2">
                                        <label for="body">@lang('admin.post_body')</label>
                                        <textarea name="body" rows="3" id="body" class="form-control @error( 'body') is-invalid @enderror" placeholder="@lang('admin.enter_post_body')">{{ $post->body }}</textarea>
                                        @error('body')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 px-2">
                                        <div class="dropzone" id="file-upload-dropzone" style="">
                                            {{ csrf_field() }}
                                            <div class="fallback">
                                                <input name="file" type="file" multiple/>
                                            </div>
                                            <input name="image_url" id="image_url" type="hidden"/>
                                        </div>
                                        <input type="hidden" name="post_id" value="{{$post->id}}" id="postID">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" id="submitFormBtn" class="btn btn-outline-blue">@lang('admin.submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        // disabled dropzone auto discover
        Dropzone.autoDiscover = false;
        // Dropzone class
        myDropzone = new Dropzone("div#file-upload-dropzone", {
            url: "{{ route('posts-files.store') }}",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            paramName: "file",
            dictDefaultMessage: "@lang('admin.drop_files_here_or_click_to_upload') <br> @lang('admin.selected_files_are_not_actually_uploaded')",
            maxFilesize: 5, // The user is not allowed to upload a file of more than 5 megabytes
            maxFiles: 10, // this mean that the user can't upload more than 10 files in creation form
            acceptedFiles: "image/*", // The user is not allowed to upload any type of files else images
            uploadMultiple: true,
            addRemoveLinks: true,
            dictRemoveFile: "@lang('admin.remove_file')",
            removedfile:function(file)
            {
                $.ajax({
                    dataType:'json',
                    type:'post',
                    url:'{{ route('posts-files.destroy') }}',
                    data:{
                        _token:'{{ csrf_token() }}',
                        id:file.id
                    }
                });
                var attachmentObject;
                return (attachmentObject = file.previewElement) != null ? attachmentObject.parentNode.removeChild(file.previewElement):void 0;

            },
            parallelUploads: 10,
            init: function () {
                // myDropzone = this;
                @foreach($post->attachments as $attachment)
                    var attachmentObject = {name:"{{$attachment->file}}", id:"{{$attachment->id}}"};
                    this.emit('addedfile', attachmentObject);
                    this.options.thumbnail.call(this, attachmentObject, "{{asset('uploads/posts/'.$attachment->file)}}")
                @endforeach

            }
        });

        // sending post id in dropzone submission form
        myDropzone.on('sending', function (file, xhr, formData) {
            formData.append('post_id', $('#postID').val());
        });

    </script>
@endpush


@push('css')
    <style>
        .dropzoneDragArea {
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
            border-radius: 6px;
            padding: 60px;
            text-align: center;
            margin-bottom: 15px;
            cursor: pointer;
        }
        .dropzone{
            box-shadow: 0 2px 20px 0 #f2f2f2;
            border-radius: 10px;
        }
    </style>
@endpush()
