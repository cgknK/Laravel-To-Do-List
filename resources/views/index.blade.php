@php
    use Illuminate\Support\Str;
@endphp
@extends('mylayout')
@section('content')
    <style>
        .my-red-left-border {
            border-left: 1px solid #fa0219;
        }
        .popover-header {
            color: red;
        }
    </style>
    <style>
        :root {
            --#{$prefix}tooltip-max-width: 800px;
            --#{$prefix}tooltip-color: #00f;
            --#{$prefix}tooltip-bg: #000;
        }
    </style>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="text-gray-900">
                @if (session()->has('successS'))
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                {{-- <img src="http://www.w3.org/2000/svg" class="rounded me-2 green-box" alt="..."> --}}
                                <rect width="100%" height="100%" fill="#007aff"></rect>
                                <strong class="me-auto text-success">{{ session()->get('successS')[0]}}</strong>
                                <small>Created: {{ session('successS')[1] }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Title: {{ session('successS')[2] }}
                            </div>
                        </div>
                    </div>
                    <script>
                        const toastLiveStore = document.getElementById('liveToast');
                        const toast = new bootstrap.Toast(toastLiveStore);
                        toast.show();
                    </script>

                    {{--
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('successS') }}
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    --}}
                @elseif(session()->has('successU'))
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                {{-- <img src="http://www.w3.org/2000/svg" class="rounded me-2 green-box" alt="..."> --}}
                                <rect width="100%" height="100%" fill="#007aff"></rect>
                                <strong class="me-auto text-success">{{ session()->get('successU')[0]}}</strong>
                                <small>Update: {{ session('successU')[1] }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Title: {{ session('successU')[2] }}<br>
                                Ch: {{ session('successU')[3] }}
                            </div>
                        </div>
                    </div>
                    <script>
                        const toastLiveStore = document.getElementById('liveToast');
                        const toast = new bootstrap.Toast(toastLiveStore);
                        toast.show();
                    </script>
                @elseif(session()->has('failU')))
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                {{-- <img src="http://www.w3.org/2000/svg" class="rounded me-2 green-box" alt="..."> --}}
                                <rect width="100%" height="100%" fill="#007aff"></rect>
                                <strong class="me-auto text-success">{{ session()->get('failU')[0]}}</strong>
                                <small>Update: {{ session('failU')[0] }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Title: {{ session('failU')[1] }}<br>
                                Fail: Unknow .d
                            </div>
                        </div>
                    </div>
                    <script>
                        const toastLiveStore = document.getElementById('liveToast');
                        const toast = new bootstrap.Toast(toastLiveStore);
                        toast.show();
                    </script>
                @elseif(session()->has('successD'))
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                {{-- <img src="http://www.w3.org/2000/svg" class="rounded me-2 green-box" alt="..."> --}}
                                <rect width="100%" height="100%" fill="#007aff"></rect>
                                <strong class="me-auto text-success">{{ session()->get('successD')[0]}}</strong>
                                <small>Destroy: {{ session('successD')[1] }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Title: {{ session('successD')[2] }}
                            </div>
                        </div>
                    </div>
                    <script>
                        const toastLiveStore = document.getElementById('liveToast');
                        const toast = new bootstrap.Toast(toastLiveStore);
                        toast.show();
                    </script>
                {{--
                    <p></p>
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                {{ <img src="http://www.w3.org/2000/svg" class="rounded me-2 green-box" alt="..."> }}
                                <rect width="100%" height="100%" fill="#007aff"></rect>
                                <strong class="me-auto text-success">{{ session('deleted_note') }}</strong>
                                <small>Created: {{ session('deleted_note') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Title: {{ session('deleted_note') }}
                            </div>
                        </div>
                    </div>
                    <script>
                        const toastLiveStore = document.getElementById('liveToast');
                        const toast = new bootstrap.Toast(toastLiveStore);
                        toast.show();
                    </script>
                    <br>
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
    --}}
                @endif
            </div>
            <div class="card overflow-auto">
                <div class="card-header" style="display: flex; justify-content: flex-end;">
                    <a href="{{  route("notes.create")  }}" type="button" class="btn btn-success bg-success"><i class="bi bi-plus-square-fill"></i></a>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-striped" style="width: 100%;" >
                        <thead>
                            <tr>
                                <th class="col-md-1 text-sm-center" scope="col">No</th>
                                <th class="col-md-2" scope="col">Title</th>
                                <th class="col-md-3" scope="col">Description</th>
                                <th class="col-md-2 text-sm-center" scope="col">User Name</th>
                                <th class="col-md-1 text-sm-center" scope="col">Alarm</th>
                                <th class="col-md-2" scope="col">Reminder Time</th>
                                <th class="col-md-1" scope="col" colspan="3" style="text-align: center;">Actions</th>
                                <!-- bu neden colspan 3 değil de 4 de tam oturuyor -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($one_user_notes as $note)
                            @php
                                //$limitedDescription = Str::of($note->description, 100, '...')->limit(10);
                                //$len = 27;
                                $len = 20;
                                $limitedDescription = substr($note->description, 0, $len);
                                if (strlen($note->description) > $len) {
                                    $limitedDescription .= "...";
                                }
                            @endphp
                            @if(0 && $note->title == "Non dolore elit aut")
                                <p>{{ $limitedDescription }}</p>
                            @endif
                                <!--tr class="{{-- $note->deleted_at == null && $note->is_remember && date('Y-m-d H:i', strtotime($note->remember_date)) <= date('Y-m-d H:i') ? 'border border-left-danger outline outline-danger' : '' --}}"-->
                            <tr class="{{ $note->deleted_at == null && $note->is_remember && date('Y-m-d H:i', strtotime($note->remember_date)) <= date('Y-m-d H:i') ? 'my-red-left-border' : '' }}">
                                <th class="text-sm-center" scope="col" scope="row">{{$note->id}}</th>
                                <td>{{$note->title}}</td>
                                <!--td style="width: 750px;word-wrap: break-word;">{{--$note->description--}}</td-->
                                <td class="description-cell" role="button" data-fullDescription="{{ $note->description }}">
                                    <div class="description-container">
                                        <span class="copy-button" onclick="myFunction()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $note->description }}">
                                            {{ $limitedDescription }}
                                        </span>
                                    </div>
                                </td>
                                <script>
                                    window.APP_DEBUG = @json(env('APP_DEBUG'));
                                    function myFunction() {
                                        /*
                                        // Get the text field
                                        let copyText = document.querySelector(".copy-button");
                                        console.log(copyText);
                                        // Select the text field
                                        let fullDescription = copyText.dataset.fullDescription;
                                        console.log(fullDescription);

                                        // Copy the text inside the text field
                                        navigator.clipboard.writeText(fullDescription);

                                        // Alert the copied text
                                        alert("Copied the text: " + fullDescription);
                                         */
                                        // Get the HTML element
                                        let copyText = document.querySelector(".copy-button");
                                        console.log(copyText);
                                        // Get the original title from the dataset
                                        let originalTitle = copyText.dataset.bsOriginalTitle;
                                        console.log(originalTitle);
                                        // Copy the original title to the clipboard
                                        navigator.clipboard.writeText(originalTitle);
                                        if ( window.APP_DEBUG ) {
                                            // Alert the copied text
                                            alert("DEBUG=True - Copied the text: " + originalTitle);
                                        }
                                    }
                                </script>
                                {{-- <td>{{ Str::limit($note->description, 300, '...') }}</td> --}}
                                <td class="text-sm-center">{{$note->user->name}}</td>
                                @if($note->is_remember == 0)
                                    <td>
                                        <div class="custom-control custom-switch text-sm-center">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" disabled>
                                            <label class="custom-control-label" for="customSwitch1"></label>
                                            <!-- Gizli alan ekleyin -->
                                            <input type="hidden" name="is_remember" value="off">
                                        </div>
                                    </td>
                                @else
                                    <td>
                                        <div class="custom-control custom-switch align-middle text-sm-center">
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
                                    <form action="{{  route('notes.destroy', $note->id)  }}" method="POST" id="delete-form-{{$note->id}}">
                                        <!-- bunlar dekaratör mü -->
                                        @csrf
                                        @method("DELETE")
                                        {{--
                                        <!--button type="button" class="btn btn-danger bg-danger example-popover" data-bs-html=“true” data-bs-toggle="popover" data-bs-title="Attention: Delete" data-bs-content=""><i class="bi bi-trash" ></i></button-->
                                        <button type="button" class="btn btn-danger bg-danger" data-bs-trigger="focus" data-bs-toggle="popover" data-bs-html="true" data-bs-title="Attention: Delete" data-bs-content="<div class='modal-like'><div class='modal-like-body'><p>{{ $note->title }}: {{ Str::words($note->description, 20, '...') }}</p></div><div class='modal-like-footer'><a type='button' class='btn btn-secondary bg-secondary m-1 mx-1'>Close</a><a class='btn btn-danger bg-danger m-1 mx-1' data-form-id='delete-form-{{ $note->id }}'>OK</a></div></div>"><i class="bi bi-trash"></i></button>
                                        <!--button data-bs-target="#popover-{{$note->id}}" type="button" class="btn btn-danger bg-danger" data-bs-trigger="focus" data-bs-toggle="popover" data-bs-html="true" data-bs-title="Attention: Delete" data-bs-content="<div class='modal-like'><div class='modal-like-body'><p>{{ $note->title }}: {{ Str::words($note->description, 20, '...') }}</p></div><div class='modal-like-footer'><a type='button' class='btn btn-secondary bg-secondary m-1 mx-1'>Close</a><a type='button' class='btn btn-danger bg-danger m-1 mx-1' data-form-id='delete-form-{{$note->id}}'>OK</a></div></div>"><i class="bi bi-trash"></i></button-->
                                        --}}
                                        <button type="button" class="btn btn-danger bg-danger" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-trash"></i></button>
                                        <button type="submit" class="btn btn-outline-light" style="display: none" id="delete-submit-{{$note->id}}">bu yazi gorunmemelidir</button>
                                        <!-- The Modal -->
                                        <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Attention: Delete</h4>
                                                        <button type="button" class="btn btn-close" data-bs-dismiss="modal">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure; delete {{  $note->title  }}: {{ $limitedDescription }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary bg-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger bg-danger" data-bs-dismiss="modal">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

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

            $('#myTable').DataTable({
                layout: {
                    topStart: {
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    }
                }
            });
        });

        /*
        const descriptionCells = document.querySelectorAll('.description-cell');

        descriptionCells.forEach(cell => {
            const copyButton = cell.querySelector('.copy-button');

            if (copyButton) {
                copyButton.addEventListener('click', async () => {
                    const fullDescription = cell.dataset.fullDescription;
                    console.log(fullDescription);

                    if (fullDescription) {
                        try {
                            await navigator.clipboard.writeText(fullDescription);
                            console.log('Tam açıklama kopyalandı!');
                        } catch (error) {
                            console.error('Tam açıklama kopyalama başarısız:', error);
                        }
                    } else {
                        console.error('Tam açıklama verisi bulunamadı!');
                    }
                });
            }
        });
         */

        /*
        const descriptionCells = document.querySelectorAll('.description-cell');

        descriptionCells.forEach(cell => {
            const copyButton = cell.querySelector('.copy-button');

            if (copyButton) {
                copyButton.addEventListener('click', async () => {
                    //const fullDescription = cell.dataset.fullDescription;
                    const fullDescription = cell.dataset.fullDescription
                    console.log(fullDescription.length > 0);

                    if (fullDescription || !fullDescription) {
                        try {
                            await navigator.clipboard.writeText(fullDescription);
                            console.log('Tam açıklama kopyalandı!');
                        } catch (error) {
                            console.error('Tam açıklama kopyalama başarısız:', error);
                        }
                    } else {
                        console.error('Tam açıklama verisi bulunamadı!');
                    }
                });
            }
        });

         */

        /*
        const descriptionCells = document.querySelectorAll('.description-cell');

        descriptionCells.forEach(cell => {
            const copyButton = cell.querySelector('.copy-button');

            if (copyButton) {
                copyButton.addEventListener('click', async () => {
                    //const fullDescription = cell.dataset.fullDescription;
                    const fullDescription = cell.dataset.fullDescription
                    console.log(fullDescription.length > 0);

                    if (fullDescription && fullDescription.length > 0) {
                        try {
                            await navigator.clipboard.writeText(fullDescription);
                            console.log('Tam açıklama kopyalandı!');
                        } catch (error) {
                            console.error('Tam açıklama kopyalama başarısız:', error);
                        }
                    } else {
                        console.error('Tam açıklama verisi bulunamadı!');
                    }
                });
            }
        });
         */
    </script>
@endsection
