<?php
include_once("top.php");
include_once("includes/autoload.php");
if (isset($_GET['arc'])) {
  $n=new notification($_GET['arc']);
  $n->archive();
  #$n->read();
  echo "<script>window.location.href='notifications.php';</script>";
}
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-info-circle"></i> Notifications / <?php if (isset($_GET['archive'])) { echo "Archived/"; } ?></h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-bell fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Notification</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="btn-group" style="margin:2% auto;">
                <a href="notifications.php" class="btn btn-success"><i class="fa fa-inbox"></i>New <span id="notify"><?php $not=new notification("NO"); echo "(".$not->getCountAll($username,"NO").")"; ?></span></a>

                <a href="?archive" class="btn btn-danger"><i class="fa fa-archive"></i> Archived<?php $not=new notification("NO"); echo "(".$not->getCountAll($username,"YES").")"; ?></a>

                <a href="send-message.php" class="btn btn-info"><i class="fa fa-envelope"></i> COMPOSE MESSAGE</a>
              </div>
              <?php
              if (isset($_GET['archive'])) {
                $n=new notification($username); 
               echo $n->listThem($username,"YES");
              }else{
               $n=new notification($username); 
               echo $n->listThem($username,"NO");
              }
              
              ?>
            </div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>