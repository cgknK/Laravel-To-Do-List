@extends('mylayout')
@section('content')
    <br>
    <!-- container -->
    <div class="container">
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
                <label class="form-label">GereksizUserID</label>
                <input type="text" class="form-control" name="remember" value="{{$note->user_idgit }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Reminder</label>
                <input type="text" class="form-control" name="remember" value="{{$note->is_remember}}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Remember Date</label>
                <input type="text" class="form-control" name="rememberDate" value="{{$note->remember_date}}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Del</label>
                <input type="text" class="form-control" name="delete" value="{{$note->deleted_at}}" readonly>
            </div>
            <button type="submit" class="btn btn-primary" style="color: black">Submit</button>
        </form>
    </div>

@endsection
