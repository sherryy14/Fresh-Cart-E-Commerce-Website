<?php
include 'header.php';
include 'config.php';

// Graph Query 
$query = "SELECT c.cat_name AS name, count(p.p_category) AS y FROM `category` AS c LEFT JOIN `products` AS p ON c.cat_id = p.p_category GROUP BY c.cat_id";
$res = mysqli_query($conn, $query);

$newVsReturningVisitorsDataPoints = array();
while ($data = mysqli_fetch_assoc($res)) {
	array_push($newVsReturningVisitorsDataPoints, $data);
}
$totalVisitors = 0;

// Products , Categories, And Users Count 
$nOofProdCat = "SELECT count(p_id) AS p_count,  count(cat_id) AS c_count FROM `products` AS p RIGHT JOIN `category` AS c ON c.cat_id = p.p_category";
$noRes = mysqli_query($conn, $nOofProdCat);
$noRow = mysqli_fetch_array($noRes);

$nOofUsers = "SELECT count(user_id) AS users FROM `register`";
$noUser = mysqli_query($conn, $nOofUsers);
$users = mysqli_fetch_array($noUser);

// Recently Added Products 
$prodQuery = "SELECT * FROM `category` AS `c` INNER JOIN `products` AS `p` ON c.cat_id = p.p_id ORDER BY p_id DESC LIMIT 5";
if(isset($_POST['stockbtn'])) {
  if($_POST['stockvalue']=='1') { 
    $prodQuery = "SELECT * FROM `category` AS `c` INNER JOIN `products` AS `p` ON c.cat_id = p.p_id ORDER BY p_id DESC LIMIT 5 WHERE stock = 'In stock'";  
  }
  elseif($_POST['stockvalue']=='2') {     
    $prodQuery = "SELECT * FROM `category` AS `c` INNER JOIN `products` AS `p` ON c.cat_id = p.p_id ORDER BY p_id DESC LIMIT 5 WHERE stock = 'Out of stock'";
  }
  elseif($_POST['stockvalue']=='0'){
    $prodQuery = "SELECT * FROM `category` AS `c` INNER JOIN `products` AS `p` ON c.cat_id = p.p_id ORDER BY p_id DESC LIMIT 5";
  }
}
$prodResult = mysqli_query($conn, $prodQuery) or die (mysqli_error($conn));

?>




