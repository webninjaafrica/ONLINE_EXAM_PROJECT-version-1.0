<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="teacher"){

$created_by=$username;
 include_once("autoload.php");
$id="";
if (isset($_GET['id'])) {
  $id=$_GET['id'];
}
$quiz_id=$id;
$qs=new question("");
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Questions</h1>
          <p>Create New Exam</p>
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
              


              <div class="container-fluid">
  <div class="row" style="margin-top:11px;">
    <div class="col-sm-5 col-md-5 col-xs-5 col-lg-5">
      
      <form method="POST" class="form" action="<?php if (isset($_GET['id']) && isset($_GET['edit'])) { echo '?id='.$_GET['id'].'&edit='.$_GET['edit']; }
      if (isset($_GET['id']) && !isset($_GET['edit'])) { echo '?id='.$_GET['id']; } ?>">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <i class="fa fa-info-circle"></i>
               QUESTION INFO.
          </div>
          <div class="panel-body">
            <?php
            $question=$option_1=$option_2=$option_3=$option_4=$correct_answer="";
            if (isset($_GET['id']) && isset($_GET['edit'])) {
              $question_id=$_GET['edit'];
              $q=new question($question_id);
              $de=$q->question_details_by_id;
              extract($de);
              $correct_answer="<option value='".$correct_answer."'>".$correct_answer."</option>";
            }
      if (isset($_POST['go'])) {
        extract($_POST);
        $q=new question('');
        
        if (isset($_GET['id']) && isset($_GET['edit'])) {
          $quiz_id=$_GET['id'];
          $question_id=$_GET['edit'];
          $q=new question($question_id);
          echo "<div class='alert alert-info'>".$q-> update($question,$option_1,$option_2,$option_3,$option_4,$correct_answer,$quiz_id,$created_by)."</div>";
        }else{
          echo "<div class='alert alert-info'>".$q-> create($question,$option_1,$option_2,$option_3,$option_4,$correct_answer,$quiz_id,$created_by)."</div>";
        }

        $question=$option_1=$option_2=$option_3=$option_4=$correct_answer="";
      }
       ?>
        <div class="row form-group">
          <div class="col-12 col-sm-3">
            Question
          </div>
          <div class="col-12 col-sm-9">
            <textarea name="question" class="form-control" required="required"><?php echo $question; ?></textarea>

          </div>
        </div>


        <div class="row form-group">
          <div class="col-12 col-sm-3">
          A.
          </div>
          <div class="col-12 col-sm-9">
            <textarea id="A" name="option_1" class="form-control" required="required"><?php echo $option_1; ?></textarea>
            <input type="hidden" id="hidden" name="correct_answer">
          </div>
        </div>

        <div class="row form-group">
          <div class="col-12 col-sm-3">
            B.
          </div>
          <div class="col-12 col-sm-9">
            <textarea id="B" name="option_2" class="form-control" required="required"><?php echo $option_2; ?></textarea>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-12 col-sm-3">
            C.
          </div>
          <div class="col-12 col-sm-9">
            <textarea id="C" name="option_3" class="form-control" required="required"><?php echo $option_3; ?></textarea>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-12 col-sm-3">
            D.
          </div>
          <div class="col-12 col-sm-9">
            <textarea id="D" name="option_4" class="form-control" required="required"><?php echo $option_4; ?></textarea>
          </div>
        </div>


        <div class="row form-group">
          <div class="col-12 col-sm-3">
            Correct Answer
          </div>
          <div class="col-12 col-sm-9">
            <select id="sel" name="answer" class="form-control" required="required"  onchange="selc();" >
              <?php echo $correct_answer; ?>
              <option>Choose</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
            </select>
          </div>
        </div>



        <div class="row form-group">
          <div class="col-12 col-sm-12">
            
          </div>
        </div>

        </div>

        <div class="panel-footer">
          <button type="submit" name="go" class="btn btn-primary">
              <i class="fa fa-save"></i> SAVE
            </button>
        </div>
      </div>




      </form>

    </div>
    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
      <div class="panel panel-primary">
        <div class="panel-heading">Questions</div>
        <div class="panel-body">
          <form method="POST">
            
          <ol>
            <style type="text/css">
              ol ol{
                list-style: upper-alpha;
              }
            </style>
            <?php
            $tot=$qs->listQuestions($quiz_id);
            for ($i=0; $i < count($tot); $i++) { 
              echo "<li>".$tot[$i]['question']."<a href='new-question.php?edit=".$tot[$i]['question_id']."&id=".$_GET['id']."'> <i class='fa fa-edit'></i> Edit</a>
              <ol class=''>
              <li class=''><input type='radio' name='".$tot[$i]['question_id']."'  value='".$tot[$i]['option_1']."' checked>&nbsp;&nbsp;".$tot[$i]['option_1']."  </li>
              <li class=''><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_2']."' >&nbsp;&nbsp;".$tot[$i]['option_2']."</li>
              <li class=''><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_3']."' >&nbsp;&nbsp;".$tot[$i]['option_3']."</li>
              <li class=''><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_4']."' >&nbsp;&nbsp;".$tot[$i]['option_4']."</li>
              </ol>
              ANSWER: <span style='color:red;'>".$tot[$i]['answer']."</span></li>";
            }
             ?>
          </ol>
          
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row"></div>
  <div class="row"></div>
</div>



            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        function selc(){
         var d= document.querySelector("#sel");
          var selc=d.options[d.options.selectedIndex].value;
          var b=document.querySelector("#"+selc).value;
          document.querySelector("#hidden").value=b;
        }
      </script>
<?php } include_once("bottom.php"); ?>