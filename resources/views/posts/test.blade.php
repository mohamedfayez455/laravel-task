@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('claims.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('app.addNew')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/summernote/dist/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.css') }}">
    <link rel="stylesheet"
          href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <style>
        .panel-black .panel-heading a, .panel-inverse .panel-heading a {
            color: unset !important;
        }
        .dropzone {
            border: 4px dashed #8080e1 !important ;
        }

    </style>
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="modal fade bs-modal-md in" id="addclaim" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-md" id="modal-data-application">
                    <div class="modal-content">
                        {{--                        <div class="modal-header">--}}
                        {{--                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>--}}
                        {{--                            <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>--}}
                        {{--                        </div>--}}
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="fas fa-check-circle"
                                   style="font-size: 60px; color: #1b7e5a; padding-top: 30px; padding-bottom: 15px"></i>
                                <h4>Thank you for submitting your request.
                                    <br>
                                    One of our customer service representative will contact you shortly.
                                    <br>
                                    #Your Request
                                    <span style="font-weight: bolder; font-size: 15px" id="refernceClaim"></span>
                                </h4>

                                <p>You will be redirected to Home. Click here to go Home now.</p>
                            </div>
                        </div>
                        {{--                        <div class="modal-footer">--}}
                        {{--                            <button type="button" class="btn default" data-dismiss="modal">Close</button>--}}
                        {{--                            <button type="button" class="btn blue">Save changes</button>--}}
                        {{--                        </div>--}}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="panel panel-inverse">
                <div class="panel-heading"> @lang('modules.claims.newClaim')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {!! Form::open(['id'=>'storeClaim','class'=>'ajax-form','method'=>'POST']) !!}

                        <div class="form-body">
                            <div class="row">
                                <div class="row">
                                    @if(in_array('claims', $modules))

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label required">@lang('app.menu.propertyBuildings')</label>
                                                <select class="select2 form-control"
                                                        name="property_building_id"
                                                        data-placeholder="@lang("app.menu.propertyBuildings")"
                                                        id="property_building_id">
                                                    <option value="">Choose Building</option>
                                                    @foreach($buildings as $building)
                                                        <option
                                                            value="{{ $building->id }}">{{ ucwords($building->translation()->first()->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4" id="unit_id">

                                            <div class="form-group">
                                                <label class="control-label required">Units</label>
                                                <select class="select2 form-control"
                                                        name="unit_id"
                                                        data-placeholder="Units"
                                                >
                                                    <option value=""></option>
                                                    {{--                                                    @foreach($units as $unit)--}}
                                                    {{--                                                        <option--}}
                                                    {{--                                                                value="{{ $unit->id }}">{{ ucwords($unit->translation()->first()->name) }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </div>
                                        </div>

                                        {{--                                        <div class="col-md-4" id="properties">--}}
                                        {{--                                            <div class="form-group">--}}
                                        {{--                                                <label class="control-label required">Unit</label>--}}
                                        {{--                                                <select class="select2 form-control"--}}
                                        {{--                                                        name="property_id"--}}
                                        {{--                                                        id="property_id">--}}
                                        {{--                                                    <option value=""></option>--}}
                                        {{--                                                </select>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}



                                        <div class="col-md-4" id="parent_categories_id">
                                            <div class="form-group">
                                                <label class="control-label required">@lang('modules.claims.chooseParentClaimCategory')
                                                </label>
                                                <select class="select2 form-control" name="category_id"
                                                        id="category_id"
                                                        data-style="form-control">

                                                    @if ($parent_categories->count())
                                                        <option value="">@lang('modules.claims.chooseParentClaimCategory')</option>
                                                    @endif

                                                    @forelse($parent_categories as $category)

                                                        <option data-priority-value="{{$category->priority}}"
                                                                value="{{ $category->id }}">
                                                            {{ ucwords(optional(\App\ClaimCategoryTranslation::where('claim_category_id',$category->id)->where('locale','en')->first())->name) ?? '-' }}
                                                        </option>
                                                    @empty
                                                        <option value="">@lang('messages.noClaimCategoryAdded')</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                            {{--                                            <a href="javascript:;" id="add-employee"--}}
                                            {{--                                               class="btn btn-xs btn-success btn-outline"><i class="fa fa-plus"></i></a>--}}
                                            <div class="col-md-4" id="sub_categories">
                                                <div class="form-group">
                                                    <label class="control-label required">Claim Sub Categories
                                                    </label>
                                                    <select class="select2 form-control"

                                                            data-style="form-control">

                                                        <option value="">Claim Sub Categories</option>


                                                    </select>
                                                </div>


                                            </div>
                                            <div class="col-md-4" id="claim_types">
                                                <div class="form-group">
                                                    <label class="control-label required">Claim Type
                                                    </label>
                                                    <select class="select2 form-control"

                                                            data-style="form-control">

                                                        <option value="">Choose Claim Type</option>


                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <!--/span-->
                                    <div class="col-xs-12 col-md-4">
                                        <div class="form-group">

                                            <label class="required">@lang('modules.module.priority')</label>
                                            <select class="select2 form-control" name="priority" id="priority"
                                                    {{ Auth::user()->hasRole('client') ? 'disabled' : '' }}
                                                    data-style="form-control">

                                                <option value="" selected disabled> Select Priority</option>
                                                <option value="low">Low</option>
                                                <option value="medium">Medium</option>
                                                <option value="high">High</option>
                                                <option value="urgent">Urgent</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label required">@lang('app.available_date')</label>

                                            <input type="text" autocomplete="off" value="{{now()->format('Y-m-d')}}" name="available_date"
                                                   id="available_date"
                                                   class="form-control date-picker">

                                        </div>
                                    </div>
                                    <!--/span-->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label required">@lang('app.available_time')
                                            </label>
                                            <select class="selectpicker form-control" name="available_time"
                                                    id="available_time"
                                                    data-style="form-control">

                                                <option value="Any Time">Any Time</option>
                                                <option value="8 AM - 12 PM">8 AM - 12 PM</option>
                                                <option value="12 PM - 4 PM">12 PM - 4 PM</option>
                                                <option value="4 PM - 8 PM">4 PM - 8 PM</option>

                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <!--/span-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label required">@lang('app.description')</label>
                                            <textarea id="description" name="description"
                                                      class="form-control " rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        @if($upload)
                                            <button type="button"
                                                    class="btn btn-block btn-outline-info btn-sm col-md-2 select-image-button"
                                                    style="margin-bottom: 10px;display: none "><i
                                                    class="fa fa-upload"></i>
                                                File Select Or Upload
                                            </button>
                                            <div id="file-upload-box">
                                                <div class="row" id="file-dropzone">
                                                    <div class="col-md-12">
                                                        <div class="dropzone"
                                                             id="file-upload-dropzone" style="">
                                                            {{ csrf_field() }}
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple/>
                                                            </div>
                                                            <input name="image_url" id="image_url" type="hidden"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="claimID" id="claimID">
                                        @else
                                            <div class="alert alert-danger">@lang('messages.storageLimitExceed', ['here' => '<a href='.route('billing.packages'). '>Here</a>'])</div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <!--/row-->

                        </div>
                        <div class="form-actions">
                            <button type="button" id="store-claim" class="btn btn-success"><i
                                    class="fa fa-check"></i> @lang('app.save')</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="claim-categoriesModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->.
    </div>
    {{--Ajax Modal Ends--}}
    <div class="modal fade bs-modal-lg in" id="claimLabelModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->.
    </div>
    {{--Ajax Modal Ends--}}


@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $('#multiselect').selectpicker();
        @if($upload)
            Dropzone.autoDiscover = false;
        //Dropzone class
        myDropzone = new Dropzone("div#file-upload-dropzone", {
            url: "{{ route('admin.claim-files.store') }}",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            paramName: "file",
            dictDefaultMessage: "Drop Files Here Or Click To Upload <br>(This Is Just a Demo Dropzone. Selected files Are not actually uploaded)",
            maxFilesize: 10,
            maxFiles: 10,
            acceptedFiles: "image/*,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/docx,application/pdf,text/plain,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            addRemoveLinks: true,
            parallelUploads: 10,
            init: function () {

                myDropzone = this;
                this.on("success", function (file, response) {
                    if (response.status == 'fail') {
                        $.showToastr(response.message, 'error');
                        return;
                    }
                })
            }
        });

        myDropzone.on('sending', function (file, xhr, formData) {
            console.log(myDropzone.getAddedFiles().length, 'sending');
            var ids = $('#claimID').val();
            formData.append('claim_id', ids);
        });

        myDropzone.on('completemultiple', function () {
            var msgs = "@lang('messages.claimCreatedSuccessfully')";
            $.showToastr(msgs, 'success');
            window.location.href = '{{ route('claims.index') }}'
        });


        @endif
        $('.summernote').summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ["view", ["fullscreen"]]
            ]
        });

        //    update claim
        $('#store-claim').click(function () {

            $.easyAjax({
                url: '{{route('claims.store')}}',
                container: '#storeClaim',
                type: "POST",
                data: $('#storeClaim').serialize(),
                success: function (data) {
                    $('#storeClaim').trigger("reset");
                    $('.summernote').summernote('code', '');
                    var dropzone = 0;
                    @if($upload)
                        dropzone = myDropzone.getQueuedFiles().length;
                    @endif

                    if (dropzone > 0) {
                        claimID = data.claimID;
                        $('#claimID').val(data.claimID);
                        myDropzone.processQueue();
                    }

                    $('#refernceClaim').append(data.refernceClaim);
                    $.ajaxModal('#addclaim');
                    var seconds = 5;
                    setInterval(function () {
                        seconds--;
                        if (seconds == 0)
                            window.location.href = '{{ route('claims.index') }}'
                    }, 1000);
                }
            })
        });

        var minDate = new Date(Date.now());

        $("#available_date").datepicker({
            todayHighlight: true,
            autoclose: true,
            minDate: 0,

            weekStart: '{{ $global->week_start }}',
            format: '{{ $global->date_picker_format }}'
        }).datepicker('setStartDate', minDate);


        $(".select2").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        $('#property_type').change(function () {

            var id = $(this).val();
            var property_building_id = $('#property_building_id').val();

            var url = '{{route('admin.property-type.properties' , ':id')}}?property_building_id=' + property_building_id;

            url = url.replace(':id', id);

            $.easyAjax({
                url,
                dataType: 'text',
                success: function (data) {
                    $('#parent_categories_id').css('clear', 'none');
                    $("#properties").empty();
                    $("#properties").html(data)
                }
            })
        });

        $('#category_id').change(function () {

            var id = $(this).val();
            var priority = $(this).find('option:selected').data('priority-value');

            var url = '{{route('admin.claim-categories.sub-categories' , ':id')}}';

            url = url.replace(':id', id);

            $.easyAjax({
                url,
                dataType: 'text',
                success: function (data) {
                    $("#sub_categories").empty();
                    $("#sub_categories").html(data);
                    if ($('#sub_categories').val() == '') {
                        console.log(priority)
                        $("#priority").val(priority).change();
                    }
                }
            })
        });

        $(document).on('change', '#sub_category_id', function () {

            var id = $(this).val();
            var priority = $(this).find('option:selected').data('priority-value');

            var url = '{{route('admin.claim-categories.claim-types' , ':id')}}';

            url = url.replace(':id', id);

            $.easyAjax({
                url,
                dataType: 'text',
                success: function (data) {
                    $("#claim_types").empty();
                    $("#claim_types").html(data);
                    $("#priority").val(priority).change();

                }
            })
        });
        $(document).on('change', '#property_building_id', function () {

            var id = $(this).val();
            var url = '{{route('admin.claims.claim-unit' , ':id')}}';

            url = url.replace(':id', id);

            $.easyAjax({
                url,
                dataType: 'text',
                success: function (data) {
                    $("#unit_id").empty();
                    $("#unit_id").html(data);
                }
            })
        });

        $('#dependent-claim').change(function () {
            if ($(this).is(':checked')) {
                $('#dependent-fields').show();
            } else {
                $('#dependent-fields').hide();
            }
        })
    </script>
    <script>

        $('#add-employee').click(function () {
            var url = '{{ route('admin.employees.create')}}';
            $('#modelHeading').html("@lang('app.add') @lang('app.employee')");
            $.ajaxModal('#propertyTimerModal', url);
        });

    </script>
@endpush
