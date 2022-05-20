<?php
include_once("top.php");
include_once("includes/autoload.php");
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dinbox"></i> SEND MESSAGE</h1>
          <p>contact a teacher/student here</p>
          <a href="notifications.php"><< BACK TO INBOX</a>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">compose</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form method="POST">
                <?php if (isset($_POST['go'])) {
                  extract($_POST);
                  $notification=new notification();
                   $notification->send($usernamex,$title,$message,$username);
                   echo "<div class='alert alert-success'>SENT SUCCESSIFULLY</div>";
                } ?>
                <div class="form-group">
                  <b>Select Recipient</b>
                  <select name="usernamex" class="form-control" required="required" style="color: black;">
                    <optgroup label="students">
                  <?php

                  $l=new login(""); $data=$l->showusers("student");
                  for ($i=0; $i <count($data) ; $i++) { 
                    echo "<option value='".$data[$i]['username']."'>".$data[$i]['names']."</option>";
                  }
                   ?>
                   </optgroup>

                   <optgroup label="teachers">
                  <?php

                  $l=new login(""); $data=$l->showusers("teacher");
                  for ($i=0; $i <count($data) ; $i++) { 
                    echo "<option value='".$data[$i]['username']."'>".$data[$i]['names']."</option>";
                  }
                   ?>
                   </optgroup>
                 </select>
                  
                </div>
                <div class="form-group">
                  <b>Title/Subject</b>
                  <input type="text" name="title" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <textarea name="message" class="form-control" required="required"></textarea>
                </div>
                <div class="form-group">
                  <button name="go" type="submit" class="btn btn-primary"><i class="fa fa-send"></i> SEND</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>