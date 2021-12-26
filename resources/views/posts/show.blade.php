@extends('index')
{{--@section('title')--}}
{{--    <h3 class="card-title mt-2">المستخدمين</h3>--}}
{{--@endsection--}}
@section('content')

    <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-body px-2">
                    <!-- data table of admins (users) data would be included here-->
{{--                    {!! Form::open(['url' => route('admins.destroy.all'), 'id' => 'form_data' , 'method' => 'delete']) !!}--}}
{{--                    {!! $dataTable->table([ 'class' => 'dataTable table table-striped table-hover table-bordered' ] , true) !!}--}}
{{--                    {!! Form::close() !!}--}}

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
                    <h5 class="modal-title">حذف مستخدمين</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="empty_record " hidden>
                        <p>من فضلك حدد المستخدمين الذين ترغب فى القيام بحذفهم</p>
                    </div>
                    <div class="not_empty_record " hidden>
                        <p>هل تريد حقًا حذف عدد  <span class="record_count"></span> مستخدم ؟!</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="empty_record " hidden>
                        <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                    </div>
                    <div class="not_empty_record " hidden>
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <input type="submit" name="del_all" value="تأكيد" class="btn btn-danger del_all">
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


