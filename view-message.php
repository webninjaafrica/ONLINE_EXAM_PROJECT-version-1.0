<?php
include_once("top.php");
include_once("includes/autoload.php");
$id="";
if (isset($_GET['id'])) {
  $id=$_GET['id'];
}
$n=new notification($id);
$de=$n->details;
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-envelope-o"></i> <?php echo $de['title'] ?></h1>
          <p>From: <?php echo $de['sender']; ?></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-inbox fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="notifications.php">INBOX</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body"><?php echo $de['message'];
            $n->read(); ?></div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>