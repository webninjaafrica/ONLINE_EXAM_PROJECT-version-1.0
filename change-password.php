<?php
include_once("top.php");
include_once("includes/autoload.php");
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Privacy</h1>
          <p>Change Password</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>

          <li class="breadcrumb-item"><i class="fa fa-folder fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Privacy</a></li>

          <li class="breadcrumb-item"><i class="fa fa-lock fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="change-password.php">Change Password</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form method="POST" class="form">
                <?php if (isset($_POST['go'])) {
                  extract($_POST);
                } ?>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">Old Password</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="oldpassword" class="form-control" required="required">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-12 col-sm-3">New Password</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="password" class="form-control" required="required">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">Confirm New Password</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="confirmpassword" class="form-control" required="required">
                  </div>
                </div>
                <button type="submit" name="go" class="btn btn-info btn-lg btn-block"><i class="fa fa-save"></i> UPDATE</button>

              </form>
            </div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>