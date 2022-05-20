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
$quiz_id=$id;
$qs=new question("");
$qz=new quiz($quiz_id);
$data=$qz->quiz_details_by_id;
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-table"></i>   <?php echo ucwords($data['quiz_name']." ".$data['category_id']); ?> TIME-LAPSED:: <span id="time" style="color:Tomato;font-weight: bold;font-family: Helvetica;">[EXAM]</span></h1>
          <p>My Quiz</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">New Quiz</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          

          <div class="tile">
            <div class="tile-body">

              
              <button style="margin-top: 14px; margin-bottom: 24px;" class="btn btn-info btn-sm" onclick="popp();">OR LOGIN TO A DIFFERENT EXAM</button>
              <form method="POST">
            <?php
            $conf=new performance($quiz_id,$username);
            $rows=$conf->performance_exists;
            if ($rows <1 && !empty($quiz_id)) {
              
            $p=new performance();
            $correct=array();
             if (isset($_POST['gpo'])) {
              foreach ($_POST as $key => $value) {
                $question=$key; $answer=$value;
                if ($key!=="gpo") {
                  
                $qu=new question($question);
                $an=$qu->question_details_by_id;
                if ($an['correct_answer']==$answer) {
                  $score="1";
                  array_push($correct, $score);
                }else{
                  $score="0";
                  array_push($correct, $score);
                }
                $ans=new answer();
                $ans->create($question,$username,$answer,$score);


              }

              }
              $p->create($quiz_id,$username,array_sum($correct));
              $notification=new notification();
    $message="Your Examination was completed <br>-successifully and we have marked it. <br>We are happy to inform you that You scored <b>".array_sum($correct)." [marks] </b>on the exam.<p>Regards,<br><i>Exams Team.</i>";
    $q=new quiz($quiz_id);
    $rt=$q->quiz_details_by_id;
    $title="CONGRATULATIONS!! YOU COMPLETED ".$rt['quiz_name']." TEST";
    $receiver=$username;
    $notification->send($receiver,$title,$message,"EXAMS TEAM");
              echo "<div class='alert alert-info'>You Scored: ".array_sum($correct)."</div>";
              
            } } ?>
          <ol>
            <style type="text/css">
              ol ol{
                list-style: upper-alpha;
              }
            </style>
            <?php
            $tot=$qs->listQuestions($quiz_id);
            for ($i=0; $i < count($tot); $i++) { 
              echo "<li>".$tot[$i]['question']."
              <ol class=''>
              <li class=''><input type='radio' name='".$tot[$i]['question_id']."'  value='".$tot[$i]['option_1']."' checked>&nbsp;&nbsp;".$tot[$i]['option_1']."  </li>
              <li class=''><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_2']."' >&nbsp;&nbsp;".$tot[$i]['option_2']."</li>
              <li class=''><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_3']."' >&nbsp;&nbsp;".$tot[$i]['option_3']."</li>
              <li class=''><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_4']."' >&nbsp;&nbsp;".$tot[$i]['option_4']."</li>
              </ol>
              </li>";
            }
             ?>
          </ol>
          <button type="submit" name="gpo">SUBMIT</button>
        </form>


</div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        function gTime(){
          var c=document.querySelector("#time");
          var d=new Date();
          var hrs=d.getHours();
          var min=d.getMinutes();
          var ms=d.getSeconds();
          var str=hrs+":"+min+":"+ms;
          c.innerHTML=str;
          setTimeout(gTime,300);
        }
        window.onload=gTime();
      </script>
<?php } include_once("bottom.php"); ?>