$(document).ready(function () {

  jQuery('#my_styles .btn').click(function () {
    jQuery('#my_styles .btn').removeClass('actives');
    jQuery(this).toggleClass('actives');
  });

  $('.trigger').on('click', function () {
    $('.modal-wrapper').toggleClass('open');
    $('.page-wrapper').toggleClass('blur-it');
    return false;
  });

  $('.modal-trigger').click(function (e) {
    e.preventDefault();

    let selector = $(this).attr('data-modal');
    let targetModal = $(`#${selector}`);
    let targetJob = e.target.getAttribute('data-job');
    targetJob = targetJob ? JSON.parse(targetJob) : {};
    console.log(targetModal.children('.card-title').html());
    targetModal.children('.card-title').text(targetJob.title);

    targetModal.css({
      'display': 'block',
    });
  });

  $('.close-modal, .modal-sandbox').click(function () {
    $('.modal').css({
      'display': 'none',
    });
  });

  $('.modal-trigger').click(function (e) {
    e.preventDefault();
    dataModal = $(this).attr('data-modal');
    $('#' + dataModal).css({
      'display': 'block',
    });
  });

  $('.close-modal, .modal-sandbox').click(function () {
    $('.modal').css({
      'display': 'none',
    });
  });

  $('#menu li a').click(function (ev) {
    $('#menu li').removeClass('selected');
    $(ev.currentTarget).parent('li').addClass('selected');
  });

  $(function () {
    $('#new-role-launcher, #new-role-background, #new-role-close').click(function () {
      $('#new-role-content,#new-role-background').toggleClass('active');
    });
  });

  $(function () {
    $('#edit-role-background, #edit-role-close').click(function () {
      $('#edit-role-content, #edit-role-background').toggleClass('active');
    });
  });

  $(function () {
    $('#view-role-background, #view-role-close').click(function () {
      $('#view-role-content,#view-role-background').toggleClass('active');
    });
  });

  $(function () {
    $('#view-tos-background, #view-tos-close').click(function () {
      $('#view-tos-content,#view-tos-background').toggleClass('active');
    });
  });

  $(function () {
    $('#view-permission-background, #view-permission-close').click(function () {
      $('#view-permission-content,#view-permission-background').toggleClass('active');
    });
  });

  $(function () {
    $('#view-user-background, #view-user-close').click(function () {
      $('#view-user-content,#view-user-background').toggleClass('active');
    });
  });

  $(function () {
    $('#new-permission-launcher, #new-permission-background, #new-permission-close').click(function () {
      $('#new-permission-content,#new-permission-background').toggleClass('active');
    });
  });

  $(function () {
    $('#edit-permission-background, #edit-permission-close').click(function () {
      $('#edit-permission-content, #edit-permission-background').toggleClass('active');
    });
  });

  $(function () {
    $('#new-tos-launcher, #new-tos-background, #new-tos-close').click(function () {
      $('#new-tos-content,#new-tos-background').toggleClass('active');
    });
  });

  $(function () {
    $('#edit-tos-background, #edit-tos-close').click(function () {
      $('#edit-tos-content, #edit-tos-background').toggleClass('active');
    });
  });
});

/**
 * Open  ui tab by passing the tabName
 * @param {mixed} evt
 * @param {string} tabName
 */
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName('tabcontent');
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = 'none';
  }

  tablinks = document.getElementsByClassName('tablinks');
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(' active', '');
  }

  document.getElementById(tabName).style.display = 'block';
  evt.currentTarget.className += ' active';
}

function ChangeUrl(page, url) {
  if (typeof (history.pushState) != 'undefined') {
    var obj = {
      Page: page,
      Url: url,
    };
    history.pushState(obj, obj.Page, obj.Url);
  } else {
    alert('Browser does not support HTML5.');
  }
}

/**
 * Define routing for the Dashboard sidebar menus
 */
