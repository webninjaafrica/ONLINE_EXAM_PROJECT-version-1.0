<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="teacher"){

$created_by=$username;
 include_once("autoload.php");
$quiz_id="";
if (isset($_GET['quiz_id'])) {
  $quiz_id=$_GET['quiz_id'];
}

 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-folder-open"></i> Submitted EXAMS</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Student work</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="col-md-4">
          <div class="tile">
            <div class="tile-body">
              <h3>Exams List</h3><hr><p>
                <ol class="list-group">
                <?php $qs=new quiz("");
                $k=$qs->listQuizTypesByType($username,"EXAM");
                for ($i=0; $i <count($k); $i++) { 
                   ?>

                   <li class="list-group-item">
                     <a href="?quiz_id=<?php echo $k[$i]['quiz_id'] ?>"><?php echo $k[$i]['quiz_name']." (".$k[$i]['class'].")"; ?></a>
                   </li>

              <?php } ?>
            </ol>




</div>
          </div>
        </div>


        <div class="col-md-8">
          <div class="tile">
            <div class="tile-body">

              <h3>STUDENTS</h3>

              <?php
              $qs=new quiz($quiz_id);
              $de=$qs->quiz_details_by_id;
              echo "<p>".$de['quiz_name']."</p><hr><p>";
              if ($qs->quiz_exists_by_id >0) {
                echo "<ol>";
               $as=new answer(""); $to=$as->listUserAnswers($quiz_id); 
               for ($i=0; $i <count($to) ; $i++) {
               $log=new login($to[$i]['user_id']); $df=$log->details;
        $names=$df["first_name"]." ".$df['other_names']." ".$df['last_name']." (".$df['classf'].")"; ?>              
                 <li><a href="mark-answers.php?quiz_id=<?php echo $quiz_id; ?>&user=<?php echo $to[$i]['user_id']; ?>">
                   <?php echo $names; ?>
                 </a> &nbsp;&nbsp; <a href="mark-answers.php?quiz_id=<?php echo $quiz_id; ?>&user=<?php echo $to[$i]['user_id']; ?>"> MARK EXAM</a></li>
               



             <?php } echo "</ol>";  }else{ echo "<div class='alert alert-info'>Please select the exam type first to view the student list who did the work.</div>";} ?>



</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>