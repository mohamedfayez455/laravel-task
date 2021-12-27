@extends('index')

@section('content')
    <section class="content d-flex align-items-center forms-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 px-0 m-auto">
                    <div class="card card-primary mb-0">

                        <!--    update post form    -->
                        <form id="updatePostForm" role="form" method="post" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
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
                                    <!--    dropzone    -->
                                    <div class="form-group col-md-12 px-2">
                                        <div class="dropzone" id="file-upload-dropzone"></div>
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
            url: "{{ route('posts-files.store') }}", // the url which the Dropzone goes
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            paramName: "file", // the name that send with url request
            dictDefaultMessage: "@lang('admin.drop_files_here_or_click_to_upload') <br> @lang('admin.selected_files_are_not_actually_uploaded')",
            maxFilesize: 5, // The user is not allowed to upload a file of more than 5 megabytes
            maxFiles: 10, // this mean that the user can't upload more than 10 files in creation form
            acceptedFiles: "image/jpeg,image/png,image/jpg", // The user is not allowed to upload any type of files else images
            uploadMultiple: true,   // this allows to user to select multi photo and upload them
            parallelUploads: 10,    // This makes the Dropzone add a delete link below the images
            addRemoveLinks: true,
            dictRemoveFile: "@lang('admin.remove_file')",
            init: function () {
                // loop for post attachments and added them in dropzone
                @foreach($post->attachments as $attachment)
                    var attachmentObject = {name:"{{$attachment->file}}", id:"{{$attachment->id}}"};
                    this.emit('addedfile', attachmentObject);
                    this.options.thumbnail.call(this, attachmentObject, "{{$attachment->file_path}}")
                @endforeach

                // sending post id in dropzone submission form
                this.on('sending', function (file, xhr, formData) {
                    formData.append('post_id', $('#postID').val());
                });
            },
            // When the user clicks on the delete link below the images send ajax request to delete photo from public path && frpm database
            removedfile:function(file)
            {
                $.ajax({
                    dataType:'json',
                    type:'post',
                    url:'{{ route('posts-files.destroy') }}',   // the user for remove photo
                    data:{
                        _token : '{{ csrf_token() }}',
                        id     : file.id
                    }
                });
                var attachmentObject;
                return (attachmentObject = file.previewElement) != null ? attachmentObject.parentNode.removeChild(file.previewElement):void 0;
            }
        });
    </script>
@endpush
