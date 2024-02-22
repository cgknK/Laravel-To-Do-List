@extends('mylayout')<!-- mylayout or layout -->
@section('content')
    <style>
        .my-red-left-border {
            border-left: 1px solid #fa0219;
        }
    </style>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
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
                        {{-- session('deleted_note') --}}...Add-More/HideButton
                        </button-->
                        <button id="close_button" type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: flex-end;">
                    <a href="{{route("notes.create")}}" type="button" class="btn btn-success bg-success"><i class="bi bi-plus-square-fill"></i></a>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-striped" style="width: 100%;" >
                        <thead>
                            <tr>
                                <th class="col-md-1" scope="col">No</th>
                                <th class="col-md-2" scope="col">Title</th>
                                <th class="col-md-3" scope="col">Description</th>
                                <th class="col-md-2 text-sm-center" scope="col">User Name</th>
                                <th class="col-md-1" scope="col">Alarm</th>
                                <th class="col-md-2" scope="col">Reminder Time</th>
                                <th class="col-md-1" scope="col" colspan="3" style="text-align: center;">Actions</th>
                                <!-- bu neden colspan 3 değil de 4 de tam oturuyor -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($one_user_notes as $note)
                            <!--tr class="{{-- $note->deleted_at == null && $note->is_remember && date('Y-m-d H:i', strtotime($note->remember_date)) <= date('Y-m-d H:i') ? 'border border-left-danger outline outline-danger' : '' --}}"-->
                            <tr class="{{ $note->deleted_at == null && $note->is_remember && date('Y-m-d H:i', strtotime($note->remember_date)) <= date('Y-m-d H:i') ? 'my-red-left-border' : '' }}">
                                <th scope="col" scope="row">{{$note->id}}</th>
                                <td>{{$note->title}}</td>
                                <!--td style="width: 750px;word-wrap: break-word;">{{--$note->description--}}</td-->
                                <td>{{$note->description}}</td>
                                <td class="align-middle text-sm-center bg-danger">{{$note->user->name}}</td>
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
                                    <td class="text-sm-center">{{-- $note->is_remember --}}-</td>
                                @else
                                    <!--td>{{--$note->remember_date--}}</td-->
                                    <td>{{  date('Y-m-d H:i', strtotime($note->remember_date))  }}</td>
                                @endif
                                <!--td id="joker_a" value="Value {{-- date('Y-m-d H:i', now()) --}}">{{-- date('Y-m-d H:i', now()) --}}></td-->
                                <!--td class="time-info">{{-- $localTime --}}</--td-->
                                <td><a href="{{  route('notes.show', $note->id)  }}" type="button" class="btn btn-info bg-info"><i class="bi bi-search"></i></a> </td>
                                <td><a href="{{  route('notes.edit', $note->id)  }}" type="button" class="btn btn-warning bg-warning"><i class="bi bi-pencil"></i></a> </td>
                                <td>
                                    <!-- note-s nerden ch -->
                                    <form action="{{  route('notes.destroy', $note->id)  }}" method="POST">
                                        <!-- bunlar dekaratör mü -->
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger bg-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $('#myTable').DataTable({
                layout: {
                    topStart: {
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    }
                }
            });
        });

        /*
        new DataTable('#myTable', {
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                }
            }
        });
        */
    </script>
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
@endsection
