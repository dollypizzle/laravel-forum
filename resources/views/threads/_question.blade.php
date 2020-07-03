{{-- Editing the question. --}}
<div class="card card-muted mb-5" v-if="editing">
    <div class="card-header">
        <div class="level">
            <input type="text" class="form-control" v-model="form.title">
        </div>
    </div>

    <div class="card-body">
        <div class="form-group mb-2">
            <textarea class="form-control" rows="5" v-model="form.body"></textarea>
        </div>
    </div>

    <div class="card-footer">
        <div class="level">
            <button class="btn btn-xs btn-secondary level-item" @click="editing = true" v-show="! editing">Edit</button>
            <button class="btn btn-primary btn-primary btn-xs level-item" @click="update">Update</button>
            <button class="btn btn-xs level-item btn-dark" @click="resetForm">Cancel</button>

            @can ('update', $thread)
                <form action="{{ $thread->path() }}" method="POST" class="ml-auto">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-danger">Delete Thread</button>
                </form>
            @endcan

        </div>
    </div>
</div>


{{-- Viewing the question. --}}
<div class="card card-muted mb-5" v-else>
    <div class="card-header">
        <div class="level">
            <img src="{{ $thread->creator->avatar_path }}"
                alt="{{ $thread->creator->name }}"
                width="25"
                height="25"
                class="mr-1">

            <span class="flex">
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted: <span v-text="title"></span>
            </span>
        </div>
    </div>

    <div class="card-body" v-text="body"></div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-x btn-secondary" @click="editing = true">Edit</button>
    </div>
</div>
