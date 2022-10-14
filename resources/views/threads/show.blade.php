@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection

@section('content')
<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">
                        <div class="level">
                            <img src="{{ $thread->creator->avatar() }}" alt="{{ $thread->creator->name }}" width="25" height="25" class="mr-1 rounded">
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">
                                    {{ $thread->creator->name }}
                                </a> posted:
                                {{ $thread->title }}
                            </span>
                            @can('update', $thread)
                                <form action="{{ $thread->path() }} " method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                <replies @added="repliesCount++"
                @removed="repliesCount--"></replies>

            </div>
            <div class="col-md-4">
                <div class="card mb-5">
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans()}} by
                            <a href="">{{ $thread->creator->name }}</a>, and currently
                            has <span v-text="repliesCount"></span> {{ Str::plural('comment', $thread->replies_count) }}.
                        </p>
                        <p>
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
