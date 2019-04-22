@extends('manager.master')
@section('content')
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Total Orders</span>
      <div class="count">{{ $orders }}</div>
      {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> --}}
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
      <div class="count">{{ $products }}</div>
      {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> --}}
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Product Sold</span>
      <div class="count">{{ $product_sold }}</div>
      {{-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span> --}}
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Customers</span>
      <div class="count">{{ $customers }}</div>
      {{-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> --}}
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Revenue in this month</span>
      <div class="count green">{{ $revenue }}</div>
      {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> --}}
    </div>
  </div>
  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>Best seller <small></small></h3>
          </div>
          <div class="col-md-6">
            <form action="" id="form-check" method="POST" role="form" enctype="multipart/form-data" >
              <div class="pull-right row form-group" style="background: #fff; cursor: pointer; padding: 5px 10px;">
              @csrf
                <div class="col-md-5 datetime">
                  <input type="text" class="form-control form_datetime" name="start-time" id="start_time" placeholder="Start time">
                </div>
                <div class="col-md-5 datetime">
                  <input type="text" class="form-control form_datetime" name="end-time" id="end_time" placeholder="End time">               
                </div>
                <div class="col-md-2">
                  <button class="btn btn-sm-primary" type="submit">Check</button>
                </div>
              </div>
            </form>
            
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <table class="table table-striped table-responsive">
            <thead>
              <th>Product</th>
              <th  style="width: 20%;">Thumbnail</th>
              <th>Brand</th>
              <th>Price</th>
              <th>Quantity</th>
            </thead>
            <tbody id="content">
            </tbody>
          </table>
        </div>
        

        <div class="clearfix"></div>
      </div>
    </div>

  </div>
  <br />


  <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Recent Activities <small>Sessions</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">

            <ul class="list-unstyled timeline widget">
              <li>
                <div class="block">
                  <div class="block_content">
                    <h2 class="title">
                      <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                    </h2>
                    <div class="byline">
                      <span>13 hours ago</span> by <a>Jane Smith</a>
                    </div>
                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                    </p>
                  </div>
                </div>
              </li>
              <li>
                <div class="block">
                  <div class="block_content">
                    <h2 class="title">
                      <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                    </h2>
                    <div class="byline">
                      <span>13 hours ago</span> by <a>Jane Smith</a>
                    </div>
                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                    </p>
                  </div>
                </div>
              </li>
              <li>
                <div class="block">
                  <div class="block_content">
                    <h2 class="title">
                      <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                    </h2>
                    <div class="byline">
                      <span>13 hours ago</span> by <a>Jane Smith</a>
                    </div>
                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                    </p>
                  </div>
                </div>
              </li>
              <li>
                <div class="block">
                  <div class="block_content">
                    <h2 class="title">
                      <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                    </h2>
                    <div class="byline">
                      <span>13 hours ago</span> by <a>Jane Smith</a>
                    </div>
                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                    </p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-8 col-sm-8 col-xs-12">



      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Visitors location <small>geo-presentation</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="dashboard-widget-content">
                <div class="col-md-4 hidden-small">
                  <h2 class="line_30">125.7k Views from 60 countries</h2>

                  <table class="countries_list">
                    <tbody>
                      <tr>
                        <td>United States</td>
                        <td class="fs15 fw700 text-right">33%</td>
                      </tr>
                      <tr>
                        <td>France</td>
                        <td class="fs15 fw700 text-right">27%</td>
                      </tr>
                      <tr>
                        <td>Germany</td>
                        <td class="fs15 fw700 text-right">16%</td>
                      </tr>
                      <tr>
                        <td>Spain</td>
                        <td class="fs15 fw700 text-right">11%</td>
                      </tr>
                      <tr>
                        <td>Britain</td>
                        <td class="fs15 fw700 text-right">10%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row">


        <!-- Start to do list -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>To Do List <small>Sample tasks</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <div class="">
                <ul class="to_do">
                  <li>
                    <p>
                      <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                    </li>
                    <li>
                      <p>
                        <input type="checkbox" class="flat"> Create email address for new intern</p>
                      </li>
                      <li>
                        <p>
                          <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                              </li>
                              <li>
                                <p>
                                  <input type="checkbox" class="flat"> Create email address for new intern</p>
                                </li>
                                <li>
                                  <p>
                                    <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                                  </li>
                                  <li>
                                    <p>
                                      <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End to do list -->

                          <!-- start of weather widget -->
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Daily active users <small>Sessions</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                  <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                      <li><a href="#">Settings 1</a>
                                      </li>
                                      <li><a href="#">Settings 2</a>
                                      </li>
                                    </ul>
                                  </li>
                                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                                  </li>
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="temperature"><b>Monday</b>, 07:30 AM
                                      <span>F</span>
                                      <span><b>C</b></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <div class="weather-icon">
                                      <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                                    </div>
                                  </div>
                                  <div class="col-sm-8">
                                    <div class="weather-text">
                                      <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="weather-text pull-right">
                                    <h3 class="degrees">23</h3>
                                  </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="row weather-days">
                                  <div class="col-sm-2">
                                    <div class="daily-weather">
                                      <h2 class="day">Mon</h2>
                                      <h3 class="degrees">25</h3>
                                      <canvas id="clear-day" width="32" height="32"></canvas>
                                      <h5>15 <i>km/h</i></h5>
                                    </div>
                                  </div>
                                  <div class="col-sm-2">
                                    <div class="daily-weather">
                                      <h2 class="day">Tue</h2>
                                      <h3 class="degrees">25</h3>
                                      <canvas height="32" width="32" id="rain"></canvas>
                                      <h5>12 <i>km/h</i></h5>
                                    </div>
                                  </div>
                                  <div class="col-sm-2">
                                    <div class="daily-weather">
                                      <h2 class="day">Wed</h2>
                                      <h3 class="degrees">27</h3>
                                      <canvas height="32" width="32" id="snow"></canvas>
                                      <h5>14 <i>km/h</i></h5>
                                    </div>
                                  </div>
                                  <div class="col-sm-2">
                                    <div class="daily-weather">
                                      <h2 class="day">Thu</h2>
                                      <h3 class="degrees">28</h3>
                                      <canvas height="32" width="32" id="sleet"></canvas>
                                      <h5>15 <i>km/h</i></h5>
                                    </div>
                                  </div>
                                  <div class="col-sm-2">
                                    <div class="daily-weather">
                                      <h2 class="day">Fri</h2>
                                      <h3 class="degrees">28</h3>
                                      <canvas height="32" width="32" id="wind"></canvas>
                                      <h5>11 <i>km/h</i></h5>
                                    </div>
                                  </div>
                                  <div class="col-sm-2">
                                    <div class="daily-weather">
                                      <h2 class="day">Sat</h2>
                                      <h3 class="degrees">26</h3>
                                      <canvas height="32" width="32" id="cloudy"></canvas>
                                      <h5>10 <i>km/h</i></h5>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                </div>
                              </div>
                            </div>

                          </div>
                          <!-- end of weather widget -->
                        </div>
                      </div>
  </div>

</div>
@endsection
@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


<script type="text/javascript">
  $(function () {
    $('.form_datetime').datetimepicker();
  });
</script>
<script type="text/javascript" src="/js/manager/dashboard.js"></script>
@endsection