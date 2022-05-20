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
           <li class="breadcrumb-item"><a href="javascript:window.history.back();"> BACK</a></li>
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
            $qtype="WORKED_EXAMPLES";
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
          echo "<div class='alert alert-info'>".$q-> update($question,$option_1,$option_2,$option_3,$option_4,$correct_answer,$quiz_id,$correct_answer,$created_by,$qtype)."</div>";
        }else{
          echo "<div class='alert alert-info'>".$q-> create($question,$option_1,$option_2,$option_3,$option_4,$correct_answer,$quiz_id,$correct_answer,$created_by,$qtype)."</div>";
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
              echo "<li>".$tot[$i]['question']."<a href='addhw.php?edit=".$tot[$i]['question_id']."&id=".$quiz_id."'> <i class='fa fa-edit'></i> Edit</a><p>
              ANSWER: <span style='color:red;'>REQUIRES FILE UPLOADED FILES WITH ANSWER FROM THE STUDENT</span></li>";
            }
             ?>
          </ol>

          <ul class="pagination">
          	<li><a href="#">NEXT</a></li>
          	
          	<li><a href="#">Previous</a></li>
          </ul>
          
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