@extends('index')

@section('content')
    <section class="content d-flex align-items-center forms-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 px-0 m-auto">
                    <div class="card card-primary mb-0">

                        <form id="addPostForm" role="form" method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 px-2">
                                        <label for="title">@lang('admin.post_title')</label>
                                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" placeholder="@lang('admin.enter_post_title')">
                                        @error('title')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 px-2">
                                        <label for="body">@lang('admin.post_body')</label>
                                        <textarea name="body" rows="3" id="body" class="form-control @error( 'body') is-invalid @enderror" placeholder="@lang('admin.enter_post_body')">{{ old('body') }}</textarea>
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
                                        <input type="hidden" name="post_id" id="postID">
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
        //Dropzone class
        myDropzone = new Dropzone("div#file-upload-dropzone", {
            url: "{{ route('posts-files.store') }}",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            paramName: "file",
            dictDefaultMessage: "@lang("admin.drop_files_here_or_click_to_upload") <br>@lang('admin.selected_files_are_not_actually_uploaded')",
            maxFilesize: 5, // The user is not allowed to upload a file of more than 5 megabytes
            maxFiles: 10, // this mean that the user can't upload more than 10 files in creation form
            acceptedFiles: "image/*", // The user is not allowed to upload any type of files else images
            uploadMultiple: true,
            addRemoveLinks: true,
            dictRemoveFile: "@lang('admin.remove_file')",
            autoProcessQueue: false,
            parallelUploads: 10,
            init: function () {
                myDropzone = this;
                this.on("success", function (file, response) {
                    if (response.status === 'fail') {
                        return;
                    }
                })
            }
        });

        // sending post id in dropzone submission form
        myDropzone.on('sending', function (file, xhr, formData) {
            formData.append('post_id', $('#postID').val());
        });

        // go back to posts page after inserting post and attachments
        myDropzone.on('completemultiple', function () {
            window.location.href = '{{ route('posts.index') }}'
        });

        // submit add post form for insert post in database and return post id to used in dropzone
        $("#addPostForm").submit(function (e){
            // prevent default of form submission to prevent page reload
            e.preventDefault();
                // send ajax request to insert form data in database
            $.ajax({
                url: "{{ route('posts.store') }}",
                type: "POST",
                container: '#addPostForm',
                data: $('#addPostForm').serialize(),
                // on success after data inserted in database send post id to hidden input and start Dropzone processQueue
                success: function(data) {
                    if (myDropzone.getQueuedFiles().length > 0) {
                        $('#postID').val(data.post_id);
                        myDropzone.processQueue();
                    }
                },
                // on error of added post data in database return error validation message
                error: function(xhr, status, error) {
                    let errorMessage = xhr.responseJSON.errors;
                    document.querySelectorAll("#addPostForm input,textarea").forEach(function(input) {
                        if (input.name in errorMessage) {
                            input.classList.add("is-invalid");
                            input.classList.add("input-border-error");
                            if (input.parentElement.lastChild.nodeName !== "DIV") {
                                for (let i = 0; i < errorMessage[input.name].length; i++) {
                                    input.parentElement.insertAdjacentHTML('beforeend', `<div class="invalid-feedback d-block">${errorMessage[input.name][i]}</div>`);
                                }
                            }
                        }
                    })
                }
            });
        });

    </script>
@endpush


@push('css')
    <style>
    </style>
@endpush()