$(function () {
  $('#analysis').click(function () {
    ChangeUrl('analyse', '/dashboard/Analytics');
  });

  $('#user').click(function () {
    ChangeUrl('use', '/dashboard/Users');
  });

  $('#role').click(function () {
    ChangeUrl('rol', '/dashboard/Roles');
  });

  $('#permission').click(function () {
    ChangeUrl('permiss', '/dashboard/Permissions');
  });

  $('#report').click(function () {
    ChangeUrl('repo', '/dashboard/Reports');
  });

  $('#admin').click(function () {
    ChangeUrl('admini', '/dashboard/Admins');
  });

  $('#server').click(function () {
    ChangeUrl('serve', '/dashboard/Servers');
  });

  $('#toses').click(function () {
    ChangeUrl('tost', '/dashboard/TOS');
  });

  $('#setting').click(function () {
    ChangeUrl('set', '/dashboard/Settings');
  });
});

// -----------
// Display auth & Non auth users analytics
// -----------

const monthlyLoggedInUsers = parseInt(document.getElementById('monthlyLoggedInUsers').innerText);
const monthlyAuthUsers = parseInt(document.getElementById('monthlyAuthUsers').innerText);
const monthlyNonAuthUsers = parseInt(document.getElementById('monthlyNonAuthUsers').innerText);

const monthlyAuthUsersPercentage = parseFloat(`${(monthlyAuthUsers * 100) / monthlyLoggedInUsers}`).toFixed();
const monthlyNonAuthUsersPercentage = parseFloat(`${(monthlyNonAuthUsers * 100) / monthlyLoggedInUsers}`).toFixed();

var num = 25;
var s = Number(num / 100).toLocaleString(undefined, {
  style: 'percent',
  minimumFractionDigits: 2,
});

let options = {
  animation: false,
  startAngle: -1.55,
  size: 150,
  value: monthlyAuthUsersPercentage,
  fill: {
    gradient: ['#03a9f4', '#03a9f4'],
  },
};

const authAndNonAuth = () => {
  let pieChart = new Chart(PIECHART, {
    type: 'doughnut',
    data: data = {
      labels: ['Non-Authenticated', 'Authenticated'],
      datasets: [
        {
          backgroundColor: ['#1de9b6', '#03a9f4'],
          data: [monthlyAuthUsersPercentage, monthlyNonAuthUsersPercentage],
        },
      ],
    },
  });
};

var colors = ['#1de9b6', '#03a9f4', '#333', '#c3e6cb', '#dc3545', '#6c757d', '#706d67'];

var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

var today = mm + '/' + dd + '/' + yyyy;

/**
 * Get logged-in users statistics on the line chart
 * @param {int} daily
 * @param {int} weekly
 * @param {int} monthly
 */
