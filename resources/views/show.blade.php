@extends('mylayout')
@section('content')
    <br>
    <br>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- container -->
                <div class="container">
                    <!-- @csrf gerekiyor mu -->
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="name" value="{{$note->title}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="desc" value="{{$note->description}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="remember" value="{{$note->user->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reminder</label>
                            <input type="text" class="form-control" name="remember" value="{{$note->is_remember ? "On" : "Off"}}" disabled>
                        </div>
                        @if($note->is_remember === 1)
                            <div class="mb-3">
                                <label class="form-label">Remember Date</label>
                                <input type="text" class="form-control" name="remember_date" value="{{$note->remember_date}}" disabled>
                            </div>
                        @endif
                        @if($note->deleted_at != null)
                            <div class="mb-3">
                                <label class="form-label">Done timestamp</label>
                                <input type="text" class="form-control" name="delete" value="{{$note->deleted_at}}" disabled>
                            </div>
                        @endif
                    </form>
                    <form action="{{route('notes.destroy', $note->id)}}" method="POST">
                        <!-- bunlar dekaratör mü -->
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger bg-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
