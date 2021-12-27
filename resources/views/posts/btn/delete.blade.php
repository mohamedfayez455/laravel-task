<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#del_post_{{$id}}">  <i class="bi bi-trash"></i></button>

<div id="del_post_{{$id}}" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('admin.delete_post')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('posts.destroy', $id)}}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p> @lang('admin.do_you_really_want_to_delete_the_article')  </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin.cansel')</button>
                    <button type="submit" class="btn btn-outline-danger" >@lang('admin.submit')</button>
                </div>
            </form>

        </div>
    </div>
</div>



