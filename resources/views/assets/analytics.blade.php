<div>
    <div class="row margining">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <h2 class="text-uppercase analyticing">Analytics</h2>
            </div>
        </div>
    </div>
    <div class="margining">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">

            <!-- Modal for viewign much charts -->
            <div class="modal" id="modal-name">
                <div class="modal-sandbox"></div>
                <div class="modal-box">
                    {{-- sizing2 card-common --}}
                    <div class="modal-body">
                        <div class="">
                            <div class="">
                                <div class="row">
                                    <div class="col users text-muted">Active users statistics</div>
                                    <div class="col bordering d-flex justify-content-between" style="padding: 2px">
                                        <div class="last-align">
                                            <div class="row">
                                                <div class="show">
                                                    <select class="form-control control">
                                                        <option value="volvo">Last 90 days Mobile visitors(IOS)
                                                        </option>
                                                        <option value="saab">Last 90 days Mobile visitors(ANDROID)
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <h1 class="user-analytics_card">
                                                {{ $homeAnalytics['mobileAppVisitors'] }}
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-between">
                                        <div class="last-align">
                                            <div class="row">
                                                <div class="show">
                                                    <select class="form-control control">
                                                        <option value="volvo">Last 90 days Web visitors</option>
                                                        <option value="saab">Last 90 days Mobile Web visitors
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <h1 class="user-analytics_card">
                                                <h1 class="user-analytics_card">{{ $homeAnalytics['webVisitors'] }}
                                                </h1>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                                <br>
                                <div id="show-div">
                                    <div id="full">
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                    <div id="empty">
                                        <canvas id=""></canvas>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 show p-4">
                                        <select class="form-control control switch-expanded-chart" id="expandedActiveUsersChartSwitch_b">
                                            <option value="">Select</option>
                                            <option value="one_week_b_e">Weekly</option>
                                            <option value="one_month_b_e">Monthly</option>
                                            <option value="three_months_b_e">Last 3 Months</option>
                                            <option value="six_months_b_e">Last 6 Months</option>
                                            <option value="one_year_b_e">Yearly</option>
                                        </select>
                                    </div>
                                    <div id="" class="col-lg-4 show p-4">
                                        <select class="form-control control switch-expanded-chart" id="expandedActiveUsersChartSwitch_a">
                                            <option value="">Select</option>
                                            <optgroup label="Current Month">
                                                <option value="one_month_a_e">1 Month</option>

                                            </optgroup>
                                            <optgroup label="3 Months">
                                                <option value="three_months_a_e">Last 3 Months</option>

                                            </optgroup>
                                            35 333907 607097 3
                                            <optgroup label="6 Months">
                                                <option value="six_months_a_e">Last 6 Months</option>

                                            </optgroup>
                                            <optgroup label="1 Year">
                                                <option value="one_year_a_e">Last 12 Months</option>

                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class=" mx-2">
                                <button type="button"
                                    class="close-modal btn btn-primary text-white font-weight-bold">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flexing pt-md-5 mt-md-5 pl-3">
                <div class="line">

                    <div class="col-md-7 col-sm-6 p-2 mb-2">
                        <div class="card card-common1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="users text-muted">Daily online average time for Auth and Non-Auth Users
                                    </div>
                                    <div class="click text-muted">Click the buttons below to switch either to non auth
                                        or auth users to get the average time. </div>

                                        <div class="row mt-4 mb-4 pb-3 ml-3" id="my_styles">
                                        <button type="button" id="switchToNonAuth myButton" value="A"
                                            onclick="populateData(event)"
                                            class="btn btn-outline-primary new1 text-dark actives">Auth</button>
                                        <button type="button" id="switchToAuth" value="B" onclick="populateData(event)"
                                            class="btn btn-outline-primary new1 text-dark">Non-Auth</button>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <div class="click1 text-muted">
                                        Average Time:
                                        <b class="text-muted switching" id="switching">{{ $homeAnalytics['authUsersTimeSpent'] }} (Auth)</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 p-2">
                        <div>
                            <div class="card sizing0 card-common">
                                <div class="card-body">
                                    <div class="users text-muted">Auth User Retention(New & Returning Users)</div>
                                    <canvas id="stacked"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- table for 10 most active users--}}
            <div class="pl-3">
                {{-- Users analytics --}}
                {{-- Users list --}}
                <div class="flexing mb-2">
                    <div class="line">

                    </div>
                </div>
            </div>
            {{-- end of table for 10 mosst active users --}}

            {{-- donut charts --}}
            <div class="flexing mb-3">
                <div class="line">
                    <div class="col-md-7 col-sm-6 p-2">
                        <div class="wrapper">
                            <div class="card sizing card-common">
                                <div class="card-body">
                                    <div class="users text-muted">Monthly Auth & Non-Auth Visitors Percentage</div>
                                    <div class="row mt-4">
                                        <div class="col-lg-8 col-md-9 col-sm-9">
                                            <canvas id="pieChart"></canvas>
                                            <div class="percentage">%</div>
                                        </div>
                                        <div class="col-lg-4 col-md-3 col-sm-3 mt-2 allin">
                                            <div class="d-flex flex-column badge text-right">
                                                <p class="">Total Users <br>
                                                    <span id="monthlyLoggedInUsers"
                                                        class="all-users">{{ $homeAnalytics['monthlyLoggedInUsers'] }}</span>
                                                </p>
                                            </div>
                                            <div class="d-flex flex-column badge text-right">
                                                <p class="">Auth users <br>
                                                    <span id="monthlyAuthUsers"
                                                        class="all2">{{ $homeAnalytics['monthlyAuthUsers'] }}</span>
                                                </p>
                                            </div>
                                            <div class="d-flex flex-column badge text-right">
                                                <p class="">Non-Auth users <br>
                                                    <span id="monthlyNonAuthUsers"
                                                        class="all1">{{ $homeAnalytics['monthlyNonAuthUsers'] }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 p-2 ml-3">
                        <div class="wrapper">
                            <div class="card sizing-mobile card-common">
                                <div class="card-body">
                                    <div class="users text-muted">Mobile visitors for IOS and Android</div>
                                    <div class="row mt-4">
                                        <div class="col-lg-8 col-md-9 col-sm-9 mb-3">
                                            <canvas id="pieChartMobile"></canvas>
                                        </div>

                                        <div class="col-lg-4 col-md-3 col-sm-3 mt-2 allin">
                                            <div class="d-flex flex-column badge text-right">
                                                <p class="">IOS Visitors <br>
                                                    <span id="monthlyLoggedInUsers"
                                                        class="mobile-all2">0</span>
                                                </p>
                                            </div>
                                            <div class="d-flex flex-column badge text-right">
                                                <p class="">Android Visitors <br>
                                                    <span id="monthlyAuthUsers"
                                                        class="mobile-all1">0</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flexing mb-3">
                <div class="line">
                    <div class="col-md-7 col-sm-6 p-2 ml-3">
                        <div class="wrapper">
                            <div class="card sizing-web card-common">
                                <div class="card-body">
                                    <div class="users text-muted">Web visitors for Mobile & Desktop</div>
                                    <div class="row mt-4">
                                        <div class="col-lg-8 col-md-8 col-sm-9 mb-5">
                                            <canvas id="pieChartWeb" height="215"></canvas>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-9 mt-3 allin">
                                            <div class="d-flex flex-column badge text-right">
                                                <p class="">Desktop Web Visitors  <br>
                                                    <span id=""
                                                        class="desktop-web-all2">{{ $homeAnalytics['desktopBrowserVisitors'] }}</span>
                                                </p>
                                            </div>
                                            <div class="d-flex flex-column badge text-right">
                                                <p class="">Mobile Web Visitors <br>
                                                    <span id=""
                                                        class="mobile-web-all1">{{ $homeAnalytics['mobileBrowserVisitors'] }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 p-2">
                        <div>
                            <div class="card auth-sizing0 card-common">
                                <div class="card-body">
                                    <div class="users text-muted">Auth and NON-Auth Users</div>
                                    <canvas id="stackedUsers"></canvas>
                                </div>
                                <div class="row">
                                    <div id="" class="col-4 show pl-4 pb-4">
                                        <select class="form-control control" id="switchAuthStackedBarBard">
                                            <option value="one_week">Weekly</option>
                                            <option value="one_month">Monthly</option>
                                            <option value="three_months">Last 3 Months</option>
                                            <option value="six_months">Last 6 Months</option>
                                            <option value="one_year">Yearly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flexing mb-2">
                <div class="line">

                    <div class="col-md-7 col-sm-6 p-2">
                        <div class="card sizing2 card-common">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col users text-muted">Active users statistics</div>
                                </div>
                                <div class="row">
                                    <div class="col bordering d-flex justify-content-between mt-2" style="padding: 2px">
                                        <div class="last-align">
                                            <div class="row">
                                                <div class="show">
                                                    <select class="form-control control" name="cars" id="cars">
                                                        <option value="volvo">Last 90 days Mobile visitors(IOS)
                                                        </option>
                                                        <option value="saab">Last 90 days Mobile visitors(ANDROID)
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <h1 class="user-analytics_card">
                                                {{ $homeAnalytics['mobileAppVisitors'] }}
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-between" style="padding: 2px">
                                        <div class="last-align">
                                            <div class="row">
                                                <div class="show">
                                                    <select class="form-control control">
                                                        <option value="volvo">Last 90 days Web visitors</option>
                                                        <option value="saab">Last 90 days Mobile Web visitors
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <h1 class="user-analytics_card">
                                                <h1 class="user-analytics_card">{{ $homeAnalytics['webVisitors'] }}
                                                </h1>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                                <div id="show-div">
                                    <div id="full">
                                        <canvas id="lineChartUsers"></canvas>
                                    </div>
                                    {{-- <div id="empty">
                                        <canvas id=""></canvas>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div id="" class="col show p-4">
                                        <select class="form-control control switchActiveUsers" id="switchActiveUsersChartData_b">
                                            <option value="">Select</option>
                                            <option value="one_week_b">Weekly</option>
                                            <option value="one_month_b">Monthly</option>
                                            <option value="three_months_b">Last 3 Months</option>
                                            <option value="six_months_b">Last 6 Months</option>
                                            <option value="one_year_b">Yearly</option>
                                        </select>
                                    </div>
                                    <div id="" class="col show p-4">
                                        {{-- multiple data-live-search="true" class is selectpicker  --}}
                                        <select class="form-control control switchActiveUsers" id="switchActiveUsersChartData_a">
                                            <option value="">Select</option>
                                            <optgroup label="Current Month">
                                                <option value="one_month_a">1 Month</option>
                                            </optgroup>
                                            <optgroup label="3 Months">
                                                <option value="three_months_a">Last 3 Months</option>
                                            </optgroup>
                                            <optgroup label="6 Months">
                                                <option value="six_months_a">Last 6 Months</option>

                                            </optgroup>
                                            <optgroup label="1 Year">
                                                <option value="one_year_a">Last 12 Months</option>


                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col p-4">
                                        <button type="button" data-modal="modal-name"
                                            class="modal-trigger btn btn-primary new1 text-white">Click here to
                                            expand</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 ml-2 p-2">
                        <div class="card sizing5 card-common">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="col d-flex ">
                                        <h5 class="text-muted text-left mb-3">10 Most Active Users </h5>
                                    </div>
                                    <div class="col d-flex bordering justify-content-between">
                                        <div class="">
                                            <span class="daily">Total Users Accounts:</span>
                                            <span
                                                class="display-5 user-analytics_card">{{ $homeAnalytics['totalUsersAccounts'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-container">
                                    <table class="table table-white  table-hover text-left scroll-auto">
                                        <thead class="table-outline-dark ">
                                            <tr class="text-muted">
                                                <th>
                                                    @Name
                                                </th>
                                                <th>Display Name</th>
                                                <th>Last logged in at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($homeAnalytics['mostActiveUsers'] as $visitor)
                                                <tr>
                                                    <td>
                                                        <img src="/images/avatar_2mdpi.png" class="img-fluid luci"
                                                            alt="">
                                                        {{ '@' . $visitor->user->name }}
                                                    </td>
                                                    <td>{{ $visitor->user->public_name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($visitor->last_visit_ended_at)->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach
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
