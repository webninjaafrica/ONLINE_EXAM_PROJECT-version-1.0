<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="admin"){
if (isset($_GET['activate'])) {
  $act=$_GET['activate'];
  $login=new login($act);
  $login->activate($act);
  echo "<script>
  alert('Account has been activated!');
  window.location.href='teachers.php';</script>";
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
          <h1><i class="fa fa-users"></i> Teachers</h1>
          <p>/</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-users fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">All Teachers</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">

              <div class="btn-group" style="margin-bottom: 28px;">
                <a href="teachers.php" class="btn btn-primary"><b class="fa fa-refresh"></b> Refresh List</a>

                <a href="add-teacher.php" class="btn btn-info"><b class="fa fa-user"></b> <b class="fa fa-plus"></b> New Teacher</a>
              </div>

               <table id="sampleTable" style="width: 100%;border-collapse: collapse;" border="0" cellpadding="3" class="table-striped">
                <thead>
                  <tr class="bg-info"><th>S/No.</th> <th>NAMES</th> <th>TEL</th>
                    <th>USERNAME</th> <th>Last Login</th> <th>ACTIVE</th>
                    <!--<th>Update Info</th>--></tr>
                </thead>
                <tbody>
                  <?php $l=new login(""); $data=$l->showusers("teacher");

                  for ($i=0; $i <count($data) ; $i++) { 
                    $k=$data[$i]['status'];
                    if ($k=="NO") {
                       $k="<a href='?activate=".$data[$i]['email']."' class='btn btn-info'><i class='fa fa-lock-open'></i> ACTIVATE</a>";
                     } ?>
                    <tr> <td><?php echo $data[$i]['id']; ?></td> 
                      <td><?php echo $data[$i]['names']; ?></td>
                      <td><?php echo $data[$i]['tel']; ?></td>
                      <td><?php echo $data[$i]['email']; ?></td>
                       <td><?php echo $data[$i]['last_login']; ?></td>
                       <td><?php echo $k; ?></td>

                       <!--<td><?php echo "<a href='add-teacher.php?edit=".$data[$i]['id']."' class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>"; ?></td> -->

                    </tr>

                  <?php } ?>
                </tbody>
              </table>


</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>