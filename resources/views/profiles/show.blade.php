@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header mb-5">
                    <h3>
                        {{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h3>
                </div>

            @foreach ($threads as $thread)
                <div class="card mb-5">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">
                                    {{ $thread->creator->name }}
                                </a> posted:
                                <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                            </span>
                            <span>
                                {{ $thread->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            @endforeach

            {{ $threads->links() }}
            </div>

        </div>
    </div>
@endsection
