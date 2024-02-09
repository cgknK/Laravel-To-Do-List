@extends('mylayout')
@section('content')
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
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="is_remember" name="is_remember" value="1" {{ old('is_remember') ? 'checked="checked"' : '' }}>
                <!-- input type="checkbox" name="is_remember" value="1" {{ old('is_remember') ? 'checked="checked"' : '' }}/ -->
                <label class="custom-control-label" name="is_remember label" for="is_remember">Reminder</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="reset" value="Reset" />
        </form>
    </div>
@endsection
