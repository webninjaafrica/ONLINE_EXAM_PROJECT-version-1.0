<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="teacher"){
  $created_by=$username;
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-task"></i> HomeWork</h1>
          <p>/</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
           <li class="breadcrumb-item"><a href="javascript:window.history.back();"> BACK</a></li>
          <li class="breadcrumb-item"><a href="#">Student Homework (Teacher)</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="container-fluid">
  <div class="row">
    <div class="col-sm-5 col-md-5 col-xs-5 col-lg-5">
      <?php
      if (isset($_GET['remove'])) {
        $idv=$_GET['remove'];
        $lquiz=new quiz("");
        $lquiz->remove($idv);
        echo "<script>window.location.href='homework-types.php';</script>";

      }
      $category_id=$deadline_date=$quizname=$subjectc="";
      if (isset($_GET['edit'])) {
        $id=$_GET['edit'];
        $lquiz=new quiz($id);
        $de=$lquiz->quiz_details_by_id;
        echo $lquiz->quiz_exists_by_id;
        $deadline_date=$de['deadline_date'];
        $quizname=$de['quiz_name'];
        $category_id="<option value='".$de['category_id']."'>".$de['category_id']."</option>";
        $qq=new subject($de['subjectc'],$username);
      $p=$qq->subject_details;
        $subjectc="<option value='".$de['subjectc']."'>".$p['subjectc']."</option>";

      }
if (isset($_POST['go'])) {
  extract($_POST);
$error="b";
  $attachments="";
  $allowedfiles=array('jpg','JPG','png','PNG','doc','DOC','docx','pdf','xlsx','xls');
  if (isset($_FILES['attachment']['name'])) {
    $ext=pathinfo($_FILES['attachment']['name'],PATHINFO_EXTENSION);
    $num=sha1(mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9)).mt_rand(0,22)."_";
    $ef="uploads/assignments/".$num.".".$ext;

    if (in_array($ext, $allowedfiles)) {
      $error="b";
      $attachments=$ef;
    }else{
      $error="error";
    }

    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $attachments)) {
      $error='b';
    }else{
      $error="error";
    }

  }

  if ($error=="b") {
    
  if (isset($_GET['edit'])) {
    $quiz=new quiz($_GET['edit']);
    
    echo "<div>".$quiz->update($quizname,$deadline_date,$category_id,$subjectc,"HOMEWORK",$attachments)."</div>";
  }else{
    $quiz=new quiz($quizname);
  echo "<div>".$quiz->create($created_by,$deadline_date,$category_id,$subjectc,"HOMEWORK",$attachments)."</div>";
}

}else{
  echo "<div class='alert alert-danger'>File upload failed. The file format is not allowed. The only allowed file formarts are <b>".implode(",", $allowedfiles)."</b></div>";
}



} ?>
      <form method="POST" class="form" enctype="multipart/form-data" action="<?php if(isset($_GET['edit'])){ echo '?edit='.$_GET['edit']; } ?>">
        <div class="row form-group">
          <div class="col-12 col-sm-3">Class</div>
          <div class="col-12 col-sm-9">
            <select name="category_id" class="form-control" required="required">
              <?php echo $category_id; ?>
              <optgroup label="PRIMARY SCHOOL">
                <option value="Grade 1">Grade 1</option>
                <option value="Grade 2">Grade 2</option>
                <option value="Grade 3">Grade 3</option>
                <option value="Grade 4">Grade 4</option>
                <option value="std 5">Std 5</option>
                <option value="std 6">Std 6</option>
                <option value="std 7">Std 7</option>
                <option value="std 8">Std 8</option>
              </optgroup>
             
              <optgroup label="SECONDARY SCHOOL">
                <option class="Form 1">Form 1</option>
                <option class="Form 2">Form 2</option>
                <option class="Form 3">Form 3</option>
                <option class="Form 4">Form 4</option>
              </optgroup>
              <optgroup label="COLLEGE/UNIVERSITY">
                  <option class="First Year">First Year</option>
                  <option class="Second Year">Second Year</option>
                  <option class="Third Year">Third Year</option>
                  <option class="Fourth Year">Fourth Year</option>
              </optgroup>
              <optgroup label="OTHER INSTITUTION">
                <option class="Other">Other</option>
              </optgroup>
              

            </select>
          </div>
        </div> 

        <div class="row form-group">
          <div class="col-12 col-sm-3">Type The Homework Here</div>
          <div class="col-12 col-sm-9">
            <textarea name="quizname" class="form-control" required="required" ><?php echo $quizname; ?></textarea>
          </div>
        </div>


        <div class="row form-group">
          <div class="col-12 col-sm-3">Attach File (If Any)</div>
          <div class="col-12 col-sm-9">
            <input type="file" name="attachment">
          </div>
        </div>


        <div class="row form-group">
          <div class="col-12 col-sm-3">Subject</div>
          <div class="col-12 col-sm-9">
            <select name="subjectc" class="form-control" required="required">
              <?php echo $subjectc; ?>
              <option>select subject</option>
              <?php
              $s=new subject();
              $w=$s->listMySubjects("");
             
                for ($i=0; $i <count($w) ; $i++) { 
                  echo "<option value='".$w[$i]['id']."'>".$w[$i]['subject']."</option>";
                }
              
              ?>
            </select>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-12 col-sm-3">Review Date</div>
          <div class="col-12 col-sm-9">
            <input type="date" name="deadline_date" class="form-control" required="required" value="<?php echo $deadline_date; ?>">
          </div>
        </div>


        


        <div class="row form-group">
          <div class="col-12 col-sm-12">
            <button type="submit" class="btn btn-info" name="go">
              <i class="fa fa-save"></i> SAVE
            </button>
          </div>
          
        </div>
      </form>
    </div>
    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
      <h3>Homework Categories</h3><p><hr><p>
        <div class="table-responsive">
    <table id="sampleTable" style="width: 100%;border-collapse: collapse;margin-top: 12px;" border="1" cellpadding="4">
      <thead>
        <tr class="bg-info"> <th>S/No.</th> <th>Class</th> <th>Homework</th> <th>Subject</th>  <th>Review Date</th> <th>Questions</th> <th>Edit</th> </tr>
      </thead>
      <tbody>
      <?php
      $quiz=new quiz("");
      $cat=$quiz->listHWTypes($created_by);
        for ($i=0; $i <count($cat) ; $i++) { 
          echo "<tr> <td>".$cat[$i]['id']."</td> 
          <td>".$cat[$i]['class']."</td> 
          <td>".$cat[$i]['name']."</td> 
           <td>".$cat[$i]['subjectc']."</td> 

          <td>".$cat[$i]['deadline']."</td> <td><a class='btn btn-info' href='addhw.php?id=".$cat[$i]['id']."'> <i class='fa fa-plus'></i> ADD</a></td>

          <td><a class='btn btn-info' href='homework-types.php?edit=".$cat[$i]['id']."'> <i class='fa fa-edit'></i> UPDATE</a></td>

           </tr>";
        }

       ?>
      </tbody>
    </table></div>
    </div>
  </div>
</div>


            </div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>