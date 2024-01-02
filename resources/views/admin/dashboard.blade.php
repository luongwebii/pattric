@extends('layouts/contentNavbarLayout')

@section('title', 'SPoT – Dashboard Website Administration')



@section('content')

<div class="row">


  <!-- Order Statistics -->
  <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Order Statistics</h5>
          <small class="text-muted">${{Helper::format_numbers_2($totalPrice)}} Total Sales</small>
        </div>

      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">{{Helper::format_numbers_2($totalQty)}}</h2>
            <span>Total Orders</span>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">

        @foreach ($category as $name=> $number)
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                <h6 class="mb-0">{{$name}}</h6>
                <small class="text-muted"></small>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">{{Helper::format_numbers_2($number)}}</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          @endforeach
          
        </ul>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->


  <!-- Order Statistics -->

  <!--/ Order Statistics -->




  <!-- Transactions -->
  <div class="col-md-6 col-lg-6 order-1 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Last Orders</h5>
 
      </div>
      <div class="card-body">
        
      <div class="table-responsive text-nowrap">
        
      <table class="table">
            <thead>
            <tr class="text-nowrap">
                <th scope="col" width="1%">#</th>
                <th>Date</th>
                <th>Invoice</th>
                <th>Name</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
         @foreach ($lastOrders as $name=> $order)
        
                                    <tr>
                                    <td class="sorting_1">
                                    {{ $loop->index+1 }}
                                </td>
                                <td class="sorting_1">{{ Helper::formatDate($order->created_at) }} </td>
                                <td class="soring_1">{{ $order->invoice_number }}</td>
                                <td class="soring_1"><a href="{{ route('admin.orders.show', $order) }}">{{ $order->first_name }} {{ $order->last_name }}</a></td>
                                <td class="sorting_1">${{ Helper::format_numbers($order->amount) }}</td>
                    </tr>
                                
          @endforeach
        </tbody>
        </table>

        </div>

      </div>
    </div>
  </div>



    <!-- Order Statistics -->
    <div class="col-md-12 col-lg-12 col-xl-12 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2"></h5>
         
        </div>

      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
   
          <div id="orderStatisticsChart2" style="width:100%;"></div>
        </div>
     
      </div>
    </div>
  </div>
  </div>
  <!--/ Order Statistics -->
  <script src="{!! url('assets/vendor/libs/apex-charts/apexcharts.js') !!}"></script>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

<script>
  // --------------------------------------------------------------------
  let config2 = {
  colors: {
    primary: '#696cff',
    secondary: '#8592a3',
    success: '#71dd37',
    info: '#03c3ec',
    warning: '#ffab00',
    danger: '#ff3e1d',
    dark: '#233446',
    black: '#000',
    white: '#fff',
    body: '#f4f5fb',
    headingColor: '#566a7f',
    axisColor: '#a1acb8',
    borderColor: '#eceef1'
  }
};
let cardColor, headingColor, axisColor, shadeColor, borderColor;

cardColor = config2.colors.white;
headingColor = config2.colors.headingColor;
axisColor = config2.colors.axisColor;
borderColor = config2.colors.borderColor;
  const chartOrderStatistics = document.querySelector('#orderStatisticsChart');
  

    var options = {
       // labels: ['{{implode("', '", array_keys($category))}}'],
        series: [{{implode(",", array_values($category))}}],

          chart: {
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };
  if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
    const statisticsChart = new ApexCharts(chartOrderStatistics, options);
    statisticsChart.render();
  }

  const orderStatisticsChart2 = document.querySelector('#orderStatisticsChart2');
  var colors = [
      '#008FFB',
      '#00E396',
      '#FEB019',
      '#FF4560',
      '#775DD0',
      '#546E7A',
      '#26a69a',
      '#D10CE8'
    ];
  var options2 = {
          series: [{
          data: [{{implode(",", array_values($category))}}]
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: [

            @foreach ($category as $name=> $number)
            ['{{$name}}'],
            @endforeach
           
          ],
          labels: {
            style: {
              colors: colors,
              fontSize: '12px'
            }
          }
        }
        };

      
        if (typeof orderStatisticsChart2 !== undefined && orderStatisticsChart2 !== null) {
            var chart = new ApexCharts(document.querySelector("#orderStatisticsChart2"), options2);
            chart.render();
        }
</script>
@endsection
