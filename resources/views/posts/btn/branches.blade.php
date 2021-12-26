@php
$admin = \App\Models\Admin::findOrFail($id);
@endphp

@foreach($admin->branches as $branch)
    <p class="badge badge-primary">{{$branch->name}}</p>
@endforeach
