@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                   @foreach ($threads as $thread)
                        <article>
                            <div class="level">
                                <h5 class="flex">
                                    <a href="{{ $thread->path() }}">
                                        {{ $thread->title }}
                                    </a>
                                </h5>
                                <a href="{{ $thread->path() }}">
                                   <strong>{{$thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</strong>
                                </a>
                            </div>
                            <div class="body">{{ $thread->body }}</div>
                        </article>

                        <hr>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
