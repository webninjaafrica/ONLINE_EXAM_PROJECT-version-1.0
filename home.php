<?php
include_once("top.php");
include_once("includes/autoload.php");
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Welcome</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Home</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
             
                <?php if($role=="student") { ?>
                   <div class="alert alert-info">
                <h2><b class="fa fa-info-circle fa-2x"></b> INFORMATION</h2><hr><p>
                  <p>Your account ACTIVE STATUS is: <?php if ($activated=="NO") {
                    echo "NOT ACTIVATED. Please contact the administrator to activate your account. Upon activating the account you will be able to access:<br> <ol> <li>revision papers</li> <li>Do self test exams and receive a results or a merit certificate</li> <li>Contact An Online teacher or tutor any time.</li> <ol>";
                  }else{echo $activated; } ?></p>
              </div>
               <?php }else{ ?>
                   <div class="alert alert-success">
                <h2><b class="fa fa-info-circle fa-2x"></b> WELCOME ADMIN/TEACHER </h2><hr><p> 
                  With this Interface: on the menu, you will be able to:<br>
                  <ol>
                    <li>Create Examination materials withy answers,</li>
                    <li>Invite your students to do or revise exams/ revision materials,</li>
                    <li>Monitor students performance online.</li>
                    <li>Contact you students</li>
                  </ol>
                </p>
              </div>
               <?php } ?>

            </div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>