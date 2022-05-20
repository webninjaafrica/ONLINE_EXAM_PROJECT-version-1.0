<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="teacher"){
if (isset($_GET['activate'])) {
  $act=$_GET['activate'];
  $login=new login($act);
  $login->activate($act);
  echo "<script>
  alert('Account has been activated!');
  window.location.href='students.php';</script>";
}
$created_by=$username;
 include_once("autoload.php");
$id="";
if (isset($_GET['id'])) {
  $id=$_GET['id'];
}

 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-graduation-cap"></i> My Students</h1>
          <p>Student Accounts</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">My Students</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">

              <table id="sampleTable" style="width: 100%;border-collapse: collapse;" border="0" cellpadding="3" class="table-striped">
                <thead>
                  <tr class="bg-success"><th>S/No.</th> <th>NAMES</th> <th>CLASS</th> <th>TEL</th>
                    <th>USERNAME</th> <th>Last Login</th> <th>ACTIVE</th></tr>
                </thead>
                <tbody>
                  <?php $l=new login(""); $data=$l->showusers("student",$username);

                  for ($i=0; $i <count($data) ; $i++) { 
                    $k=$data[$i]['status'];
                    if ($k=="NO") {
                       $k="<a href='?activate=".$data[$i]['email']."' class='btn btn-info'><i class='fa fa-lock-open'></i> ACTIVATE</a>";
                     } ?>
                    <tr> <td><?php echo $data[$i]['id']; ?></td> 
                      <td><?php echo $data[$i]['names']; ?></td>
                      <td><?php echo $data[$i]['class']; ?></td>
                      <td><?php echo $data[$i]['tel']; ?></td>
                      <td><?php echo $data[$i]['email']; ?></td>
                       <td><?php echo $data[$i]['last_login']; ?></td>
                       <td><?php echo $k; ?></td>
                    </tr>

                  <?php } ?>
                </tbody>
              </table>


</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>