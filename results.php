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

 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> Exams Results</h1>
          <p>list</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Exams/Results</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
             <div class="jumbotron" style="background:linear-gradient(rgba(90,56,90,.37),rgba(0,60,78,.1786),lightgrey); border: 1px dotted rgba(167,45,88,.43);"> <!--<h3>Coming Soon!</h3>
              <p>Meanwhile, All the reults will be sent on the 'Notifications' Tab on your sidebar.<br>Thank You.</p>-->
              <center><h2 style="font-family: Tahoma;"><i>CERTIFICATE OF MERIT</i></h2></center><p>
                <table style="width: 100%;margin-bottom: 34px;">
                  <tr><th style="font-family: Arial;color: darkgrey;"></th> <th style="border-bottom: 0px solid grey;">
                    <?php $r=new login($username); $dt=$r->details; echo " This Certificate was awarded to <b style='color:rgb(233,45,139);font-weight:bold;text-decoration:underline;'>".$dt['first_name']." ".$dt['other_names']." ".$dt['last_name']."</b> On: ".date('d-m-Y'); ?>
                  </th></tr>
                  <tr><th style="font-family: Arial;color: darkgrey;"></th> <th></th></tr>
                </table>
                <table style="border-collapse: collapse;width: 100%;" cellpadding="4" border="0">
                  <thead>
                    <tr class="" style="background: linear-gradient(black,#323232,black);color:#e3e3e3;">
                      <th>S/No.</th> <th>Score</th> <th>Test Date</th> <th>Test Name</th> <th>Class</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $da=new performance;
                    $data=$da->listMyQuizes($created_by);

                     for ($i=0; $i <count($data); $i++) {
                     $quiz=$data[$i]['quiz_id']; $q=new quiz($quiz);
                     $qn=$q->quiz_details_by_id;
                     $quizname=$qn["quiz_name"]; $class=$qn['category_id']; ?>
                     <tr>
                      <td><?php echo $data[$i]['quiz_id'];  ?></td>
                      <td><?php echo $data[$i]['score'];  ?></td>
                      <td><?php echo $data[$i]['date'];  ?></td>
                      <td><?php echo $quizname; ?></td>
                      <td><?php echo $class; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td colspan="4"></td>
                    </tr>
                    <tr>
                      <td colspan="4">
                        
                      </td>
                    </tr>



                    <tr>
                      <td colspan="4"></td>
                    </tr>
                    <tr>
                      <td colspan="4" style="text-align: center;font-family: Helvetica;">
                        <i>This cetrificate is computer-generated. Thus it may not require a stamp.</i>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>

              <?php

               ?>


</div>
          </div>
        </div>
      </div>
<?php } include_once("bottom.php"); ?>