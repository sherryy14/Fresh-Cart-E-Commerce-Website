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


// Fetch Category 
$query = "SELECT *, count(p_id) as cat_count FROM category AS c left join products as p on c.cat_id = p.p_id GROUP BY cat_name order by cat_status LIMIT $start_from, $num_per_page";

$result = mysqli_query($conn, $query);



?>


<!-- main -->
<main class="main-content-wrapper">
  <div class="container">
    <!-- row -->
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="d-md-flex justify-content-between align-items-center">
          <!-- pageheader -->
          <div>
            <h2>Categories</h2>
            <!-- breacrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
              </ol>
            </nav>
          </div>
          <!-- button -->
          <div>
            <a href="add-category.php" class="btn btn-primary">Add New Category</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row ">
      <div class="col-xl-12 col-12 mb-5">
        <!-- card -->
        <div class="card h-100 card-lg">
          <div class=" px-6 py-6 ">
            <div class="row justify-content-between">
              <div class="col-lg-4 col-md-6 col-12 mb-2 mb-md-0">
                <!-- form -->
                <form class="d-flex" role="search" method='post'>
                  <input class="form-control" type="search" placeholder="Search Category" aria-label="Search">
                </form>
              </div>
              <!-- select option -->
              <div class="col-xl-2 col-md-4 col-12">
                <select class="form-select" name='status'>
                  <option disabled selected>Status</option>
                  <option value="Published">Published</option>
                  <option value="Unpublished">Unpublished</option>
                </select>
              </div>
            </div>
          </div>
          <!-- card body -->
          <div class="card-body p-0">
            <!-- table -->
            <div class="table-responsive ">
              <table class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                <thead class="bg-light">
                  <tr>
                    <th>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                        <label class="form-check-label" for="checkAll">

                        </label>
                      </div>
                    </th>
                    <th>Icon</th>
                    <th> Name</th>
                    <th>Proudct</th>
                    <th>Status</th>

                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {

                      if ($row['cat_status'] == "Published") {
                        $class = "badge bg-light-primary text-dark-primary";
                      } else {
                        $class = "badge bg-light-danger text-dark-danger";
                      }

                  ?>

                      <tr>

                        <td>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="categoryOne">
                            <label class="form-check-label" for="categoryOne">

                            </label>
                          </div>
                        </td>
                        <td>
                          <a href="#!"> <img src="../assets/images/icons/<?php echo $row['cat_img']; ?>" alt="<?php echo $row['cat_name']; ?>" class="icon-shape icon-sm"></a>
                        </td>
                        <td><a href="#" class="text-reset"><?php echo $row['cat_name']; ?></a></td>

                        <td><?php echo $row['cat_count']; ?></td>

                        <td>
                          <span class="<?php echo @$class; ?>"><?php echo $row['cat_status']; ?></span>
                        </td>

                        <td>
                          <div class="dropdown">
                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="feather-icon icon-more-vertical fs-5"></i>
                            </a>
                            <ul class="dropdown-menu">

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
          <div class="border-top d-md-flex justify-content-between align-items-center  px-6 py-6">
            <span>Showing 1 to 8 of 12 entries</span>
            <nav class="mt-2 mt-md-0">
              <ul class="pagination mb-0 ">
                  <?php 
                   if($page>1){
                   
                  
                  ?>

              <li class="page-item"><a class="page-link " href="categories.php?page=<?php echo $page-1; ?>">Previous</a></li>
                <?php
                   }
                // Pagination Query 

                $page_query = "SELECT * FROM `category`";
                $page_result = mysqli_query($conn, $page_query);
                $total_records = mysqli_num_rows($page_result);


                $total_pages = ceil($total_records / $num_per_page);

                for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $page) {
                    $active = "active";
                  } else {
                    $active = "";
                  }

                  ?>
                  
                  <li class="page-item <?php echo $active; ?>"><a class="page-link" href="categories.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>


            
                  
                  
                  <?php } 
                  if($i>$page){
                  
                  
                  
                  ?>
                  <li class="page-item"><a class="page-link" href="categories.php?page=<?php echo $page+1;?>">Next</a></li>

                  <?php }?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>