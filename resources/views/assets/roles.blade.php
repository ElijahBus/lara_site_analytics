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
                {{-- Roles --}}
                <div>
                    <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                        <h2 class="text-uppercase mb-5 pb-5 analyticing2">Roles</h2>
                    </div>
                    {{-- modal for new roles --}}
                    <div id="new-role-background"></div>
                    <div id="new-role-content">
                        <i class="closet fas fa-times" id="new-role-close"></i>
                        <div>
                            <div class="users text-dark mb-4">New Role</div>
                        </div>
                        <form action="{{ route('role.store') . "#roles" }}" method="POST">
                            @csrf
                            <div>
                                <div class="text-dark mb-4">
                                    <textarea class="form-control desc1" name="name" id="" cols="3" rows="5" placeholder="Name"></textarea>
                                    @error('name')
                                        <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="text-dark mb-4">
                                    <textarea class="form-control desc1" name="display_name" id="" cols="3" rows="5" placeholder="Display Name"></textarea>
                                    @error('display_name')
                                        <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <span class="mr-3 mt-1 roles4">Assign To User:</span>
                                <div class="show col-md-6">
                                    <select class="form-control control" name="role_user" id="selected_role_user">
                                        <option value=""> -- Select a user -- </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="roles5">Description</div>
                                <textarea class="form-control desc0" name="description" id="" cols="3" rows="5"></textarea>
                                @error('description')
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
                    {{-- end of  modal for new roles --}}

                    {{-- modal for editing roles --}}
                    <div id="edit-role-background"></div>
                    <div id="edit-role-content">
                        <i class="closet fas fa-times" id="edit-role-close"></i>
                        <div>
                            <div class="users text-dark mb-4">Edit Role</div>
                        </div>
                        @isset ($data)
                            <form action="{{ route('role.update', $data->id ?? '') }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div>
                                    <div class="text-dark mb-4">
                                        <textarea class="form-control desc1" name="edit_name" id="" cols="3" rows="5">{{ $data->name ?? ''  }}</textarea>
                                        @error('edit_name')
                                            <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="text-dark mb-4">
                                        <textarea class="form-control desc1" name="edit_display_name" id="" cols="3" rows="5">{{ $data->display_name ?? ''  }}</textarea>
                                        @error('edit_display_name')
                                            <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <div class="roles2">Description:</div>
                                        <textarea class="form-control desc" name="edit_description" id="" cols="3" rows="5">{{ $data->description ?? '' }}</textarea>
                                        @error('edit_description')
                                            <span class="mr-3 mt-1 roles4 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button class="users2 btn text-white">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endisset
                    </div>
                    {{-- end of modal for editing role --}}

                    {{-- modal for viewing roles --}}
                    <div id="view-role-background"></div>
                    @isset ($viewRole)
                        <div id="view-role-content">
                            <i class="closet fas fa-times" id="view-role-close"></i>
                            <div>
                                <div class="users text-dark mb-4">View Role</div>
                            </div>

                            <div class="row">
                                <div class="text-dark mb-4">
                                    <div class="form-control desc1" name="" id="" cols="3" rows="5">{{ $data['role']->name }}</div>
                                </div>
                                <div class="text-dark mb-4">
                                    <div class="form-control desc1" name="" id="" cols="3" rows="5">{{ $data['role']->display_name }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="roles5">Description:</div>
                                <div class="roles2">{{ $data['role']->description }}</div>
                            </div>
                            <div class="row">
                                <span class="mr-5 pr-4 mt-1 roles5">Assign To User:</span>
                                <div class="show col-md-4">
                                    <form action="{{ route('user.roles.add') }}" method="post">
                                        <div class="row">
                                            <div class="col">
                                                @csrf
                                                <input type="hidden" name="roles" value="{{ $data['role']->id }}">
                                                <select class="form-control control" name="userId" id="user_assigned">
                                                    <option value=""> -- Select a user -- </option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="">
                                                <button type="submit" class="btn new text-white">Assign role</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                @isset($errorMessage)
                                    <span class="mr-5 pr-4 mt-1 roles5 text-danger">{{ $errorMessage }}</span>
                                @endisset
                            </div>
                            <div class="row">
                                <div class="roles5">Total users:</div>
                                <div class="roles2">{{ $data['roleUsersCount'] }}</div>
                            </div>

                            <div class="mb-5">
                                <div class="users text-dark mb-4 mt-4">List of users assigned to this role</div>
                                <div class="row mb-5 rowu">
                                    <div class="col-md-2    ">
                                        <select class="form-control control" name="cars" id="cars">
                                            <option value="volvo">All</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mx-2">
                                        <select class="form-control control" name="cars" id="cars">
                                            <option value="volvo">Filter By</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <form>
                                            <div class="input-group">
                                                <input type="text" class="form-control search-input text-dark" placeholder="Search...">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-white  table-hover text-left">
                                    <thead>
                                    <tr class="text-muted">
                                        <th>@NAME</th>
                                        <th>DISPLAY NAME</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['roleUsers'] as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->public_name }}</td>
                                                <td class="text-primary">
                                                    <form action="{{ route('user.roles.remove') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="userId" value="{{ $user->id }}">
                                                        <input type="hidden" name="roles" value="{{ $data['role']->id }}">
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
                    @endisset
                    {{-- end of modal for viewing role --}}

                    <div class="row">
                        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                            <div class="mb-5 pb-5">
                                <div class="card sizing4 card-common">
                                    <div class="card-body">
                                        <h3 class="text-dark text-left mb-3">Roles  </h3>
                                        {{-- Roles search field --}}
                                        <div class="row mb-4 rowu">
                                            <div class="col users-search-continer">
                                                <form action="{{ route('role.display') }}" method="post" class="d-flex">
                                                    @csrf
                                                    <div class="col mr-5 pr-5">
                                                        <input class="form-control control users-search" list="roles-list" id="roles-search" name="roles-search"  placeholder="Search role"/>
                                                    </div>
                                                    <div class="col ml-5 pl-5">
                                                        <button type="submit" class="btn new text-white">Search Role</button>
                                                    </div>
                                                    <div class="col">
                                                        <button type="button" class="btn new text-white" id="new-role-launcher">New Role</button>
                                                    </div>
                                                </form>
                                                <datalist id="roles-list">
                                                    @isset($roles)
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->name }}"></option>
                                                        @endforeach
                                                    @endisset
                                                </datalist>
                                            </div>
                                        </div>
                                        <table class="table table-white  table-hover text-left">
                                            <thead>
                                            <tr class="text-muted">
                                                <th>ROLE NAME</th>
                                                <th>ROLE DISPLAY NAME</th>
                                                <th>DESCRIPTION</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        {{-- <th>
                                                            <label class="container1">
                                                                <input type="checkbox">
                                                                <span class="checkmark1 checkmark"></span>
                                                            </label>
                                                        </th> --}}
                                                        <td>{{ $role->name }}</td>
                                                        <td>{{ $role->display_name }}</td>
                                                        <td>{{ str_limit($role->description, 12, '...') }}</td>
                                                        <td class="text-primary">
                                                            <a class="links" id="view-role-launcher" href="{{ route('role.show', $role->id) }}">
                                                                <i class="far fa-eye"></i>
                                                                View Role
                                                            </a>
                                                        </td>
                                                        <td class="text-primary">
                                                            <a class="links" id="edit-role-launcher" href="{{ route('role.edit', $role->id) . "#roles"}}">
                                                                <i class="far fa-edit"></i>
                                                                Edit
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button class="btn delete text-white">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                    Delete
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
                {{-- End of Roles --}}
            </div>
            {{-- End of all assets --}}
        </div>
    </div>
@endsection

