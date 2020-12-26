@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{ route('posts') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="bg-gray-100
                    border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" 
                    placeholder="Post something" style="resize: none"></textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm text-center">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white 
                    px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>

            
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mt-5 bg-gray-500 w-full p-3 text-white rounded relative">
                        <a class="font-bold">{{ $post->user->username }}</a><span class="ml-3 text-gray-200 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        <p class="mb-2 bg-gray-400 p-3 mt-1 rounded-lg">{{ $post->body}}</p>
                        @if ($post->ownedBy(Auth::user()))
                            <div class="absolute top-4 right-4 text-sm flex justify-around w-10">
                                <a href="{{ route('post.edit', $post )}}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route("posts.destroy", $post)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        @endif
                        <div class="flex items-center">
                            @auth
                                @if (!$post->likedBy(auth()->user()))
                                    <form action="{{ route("posts.likes", $post) }}" method="POST" class="mr-1">
                                        @csrf
                                        <button type="submit" class="text-white"><i class="fas fa-thumbs-up"></i></button>
                                    </form>
                                @else
                                    <form action="{{ route("posts.likes", $post) }}" method="POST" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-blue-500"><i class="fas fa-thumbs-up"></i></button>
                                    </form>
                                @endif
                            @endauth
                            <span>{{ $post->likes->count()}} {{ Str::plural('like', $post->likes->count())}}</span>
                        </div>
                        <div class="bg-gray-600 p-2 rounded">
                            <div class="w-full mt-2 items-center">
                                <form action="{{ route('post.comment', $post) }}" class="justify-between flex flex-row" method="POST">
                                    @csrf
                                    <input class="w-4/5 rounded p-0.5 text-black border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="text" id="comment" name="comment" placeholder="Comment..." autocomplete="off" >
                                    <button type="submit" class="rounded p-1 w-20 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                                        Send
                                    </button>
                                </form>
                            </div>
                            @foreach ($post->comments as $comment)                   
                                <div class="mt-2 bg-blue-400 p-2 rounded relative">
                                    <div class="flex items-center">
                                        <h1 class="text-gray-200 font-bold">{{ $comment->user->username }}</h1>
                                        <span class="ml-3 text-gray-200 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="bg-gray-200 text-black p-2 rounded">{{ $comment->comment }}</p>
                                    @if ($comment->ownedBy(Auth::user()))
                                        <form action="{{ route("post.comment", $comment)}}" method="POST" class="text-sm absolute top-2 right-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="mt-2">
                    {{ $posts->links() }}
                </div>
            @else 
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection