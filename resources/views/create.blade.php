@extends('mylayout')
@section('content')

    <br>
    <div class="container">
        <form action="{{route("notes.store")}}" method="POST">
            <!-- post belirtilmeseydi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" name="description">
            </div>


            <div class="form-check form-switch" >
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_remember" style="cursor: pointer">
                <label class="form-check-label" for="flexSwitchCheckDefault">Alarm On/Off</label>
            </div>
            <div class="mb-3" id="secret-div" style="display: none;">
                <label class="form-label">Alarm Date&Time</label>
                <input type="datetime-local" class="form-control" name="remember_date" id="remember_date" value="">
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

            <br>
            <button type="submit" class="btn btn-success bg-success">Add Note</button>
            <input type="reset" value="Reset" class="btn btn-danger bg-danger"/>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