var lineChartData = (daily, weekly, monthly) => {
  /* large line chart */
  var chLine = document.getElementById('chLine');
  var chartData = {
    labels: ['Daily, ' + today, 'Last 7 days', 'Last 30 days'],
    datasets: [
      {
        data: [daily, weekly, monthly],
        backgroundColor: 'transparent',
        borderColor: colors[0],
        borderWidth: 4,
        pointBackgroundColor: colors[0],
      },

    ],
  };
  if (chLine) {
    new Chart(chLine, {
      type: 'line',
      data: chartData,
      options: {
        animation: false,
        scales: {
          xAxes: [
            {
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: false,
        },
        responsive: true,
      },
    });
  }
};

var lineChartDataNonAuth = (daily, weekly, monthly) => {
  /* large line chart */
  var chLineNonAuth = document.getElementById('chLineNonAuth');
  var chartDataNonAuth = {
    labels: ['Daily, ' + today, 'Last 7 days', 'Last 30 days'],
    datasets: [
      {
        data: [daily, weekly, monthly],
        backgroundColor: 'transparent',
        borderColor: colors[0],
        borderWidth: 4,
        pointBackgroundColor: colors[0],
      },

    ],
  };
  if (chLineNonAuth) {
    new Chart(chLineNonAuth, {
      type: 'line',
      data: chartDataNonAuth,
      options: {
        animation: false,
        scales: {
          xAxes: [
            {
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: false,
        },
        responsive: true,
      },
    });
  }
};

/**
 * Get auth and non-auth users statistics on the bar chart
 * @param {array} weeklyAuthUsers
 * @param {array} weeklyNonAuthUsers
 */
var barChartData = (weeklyAuthUsers, weeklyNonAuthUsers) => {
  weeklyAuthUsers = JSON.parse(weeklyAuthUsers);
  weeklyNonAuthUsers = JSON.parse(weeklyNonAuthUsers);

  var foo = function (num) {
    num -= Math.trunc(num);
    num *= 100;
    return Math.round(num);
  };

  var chBar = document.getElementById('chBar');
  if (chBar) {
    new Chart(chBar, {
      type: 'bar',
      data: {
        labels: weeklyNonAuthUsers[0],
        datasets: [
          {
            data: [
              ...weeklyAuthUsers[1],
            ],
            backgroundColor: colors[1],
          },
          {
            data: [
              ...weeklyNonAuthUsers[1],
            ],
            backgroundColor: colors[0],
          },
        ],
      },
      options: {
        animation: false,
        legend: {
          display: false,
        },
        scales: {
          xAxes: [
            {
              // stacked: true,
              barPercentage: 0.4,
              categoryPercentage: 0.5,
            },
          ],
        },
      },
    });
  }
};

// -----------
// Get analytics charts
// -----------

const CHART = document.getElementById('lineChart');
const ACTIVECHART = document.getElementById('lineChartUsers');
const PIECHART = document.getElementById('pieChart');
const PIECHARTMOBILE = document.getElementById('pieChartMobile');
const PIECHARTWEB = document.getElementById('pieChartWeb');
const CHARTBAR = document.getElementById('stackedUsers');

/**
 * Get the retention of new users and returning users on the stackedbar chart,
 * in weekly segement
 * @param {array} newUsersRetention
 * @param {array} returningUsersRetention
 */
var stackedBarData = (newUsersRetention, returningUsersRetention) => {
  newUsersRetention = JSON.parse(newUsersRetention);
  returningUsersRetention = JSON.parse(returningUsersRetention);

  const totalUsersRetention = newUsersRetention.map((value, index) => value + returningUsersRetention[index]);

  const ctx = document.getElementById('stacked');
  let stacked = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: (newUsersRetention[0].length > returningUsersRetention[0].length) ?
        newUsersRetention[0] : returningUsersRetention[0],
      datasets: [
        {
          label: 'New Users',
          data: [
            ...newUsersRetention[1],
          ],
          backgroundColor: '#a89f9f',
          borderColor: '#a89f9f',
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: '#1de9b6',
          pointBackgroundColor: '#fff',
          pointBorderWidth: 1,
          pointHoverRadius: 5,
          pointHoverBackgroundColor: '#1DE9B6)',
          pointHoverBorderColor: '#1de9b6',
          pointHoverBorderWidth: 2,
          pointRadius: 1,
          pointHitRadius: 10,
        },

        {
          label: 'Returning Users',
          data: [
            ...returningUsersRetention[1],
          ],
          backgroundColor: '#e5e5e5',
          borderColor: '#e5e5e5',
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: '#03a9f4',
          pointBackgroundColor: '#fff',
          pointBorderWidth: 1,
          pointHoverRadius: 5,
          pointHoverBackgroundColor: '#03a9f4',
          pointHoverBorderColor: '#03a9f4',
          pointHoverBorderWidth: 2,
          pointRadius: 1,
          pointHitRadius: 10,
        },
      ],
    },
    options: {
      animation: false,
      scales: {
        yAxes: [
          {
            stacked: true,
            ticks: {
              beginAtZero: true,
            },
          },
        ],
        xAxes: [
          {
            stacked: true,
            ticks: {
              beginAtZero: true,
            },
          },
        ],

      },
    },
  });
};

const authAndNonAuthChartBar = (weekly, monthly, threeMonths, sixMonths, yearly) => {
  weekly = JSON.parse(weekly);
  monthly = JSON.parse(monthly);
  threeMonths = JSON.parse(threeMonths);
  sixMonths = JSON.parse(sixMonths);
  yearly = JSON.parse(yearly);

  const stackedBarSwtich = document.getElementById('switchAuthStackedBarBard');

  let chartBar = (authData, nonAuthData, labels) => {
    return new Chart(CHARTBAR, {
      type: 'bar',
      data: data = {
        labels: [...labels],
        datasets: [
          {
            label: 'NON-Auth Users',
            backgroundColor: '#1de9b6',
            data: [...authData],
          },

          {
            label: 'Auth Users',
            backgroundColor: '#03a9f4',
            data: [...nonAuthData],
          },
        ],
      },
      options: {
        animation: {
          duration: 0,
        },
        scales: {
          yAxes: [
            {
              stacked: true,
              ticks: {
                beginAtZero: true,
              },
            },
          ],
          xAxes: [
            {
              stacked: true,
              ticks: {
                beginAtZero: true,
              },
            },
          ],

        },
      },
    });
  };

  // Initial chart with weekly data
  let chartData = weekly['auth'];
  chartBar(chartData[1], chartData[2], chartData[0]);

  console.log(sixMonths);

  stackedBarSwtich.addEventListener('change', () => {
    switch (event.target.value) {
      case 'one_week':
        chartData = weekly['auth'];
        chartBar(chartData[1], chartData[2], chartData[0]);
        break;
      case 'one_month':
        chartData = monthly['auth'];
        chartBar(chartData[1], chartData[2], chartData[0]);
        break;
      case 'three_months':
        chartData = threeMonths['auth'];
        chartBar(chartData[1][0], chartData[1][1], chartData[0]);
        break;
      case 'six_months':
        chartData = sixMonths['auth'];
        chartBar(chartData[1][0], chartData[1][1], chartData[0]);
        break;
      case 'one_year':
        chartData = yearly['auth'];
        chartBar(chartData[1][0], chartData[1][1], chartData[0]);
        break;
      default:
        break;
    }

  });
};

const MobileVisitors = () => {
  var data1 = 0;
  var data2 = 0;

  let pieChartMobile = new Chart(PIECHARTMOBILE, {
    type: 'doughnut',
    data: data = {
      labels: ['IOS', 'ANDROID'],
      datasets: [
        {
          backgroundColor: ['#34eb4f', '#2df7dc'],
          data: [data1, data2],
        },
      ],
    },
  });
};

const WebVisitors = (desktop, mobile) => {
  let pieChartMobile = new Chart(PIECHARTWEB, {
    type: 'doughnut',
    data: data = {
      labels: ['Desktop Web Visitors', 'Mobile Web Visitors'],
      datasets: [
        {
          backgroundColor: ['#f7f02d', '#f72dc5'],
          data: [desktop, mobile],
        },
      ],
    },
  });
};

// Disable the animation that caused the triggering of unwanted events
Chart.defaults.global.animation = false;

/**
 * Get daily, weekly and monthly active users on the chart
 * @param {array} weeklyUsers
 * @param {array} weeklyUsers
 * @param monthlyUsers
 * @param threeMonthsUsers
 * @param sixMonthsUsers
 * @param yearlyUsers
 */
const activeUsersChart = (weeklyUsers, monthlyUsers, threeMonthsUsers, sixMonthsUsers, yearlyUsers) => {
  weeklyUsers = JSON.parse(weeklyUsers);
  monthlyUsers = JSON.parse(monthlyUsers);
  threeMonthsUsers = JSON.parse(threeMonthsUsers);
  sixMonthsUsers = JSON.parse(sixMonthsUsers);
  yearlyUsers = JSON.parse(yearlyUsers);

  // Pass dates in weekly segment as x-axis data
  //
  const XAxisData = weeklyUsers['all'][0][0];

  // Switches data on chart depending on the selected date range
  //
  var switchChartData = document.querySelectorAll('.switchActiveUsers');
  const RemoveSwitchedData = document.getElementById('.switchActiveUsers');

  let allChartDataSet = [];
  allChartDataSet.push(chartDataSet('1 week', 0.4, '#00a87e', '#00a87e', '#1de9b6', '#1de9b6', '#1de9b6', weeklyUsers['all'][1][0]));
  new Chart(ACTIVECHART, {
    type: 'line',
    options: {
      tooltips: {
        enabled: true,
      },
      animation: {
        duration: 0,
      },

    },
    data: data = {
      labels: XAxisData,
      datasets: allChartDataSet,
    },
  });

  switchChartData.forEach((element) => {
    element.addEventListener('change', () => {
      switch (event.target.value) {
        case 'one_month_a':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('1st Week', 0.4, '#00a87e', '#00a87e', '#1de9b6', '#1de9b6', '#1de9b6', monthlyUsers['all']['detailedData'][1][0]),
            chartDataSet('2nd Week', 0.5, '#006793', '#006793', '#03a9f4', '#03a9f4', '#03a9f4', monthlyUsers['all']['detailedData'][1][1]),
            chartDataSet('3rd Week', 0.6, 'red', 'red', '#03a9f4', '#03a9f4', '#03a9f4', monthlyUsers['all']['detailedData'][1][2]),
            chartDataSet('Current Week', 0.7, 'black', 'black', '#03a9f4', '#03a9f4', '#03a9f4', monthlyUsers['all']['detailedData'][1][3]),
          );
          lineChart(allChartDataSet, XAxisData);
          break;
        case 'three_months_a':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('Month 1', 0.4, '#32a852', '#32a852', '#1de9b6', '#1de9b6', '#1de9b6', threeMonthsUsers['all']['detailedData'][1][0]),
            chartDataSet('Month 2', 0.5, '#10e4e8', '#10e4e8', '#03a9f4', '#03a9f4', '#03a9f4', threeMonthsUsers['all']['detailedData'][1][1]),
            chartDataSet('Month 3', 0.6, '#0519f2', '#0519f2', '#ffd269', '#ffd269', '#ffd269', threeMonthsUsers['all']['detailedData'][1][2]),
          );
          lineChart(allChartDataSet, threeMonthsUsers['all']['detailedData'][0][2]);
          break;
        case 'six_months_a':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('Month 1', 0.4, '#d503ff', '#d503ff', '#1de9b6', '#1de9b6', '#1de9b6', sixMonthsUsers['all']['detailedData'][1][0]),
            chartDataSet('Month 2', 0.5, '#ff0368', '#ff0368', '#03a9f4', '#03a9f4', '#03a9f4', sixMonthsUsers['all']['detailedData'][1][1]),
            chartDataSet('Month 3', 0.6, '#9e9826', '#9e9826', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['detailedData'][1][2]),
            chartDataSet('Month 4', 0.7, '#368a25', '#368a25', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['detailedData'][1][3]),
            chartDataSet('Month 5', 0.8, '#913527', '#913527', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['detailedData'][1][4]),
            chartDataSet('Month 6', 0.9, '#2b2691', '#2b2691', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['detailedData'][1][5]),
          );
          lineChart(allChartDataSet, sixMonthsUsers['all']['detailedData'][0][5]);
          break;
        case 'one_year_a':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('Month 1', 0.4, '#8f5424', '#8f5424', '#1de9b6', '#1de9b6', '#1de9b6', yearlyUsers['all']['detailedData'][1][0]),
            chartDataSet('Month 2', 0.5, '#fa7305', '#fa7305', '#03a9f4', '#03a9f4', '#03a9f4', yearlyUsers['all']['detailedData'][1][1]),
            chartDataSet('Month 3', 0.6, '#917e6e', '#917e6e', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][2]),
            chartDataSet('Month 4', 0.6, '#609c91', '#609c91', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][3]),
            chartDataSet('Month 5', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][4]),
            chartDataSet('Month 6', 0.4, '#285f75', '#285f75', '#1de9b6', '#1de9b6', '#1de9b6', yearlyUsers['all']['detailedData'][1][5]),
            chartDataSet('Month 7', 0.5, '#05b8ff', '#05b8ff', '#03a9f4', '#03a9f4', '#03a9f4', yearlyUsers['all']['detailedData'][1][6]),
            chartDataSet('Month 8', 0.6, '#22437a', '#22437a', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][7]),
            chartDataSet('Month 9', 0.6, '#0060ff', '#0060ff', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][8]),
            chartDataSet('Month 10', 0.6, '#343885', '#343885', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][9]),
            chartDataSet('Month 11', 0.6, '#000cf5', '#000cf5', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][10]),
            chartDataSet('Month 12', 0.6, '#3b215c', '#3b215c', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][11]),
          );
          lineChart(allChartDataSet, yearlyUsers['all']['detailedData'][0][11]);
          break;
        case 'one_week_b':
          allChartDataSet = [];
          allChartDataSet.push(chartDataSet('1 week', 0.4, '#00a87e', '#00a87e', '#1de9b6', '#1de9b6', '#1de9b6', weeklyUsers['all'][1][0]));
          lineChart(allChartDataSet, XAxisData);
          break;
        case 'one_month_b':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('1 Month', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', monthlyUsers['all']['oneLineData'][1][0]),
          );
          lineChart(allChartDataSet, monthlyUsers['all']['oneLineData'][0][0]);
          break;
        case 'three_months_b':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('3 Months', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', threeMonthsUsers['all']['oneLineData'][1][0]),
          );
          lineChart(allChartDataSet, threeMonthsUsers['all']['oneLineData'][0][0]);
          break;
        case 'six_months_b':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('6 Months', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['oneLineData'][1][0]),
          );
          lineChart(allChartDataSet, sixMonthsUsers['all']['oneLineData'][0][0]);
          break;
        case 'one_year_b':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('1 Year', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['oneLineData'][1][0]),
          );
          lineChart(allChartDataSet, yearlyUsers['all']['oneLineData'][0][0]);
          break;
        default:
          break;
      }

    });
  });

  let lineChart = (data, XAxisData) => {
    return new Chart(ACTIVECHART, {
      type: 'line',
      options: {
        responsive: true,
        animation: {
          duration: 0,
        },
      },
      data: data = {
        labels: XAxisData,
        datasets: data,
      },
    });
  };
};

