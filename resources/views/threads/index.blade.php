@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('threads._list')

            {{ $threads->render() }}
        </div>

        <div class="col-md-4">
            <div class="card mb-5">
                <div class="card-header bg-dark text-white">
                    Search
                </div>

                <div class="card-body">
                    <form method="GET" action="/threads/search">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." name="q" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-dark" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>


            @if (count($trending))
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Trending Threads
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($trending as $thread)
                                <li class="list-group-item">
                                    <a href="{{ url($thread->path) }}">
                                        {{ $thread->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
