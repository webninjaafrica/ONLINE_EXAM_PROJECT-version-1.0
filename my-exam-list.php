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
          <h1><i class="fa fa-briefcase"></i> My Exams</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">My Exams</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <?php $nq=new quiz("");
              $sd=$nq->listEWork($class,$username);

               ?>
              <div class="table-responsive"><table id="sampleTable" class="table table-bordered">
                <thead>
                  <tr style="background: black;color: white;">
                    <th>Serial No</th>
                    <th>Due Date</th>
                    <th>Subject</th>
                    <th>Title</th>
                   
                    <th>My Submission Status</th>
                    <th>Score</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php for ($i=0; $i < count($sd) ; $i++) {
                  $sb="NOT SUBMITTED"; $score="<a href='my-quiz.php?id=".$sd[$i]["id"]."'> DO EXAM</a>"; 
                  $ans=new performance($sd[$i]["id"],$username);
                  $rws=$ans->performance_exists;
                  $det=$ans->performance_details;
                  if ($rws >0) {
                    $sb="REVIEWED BY TEACHER &check;";
                    $score=$det['total_score'];
                  }
                   ?>

                    <tr>
                      <td><?php echo $sd[$i]["id"]; ?></td>
                      <td><?php echo $sd[$i]["deadline"]; ?></td>
                      <td><?php echo $sd[$i]["subject"]; ?></td>
                      <td><?php echo $sd[$i]["name"]; ?></td>
                      <td><?php echo $sb; ?></td>
                      <td><?php echo $score; ?></td>
                      <td><a href="my-hw.php?quiz_id=<?php echo $sd[$i]["id"]; ?>"> More Details..</a></td>
                    </tr>

                  <?php } ?>
                </tbody>
                
              </table></div>




</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>