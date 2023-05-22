<?php 
include 'header.php';
include 'config.php';

if(isset($_POST['add'])){
    $name = $_POST['categoryName'];
    $image = $_FILES['image']['name'];
    $status = $_POST['status'];

    $query = "INSERT INTO `category` ( `cat_name`, `cat_img`, `cat_status`) VALUES ('$name', '$image', '$status') ";
    $result = mysqli_query($conn, $query);
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
                                    <h2>Add New Category</h2>
                                       <!-- breacrumb -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Categories</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <a href="categories.php" class="btn btn-light">Back to Categories</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-lg-12 col-12">
                            <!-- card -->
                            <div class="card mb-6 shadow border-0">
                                <!-- card body -->
                                <div class="card-body p-6 ">
                                    <h4 class="mb-5 h5">Category Image</h4>
                                    <div class="mb-4 d-flex">
                                        <div class="position-relative" >
                                            <img class="image  icon-shape icon-xxxl bg-light rounded-4" src="../assets/images/icons/bakery.svg" alt="Image">

                                            <div class="file-upload position-absolute end-0 top-0 mt-n2 me-n1">
                                                <input type="file" class="file-input" name='image'>
                                                <span class="icon-shape icon-sm rounded-circle bg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-fill text-muted" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                  </svg>
                                                </span>
                                              </div>
                                        </div>



                                    </div>
                                    <h4 class="mb-4 h5 mt-5">Category Information</h4>

                                    <div class="row">
                                        <!-- input -->
                                        <div class="mb-3 col-lg-6">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" class="form-control" placeholder="Category Name"
                                                required name='categoryName'>
                                        </div>
                                        
                                    

                                        <div>

                                        </div>
                                      

                                        <!-- input -->
                                        <div class="mb-3 col-lg-12 ">
                                            <label class="form-label" id="productSKU">Status</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inlineRadio1" value="Published" checked>
                                                <label class="form-check-label" for="inlineRadio1">Publish</label>
                                            </div>
                                            <!-- input -->
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inlineRadio2" value="Unpublished" >
                                                <label class="form-check-label" for="inlineRadio2">Unpublish</label>
                                            </div>
                                            <!-- input -->

                                        </div>
                                       
                                        <div class="col-lg-12">
                                            <input type="submit" value="Create Product" class='btn btn-primary' name='add'>
                                            <!-- <a href="#" class="">
                                                Create Product
                                              </a> -->
                                              <a href="#" class="btn btn-secondary ms-2">
                                                Save
                                              </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        </form>
                    </div>
                </div>
            </main>


            <?php include 'footer.php';?>