<?php
include 'header.php';
include 'config.php';

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$num_per_page = 04;
$start_from = ($page - 1) * $num_per_page;



$prodQuery = "SELECT * FROM `category` AS `c` INNER JOIN `products` AS `p` ON c.cat_id = p.p_id LIMIT $start_from,$num_per_page";
if (isset($_POST['stockbtn'])) {
  if ($_POST['stockvalue'] == '1') {

    $prodQuery = "SELECT * FROM `category` AS `c` INNER JOIN `products` AS `p` ON c.cat_id = p.p_id WHERE stock = 'In stock'";
    // $prodResult = mysqli_query($conn, $prodQuery);

  } elseif ($_POST['stockvalue'] == '2') {

    $prodQuery = "SELECT * FROM `category` AS `c` INNER JOIN `products` AS `p` ON c.cat_id = p.p_id WHERE stock = 'Out of stock'";
    // $prodResult = mysqli_query($conn, $prodQuery);

  } elseif ($_POST['stockvalue'] == '0') {

    $prodQuery = "SELECT * FROM `category` AS `c` INNER JOIN `products` AS `p` ON c.cat_id = p.p_id";
    // $prodResult = mysqli_query($conn, $prodQuery);

  }
}


$prodResult = mysqli_query($conn, $prodQuery) or die(mysqli_error($conn));


?>


<!-- main -->
<main class="main-content-wrapper">
  <div class="container">
    <div class="row mb-8">
      <div class="col-md-12">
        <!-- page header -->
        <div class="d-md-flex justify-content-between align-items-center">
          <div>
            <h2>Products</h2>
            <!-- breacrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
              </ol>
            </nav>
          </div>
          <!-- button -->
          <div>
            <a href="add-product.php" class="btn btn-primary">Add Product</a>
          </div>
        </div>
      </div>
    </div>
    <!-- row -->
    <div class="row ">
      <div class="col-xl-12 col-12 mb-5">
        <!-- card -->
        <div class="card h-100 card-lg">
          <div class="px-6 py-6 ">
            <div class="row justify-content-between">
              <!-- form -->
              <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                <form class="d-flex" role="search">
                  <input class="form-control" type="search" placeholder="Search Products" aria-label="Search">
                </form>
              </div>
              <!-- select option -->
              <div class="col-lg-2 col-md-4 col-12">
                <form method="post">

                  <select class="form-select" name="stockvalue">

                    <option value="0" selected>All</option>

                    <option value="1">In Stock</option>
                    <option value="2">Out Of Stock</option>

                  </select>

                  <input type="submit" value="Filter" class='btn btn-primary' name='stockbtn'>

                </form>

              </div>
            </div>
          </div>
          <!-- card body -->
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
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($prodResult) > 0) {
                    while ($row = mysqli_fetch_array($prodResult)) {

                      if ($row['stock'] == "In stock") {
                        $class = "badge bg-light-primary text-dark-primary";
                      } else {
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
                          <a href="#!"> <img src="../assets/images/products/<?php echo $row['img1']; ?>" alt="" class="icon-shape icon-md"></a>
                        </td>
                        <td><a href="#" class="text-reset"><?php echo $row['p_title']; ?></a></td>
                        <td><?php echo $row['cat_name']; ?></td>

                        <td>
                          <span class="<?php echo $class; ?>"><?php echo $row['stock']; ?></span>
                        </td>
                        <td>$<?php echo $row['p_price']; ?></td>
                        <td>$<?php echo $row['re_price']; ?></td>

                        <td>
                          <div class="dropdown">
                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="feather-icon icon-more-vertical fs-5"></i>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-3"></i>Delete</a></li>
                              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square me-3 "></i>Edit</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                  <?php

                    }
                  }
                  ?>
                </tbody>
              </table>

            </div>
          </div>

          <?php 

          // Pagination Query 
          
          $page_query = "SELECT * FROM `products`";
                $page_result = mysqli_query($conn, $page_query);
                $total_records = mysqli_num_rows($page_result);
          
                
                $total_pages = ceil($total_records / $num_per_page);
          ?>



          <div class=" border-top d-md-flex justify-content-between align-items-center px-6 py-6">
            <span>Showing <?php echo $page ?> to <?php echo ($page+$num_per_page)-1 ?> of <?php echo $total_records;?> entries</span>
            <nav class="mt-2 mt-md-0">
              <ul class="pagination mb-0 ">
                <?php
                if($num_per_page > $total_pages+2){
                  $disable =  "disabled";
                }else{
                  $disable =  "";

                }
              
                if($page>1){
                  echo "<li class='page-item '><a href='products.php?page=".($page-1)."' class='page-link'>Previous</a></li>";
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                  if($i == $page){
                    $active ="active";
                  }else{
                    $active ="";
                  }
                
                ?>
              
                <li class="page-item <?php echo $active;?>"><a class="page-link" href="products.php?page=<?php echo $i?>"><?php echo $i?></a></li>
               

                <?php 
                }
                 if($i>$page){
                  echo "<li class='page-item $disable'><a href='products.php?page=".($page+1)."' class='page-link'>Next</a></li>";
                }
                
              
               
            
                ?>
              </ul>
            </nav>
          </div>
        </div>

      </div>

    </div>
  </div>
</main>
<?php
include 'footer.php';
?>