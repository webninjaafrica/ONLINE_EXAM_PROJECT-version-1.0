<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="teacher"){

$created_by=$username;
 include_once("autoload.php");
$id=$user="";
if (isset($_GET['quiz_id']) && isset($_GET['user'])) {
  $quiz_id=$_GET['quiz_id'];
  $user=$_GET['user'];
}
$qw=new quiz($quiz_id);
$det=$qw->quiz_details_by_id;

$log=new login($user);
$udet=$log->details;
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?php echo $det['quiz_name']; ?></h1>
          <p><?php $sb=new subject($det['subjectc']); $t=$sb->subject_details; echo $t['subjectc']." (".$t['categoryc'].")";  ?></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">New Quiz</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="tile">
            <div class="tile-body">
              <h3>Exam Answers for <?php echo $udet['first_name']; ?></h3><p>
                <form method="POST">

                  <?php if (isset($_POST['go'])) {
                    extract($_POST);
                    for ($i=0; $i <count($mark) ; $i++) { 
                      $anv=new answer("");
                    $anv->updateMarks($user,$quiz_id,$question_id[$i],$mark[$i]);
                      
                    }
                    
                    $p=new performance();
                    $p->create($quiz_id,$username,array_sum($mark));
              $notification=new notification();
    $message="Your Examination was completed <br>-successifully and we have marked it. <br>We are happy to inform you that You scored <b>".array_sum($mark)." [marks] </b>on the exam.<p>Regards,<br><i>Exams Team.</i>";
    $q=new quiz($quiz_id);
    $rt=$q->quiz_details_by_id;
    $title="CONGRATULATIONS!! YOU COMPLETED ".$rt['quiz_name']." TEST";
    $receiver=$user;
    $notification->send($receiver,$title,$message,"EXAMS TEAM");
              echo "<div class='alert alert-info'>You Scored: ".array_sum($mark)."</div>";
                  } ?>



                  <ol>
                  <?php $ans=new answer("");
                  $r=$ans->listAnswers($user,$quiz_id); 
                  #echo $ans->performance_exists;
                  for ($i=0; $i <count($r); $i++) { 
                    $qs=new question($r[$i]["question_id"]); $de=$qs->question_details_by_id;
                    $question_type=$de["qtype"];
                    $diagt="";
                    if ($question_type=="WORKED_EXAMPLES") {
                      $docs=!empty($r[$i]['files']) ? "<p> ATTACHMENTS: <br><a href='".$r[$i]['files']."'> <i class='fa fa-download'></i> Download File</a>": " NO ANSWER";

                      $diagt="<li><div class='thumbnail'>
                     STUDENT ANSWER:: <b> ".$r[$i]['typed_answer']."</b><p>
                      ".$docs."
                      </div></li>";
                    }else{
                      $diagt="STUDENT ANSWER: <b>".
                      $r[$i]['answer']."</b><p>";

                    }
                     ?>
                     <li><a href="#"><h4><?php echo $de["question"]; ?></h4> </a>
                      <ul style="list-style-type: none;">
                        
                          <?php echo $diagt; ?>
                       
                        
                        <li class="mark">
                          <input type="number" name="mark[]" required="required" placeholder="Enter Score for this answer"><input type="hidden" name="question_id[]" value="<?php echo $de['question_id']; ?>">
                        </li>
                      </ul></li>


                     <?php } ?>
                   </0l>
                  <div class="form-group">
                    <button type="submit" name="go" class="btn btn-primary">
                      <i class="fa fa-save"></i> SUMBMIT MARKS
                    </button>
                  </div>
                </form>




</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="tile">
            <div class="tile-body">
              <h4>Student Details:</h4><hr><p>
                <div class="thumbnail">
                      <img src="<?php echo $udet['picture']; ?>" class="img-responsive img-rounded" style="height: 64px;width: 63px;">
                      <div class="caption">
                         <h6> Full Names: <?php echo $udet['first_name']." ".$udet['other_names']." ".$udet['last_name']; ?></h6><p>
                  <h6>Class: <?php echo $udet['classf'] ?></h6><p>
                    <h6>Email: <?php echo  $udet['email']; ?></h6><p>
                    <h6>Tel: <?php echo $udet['tel']; ?></h6><p>
                      <h6>County <?php echo $udet['county']; ?></h6><p>
                    <h6> <?php  ?></h6><p>
                      </div>
                    </div>
               

                    




</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>