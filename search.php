<?php
include_once("top.php");
include_once("includes/autoload.php");
$res=$type=$results="---";
if (isset($_GET['q']) && isset($_GET['type'])) {
  $res=$_GET['q'];
  $type=$_GET['type'];
}
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-search"></i> "<?php echo $res; ?>" in <?php echo $type; ?></h1>
          <p>Search Results:</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#"> Search Results</a></li>
          <li class="breadcrumb-item"><a href="#"><i class="fa fa-folder-open-o"></i> <?php echo $type; ?></a></li>
          <li class="breadcrumb-item"><a href="#"><i class="fa fa-search"></i> <?php echo $res; ?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body"><?php echo $results;; ?></div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>