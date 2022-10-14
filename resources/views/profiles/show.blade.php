@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header mb-5">
                    <h3>
                        {{ $profileUser->name }}
                    </h3>
                    @can ('update', $profileUser)
                        <form method="POST" action="{{ route('avatar', $profileUser) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="file" name="avatar">

                            <button type="submit" class="btn btn-info" >Add Avatar</button>
                        </form>
                    @endcan
                    <img src="{{ asset($profileUser->avatar_path) }}" width="50" height="50">
                </div>

            @forelse ($activities as $date => $activity)
                <h3 class="card-heading">{{ $date }}</h3>

                @foreach ($activity as $record)
                    @if (view()->exists("profiles.activities.{$record->type}"))
                        @include ("profiles.activities.{$record->type}", ['activity' => $record])
                    @endif
                @endforeach
            @empty
                <p>There is no activity for this user yet.</p>
            @endforelse
            </div>

        </div>
    </div>
@endsection
