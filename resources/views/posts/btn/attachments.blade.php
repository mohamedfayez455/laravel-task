@php
    $post = \App\Models\Post::findOrFail($id);
@endphp

@foreach($post->attachments as $attachment)
    <a href="{{asset('uploads/posts/'.$attachment->file)}}" data-lity>
        <img src="{{asset('uploads/posts/'.$attachment->file)}}" alt="" style="width: 100px; height: 85px;" class="img-thumbnail">
    </a>
@endforeach
