@extends('mylayout')
@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div-- class="container">
                    <form action="{{route("notes.store")}}" method="POST">
                        <!-- post belirtilmeseydi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <!-- https://getbootstrap.com/docs/5.3/forms/validation/#how-it-works -->

                        <div class="mb-3 was-validated">
                            <label for="validationTextarea" class="form-label">Description</label>
                            <textarea type="text" class="form-control" name="description" id="floatingTextarea2" placeholder="Required, leave a comment here" style="height: 100px; '*';" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a message in the textarea.
                            </div>
                        </div>
                        <!--div class="mb-3">
                            <label for="validationTextarea" class="form-label">Description</label>
                            {{--@if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif--}}
                            <textarea type="text" class="form-control" name="description" id="floatingTextarea2" style="height: 100px; '*';"></textarea>
                            <div class="invalid-feedback">
                                Please enter a message in the textarea.
                            </div>
                        </div-->

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

                            function toggleAlarmInput() {
                                div.style.display = checkbox.checked ? "block" : "none";
                                getTime();
                            }
                            checkbox.addEventListener("change", toggleAlarmInput);

                            var reset = document.getElementById('resetButton');
                            reset.addEventListener("click", function () {
                                toggleAlarmInput();
                                div.style.display = "none";
                            })
                        </script>
                        <br>
                        <button type="submit" class="btn btn-success bg-success"><i class="bi bi-floppy"></i></button>
                        <button type="reset" id="resetButton" class="btn btn-info bg-info"><i class="bi bi-arrow-clockwise"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
