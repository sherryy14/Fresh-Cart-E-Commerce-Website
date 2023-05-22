<?php 
include 'header.php';
include 'config.php';

$catQuery = "SELECT * FROM `category`";
$catResult = mysqli_query($conn,$catQuery);

if(isset($_POST['add'])){
  $title = $_POST['title'];
  $category = $_POST['category'];
  $code = $_POST['code'];
  $rePrice = $_POST['re_price'];
  $price = $_POST['price'];
  

 $img1 = $_FILES['file1']['name'];
 $img2 = $_FILES['file2']['name'];
 $img3 = $_FILES['file3']['name'];
 $img4 = $_FILES['file4']['name'];

  if(isset($_POST['stock']) == "on")
  {

    $stock = "In stock";

  }
  else{
    $stock = "Out of stock";

  }

  $productQuery = "INSERT INTO `products` ( `p_title`, `p_category`, `img1`, `img2`, `img3`, `img4`, `p_price`, `p_code`, `re_price`, `stock`) VALUES ( '".$title."', '".$category."', '".$img1."', '".$img2."', '".$img3."', '".$img4."', '".$price."', '".$code."', '".$rePrice."', '".$stock."')";

  $productresult = mysqli_query($conn, $productQuery);



}
?>

    <!-- main -->
    <main class="main-content-wrapper">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row mb-8">
          <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
              <!-- page header -->
              <div>
                <h2>Add New Product</h2>
                  <!-- breacrumb -->
                  <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                  </ol>
                </nav>
              </div>
              <!-- button -->
              <div>
                <a href="products.php" class="btn btn-light">Back to Product</a>
              </div>
            </div>

          </div>
        </div>
        <!-- row -->
        <form method="post" enctype="multipart/form-data">
        <div class="row">

          <div class="col-lg-8 col-12">
            <!-- card -->
            <div class="card mb-6 card-lg">
              <!-- card body -->
              <div class="card-body p-6 ">
                <h4 class="mb-4 h5">Product Information</h4>
                <div class="row">
                  <!-- input -->
                  <div class="mb-3 col-lg-6">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name='title' placeholder="Product Name" required>
                  </div>
                  <!-- input -->
                  <div class="mb-3 col-lg-6">
                    <label class="form-label">Product Category</label>
                    <select class="form-select" name='category'>
                      <option disabled selected>Product Category</option>
                    <?php 
                    while($cat = mysqli_fetch_assoc($catResult)){

                      ?>
                      <option value="<?php echo $cat['cat_id']?>"> <?php echo $cat['cat_name']?> </option>
                      <?php }?>
                    </select>
                  </div>
           
                  <div>
                    <div class="mb-3 col-lg-12 mt-5">
                      <!-- heading -->
                      <h4 class="mb-3 h5">Product Images</h4>

                      <!-- input -->
                  
                        <div class="fallback">
                          <input name="file1" type="file">
                          <input name="file2" type="file" >
                          <br>
                          <br>
                          <input name="file3" type="file" >
                          <input name="file4" type="file" >
                        </div>
                  
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-4 col-12">
            <!-- card -->
            <div class="card mb-6 card-lg">
              <!-- card body -->
              <div class="card-body p-6">
                <!-- input -->  
                <div class="form-check form-switch mb-4">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchStock"  name='stock'>
                  <label class="form-check-label" for="flexSwitchStock">In Stock</label>
                </div>
                <!-- input -->
                <div>
                  <div class="mb-3">
                    <label class="form-label">Product Code</label>
                    <input type="text" class="form-control" name='code' placeholder="Enter Product Code">
                  </div>
                
                

                </div>
              </div>
            </div>
            <!-- card -->
            <div class="card mb-6 card-lg">
              <!-- card body -->
              <div class="card-body p-6">
                <h4 class="mb-4 h5">Product Price</h4>
                <!-- input -->
                <div class="mb-3">
                  <label class="form-label">Regular Price</label>
                  <input type="text" class="form-control" placeholder="$0.00" name='re_price'>
                </div>
                <!-- input -->
                <div class="mb-3">
                  <label class="form-label">Sale Price</label>
                  <input type="text" class="form-control" placeholder="$0.00" name='price'>
                </div>

              </div>
            </div>
          
            <div class="d-grid">
              <input type="submit" value="Create Product" class='btn btn-primary' name='add'>
            </div>
          </div>

        </div>
      </div>
      </form>
    </main>
     
    <?php 
include 'footer.php';
?>