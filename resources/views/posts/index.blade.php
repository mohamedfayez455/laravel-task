@extends('index')

@section('content')
    <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-body px-2">
                    <form action="{{route('posts.destroy.selected-rows')}}" id="form_data" method="post">
                        @csrf
                        @method('DELETE')
                        {!! $dataTable->table([ 'class' => 'dataTable table table-striped table-hover table-bordered' ] , true) !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for confirming msg before multi deletion -->
    <div id="multipleDelete" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('admin.delete_posts')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="empty_record " hidden>
                        @lang('admin.please_select_the_posts_you_want_to_delete')
                        <p></p>
                    </div>
                    <div class="not_empty_record " hidden>
                        <p>@lang('admin.do_you_really_want_to_delete_a_number')<span class="record_count"></span>@lang('admin.post')</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="empty_record " hidden>
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin.cancel')</button>
                    </div>
                    <div class="not_empty_record " hidden>
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin.cancel')</button>
                        <input type="submit" name="del_all" value="@lang('admin.confirm')" class="btn btn-danger del_all">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            delete_all();
        </script>
        {!! $dataTable->scripts() !!}
    @endpush
@endsection
