@extends('index')

@section('content')
    <section class="content d-flex align-items-center forms-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 px-0 m-auto">
                    <div class="card card-primary mb-0">
                        <!--    add new post form   -->
                        <form id="addPostForm" role="form" method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group form-floating col-12 px-2">
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
                                    <!--    dropzone for upload multi files    -->
                                    <div class="form-group col-md-12 px-2">
                                        <div class="dropzone" id="file-upload-dropzone" style=""></div>
                                            <!--     hidden field to hold a value of post id after creating it -->
                                        <input type="hidden" name="post_id" id="postID">
                                    </div>
                                    <!--    this div for dropzone validation length     -->
                                    <div id="dropzoneLengthValidation" class="invalid-feedback d-block"></div>
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
            url: "{{ route('posts-files.store') }}", // the url which the Dropzone goes
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            paramName: "file", // the name that send with url request
            dictDefaultMessage: "@lang("admin.drop_files_here_or_click_to_upload") <br>@lang('admin.selected_files_are_not_actually_uploaded')",
            maxFilesize: 5, // The user is not allowed to upload a file of more than 5 megabytes
            maxFiles: 10, // this mean that the user can't upload more than 10 files in creation form
            acceptedFiles: "image/jpeg,image/png,image/jpg", // The user is not allowed to upload any type of files else images.jpg or png or jpeg
            uploadMultiple: true, // this allows to user to select multi photo and upload them
            addRemoveLinks: true, // This makes the Dropzone add a delete link below the images
            dictRemoveFile: "@lang('admin.remove_file')",
            parallelUploads: 10,
            autoProcessQueue: false,
            init: function () {
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

        // go back to post index page after inserting post and attachments
        myDropzone.on('completemultiple', function () {
            window.location.href = '{{ route('posts.index') }}'
        });


        //  validate front  for add new post with  && submit form with ajax in submitHandler
        $("#addPostForm").validate({
            rules: {
                "title": {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },"body": {
                    minlength: 3
                },
            },
            messages: {
                "title": {
                    required: "@lang('admin.title_required')",
                    minlength: "@lang('admin.title_min')",
                    maxlength: "@lang('admin.title_max')",
                },
                "body": {
                    minlength: "@lang('admin.body_min')",
                },
            },
            submitHandler: function(form) {
                // check for dropzone length
                $("#dropzoneLengthValidation").empty();
                if (myDropzone.files.length !== 0) {
                    // send ajax request to insert form data in database && return post id to used in dropzone
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
                            // get response error message and append it in form inputs
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
                } else {
                    $("#dropzoneLengthValidation").append("@lang('admin.attachments_required')");
                }
            },
            ignore: [],
            errorClass: "invalid-feedback animated fadeInUp d-inline-flex",
            errorElement: "div",
            errorPlacement: function(error, element) {
                jQuery(element).parents(".form-group").append(error)
            },
            highlight: function(error) {
                jQuery(error).closest(".form-group").find(".invalid-feedback").remove();
                jQuery(error).closest(".form-group").removeClass("is-invalid");
            },
            success: function(error) {
                jQuery(error).closest(".form-group").find(".invalid-feedback").remove();
                jQuery(error).closest(".form-group").removeClass("is-invalid");
            }
        });
    </script>
@endpush
