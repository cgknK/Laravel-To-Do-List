@extends('mylayout')
@section('content')
    <!-- container -->
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
            <label class="form-label">Reminder</label>
            <input type="text" class="form-control" name="r:0/1" value="{{$note->is_remember}}" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
