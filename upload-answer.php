<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="student"){

$created_by=$username;
 include_once("autoload.php");
$id=$quiz_id="";
if (isset($_GET['id']) && isset($_GET['quiz_id'])) {
  $id=$_GET['id'];
   $quiz_id=$_GET['quiz_id'];
}

$question_id=$id;
$qz=new quiz($quiz_id);
$det=$qz->quiz_details_by_id;

 ?>
 <?php $qs=new question($question_id); $de=$qs->question_details_by_id;
  ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?php echo $det['quiz_name']; ?> EXAM</h1>
          <p>H/W</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
           <li class="breadcrumb-item"><a href="javascript:window.history.back();"> BACK</a></li>
          <li class="breadcrumb-item"><a href="#">Answering h/w</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">

              <div class="row">
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                  <?php if (isset($_POST['go'])) {
                    extract($_POST);
                    $path=$error="";
                    if (isset($_FILES['filex']['tmp_name'])) {
                     $ext=array('jpg','JPG','png','PNG','doc','docx','pfd','PDF','xlsx','xls');
                     $pinf=pathinfo($_FILES['filex']['name'],PATHINFO_EXTENSION);
                     if (in_array($pinf, $ext)) {
                      $var=md5(mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9));
                       $path="uploads/".$var.".".$pinf;
                       if (move_uploaded_file($_FILES['filex']['tmp_name'], $path)) {
                         $error.=" file uploaded ";
                       }
                     }
                    }


                    if (empty($path) && empty($typeanswer)) {
                     echo "<div class='alert alert-danger'>Failes/ Please type or upload the necessary file to answer this question.</div>";
                    }else{
                      $a=new answer();
                      $score="NOT_MARKED";
                      echo "<div class='alert alert-info'>".$a->create($question_id,$username,$typeanswer,$score,$path,$quiz_id)."</div>
                      <script>setTimeout(function(){
                        window.location.href='my-hw.php?quiz_id='+".$quiz_id.";
                      },600);</script>";
                    }
                  } ?>

                  
                  <h5><?php echo $de['question']; ?></h6>
                </div>
                <div class="col-sm-5 col-md-5 col-xs-5 col-lg-5">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <b>Type Answer (optional)</b><br>
                      <textarea name="typeanswer" class="form-control" rows="5" cols="6"></textarea>
                    </div>
                    <div class="form-group">
                      <b>Select File: ( only .doc, .docs, .png, .jpg, .pdf, .xls, .xlsx Formats are allowed.)</b><p>
                        <input type="file" name="filex"><p>
                          <button name="go" class="btn btn-info"><i class="fa fa-upload"></i> Upload Document</button>
                    </div>
                  </form>
                </div>
              </div>



</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>