<?php
require '../global.php';
require_once '../admin/dao/connect.php';


if (!isset($_SESSION['user'])) {
  header('Location: /sublime/client/pages/user/login.php');
}
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  if ($user['role_user'] == 'USER') {
    header('Location: /sublime/index.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

    <?php
    include "./components/navbar.php"
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php
      include "./components/sidebar.php"
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
              </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Total Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <?php
                  $sql = "SELECT * FROM orders LEFT JOIN products ON products.id_product = orders.id_product";
                  $total = 0;
                  $products = pdo_query($sql);
                  foreach ($products as $product) {
                    $subtotal = $product['price_product'] * $product['quantity_product'];
                    $total += $subtotal;
                  }
                  echo '<h2 class="mb-5">$' . $total . '</h2>';
                  ?>
                  <!-- <h2 class="mb-5">$ 15,0000</h2> -->
                </div>
              </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Number of products <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <?php
                  $sql = 'SELECT count(*) FROM products';
                  $product = pdo_query_value($sql);
                  echo '<h2 class="mb-5">' . $product . '</h2>';
                  ?>
                </div>
              </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Number of users <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <?php
                  $sql = 'SELECT count(*) FROM users';
                  $users = pdo_query_value($sql);
                  echo '<h2 class="mb-5">' . $users . '</h2>';
                  ?>
                </div>
              </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-warning card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Sales Today <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <?php
                  $now = date("Y-m-d");
                  $sql = "SELECT * FROM orders LEFT JOIN products ON products.id_product = orders.id_product WHERE createAt_order=$now";
                  $sale = 0;
                  $it = pdo_query($sql);
                  foreach ($it as $product) {
                    $subtotal = $product['price_product']*$product['quantity_product'];
                    $sale += $subtotal;
                  }
                  echo '<h2 class="mb-5">'.$sale.'</h2>';
                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <h4 class="card-title float-left">Sale</h4>
                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                  </div>
                  <canvas id="visit-sale-chart" class="mt-4"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
            <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php
  $months = array();
  $sales = array();
  $year = date('Y');
  for ($m = 1; $m <= 12; $m++) {
    try {
      $sql = "SELECT * FROM orders LEFT JOIN products ON products.id_product = orders.id_product WHERE MONTH(createAt_order)=$m AND YEAR(createAt_order)=$year";
      $totals = 0;
      $saless = pdo_query($sql);
      foreach ($saless as $items) {
        $subtotal = $items['price_product'] * $items['quantity_product'];
        $totals += $subtotal;
      }
      array_push($sales, round($totals, 2));
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    $num = str_pad($m, 2, 0, STR_PAD_LEFT);
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }
  $months = json_encode($months);
  $sales = json_encode($sales);
  ?>
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script>
    (function($) {
      'use strict';
      $(function() {

        Chart.defaults.global.legend.labels.usePointStyle = true;
        if ($("#visit-sale-chart").length) {
          Chart.defaults.global.legend.labels.usePointStyle = true;
          var ctx = document.getElementById('visit-sale-chart').getContext("2d");

          var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
          gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
          gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');
          var gradientLegendViolet = 'linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))';

          var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 360);
          gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
          gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
          var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

          var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 300);
          gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
          gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
          var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: <?php echo $months; ?>,
              datasets: [{
                label: "Sales",
                borderColor: gradientStrokeBlue,
                backgroundColor: gradientStrokeBlue,
                hoverBackgroundColor: gradientStrokeBlue,
                legendColor: gradientLegendBlue,
                pointRadius: 0,
                fill: false,
                borderWidth: 1,
                fill: 'origin',
                data: <?php echo $sales; ?>
              }]
            },
            options: {
              responsive: true,
              legend: false,
              legendCallback: function(chart) {
                var text = [];
                text.push('<ul>');
                for (var i = 0; i < chart.data.datasets.length; i++) {
                  text.push('<li><span class="legend-dots" style="background:' +
                    chart.data.datasets[i].legendColor +
                    '"></span>');
                  if (chart.data.datasets[i].label) {
                    text.push(chart.data.datasets[i].label);
                  }
                  text.push('</li>');
                }
                text.push('</ul>');
                return text.join('');
              },
              scales: {
                yAxes: [{
                  ticks: {
                    display: false,
                    min: 0
                  },
                  gridLines: {
                    drawBorder: false,
                    color: 'rgba(235,237,242,1)',
                    zeroLineColor: 'rgba(235,237,242,1)'
                  }
                }],
                xAxes: [{
                  gridLines: {
                    display: false,
                    drawBorder: false,
                    color: 'rgba(0,0,0,1)',
                    zeroLineColor: 'rgba(235,237,242,1)'
                  },
                  ticks: {
                    padding: 20,
                    fontColor: "#9c9fa6",
                    autoSkip: true,
                  },
                  categoryPercentage: 0.5,
                  barPercentage: 0.5
                }]
              }
            },
            elements: {
              point: {
                radius: 0
              }
            }
          })
          $("#visit-sale-chart-legend").html(myChart.generateLegend());
        }
        if ($("#traffic-chart").length) {
          var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 181);
          gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
          gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
          var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

          var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 50);
          gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
          gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
          var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

          var gradientStrokeGreen = ctx.createLinearGradient(0, 0, 0, 300);
          gradientStrokeGreen.addColorStop(0, 'rgba(6, 185, 157, 1)');
          gradientStrokeGreen.addColorStop(1, 'rgba(132, 217, 210, 1)');
          var gradientLegendGreen = 'linear-gradient(to right, rgba(6, 185, 157, 1), rgba(132, 217, 210, 1))';

          var trafficChartData = {
            datasets: [{
              data: [30, 30, 40],
              backgroundColor: [
                gradientStrokeBlue,
                gradientStrokeGreen,
                gradientStrokeRed
              ],
              hoverBackgroundColor: [
                gradientStrokeBlue,
                gradientStrokeGreen,
                gradientStrokeRed
              ],
              borderColor: [
                gradientStrokeBlue,
                gradientStrokeGreen,
                gradientStrokeRed
              ],
              legendColor: [
                gradientLegendBlue,
                gradientLegendGreen,
                gradientLegendRed
              ]
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
              'Search Engines',
              'Direct Click',
              'Bookmarks Click',
            ]
          };
          var trafficChartOptions = {
            responsive: true,
            animation: {
              animateScale: true,
              animateRotate: true
            },
            legend: false,
            legendCallback: function(chart) {
              var text = [];
              text.push('<ul>');
              for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                text.push('<li><span class="legend-dots" style="background:' +
                  trafficChartData.datasets[0].legendColor[i] +
                  '"></span>');
                if (trafficChartData.labels[i]) {
                  text.push(trafficChartData.labels[i]);
                }
                text.push('<span class="float-right">' + trafficChartData.datasets[0].data[i] + "%" + '</span>')
                text.push('</li>');
              }
              text.push('</ul>');
              return text.join('');
            }
          };
          var trafficChartCanvas = $("#traffic-chart").get(0).getContext("2d");
          var trafficChart = new Chart(trafficChartCanvas, {
            type: 'doughnut',
            data: trafficChartData,
            options: trafficChartOptions
          });
          $("#traffic-chart-legend").html(trafficChart.generateLegend());
        }
      });
    })(jQuery);
  </script>
  <!-- <script src="assets/js/todolist.js"></script> -->
  <!-- End custom js for this page -->
</body>

</html>