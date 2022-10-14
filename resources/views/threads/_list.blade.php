@forelse ($threads as $thread)
    <div class="card card-default mb-4">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <h5>
                        <a href="{{ $thread->path() }}">
                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong class="text-success">
                                    {{ $thread->title }}
                                </strong>
                            @else
                                {{ $thread->title }}
                            @endif
                        </a>
                    </h5>

                    <h6>Posted By: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a></h6>
                </div>
                <a href="{{ $thread->path() }}">
                    <strong>{{$thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</strong>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="body">{{ $thread->body }}</div>
        </div>
        <div class="card-footer bg-primary text-white">
            {{ $thread->visits }} Visits
        </div>
    </div>
@empty
    <p>There are no relevant result at this time</p>
@endforelse
