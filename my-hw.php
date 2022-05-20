<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="student"){

$created_by=$username;
 include_once("autoload.php");
$quiz_id="";
if (isset($_GET['quiz_id'])) {
  $quiz_id=$_GET['quiz_id'];
}
$qs=new quiz($quiz_id);
$det=$qs->quiz_details_by_id;
$qs=new question();
$arr=$qs->listQuestions($quiz_id);
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?php echo $det['quiz_name']; ?> /</h1>
          <p>My H/W</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="javascript:window.history.back();"> BACK</a></li>
          <li class="breadcrumb-item"><a href="#">My H/W</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="tile">
            <div class="tile-body">

              <ol>
              <?php 

              for ($i=0; $i <count($arr) ; $i++) { 
                echo "<li><a href='#'>
                  ".$arr[$i]['question']." </a>
                  <p> <a href='upload-answer.php?quiz_id=".$quiz_id."&id=".$arr[$i]['question_id']."' class='btn btn-info'> Upload Answer</a></li>";
              }



              ?>
            </ol>




</div>
          </div>
        </div>


         <div class="col-md-4">
          <div class="tile">
            <div class="tile-body">
              <h5>H/Work Details:</h5><p><hr>
                <?php echo "H/W Title: ".$det['quiz_name']."<p>"."Deadline: ".$det['deadline_date']."<p>"; ?>




</div>
          </div>
        </div>

      </div>
<?php } include_once("bottom.php"); ?>