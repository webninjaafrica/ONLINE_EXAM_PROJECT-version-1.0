<?php
include_once("top.php");
include_once("includes/autoload.php");

$user=new login($username);
$details=$user->details; ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-user"></i> My Profile</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
        </ul>
      </div>
      <div class="row">
        
        <div class="col-md-9">
          <div class="tile">
            <div class="tile-body">
              <style type="text/css">
                th{
                    background: #e3e3e3;
                    text-align: right;
                }
                td{
                  background: #f3f3f3;
                  text-align: left;
                }

              </style>
              <a class="btn btn-danger btn-lg btn-block" href="edit-profile.php"><i class="fa fa-edit"></i> Edit Details</a><p>
                <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr><th class="bg-default">First Name: </th> 
                    <td><?php echo $details['first_name']; ?></td> <th>Other Names: </th> <td><?php echo $details['other_names']; ?></td> 
                    </tr>
                    <tr><td></td><td></td> <td></td><td></td></tr>
                  <tr><th>Last Name: </th> <td><?php echo $details['last_name']; ?></td> <th></th> <td></td></tr>
                    <tr><td></td><td></td> <td></td><td></td></tr>

                    <tr><th>County: </th> <td><?php echo $details['county']; ?></td> <th>Tel: </th> <td><?php echo $details['tel']; ?></td></tr>
                    <tr><td></td><td></td> <td></td><td></td></tr>

                    

                    <tr><th>Email: </th> <td><?php echo $details['email']; ?></td> <th>username: </th> <td><?php echo $details['username']; ?></td> </tr>
                    <tr><td></td><td></td> <td></td><td></td></tr>

                    <tr><th>Account Type: </th> <td><?php echo $details['user_type']; ?></td> <th>Previous Login: </th> <td><?php echo $details['last_login']; ?></td></tr>
                    <tr><td></td><td></td> <td></td><td></td></tr>

                    

                    <tr><th>user id: </th> <td><?php echo $details['id']; ?></td> <th></th> <td></td></tr>

                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="thumbnail">
          <img style="width: 160px;height:164px;border:1px solid lightgrey;" src="<?php echo $picture; ?>" class="img-responsive">
          <div class="caption">
            <p><a class="btn btn-primary btn-lg " href="change-picture.php"><i class="fa fa-photo"></i> Change</a>
          </div>
        </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>