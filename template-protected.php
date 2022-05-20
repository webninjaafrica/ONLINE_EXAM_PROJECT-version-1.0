<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="admin"){

$created_by=$username;
 include_once("autoload.php");
$id="";
if (isset($_GET['id'])) {
  $id=$_GET['id'];
}

 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Questions</h1>
          <p>Create New Quiz</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">New Quiz</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">




</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>