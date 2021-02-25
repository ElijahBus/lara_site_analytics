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
                {{-- Analytics --}}
                <div id="analytics" class="tabcontent">
                    @include('dashboard::assets.analytics')
                </div>
                {{-- End of Analytics --}}
            </div>
            {{-- End of all assets --}}
        </div>
    </div>
@endsection