/**
 * Describe the structure of data to pass on the active users chart
 *
 * @param {string} label
 * @param {float} lineTension
 * @param {string} bgc
 * @param {string} borderColor
 * @param {string} pointBorderColor
 * @param {string} pointHoverBgc
 * @param {string} pointHoverBorderColor
 * @param {array} data
 */
const chartDataSet = (label, lineTension, bgc, borderColor, pointBorderColor, pointHoverBgc, pointHoverBorderColor, data) => {
  return {
    label: label,
    fill: false,
    lineTension: lineTension,
    backgroundColor: bgc,
    borderColor: borderColor,
    borderCapStyle: 'butt',
    borderDash: [],
    borderDashOffset: 0.0,
    borderJoinStyle: 'miter',
    pointBorderColor: pointBorderColor,
    pointBackgroundColor: '#fff',
    pointBorderWidth: 1,
    pointHoverRadius: 5,
    pointHoverBackgroundColor: pointHoverBgc,
    pointHoverBorderColor: pointHoverBorderColor,
    pointHoverBorderWidth: 2,
    pointRadius: 1,
    pointHitRadius: 10,
    data: data,
  };
};

const activeUserExpandedChart = (weeklyUsers, monthlyUsers, threeMonthsUsers, sixMonthsUsers, yearlyUsers) => {
  weeklyUsers = JSON.parse(weeklyUsers);
  monthlyUsers = JSON.parse(monthlyUsers);
  threeMonthsUsers = JSON.parse(threeMonthsUsers);
  sixMonthsUsers = JSON.parse(sixMonthsUsers);
  yearlyUsers = JSON.parse(yearlyUsers);

  let lineChart = (data, XAxisData) => {
    return new Chart(CHART, {
      type: 'line',
      options: {
        animation: {
          duration: 0,
        },
      },
      data: data = {
        labels: XAxisData,
        datasets: data,
      },
    });
  };

  // Pass dates in weekly segment as x-axis data
  //
  const XAxisData = weeklyUsers['all'][0][0];

  // Switches data on chart depending on the selected date range
  //
  let switchChartData = document.querySelectorAll('.switch-expanded-chart');

  let allChartDataSet = [];
  allChartDataSet.push(chartDataSet('1 week', 0.4, '#00a87e', '#00a87e', '#1de9b6', '#1de9b6', '#1de9b6', weeklyUsers['all'][1][0]));
  lineChart(allChartDataSet, XAxisData);

  switchChartData.forEach(element => {
    element.addEventListener('change', () => {
      switch (event.target.value) {
        case 'one_month_a_e':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('1st Week', 0.4, '#00a87e', '#00a87e', '#1de9b6', '#1de9b6', '#1de9b6', monthlyUsers['all']['detailedData'][1][0]),
            chartDataSet('2nd Week', 0.5, '#006793', '#006793', '#03a9f4', '#03a9f4', '#03a9f4', monthlyUsers['all']['detailedData'][1][1]),
            chartDataSet('3rd Week', 0.6, 'red', 'red', '#03a9f4', '#03a9f4', '#03a9f4', monthlyUsers['all']['detailedData'][1][2]),
            chartDataSet('Current Week', 0.7, 'black', 'black', '#03a9f4', '#03a9f4', '#03a9f4', monthlyUsers['all']['detailedData'][1][3]),
          );
          lineChart(allChartDataSet, XAxisData);
          break;
        case 'three_months_a_e':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('Month 1', 0.4, '#32a852', '#32a852', '#1de9b6', '#1de9b6', '#1de9b6', threeMonthsUsers['all']['detailedData'][1][0]),
            chartDataSet('Month 2', 0.5, '#10e4e8', '#10e4e8', '#03a9f4', '#03a9f4', '#03a9f4', threeMonthsUsers['all']['detailedData'][1][1]),
            chartDataSet('Month 3', 0.6, '#0519f2', '#0519f2', '#ffd269', '#ffd269', '#ffd269', threeMonthsUsers['all']['detailedData'][1][2]),
          );
          lineChart(allChartDataSet, threeMonthsUsers['all']['detailedData'][0][2]);
          break;
        case 'six_months_a_e':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('Month 1', 0.4, '#d503ff', '#d503ff', '#1de9b6', '#1de9b6', '#1de9b6', sixMonthsUsers['all']['detailedData'][1][0]),
            chartDataSet('Month 2', 0.5, '#ff0368', '#ff0368', '#03a9f4', '#03a9f4', '#03a9f4', sixMonthsUsers['all']['detailedData'][1][1]),
            chartDataSet('Month 3', 0.6, '#9e9826', '#9e9826', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['detailedData'][1][2]),
            chartDataSet('Month 4', 0.7, '#368a25', '#368a25', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['detailedData'][1][3]),
            chartDataSet('Month 5', 0.8, '#913527', '#913527', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['detailedData'][1][4]),
            chartDataSet('Month 6', 0.9, '#2b2691', '#2b2691', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['detailedData'][1][5]),
          );
          lineChart(allChartDataSet, sixMonthsUsers['all']['detailedData'][0][5]);
          break;
        case 'one_year_a_e':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('Month 1', 0.4, '#8f5424', '#8f5424', '#1de9b6', '#1de9b6', '#1de9b6', yearlyUsers['all']['detailedData'][1][0]),
            chartDataSet('Month 2', 0.5, '#fa7305', '#fa7305', '#03a9f4', '#03a9f4', '#03a9f4', yearlyUsers['all']['detailedData'][1][1]),
            chartDataSet('Month 3', 0.6, '#917e6e', '#917e6e', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][2]),
            chartDataSet('Month 4', 0.6, '#609c91', '#609c91', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][3]),
            chartDataSet('Month 5', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][4]),
            chartDataSet('Month 6', 0.4, '#285f75', '#285f75', '#1de9b6', '#1de9b6', '#1de9b6', yearlyUsers['all']['detailedData'][1][5]),
            chartDataSet('Month 7', 0.5, '#05b8ff', '#05b8ff', '#03a9f4', '#03a9f4', '#03a9f4', yearlyUsers['all']['detailedData'][1][6]),
            chartDataSet('Month 8', 0.6, '#22437a', '#22437a', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][7]),
            chartDataSet('Month 9', 0.6, '#0060ff', '#0060ff', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][8]),
            chartDataSet('Month 10', 0.6, '#343885', '#343885', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][9]),
            chartDataSet('Month 11', 0.6, '#000cf5', '#000cf5', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][10]),
            chartDataSet('Month 12', 0.6, '#3b215c', '#3b215c', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['detailedData'][1][11]),
          );
          lineChart(allChartDataSet, yearlyUsers['all']['detailedData'][0][11]);
          break;
        case 'one_week_b_e':
          allChartDataSet = [];
          allChartDataSet.push(chartDataSet('1 week', 0.4, '#00a87e', '#00a87e', '#1de9b6', '#1de9b6', '#1de9b6', weeklyUsers['all'][1][0]));
          lineChart(allChartDataSet, XAxisData);
          break;
        case 'one_month_b_e':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('1 Month', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', monthlyUsers['all']['oneLineData'][1][0]),
          );
          lineChart(allChartDataSet, monthlyUsers['all']['oneLineData'][0][0]);
          break;
        case 'three_months_b_e':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('3 Months', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', threeMonthsUsers['all']['oneLineData'][1][0]),
          );
          lineChart(allChartDataSet, threeMonthsUsers['all']['oneLineData'][0][0]);
          break;
        case 'six_months_b_e':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('6 Months', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', sixMonthsUsers['all']['oneLineData'][1][0]),
          );
          lineChart(allChartDataSet, sixMonthsUsers['all']['oneLineData'][0][0]);
          break;
        case 'one_year_b_e':
          allChartDataSet = [];
          allChartDataSet.push(
            chartDataSet('1 Year', 0.6, '#08ffd2', '#08ffd2', '#ffd269', '#ffd269', '#ffd269', yearlyUsers['all']['oneLineData'][1][0]),
          );
          lineChart(allChartDataSet, yearlyUsers['all']['oneLineData'][0][0]);
          break;
        default:
          break;
      }

    });
  });

  var targetDiv = document.getElementById('switching');
  var htmlContent = '';

  /**
   * Define Auth & Non users auth time spent on the time
   */
  let authUsersTimeSpent, nonAuthUsersTimeSpent;

  var getUsersTimeSpent = (authUsersTime, nonAuthUsersTime) => {
    authUsersTimeSpent = authUsersTime.toString();
    nonAuthUsersTimeSpent = nonAuthUsersTime.toString();

    // Switch to the value of non-auth users b default
    // document.getElementById("switchToNonAuth").click();
  };

  /**
   * Populate data for auth & non auth users time spent on the site
   * @param {mixed} event
   */
  function populateData(event) {
    switch (event.target.value) {
      case 'A': {
        htmlContent = `${authUsersTimeSpent} (${event.target.innerText})`;
        break;
      }
      case 'B': {
        htmlContent = `${nonAuthUsersTimeSpent}  (${event.target.innerText})`;
        break;
      }
    }
    targetDiv.innerHTML = htmlContent;
  }

  // -----------
  // Toggling the charts data from auth to non auth active users
  // -----------

  $(document).ready(function () {
    $('#show-div').show();
    $('#full').show();
    $('#empty').hide();
    $('#new').hide();

    $('button[type="button"]').click(function () {
      if ($(this).attr('id') == 'option1') {
        $('#show-div').show();
        $('#full').show();
        $('#units').show();
        $('#empty').hide();
        $('#new').hide();
      } else if ($(this).attr('id') == 'option2') {
        $('#show-div').show();
        $('#full').hide();
        $('#empty').show();
        $('#new').hide();
      } else if ($(this).attr('id') == 'option3') {
        $('#show-div').show();
        $('#full').hide();
        $('#empty').hide();
        $('#new').show();
      } else {
        $('#show-div').show();
        $('#full').show();
        $('#default').show();
      }
    });
  });

  function closeAlert() {
    document.querySelector('.closebtn').parentElement.style.display = 'none';
  }

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function () {
      var div = this.parentElement;
      div.style.opacity = '0';
      setTimeout(function () {
        div.style.display = 'none';
      }, 600);
    };
  }

};

