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
$q=new quiz();
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-bar-chart"></i> Performance</h1>
          <p>Analysis</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Performance</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <center style="margin-bottom: 23px;">SORT: BY 
                <select id="quiz" class="form-control" onchange="quizsel();">
              <?php $c=$q->listQuizTypes($created_by); 
              for ($i=0; $i <count($c) ; $i++) { ?>
                <option value="<?php echo $c[$i]['id']; ?>"><?php echo $c[$i]['name']; ?></option>

              <?php } ?>
            </select><p>
              <?php $e=new quiz($quiz_id);
              $f=$e->quiz_details_by_id; echo "SELECTED: [ <b>".$f['quiz_name']."</b> ]"; ?></center>

            <table id="sampleTable" style="width: 100%;border-collapse: collapse;margin-top: 12px;" border="1" cellpadding="4">
              <thead>
                <tr>
                  <th>S/NO.</th> <th>Names</th> <th>Tel</th> <th>Score</th> <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $p=new performance("");
                $v=$p->listPerformance($quiz_id);
                 for ($i=0; $i <count($v) ; $i++) {
                 $login=new login($v[$i]['user_id']);
                 $de=$login->details;  ?>
                 <tr>
                   <td><?php echo $de['id']; ?></td>
                   <td><?php echo $de['first_name']." ".$de['last_name']; ?></td>
                   <td><?php echo $de['tel']; ?></td>
                   <td><?php echo $v[$i]['score']; ?></td>
                  <td>--</td>
                 </tr>
                <?php } ?>

                <?php ?>
              </tbody>
            </table>



</div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        function quizsel(){
          var a=document.querySelector("#quiz");
          var s=a.options[a.options.selectedIndex].value;
          window.location.href="performance.php?id="+s;
        }
      </script>
<?php } include_once("bottom.php"); ?>