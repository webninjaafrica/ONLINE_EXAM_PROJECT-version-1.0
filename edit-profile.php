<?php
include_once("top.php");
include_once("includes/autoload.php");
$login=new login($username);
$details=$login->details;
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Personal Details</h1>
          <p>Edit</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>
          <li class="breadcrumb-item"><i class="fa fa-edit fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Edit</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form class="form" method="POST">
                <?php if (isset($_POST['go'])) {
                  extract($_POST);
                  
                  echo "<div class='alert alert-success'>".$login->UpdateRegister($first_name,$last_name,$other_names,$email,$user_type,$details['id'],$tel,$country)."</div>";
                } ?>
                <div class="row form-group">
                  <div class="col-12 col-sm-3">First Name</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="first_name" class="form-control" required="required" value="<?php echo $details['first_name']; ?>">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">Last Name</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="last_name" class="form-control" required="required" value="<?php echo $details['last_name']; ?>">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">Other Names</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="other_names" class="form-control" required="required" value="<?php echo $details['last_name']; ?>">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">Country</div>
                  <div class="col-12 col-sm-9">
                    <select name="country" class="form-control" required="required">
                      <?php echo "<option value='".$details['country']."'>".$details['country']."</option>"; ?>
                      <?php $c=new country();
                                        $cx=$c->listCountries();
                                        for($i=0; $i<count($cx); $i++){ ?><option value="<?php
                                        echo $cx[$i];  ?>"><?php
                                        echo $cx[$i]; ?></option>
                                        <?php } ?> 
                    </select>
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">Tel</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="tel" class="form-control" required="required" value="<?php echo $details['tel']; ?>">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">Email:</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="email" class="form-control" required="required" value="<?php echo $details['email']; ?>">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">username</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="username" class="form-control" required="required" readonly="readonly" value="<?php echo $details['username']; ?>">
                  </div>
                </div>
                
                <button type="submit" name="go" class="btn btn-info btn-lg btn-block"><i class="fa fa-save"></i> UPDATE</button>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>