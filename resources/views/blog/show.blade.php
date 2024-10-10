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
                <form 
                action="/blog/{{ $post->slug }}"
                method="POST">
                @csrf
                @method('delete')

                <button
                    class="text-red-500 pr-3"
                    type="submit">
                    Delete
                </button>

            </form>
        </span>
    @endif

    <span class="text-gray-500">
        By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
    </span>

    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
        {{ $post->body }}
    </p>

    <div>
        <img src="{{ asset('images/' . $post->image_path) }}" alt="">
    </div>

    @if($post->comments)
        <div>
            <h3>Comments</h3>
            @foreach ($post->comments as $comment)
                <p></p>
            @endforeach
        </div>
    @endif

    @if (Auth::check())
        <div>
            <form action="/blog/{{$post->slug}}/comments/create" method="post">
                @csrf
                <label for="commentContent">Comment</label>
                <textarea class="resize rounded-md" name="content" id="commentContent"></textarea>
                <input type="submit" value="Submit">
            </form>
        </div>
    @endif
</div>

@endsection
