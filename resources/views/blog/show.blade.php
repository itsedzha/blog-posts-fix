@extends('layouts.app', ['title' => $post->title])

@section('content')

@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif

<div class="w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-6xl">
            {{ $post->title }}
        </h1>
    </div>
</div>

<div class="w-4/5 m-auto pt-20">
    @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
        <span class="float-right">
            <a 
                href="/blog/{{ $post->slug }}/edit"
                class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                Edit
            </a>
        </span>

        <span class="float-right">
            <form action="/blog/{{ $post->slug }}" method="POST">
                @csrf
                @method('delete')
                <button class="text-red-500 pr-3" type="submit">
                    Delete
                </button>
            </form>
        </span>
    @endif

    <span class="text-gray-500">
        By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
    </span>

    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
        {{ $post->description }}
    </p>

    <div>
        <img src="{{ asset('images/' . $post->image_path) }}" alt="">
    </div>

    @if($post->comments->count() > 0)
        <div class="mt-10">
            <h3 class="text-2xl font-bold">Comments</h3>
            @foreach ($post->comments as $comment)
                <div class="mt-4 border-b border-gray-200">
                    <p>{{ $comment->content }}</p>
                    <p class="text-sm text-gray-500">
                        By {{ $comment->user->name }} on {{ $comment->created_at->format('jS M Y') }}
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p>No comments yet.</p>
    @endif

    @if (Auth::check())
        <div class="mt-10">
            <form action="/blog/{{ $post->slug }}/comments/create" method="post">
                @csrf
                <label for="commentContent" class="block text-lg font-bold mb-2">Leave a Comment</label>
                <textarea class="w-full border rounded-md resize-none p-2" name="content" id="commentContent"></textarea>
                <input type="submit" value="Submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md">
            </form>
        </div>
    @endif
</div>

@endsection
