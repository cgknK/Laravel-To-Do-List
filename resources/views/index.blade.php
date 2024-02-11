@extends('mylayout')<!-- mylayout or layout -->
@section('content')

    <br>
    <a href="{{route("note-s.create")}}" type="button" class="btn btn-success">Add Note</a>
    <br>

    <table class="table" style="width: 1550px;">
        <thead>
        <tr>
            <th scope="col">#id??ordered</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">User Name</th>
            <th scope="col">Reminder State</th>
        </tr>
        </thead>
        <tbody>
            @foreach($one_user_notes as $note)
                <tr>
                    <th scope="row">{{$note->id}}</th>
                    <td>{{$note->title}}</td>
                    <!--td style="width: 750px;word-wrap: break-word;">{{$note->description}}</td-->
                    <td>{{$note->description}}</td>
                    <td>{{$note->user_id}}UserName</td>
                    <td>{{$note->is_remember}}</td>
                    <td>eksik</td>
                    <td><a href="{{route('note-s.show', $note->id)}}" type="button" class="btn btn-info">DoneShow</a> </td>
                    <td><a href="{{route('note-s.edit', $note->id)}}" type="button" class="btn btn-warning">Edit</a> </td>
                    <td>
                        <!-- note-s nerden ch -->
                        <form action="{{route('note-s.destroy', $note->id)}}" method="POST">
                            <!-- bunlar dekaratör mü -->
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">Del</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

@endsection
