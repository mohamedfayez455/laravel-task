@include('includes.css')

<div class="row mt-2">
    <div class="col-md-2"></div>
    <div class=" col-md-8">
        <ul class="list-group">
            <li class="list-group-item list-group-item-danger m-1" >@lang('admin.invalid_url') <a href="{{route('home')}}">@lang('admin.go_to_home')</a></li>
        </ul>
    </div>
    <div class="col-md-2"></div>
</div>

@include('includes.js')
