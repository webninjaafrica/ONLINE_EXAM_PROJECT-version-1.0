<?php
include_once("top.php");
include_once("includes/autoload.php");
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-email"></i> Email Setup</h1>
          <p>Set up Your Imap Email Access Here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-wifi fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Imap Email Setup</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form method="POST" class="form">
                <div class="panel panel-info">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    <?php
                    if (isset($_POST['go'])) {
                      error_reporting(0);
                      extract($_POST);
                      if (function_exists('imap_open')) {
                        $server='{'.$server.":".$port.'/imap/ssl/novalidate-cert}';
                       
                      if (imap_open($server, $username, $password)){
                        echo "connection successiful";
                      }else{
                        echo "<div class='alert alert-danger'>Connection Failed: ".imap_last_error()."</div>";
                      }
                    }else{
                      echo "<div class='alert alert-warning'>WARNING!! IMAP NOT SUPPORTED PLEASE CONTACT ADMINISTARTOR. at +254703103500</div>";
                    }
                    }
                     ?>
                <div class="row form-group">
                  <div class="col-12 col-sm-3">SERVER</div>
                  <div class="col-12 col-sm-9">
                    <input type="text" name="server" class="form-control" required="required">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">Port</div>
                  <div class="col-12 col-sm-9">
                    <input type="number" name="port" class="form-control" required="required" max="65535" value="143">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">username</div>
                  <div class="col-12 col-sm-9">
                    <input type="email" name="username" class="form-control" required="required">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-12 col-sm-3">password</div>
                  <div class="col-12 col-sm-9">
                    <input type="password" name="password" class="form-control" required="required">
                  </div>
                </div></div>
                <div class="panel-footer">
                  

                  <button type="submit" name="go" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> SAVE</button>
                </div></div>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>