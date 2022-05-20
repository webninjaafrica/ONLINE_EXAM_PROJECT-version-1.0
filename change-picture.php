<?php
include_once("top.php");
include_once("includes/autoload.php"); ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-camera"></i> Profile Photo</h1>
          <p>Edit your picture here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>
          <li class="breadcrumb-item"><i class="fa fa-picture fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Edit Picture</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="tile">
            <div class="tile-body"><h3>Change</h3><p><hr><p>
              <form class="form" method="POST" enctype="multipart/form-data">
                <?php 
                if (isset($_POST['go'])) {
                  $login=new login($username);
                  $f=new filemanager($username);
                  $s=$f->upload('photo',$username,"USER-PROFILE-PHOTO","profile picture");
                  if ($s['status']=="uploaded successifully.") {
                    
                  echo "<div class='alert alert-success'>".$login->updatePic($s['path'])."</div>";
                }else{
                  echo "<div class='alert alert-danger'>upload denied.</div>";
                }

                }
                ?>
                <div class="form-group">
                  <input type="file" name="photo" required="required" onchange="changePic(event);">
                </div>
                <div class="form-group">
                  <button class="btn btn-info" type="submit" name="go"><i class="fa fa-upload"></i> Upload</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="thumbnail">
            <img src="<?php echo $picture; ?>" class="img-responsive" style="width: 160px;height:164px;border:1px solid tomato;" id="img">
          </div>
        </div>
      </div>
      <script type="text/javascript">
        function changePic(evt){
          var f=new FileReader();
          f.onload=function(){
            document.querySelector("#img").src=f.result;
          };
          f.readAsDataURL(evt.target.files[0]);

        }
      </script>
<?php include_once("bottom.php"); ?>