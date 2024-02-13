@extends('mylayout')
@section('content')
    <div class="container">
        <form action="{{route("note-s.update", $note->id)}}" method="POST">
            <!-- post belirtilmeseydi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{$note->title}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Desc...</label>
                <input type="text" class="form-control" name="description" value="{{$note->description}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="remember" value="{{$note->user->name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Reminder</label>
                <input type="text" class="form-control" name="remember" value="{{$note->is_remember}}">
            </div>
            @if($note->is_remember === 1)
                <div class="mb-3">
                    <label class="form-label">Remember Date</label>
                    <input type="text" class="form-control" name="remember_date" value="{{$note->remember_date}}">
                </div>
            @endif
            @if($note->deleted_at != null)
                <div class="mb-3">
                    <label class="form-label">Done timestamp</label>
                    <input type="text" class="form-control" name="delete" value="{{$note->deleted_at}}" readonly>
                </div>
            @endif
            <button type="submit" class="btn btn-warning bg-warning">Update</button>
            <button type="reset" class="btn btn-info bg-info">Reset(LastCheckPoint)</button>
            <!-- input type="reset" value="Reset" / -->
        </form>
    </div>
@endsection
