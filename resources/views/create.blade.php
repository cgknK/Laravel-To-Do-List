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
                <input onchange="$('#secret-div').toggle()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_remember">
                <label class="form-check-label" for="flexSwitchCheckDefault">Alarm On/Off</label>
            </div>
            {{-- @if(old('is_remember')) --}}
                <div class="mb-3" id="secret-div">
                    <label class="form-label">Alarm Date&Time</label>
                    <input type="datetime-local" class="form-control" name="remember_date">
                </div>
            {{-- @endif --}}
            <br>
            <button type="submit" class="btn btn-success bg-success">Submit</button>
            <input type="reset" value="Reset" class="btn btn-danger bg-danger"/>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
