@extends('mylayout')
@section('content')

    <br>
    <div class="container">
        <form action="{{route("note-s.store")}}" method="POST">
            <!-- post belirtilmeseydi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Desc...</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_remember">
                <label class="form-check-label" for="flexSwitchCheckDefault">Setting Alarm</label>
            </div>
            <div class="mb-3">
                <label class="form-label">Date&Time</label>
                <input type="datetime-local" class="form-control" name="remember_date">
            </div>
            <button type="submit" class="btn btn-primary bg-primary">Submit</button>
            <input type="reset" value="Reset" class="btn btn-danger bg-danger"/>
        </form>
    </div>
@endsection
