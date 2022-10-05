@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            @forelse ($threads as $thread)
            <div class="card card-default mb-4">
                <div class="card-header">
                    <div class="level">
                        <h6 class="flex">
                            <a href="{{ $thread->path() }}">
                                @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                    <strong class="text-success">
                                        {{ $thread->title }}
                                    </strong class="text-red">
                                @else
                                    {{ $thread->title }}
                                @endif
                            </a>
                        </h6>
                        <a href="{{ $thread->path() }}">
                            <strong>{{$thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</strong>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="body">{{ $thread->body }}</div>

                    <hr>
                </div>
            </div>
            @empty
                <p>There are n relevant result at this time</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
