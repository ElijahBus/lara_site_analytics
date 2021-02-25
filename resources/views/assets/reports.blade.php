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

            <div data-spy="scroll" data-target="#myScrollspy" data-offset="5">
                <div class="col-xl-10 col-lg-9 col-md-8 mb-5 ml-auto">
                    <h2 class="text-uppercase">Reports</h2>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-lg-9 mt-md-5 pt-md-1 col-md-8 ml-auto">
                        <div class="mb-5 pb-5">
                            <div class="card sizing4 card-common">
                                <div class="card-body">
                                    <div class="row col-md-12">
                                        <div class="col col-md-6">
                                            <h5 class="text-dark text-left mb-3">Page views</h5>
                                            <table style="overflow: scroll" class="table table-white  table-hover text-left table-striped shadow-sm rounded">
                                                <thead class="shadow">
                                                    <tr class="text-muted">
                                                        <th>Page</th>
                                                        <th>Page views</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($pageViews)
                                                        @foreach ($pageViews as $page)
                                                            <tr>
                                                                <td class="text-primary">{{ $page->page_name }}</td>
                                                                <td><b>{{ $page->page_views_count }}</b></td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col col-md-6">
                                            <h5 class="text-dark text-left mb-3">Feature | Hits</h5>
                                            <table style="overflow: scroll" class="table table-white  table-hover text-left table-striped shadow-sm rounded">
                                                <thead class="shadow">
                                                    <tr class="text-muted">
                                                        <th>Feature</th>
                                                        <th>Views</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($featuresVisits)
                                                        @foreach ($featuresVisits as $feature)
                                                            <tr>
                                                                <td class="text-primary">{{ $feature->feature_name }}</td>
                                                                <td><b>{{ $feature->feature_visits_count }}</b></td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
