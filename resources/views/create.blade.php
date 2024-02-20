@extends('mylayout')
@section('content')
    <!--script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet"-->

    <br>
    <br>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
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
                            <!--input type="text" class="form-control form-control-lg" name="description"-->
                            <textarea type="text" class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required></textarea>
                        </div>

                        <div class="form-check form-switch" >
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_remember" style="cursor: pointer">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Alarm On/Off</label>
                        </div>
                        <div class="mb-3" id="secret-div" style="display: none;">
                            <label class="form-label">Alarm Date&Time</label>
                            <input type="datetime-local" class="form-control" name="remember_date" id="remember_date" value="">
                            <script>
                                function getTime() {
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
                                }
                            </script>
                        </div>
                        <script>
                            var checkbox = document.getElementById("flexSwitchCheckDefault");
                            var div = document.getElementById("secret-div");

                            checkbox.addEventListener("change", function() {
                                div.style.display = checkbox.checked ? "block" : "none";
                                getTime();
                            });
                        </script>

                        <br>
                        <button type="submit" class="btn btn-success bg-success"><i class="bi bi-floppy"></i></button>
                        <button type="reset" class="btn btn-info bg-info"><i class="bi bi-arrow-clockwise"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet"-->
@endsection
