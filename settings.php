<?php
include_once("top.php");
include_once("includes/autoload.php");
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-cogs"></i> Settings</h1>
          <p>Account settings</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-cogs fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="settings.php">Settings</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              

              <ul class="list-group">
                <li class="list-group-item">
                  <b>Personal</b><p>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <a href="profile.php"><b class="fa fa-user"></b> My Profile</a>
                    </li>
                    <li class="list-group-item">
                      <a href="edit-profile.php"> <b class="fa fa-edit"></b> Edit Profile</a>
                    </li>
                    <li class="list-group-item">
                      <a href="change-password.php"><b class="fa fa-key"></b> Change Password</a>
                    </li>
                  </ul>
                </li>

                <li class="list-group-item">
                  <b>Email Settings</b><p>
                    <ul class="list-group">
                      <li class="list-group-item">
                        <a href="email-setup.php"><b class="fa fa-envelope"></b> IMAP Setup</a>
                      </li>
                    </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>