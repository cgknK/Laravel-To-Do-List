@extends('mylayout')
@section('content')
    <br>
    <!-- container -->
    <div class="container">
        <!-- @csrf gerekiyor mu -->
        <form>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="name" value="{{$note->title}}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Desc...</label>
                <input type="text" class="form-control" name="desc" value="{{$note->description}}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="remember" value="{{$note->user->name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Reminder</label>
                <input type="text" class="form-control" name="remember" value="{{$note->is_remember}}" readonly>
            </div>
            @if($note->is_remember === 1)
                <div class="mb-3">
                    <label class="form-label">Remember Date</label>
                    <input type="text" class="form-control" name="remember_date" value="{{$note->remember_date}}" readonly>
                </div>
            @endif
            @if($note->deleted_at != null)
            <div class="mb-3">
                <label class="form-label">Done timestamp</label>
                <input type="text" class="form-control" name="delete" value="{{$note->deleted_at}}" readonly>
            </div>
            @endif
        </form>
        <form action="{{route('note-s.destroy', $note->id)}}" method="POST">
            <!-- bunlar dekaratör mü -->
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger bg-danger">Del(Done)</button>
        </form>
    </div>
@endsection
