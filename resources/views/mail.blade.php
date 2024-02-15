@extends('mylayout')<!-- mylayout or layout -->
@section('content')
    <div class="card" style="width: 18rem;">
        <img src="" class="card-img-top" alt="">
        <div class="card-body">
            <h5 class="card-title">{{ $title }}</h5>
            <p class="card-text">{{ $body }}</p>
            <a href="{{ route('note-s.index') }}" class="btn btn-primary bg-primary">Notes</a>
            <!-- geri al sayacı -->
        </div>
    </div>
@endsection
