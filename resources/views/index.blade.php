@extends('mylayout')<!-- mylayout or layout -->
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        document.getElementById("joker_a").value = localTime;
    </script>

    @if (session()->has('successS'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('successS')}}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @elseif(session()->has('successU'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('successU') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @elseif(session()->has('successD'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('successD') }}<br>
            <span id="more-content" style="display: none;">{{ session('deleted_note') }}</span>
            <button id="more-button" type="button" class="btn btn-info bg-info mt-3">More...</button>
            <!--button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            {{ session('deleted_note') }}...Add-More/HideButton
            </button-->
            <button id="close_button" type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <script>
            $(document).ready(function(){
                $("#more-button").click(function(){
                    $("#more-content").toggle();
                    if($("#more-content").is(":visible")){
                        $("#more-button").text("<Hide");
                        $("#more-button").addClass("d-block");
                    }else{
                        $("#more-button").text("More...");
                        $("#more-button").removeClass("d-block");
                    }
                });
            });
        </script>
    @endif

    <br>
    <div class="container">
        <a href="{{route("notes.create")}}" type="button" class="btn btn-success bg-success">Add Note</a>
        <br>
        <br>
        <table class="table" style="width: 100%;">
            <thead>
            <tr>
                <th class="col-md-1" scope="col">No</th>
                <th class="col-md-1" scope="col">Title</th>
                <th class="col-md-3" scope="col">Description</th>
                <th class="col-md-2" scope="col">User Name</th>
                <th class="col-md-1" scope="col">Alarm</th>
                <th class="col-md-2" scope="col">Reminder Time</th>
                <th class="col-md-2" scope="col" colspan="4" style="text-align: center;">Actions</th>
                <!-- bu neden colspan 3 değil de 4 de tam oturuyor -->
            </tr>
            </thead>
            <tbody>
            @foreach($one_user_notes as $note)
                <tr class="{{ $note->deleted_at == null && $note->is_remember && date('Y-m-d H:i', strtotime($note->remember_date)) >= date('Y-m-d H:i') ? 'alert alert-danger' : '' }}">
                    <th scope="row">{{$note->id}}</th>
                    <td>{{$note->title}}</td>
                    <!--td style="width: 750px;word-wrap: break-word;">{{$note->description}}</td-->
                    <td>{{$note->description}}</td>
                    <td>{{$note->user->name}}</td>
                    @if($note->is_remember == 0)
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" disabled>
                                <label class="custom-control-label" for="customSwitch1"></label>
                                <!-- Gizli alan ekleyin -->
                                <input type="hidden" name="is_remember" value="off">
                            </div>
                        </td>
                    @else
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked disabled>
                                <label class="custom-control-label" for="customSwitch1"></label>
                                <!-- Gizli alan ekleyin -->
                                <input type="hidden" name="is_remember" value="{{ $note->is_remember }}">
                            </div>
                        </td>
                    @endif

                    @if($note->is_remember == 0)
                        <td>{{-- $note->is_remember --}}-</td>
                    @else
                        <!--td>{{--$note->remember_date--}}</td-->
                        <td>{{date('Y-m-d H:i', strtotime($note->remember_date))}}</td>
                    @endif
                    <td id="joker_a" value="Value {{-- date('Y-m-d H:i', now()) --}}">{{-- date('Y-m-d H:i', now()) --}}</td>
                    <!--td class="time-info">{{-- $localTime --}}</--td-->
                    <td><a href="{{route('notes.show', $note->id)}}" type="button" class="btn btn-info bg-info">Show&Done</a> </td>
                    <td><a href="{{route('notes.edit', $note->id)}}" type="button" class="btn btn-warning bg-warning">Edit</a> </td>
                    <td>
                        <!-- note-s nerden ch -->
                        <form action="{{route('notes.destroy', $note->id)}}" method="POST">
                            <!-- bunlar dekaratör mü -->
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger bg-danger">Del(Done)</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <!--div class="container">
        <a href="{{ route('email.send')  }}" class="btn btn-secondary bg-secondary">Test e-mail get</a>
    </div-->

    <div class="container">
        <p>
            <br>
            sessions neden yok but work<br>
            index de delete sonrası hide da close butonu yanda değil<br>
            <br>
            Mail<br>
            socket (io)<br>
            .env ile nasıl şifreli mail ayarlanıp şifresiz sunucuya mail atılıyor<br>
            validation+double??<br>
            data table(order by reminder ext.)<br>
            <!-- geri al sayacı -->
            filter_input(), filter_var(), htmlspecialchars(), mysqli_real_escape_string()<br>
            prepared statements<br>
            alarm geçiş zamana kurulmaya çalışılırsa uyar<br>
            parametreyi comentlemeden yapmaya çalış<br>
            <br
            if not auth->go auth | token?<br>
            font, size, theme farklarını düzelt<br>
            loout->welcome yapılacak<br>
            edit ile hiç birşey değiştirilmeden update edildiğinde farklı bir bildirim ver ve veritabanına gitme<br>
            create de reset now() vermiyor<br>
            \n neden çalışmıyor mailde<br>
        </p>
    </div>

    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script-->

@endsection
