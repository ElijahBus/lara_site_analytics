@extends('dashboard::layouts.main')

@section('content')
    <div class="col-12">
        <div>
            <!-- navbar -->
            <nav class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <div class="container-fluid">
                        <div class="row sideways bingo">
                            <!-- sidebar -->
                                @include('dashboard::assets.sidebar')
                            <!-- end of sidebar -->
                        </div>
                    </div>
                </div>
            </nav>
            <!-- end of navbar -->

            <!-- All Assets -->
            <div id="content bingo">
                {{-- Tos --}}
                <div>
                    <div class="col-xl-10 col-lg-9 col-md-8 mb-5 ml-auto">
                        <h2 class="text-uppercase">TOS(Terms Of Services)</h2>
                    </div>
                    {{-- modal for new tos --}}
                    <div id="new-tos-background"></div>
                    <div id="new-tos-content">
                        <i class="closet fas fa-times" id="new-tos-close"></i>
                        <div>
                            <div class="users text-dark mb-4">New TOS</div>
                        </div>
                        <form action="{{ route('tos.store') }}" method="POST">
                            @csrf
                            <div>
                                <div class="text-dark mb-4">
                                    <textarea class="form-control desc1" name="version" id="" cols="3" rows="5" placeholder="Version"></textarea>
                                    @error('version')
                                        <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="text-dark mb-4">
                                    <textarea class="form-control desc1" name="type" id="" cols="3" rows="5" placeholder="Type"></textarea>
                                    @error('type')
                                        <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="roles5 mb-2">Content:</div>
                                <textarea class="form-control desc0" name="content" id="" cols="3" rows="5"></textarea>
                                @error('content')
                                    <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <button class="users0 btn text-white">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                    {{-- end of  modal for new tos --}}

                    {{-- modal for editing roles --}}
                    <div id="edit-tos-background"></div>
                    <div id="edit-tos-content">
                        <i class="closet fas fa-times" id="edit-tos-close"></i>
                        <div>
                            <div class="users text-dark mb-4">EDIT TOS</div>
                        </div>

                        @isset ($data)
                            <form action="{{ route('tos.update', $data->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div>
                                    <div class="text-dark mb-4">
                                        <textarea class="form-control desc1" name="edit_version" id="" cols="3" rows="5">{{ $data->version }}</textarea>
                                        @error('edit_version')
                                            <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="text-dark mb-4">
                                        <textarea class="form-control desc1" name="edit_type" id="" cols="3" rows="5">{{ $data->type }}</textarea>
                                        @error('edit_type')
                                            <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="roles5 mb-2">Content:</div>
                                    <textarea class="form-control desc0" name="edit_content" id="" cols="3" rows="5">{{ $data->content }}</textarea>
                                    @error('edit_content')
                                        <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <button class="users0 btn text-white">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        @endisset
                    </div>
                    {{-- end of modal for editing tos --}}

                    {{-- modal for viewing tos --}}
                    <div id="view-tos-background"></div>

                    @isset ($viewTos)
                        <div id="view-tos-content">
                            <i class="closet fas fa-times" id="view-tos-close"></i>
                            <div>
                                <div class="users text-dark mb-4">View TOS</div>
                            </div>

                            <div class="row">
                                <div class="text-dark mb-4">
                                    <div class="form-control desc1" name="" id="" cols="3" rows="5">{{ $data->version }}</div>
                                </div>
                                <div class="text-dark mb-4">
                                    <div class="form-control desc1" name="" id="" cols="3" rows="5">{{ $data->type }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="roles5">Content:</div>
                                <textarea class="form-control desc0" name="content" id="" cols="3" rows="5" disabled>{{ $data->content }}</textarea>
                            </div>
                        </div>
                    @endisset
                    {{-- end of modal for viewing role --}}

                    <div class="row">
                        <div class="col-xl-10 col-lg-9 mt-md-5 pt-md-1 col-md-8 ml-auto">
                            <div class="mb-5 pb-5">
                                <div class="card sizing4 card-common">
                                    <div class="card-body">
                                        <h3 class="text-dark text-left mb-3">TOS(Terms Of Services)  </h3>

                                        {{-- Search tos field --}}
                                        <div class="row mb-4 rowu">
                                            <div class="col users-search-continer">
                                                <form action="{{ route('tos.display') }}" method="post" class="d-flex row">
                                                    @csrf
                                                    <div class="col col-md-6 ">
                                                        <input class="form-control control users-search" list="tos-list" id="tos-search" name="tos-search"  placeholder="Search Tos"/>
                                                    </div>
                                                    <div class="col col-md-3 ">
                                                        <button type="submit" class="btn new text-white">Search Tos</button>
                                                    </div>
                                                    {{-- New tos launch button --}}
                                                    <div class="col col-md-3">
                                                        <button type="button" class="btn new text-white" id="new-tos-launcher">New TOS</button>
                                                    </div>
                                                </form>
                                                <datalist id="tos-list">
                                                    @isset($toss)
                                                        @foreach ($toss as $tos)
                                                            <option value="{{ $tos->version }}"></option>
                                                        @endforeach
                                                    @endisset
                                                </datalist>
                                            </div>
                                        </div>


                                        {{-- Tos list --}}
                                        <table class="table table-white  table-hover text-left">
                                            <thead>
                                            <tr class="text-muted">
                                                {{-- <th>
                                                    <label class="container1">
                                                        <input type="checkbox" checked="checked">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th> --}}
                                                <th>VERSION</th>
                                                <th>CONTENT</th>
                                                <th>TYPE</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($toss as $tos)
                                                    <tr>
                                                        {{-- <th>
                                                            <label class="container1">
                                                                <input type="checkbox">
                                                                <span class="checkmark1 checkmark"></span>
                                                            </label>
                                                        </th> --}}
                                                        <td>{{ $tos->version }}</td>
                                                        <td>{{ $tos->type }}</td>
                                                        <td>{{ $tos->content }}</td>
                                                        <td class="text-primary">
                                                            <a class="links" id="edit-tos-launcher" href="{{ route('tos.edit', $tos->id) }}">
                                                                <i class="far fa-edit"></i>
                                                                Edit
                                                            </a>
                                                        </td>
                                                        <td class="text-primary">
                                                            <a class="links" id="view-tos-launcher" href="{{ route('tos.show', $tos->id) }}">
                                                                <i class="far fa-eye"></i>
                                                                View TOS
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('tos.destroy', $tos->id) }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button class="btn delete text-white">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                    Remove
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- pagination -->
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="pagination justify-content-center">
                                                    <a href="#"><i class="fas fa-caret-left"></i></a>
                                                    <a href="#">1</a>
                                                    <a href="#"><i class="fas fa-caret-right"></i></a>
                                                </div>
                                            </div>
                                            <span class="mr-2 mt-1 roles3">Show:</span>
                                            <div class="show">
                                                <select class="form-control control" name="cars" id="cars">
                                                    <option value="volvo">5</option>
                                                    <option value="saab">10</option>
                                                    <option value="mercedes">20</option>
                                                    <option value="audi">50</option>
                                                    <option value="audi">100</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- end of pagination -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of Tos --}}
            </div>
            {{-- End of all assets --}}
        </div>
    </div>
@endsection


