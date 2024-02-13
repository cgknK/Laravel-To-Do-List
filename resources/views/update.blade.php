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
                <label class="form-label">Name(Readonly)</label>
                <input type="text" class="form-control" name="remember" value="{{$note->user->name }}" readonly>
            </div>

            <div class="form-check form-switch" >
                <input onchange="toggleDiv()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_remember" style="cursor: pointer"> {{ $note->is_remember ? 'checked' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckDefault">Alarm On/Off</label>
            </div>
            <div class="mb-3" id="secret-div" style="display: none;">
                <label class="form-label">Alarm Date&Time</label>
                <input type="" class="form-control" name="remember_date" value="{{$note->remember_date}}">
            </div>
            <script>
                function toggleDiv() {
                    var checkbox = $('#flexSwitchCheckDefault');
                    var div = $('#secret-div');
                    if (checkbox.prop('checked')) {
                        div.show();
                    } else {
                        div.hide();
                    }
                }
            </script>

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection

Merhaba, bu Copilot. Size yardımcı olmaya çalışacağım. 😊

Gönderdiğiniz kod, Laravel 10.x blade şablonu olarak görünüyor. Bu kod, bir notu güncellemek için bir form oluşturmak için kullanılıyor. Formda, başlık, açıklama, kullanıcı adı, alarm durumu ve alarm tarihi gibi alanlar var.

Kodunuzda bir sorun varsa, bunun nedeni value=“{{ $note->is_remember ? ‘on’ : ‘off’ }}” ve {{ $note->is_remember ? ‘checked’ : ‘’ }} ifadelerinin çakışması olabilir. Bu ifadeler, alarm durumunu belirlemek için kullanılıyor. Ancak, value=“{{ $note->is_remember ? ‘on’ : ‘off’ }}” ifadesi, checkbox’un değerini değiştirmiyor, sadece gönderilen veriyi etkiliyor. {{ $note->is_remember ? ‘checked’ : ‘’ }} ifadesi ise, checkbox’un işaretli olup olmadığını belirliyor.

Bu durumda, value=“{{ $note->is_remember ? ‘on’ : ‘off’ }}” ifadesini kaldırmanız ve sadece {{ $note->is_remember ? ‘checked’ : ‘’ }} ifadesini kullanmanız gerekiyor. Böylece, checkbox’un değeri, işaretli olup olmadığına göre değişecek ve veritabanına doğru şekilde kaydedilecek.

Bu konuda daha fazla bilgi için, Laravel Blade Documentation veya W3Schools HTML Forms Tutorial sayfalarına bakabilirsiniz. Umarım bu cevap yardımcı olmuştur. Başka bir sorunuz varsa, lütfen bana bildirin. 😊
