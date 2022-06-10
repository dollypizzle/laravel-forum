@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header mb-5">
                    <h3>
                        {{ $profileUser->name }}
                    </h3>
                </div>

            @foreach ($activities as $date => $activity)
                <h3 class="card-heading">{{ $date }}</h3>

                @foreach ($activity as $record)
                    @include ("profiles.activities.{$record->type}", ['activity' => $record])
                @endforeach
            @endforeach
            </div>

        </div>
    </div>
@endsection
