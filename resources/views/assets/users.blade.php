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
            <div id="content bingo">
                {{-- Users --}}
                <div>
                    <div class="col-xl-10 col-lg-9 mb-5 col-md-8 ml-auto">
                        <h2 class="text-uppercase analyticing1">Users</h2>
                        {{-- modal for viewing user --}}
                    </div>
                    <div class="row">
                        {{-- Users analytics --}}
                        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                            <div id="view-user-background"></div>
                            @isset($viewUser)
                                <div id="view-user-content">
                                    <i class="closet fas fa-times" id="view-user-close"></i>
                                    <div>
                                        <div class="users text-dark mb-4">User Information</div>
                                    </div>
                                    <div>
                                        <img src="/images/kid.jpg" class="img-fluid luci1" alt="">
                                    </div>
                                    <div class="row">
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Public Display Name: <b>{{ $data->public_name }}</b></div>
                                        </div>
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">@Account Name: <b>{{ $data->name }}</b></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Real Name: <b>{{ $data->legal_first_name . " " . $data->legal_second_name }}</b></div>
                                        </div>
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Nationality: <b>{{ $data->nationality }}</b></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Location: <b>{{ $data->location }}</b></div>
                                        </div>
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Birth Date: <b>{{ $data->dob }}</b></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Phone: <b>{{ $data->phone }}</b></div>
                                        </div>
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Email: <b>{{ $data->email }}</b></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Website: <b>{{ $data->website }}</b></div>
                                        </div>
                                        <div class="text-dark mb-4">
                                            <div class="form-control desc1" name="" id="" cols="3" rows="5">Personal Bio: <b>{{ $data->bio }}</b></div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="container">
                                        {{-- To be implement by the developer --}}
                                        <button class="btn btn-danger btn-sm">Lock account</button>
                                    </div>
                                </div>
                            @endisset
                            {{-- end of modal for viewing user --}}

                            {{-- Users list --}}
                            <div class="mb-5 pb-5 pt-md-1 mt-md-5">
                                <div class="card sizing3 card-common">
                                    <div class="card-body">
                                        <h3 class="text-muted text-left mb-3">Users </h3>
                                        <div class="row mb-4 rowu">
                                            <div class="col users-search-continer">
                                                <form action="{{ route('dashboard.show_user') }}" method="post" class="d-flex">
                                                    @csrf
                                                    <div class="col">
                                                        <input class="form-control control users-search" list="users-list" id="users-search" name="users-search"  placeholder="Search user"/>
                                                    </div>
                                                    <div class="col">
                                                        <button type="submit" class="btn new text-white">Search User</button>
                                                    </div>
                                                </form>
                                                <datalist id="users-list">
                                                    @isset($homeAnalytics['authVisitorsInfo'])
                                                        @foreach ($homeAnalytics['authVisitorsInfo'] as $visitor)
                                                            <option value="{{ "@" . $visitor->user->name }}"></option>
                                                        @endforeach
                                                    @endisset
                                                </datalist>
                                            </div>
                                        </div>
                                        <div>
                                            <table class="table table-white  table-hover text-left">
                                                <thead>
                                                <tr class="text-muted">
                                                    <th>@Name</th>
                                                    <th>Display Name</th>
                                                    <th>Last logged in at</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($homeAnalytics['authVisitorsInfo'] as $visitor)
                                                    <tr class="table-column" id="view-user-launcher">
                                                        <td>
                                                            <img src="/images/avatar_2mdpi.png" class="img-fluid luci" alt="">
                                                            {{  "@" . $visitor->user->name }}
                                                        </td>
                                                        <td>{{ $visitor->user->public_name }}</td>
                                                        <td>
                                                            <div class="badge badge-info d-flex text-sm-center flex-column align-items-center">
                                                                <p class="m-1 h6">{{ \Carbon\Carbon::parse($visitor->last_visit_ended_at)->diffForHumans() }}</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('dashboard.show_user') }}" method="post" class="d-flex">
                                                                @csrf
                                                                <div class="col">
                                                                    <input type="hidden" name="users-search" value="{{ "@" . $visitor->user->name }}">
                                                                </div>
                                                                <div class="col">
                                                                    <button type="submit" class="btn new text-white">
                                                                        <span class="links">
                                                                            <i class="far fa-eye"></i>
                                                                            View User
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- pagination -->
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="pagination justify-content-center">
                                                    <a href="#"><i class="fas fa-caret-left"></i></a>
                                                    <a href="#">1</a>
                                                    <a href="#">2</a>
                                                    <a href="#" class="active">3</a>
                                                    <a href="#">...</a>
                                                    <a href="#">15</a>
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
                {{-- End of Users --}}
            </div>
        </div>
    </div>
@endsection