<!-- main wrapper -->
<main class="main-content-wrapper">
    <section class="container">
        <!-- row -->
        <div class="row mb-8">
            <div class="col-md-12">
                <!-- card -->
                <div class="card bg-light border-0 rounded-4" style="background-image: url(../assets/images/slider/slider-image-1.jpg); background-repeat: no-repeat; background-size: cover; background-position: right;">
                    <div class="card-body p-lg-12">
                        <h1>Welcome back! FreshCart
                        </h1>
                        <p>FreshCart is simple & clean design for developer and
                            designer.</p>
                        <a href="products.php" class="btn btn-primary">
                            Create Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- table -->

        <div class="row">
            <div class="col-lg-4 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div>
                                <h4 class="mb-0 fs-5">Products</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-danger text-dark-danger rounded-circle">
                                <i class="bi bi-cart fs-5"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1">
                            <h1 class=" mb-2 fw-bold fs-2"><?php echo $noRow['p_count']?></h1>
                            <span>No. Of Products</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div>
                                <h4 class="mb-0 fs-5">Category</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-warning text-dark-warning rounded-circle">
                                <i class="bi bi-cart fs-5"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1">
                            <h1 class=" mb-2 fw-bold fs-2"><?php echo $noRow['c_count']?></h1>
                            <span>No . Of Categories</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div>
                                <h4 class="mb-0 fs-5">Users</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-info text-dark-info rounded-circle">
                                <i class="bi bi-people fs-5"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1">
                            <h1 class=" mb-2 fw-bold fs-2"><?php echo $users['users']?></h1>
                            <span>No. Of Registered Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="row ">
            <div class="col-xl-8 col-lg-6 col-md-12 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <div class="card-body p-6">
                        <!-- heading -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="mb-1 fs-5">Revenue </h3>
                                <small>(+63%) than last year</small>
                            </div>
                            <div>
                                <!-- select option -->
                                <select class="form-select ">
                                    <option selected>2019</option>
                                    <option value="2023">2020</option>
                                    <option value="2024">2021</option>
                                    <option value="2025">2022</option>
                                    <option value="2025">2023</option>
                                </select>
                            </div>

                        </div>
                        <!-- chart -->
                        <div id="revenueChart" class="mt-6"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- heading -->
                        <h3 class="mb-0 fs-5">Products By Category</h3>
                        <!-- <div id="totalSale" class="mt-6 d-flex justify-content-center"></div> -->
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>


                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row ">
            <div class="col-xl-6 col-lg-6 col-md-12 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <h3 class="mb-0 fs-5">Sales Overview </h3>
                        <div class="mt-6">
                            <!-- text -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="fs-6">Total Profit</h5>
                                    <span><span class="me-1 text-dark">$1,619</span> (8.6%)</span>
                                </div>
                                <!-- main wrapper -->
                                <div>
                                    <!-- progressbar -->
                                    <div class="progress bg-light-primary" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-label="Example 1px high" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <!-- text -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="fs-6">Total Income</h5>
                                    <span><span class="me-1 text-dark">$3,571</span> (86.4%)</span>
                                </div>
                                <div>
                                    <!-- progressbar -->
                                    <div class="progress bg-info-soft" style="height: 6px;">
                                        <div class="progress-bar bg-info" role="progressbar" aria-label="Example 1px high" style="width: 88%;" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- text -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="fs-6">Total Expenses</h5>
                                    <span><span class="me-1 text-dark">$3,430</span> (74.5%)</span>
                                </div>
                                <div>
                                    <!-- progressbar -->
                                    <div class="progress bg-light-danger" style="height: 6px;">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-label="Example 1px high" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-12 mb-6">
                <div class=" position-relative h-100">
                    <!-- card -->
                    <div class="card card-lg mb-6">
                        <!-- card body -->
                        <div class="card-body px-6 py-8">
                            <div class="d-flex align-items-center">
                                <div>
                                    <!-- svg -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bell text-warning" viewBox="0 0 16 16">
                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                    </svg>
                                </div>
                                <!-- text -->
                                <div class="ms-4">
                                    <h5 class="mb-1">Start your day with New Notification.</h5>
                                    <p class="mb-0">You have <a class="link-info" href="#!">2 new
                                            notification</a></p>
                                </div>

                            </div>



                        </div>
                    </div>
                    <!-- card -->
                    <div class="card card-lg">
                        <!-- card body -->
                        <div class="card-body px-6 py-8">
                            <div class="d-flex align-items-center">
                                <!-- svg -->
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-lightbulb text-success" viewBox="0 0 16 16">
                                        <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z" />
                                    </svg>
                                </div>
                                <!-- text -->
                                <div class="ms-4">
                                    <h5 class="mb-1">Monitor your Sales and Profitability</h5>
                                    <p class="mb-0"> <a class="link-info" href="#!">View Performance</a></p>
                                </div>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
                <div class="card h-100 card-lg">
                    <!-- heading -->
                    <div class="p-6">
                        <h3 class="mb-0 fs-5">Recently Added Products</h3>
                    </div>
                    <div class="card-body p-0">
                        <!-- table -->
                        <div class="table-responsive">
                        <table class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
                <thead class="bg-light">
                  <tr>
                    <th>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                        <label class="form-check-label" for="checkAll">

                        </label>
                      </div>
                    </th>
                    <th>Image</th>
                    <th>Proudct Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Sales Price</th>
                    <th>Regular Price</th>
                 
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($prodResult) > 0) {
                    while ($row = mysqli_fetch_array($prodResult)) {

                      if($row['stock']== "In stock"){
                        $class = "badge bg-light-primary text-dark-primary";
                      }else{
                        $class = "badge bg-light-danger text-dark-danger";
                      }
                  ?>
                  
                      <tr>

                        <td>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="productOne">
                            <label class="form-check-label" for="productOne">

                            </label>
                          </div>
                        </td>
                        <td>
                          <a href="#!"> <img src="../assets/images/products/<?php echo $row['img1'];?>" alt="" class="icon-shape icon-md"></a>
                        </td>
                        <td><a href="#" class="text-reset"><?php echo $row['p_title'];?></a></td>
                        <td><?php echo $row['cat_name'];?></td>

                        <td>
                          <span class="<?php echo $class;?>"><?php echo $row['stock'];?></span>
                        </td>
                        <td>$<?php echo $row['p_price'];?></td>
                        <td>$<?php echo $row['re_price'];?></td>
                        
                       
                      </tr>
                  <?php

                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

        </div>
        <div class="container w-25">
        <a href="products.php" class='btn btn-primary '>View All</a>
        </div>
    </section>
</main>

<script>
    window.onload = function() {

        var totalVisitors = <?php echo $totalVisitors ?>;
        var visitorsData = {
            "New vs Returning Visitors": [{
                click: visitorsChartDrilldownHandler,
                cursor: "pointer",
                explodeOnClick: false,
                innerRadius: "75%",
                legendMarkerType: "square",
                name: "New vs Returning Visitors",
                radius: "100%",
                showInLegend: true,
                startAngle: 90,
                type: "doughnut",
                dataPoints: <?php echo json_encode($newVsReturningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        };

        var newVSReturningVisitorsOptions = {
            animationEnabled: true,
            theme: "light2",
        };

        var visitorsDrilldownedChartOptions = {
            animationEnabled: true,
            theme: "light2",
            axisX: {
                labelFontColor: "#717171",
                lineColor: "#a2a2a2",
                tickColor: "#a2a2a2"
            },
            axisY: {
                gridThickness: 0,
                includeZero: false,
                labelFontColor: "#717171",
                lineColor: "#a2a2a2",
                tickColor: "#a2a2a2",
                lineThickness: 1
            },
            data: []
        };

        var chart = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
        chart.options.data = visitorsData["New vs Returning Visitors"];
        chart.render();

        function visitorsChartDrilldownHandler(e) {
            chart = new CanvasJS.Chart("chartContainer", visitorsDrilldownedChartOptions);
            chart.options.data = visitorsData[e.dataPoint.name];
            chart.options.title = {
                text: e.dataPoint.name
            }
            chart.render();
            $("#backButton").toggleClass("invisible");
        } 
    }
</script>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<?php include 'footer.php' ?>