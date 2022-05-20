<?php
include_once("top.php");
include_once("includes/autoload.php");
if($role=="admin"){

$created_by=$username;
 include_once("autoload.php");
$edit="";
if (isset($_GET['edit'])) {
  $edit=$_GET['edit'];
}

 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-folder-open-o"></i> Subjects</h1>
          <p>Create/ view subjects</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Subjects Info</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">


              <div class="row">
                <div class="col-md-4">
                  <h5><i class='fa fa-info-circle'></i> NEW SUBJECT INFO</h5><hr>
                  <form class="form" method="POST" action="<?php if(isset($_GET['edit'])){ echo '?edit='.$_GET['edit']; } ?>">
                    <?php $n=$c=$sel="";
                    $y=array('M-','S-','A-','J-','H-','C-');
                    $bc=mt_rand(0,120000);
                    $c=$y[mt_rand(0,5)].$bc;
                    if (isset($_GET['edit'])) {
                      $r=new subject($_GET['edit'],$username);
                      $de=$r->subject_details;
                      $n=$de['subjectc'];
                      $c=$de['subject_code'];
                      $sel="<option value='".$de['categoryc']."'>".$de['categoryc']."</option>";
                     } 

                     if (isset($_POST['ss'])) {
                       extract($_POST);
                       
                       if (!isset($_GET['edit'])) {
                        $t=new subject("");
                       echo "<div class='alert alert-info'>".$t->create($subject,$username,$category,$code)."</div>"; }

                        if (isset($_GET['edit'])) {
                        $tl=new subject($edit,$username);
                        $id=$_GET['edit'];

                       echo "<div class='alert alert-info'>".$tl->update($id,$subject,$category,$code,$username)."</div>"; }

                     }
                     ?>

                     <div class="row form-group">
                      <div class="col-12 col-sm-3">CLASS</div>
                       <div class="col-12 col-sm-9">
                        <select name="category" class="form-control" required="required">
                              <?php echo $sel; ?>
                              <optgroup label="PRIMARY SCHOOL">
                <option value="std 1">Grade 1</option>
                <option value="std 2">Grade 2</option>
                <option value="std 3">Grade 3</option>
                <option value="std 4">Grade 4</option>
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
                      <div class="col-12 col-sm-3">SUBJECT NAME</div>
                       <div class="col-12 col-sm-9">
                         <input type="text" name="subject" class="form-control" required="required" value="<?php echo $n; ?>">
                       </div>
                    </div>


                    <div class="row form-group">
                      <div class="col-12 col-sm-3">SUBJECT CODE</div>
                       <div class="col-12 col-sm-9">
                         <input type="text" name="code" class="form-control" required="required" value="<?php echo $c; ?>">
                       </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-12 col-sm-12">
                        <button type="submit" name="ss" class="btn" style="border: 1px solid rgb(112,67,188);"><i class="fa fa-save"></i> SAVE</button>
                      </div>
                    </div>
                  </form>
                </div>
                 <div class="col-md-8">
                  <center><h5>SUBJECTS</h5></center><hr>
                  <div class="table-responsive">
                   <table style="width: 100%;border-collapse: collapse;" border="1" cellpadding="2" id="sampleTable">
                     <thead>
                       <tr class="bg-success"><th>S/No.</th> <th>SUBJECT</th>
                       <th>SUBJECT CODE</th>
                       <th>SUBJECT CODE</th> <th>DATE CREATED</th>
                        <th>UPDATE INFO</th></tr>
                     </thead>
                     <tbody>
                       <?php $s=new subject(""); $sb=$s->listMySubjects($username);
                       for ($i=0; $i <count($sb) ; $i++) { 
                           ?>
                        <tr>
                          <td><?php echo $sb[$i]['id']; ?></td>
                           <td><?php echo $sb[$i]['subject']; ?></td>

                           <td><?php echo $sb[$i]['category']; ?></td>
                           <td><?php echo $sb[$i]['subject_code']; ?></td>
                            <td><?php echo $sb[$i]['date_created']; ?></td>
                             <td><a href='?edit=<?php echo $sb[$i]['id']; ?>'><i class="fa fa-edit"></i> EDIT</a></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                   </table></div>
                 </div>
              </div>

</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>