@extends('mylayout')
@section('content')
    <div class="container">
        <form action="{{route("note-s.store")}}" method="POST">
            <!-- post belirtilmeseydi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label">Desc...</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="mb-3">
                <label class="form-label">Reminder</label>
                <input type="text" class="form-control" name="is_remember">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="reset" value="Reset" />
        </form>
    </div>
@endsection
