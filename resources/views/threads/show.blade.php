@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="">
                        {{ $thread->creator->name }}
                    </a> posted:
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>

            @foreach ($replies as $reply)
                @include ('threads.reply')
            @endforeach

            {{ $replies->links() }}

            @if(auth()->check())

            <form class="mt-5" method="POST" action="{{ $thread->path() . '/replies' }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" rows="7" placeholder="Have something to say?"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Post</button>
            </form>


            @else
            <p class="text-center mt-5">Please <a href="{{ route('login') }}"> sign in </a> to participate in this discussion.</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card mb-5">
                <div class="card-body">
                    This thread was published {{ $thread->created_at->diffForHumans()}} by
                    <a href="">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
