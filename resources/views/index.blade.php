@extends('mylayout')<!-- mylayout or layout -->
@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <a href="{{route("note-s.create")}}" type="button" class="btn btn-success bg-success">Add Note</a>
        <br>
        <br>
        <table class="table" style="width: 100%;">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">User Name</th>
                <th scope="col">Reminder State</th>
                <th scope="col">Time Info</th>
                <th scope="col" colspan="3" style="text-align: center;">Quick Buttons</th>
            </tr>
            </thead>
            <tbody>
            @foreach($one_user_notes as $note)
                <tr>
                    <th scope="row">{{$note->id}}</th>
                    <td>{{$note->title}}</td>
                    <!--td style="width: 750px;word-wrap: break-word;">{{$note->description}}</td-->
                    <td>{{$note->description}}</td>
                    <td>{{$note->user->name}}</td>
                    @if($note->is_remember == 0)
                        <td>{{-- $note->is_remember --}}Doesn't exist</td>
                    @else
                        <!--td>{{$note->remember_date}}</td-->
                        <td>{{date('Y-m-d\TH:i', strtotime($note->remember_date))}}</td>
                    @endif
                    <td>eksik</td>
                    <td><a href="{{route('note-s.show', $note->id)}}" type="button" class="btn btn-info bg-info">Show&Done</a> </td>
                    <td><a href="{{route('note-s.edit', $note->id)}}" type="button" class="btn btn-warning bg-warning">Edit</a> </td>
                    <td>
                        <!-- note-s nerden ch -->
                        <form action="{{route('note-s.destroy', $note->id)}}" method="POST">
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

    <div class="container">
        <form action="http://localhost:8000/send-welcome-email" method="POST">
            <button type="submit" class="btn btn-secondary bg-secondary">Test e-mail</button>
        </form>
    </div>
    <a href="http://localhost:8000/send-welcome-email" class="btn btn-secondary bg-secondary">Test e-mail get</a>

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
            filter_input(), filter_var(), htmlspecialchars(), mysqli_real_escape_string()<br>
            prepared statements<br>
            alarm geçiş zamana kurulmaya çalışılırsa uyar<br>
            <br
            if not auth->go auth | token?<br>
            font, size, theme farklarını düzelt<br>
            loout->welcome yapılacak<br>
            edit ile hiç birşey değiştirilmeden update edildiğinde farklı bir bildirim ver ve veritabanına gitme<br>
        </p>
    </div>

    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script-->

@endsection
