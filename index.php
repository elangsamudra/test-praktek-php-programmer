
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <!-- CSS only -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="alert alert alert-primary" role="alert">
  <h4 class="text-primary text-center">PHP CRUD Application </h4>
</div>
<div class="alert alert-success text-center message" role="alert">A New Item has been added successfully!</div>
<?php
include_once 'form.php';
include_once 'barang.php';
?>


<div class="row mb-3">
<div class="col-3">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal" id="addnewbtn">Add New <i class="bx bx-box" ></i></button>
</div>
<div class="col-9">
<div class="input-group input-group-lg">
<div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon2"><i class="bx bx-search" aria-hidden="true"></i></span>
  </div>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="Search..." id="searchinput">
  
</div>
</div>
</div>
<?php
include_once 'barangtable.php';
?>
<nav id="pagination">
    
</nav>
<input type="hidden" name="currentpage" id="currentpage" value="1">
</div>
<div>

<!-- JS, Popper.js, and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>

</div>
<div id="overlay" style="display:none;">
    <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
    <br/>
    Loading...
</div>
</body>
<script>
    $(document).ready(function(){
    $('#overlay').fadeIn().delay(2000).fadeOut();
    });
</script>
</html>