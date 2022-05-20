<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="student"){

$created_by=$username;
 include_once("autoload.php");
$id="";
if (isset($_GET['id'])) {
  $id=$_GET['id'];
}

 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-briefcase"></i> My HomeWorks</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">My Home-works</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <?php $nq=new quiz("");
              $sd=$nq->listHomeWork($class,$username);

               ?>
              <div class="table-responsive"><table id="sampleTable" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Serial No</th>
                    <th>Due Date</th>
                    <th>Subject</th>
                    <th>Title</th>
                    <th>Attachments</th>
                    <th>My Submission Status</th>
                    <th>Score</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php for ($i=0; $i < count($sd) ; $i++) {
                  $sb="PENDING"; $score="NULL"; 
                  $ans=new performance($sd[$i]["id"],$username);
                  $rws=$ans->performance_exists;
                  $det=$ans->performance_details;
                  if ($rws >0) {
                    $sb="REVIEWED BY TEACHER &check;";
                    $score=$det['total_score'];
                  }
                   ?>

                    <tr>
                      <td>000<?php echo $sd[$i]["id"]; ?></td>
                      <td><?php echo $sd[$i]["deadline"]; ?></td>
                      <td><?php echo $sd[$i]["subject"]; ?></td>
                      <td><?php echo $sd[$i]["name"]; ?></td>
                      <td><?php echo !empty($sd[$i]["attachments"])? "<a href='".$sd[$i]["attachments"]."'><i class='fa fa-download'></i> Download</a>" : "NO ATTACHMENT"; ?></td>
                      <td><?php echo $sb; ?></td>
                      <td><?php echo $score; ?></td>
                      <td><?php if ($score=="NULL") { ?><a href="my-hw.php?quiz_id=<?php echo $sd[$i]["id"]; ?>"> DO HOMEWORK/<br> <i class="fa fa-edit"></i> EDIT MY WORK</a> <?php }else{ ?> ---<?php } ?></td>
                    </tr>

                  <?php } ?>
                </tbody>
                
              </table></div>




</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>