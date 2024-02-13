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

            <!--div class="form-check form-switch" >
                <input onchange="toggleDiv()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_remember" style="cursor: pointer" {{ $note->is_remember ? 'checked' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckDefault">Alarm On/Off</label>
            </div>
            <div class="mb-3" id="secret-div" style="display: block;">
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
            </script-->

            <!--div class="form-check form-switch" >
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_remember" style="cursor: pointer" {{ $note->is_remember ? 'checked' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckDefault">Alarm On/Off</label>
            </div>
            <div class="mb-3" id="secret-div" style="display: block;">
                <label class="form-label">Alarm Date&Time</label>
                <input type="datetime-local" class="form-control" name="remember_date" value="{{$note->remember_date}}">
            </div>
            <script>
                $(document).ready(function() {
                    $("#secret-div").css("display", $("#flexSwitchCheckDefault").prop("checked") ? "block" : "none");

                    $("#flexSwitchCheckDefault").change(function() {
                        $("#secret-div").toggle(this.checked);
                    });
                });
            </script-->



            <div class="form-check form-switch" >
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_remember" style="cursor: pointer" {{ $note->is_remember ? 'checked="checked"' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckDefault">Alarm On/Off</label>
            </div>
            <div class="mb-3" id="secret-div" style="display: {{ $note->is_remember ? 'block' : 'none' }};">
                <label class="form-label">Alarm Date&Time</label>
                <!--input type="datetime-local" class="form-control" name="remember_date" id="remember_date" value="{{-- $note->remember_date ? Carbon\Carbon::parse($note->remember_date)->format('Y-m-d\TH:i') : '' --}}"-->
                <input type="datetime-local" class="form-control" name="remember_date" id="remember_date" value="{{$note->is_remember ? $note->remember_date : ""}}"> <!-- date('Y-m-d H:i:s') --->
                <script>
                    // Kullanıcının yerel saatini al
                    var year = new Date().getFullYear();
                    var month = new Date().getMonth();
                    var day = new Date().getDate();
                    var hour = new Date().getHours();
                    var minute = new Date().getMinutes();

                    // Kullanıcının yerel saatine göre bir UTC zaman damgası oluştur
                    var utcTime = Date.UTC(year, month, day, hour, minute);

                    // Bu UTC zaman damgasını new Date() fonksiyonuna parametre olarak ver
                    var localTime = new Date(utcTime).toISOString().substring(0, 16);

                    // value özelliğine yerel saati ata
                    if(!{{$note->is_remember}})
                        document.getElementById("remember_date").value = localTime;
                </script>
            </div>
            <script>
                var checkbox = document.getElementById("flexSwitchCheckDefault");
                var div = document.getElementById("secret-div");

                checkbox.addEventListener("change", function() {
                    div.style.display = checkbox.checked ? "block" : "none";
                });
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
