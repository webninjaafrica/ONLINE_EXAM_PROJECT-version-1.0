<?php session_start();
include_once("includes/autoload.php");
$error="";
$username=$role="";
if (isset($_SESSION['username'])) {
   $username=$_SESSION['username'];
}
if (isset($_SESSION['password']) && isset($_SESSION['username'])) {
    header("Location: home.php");
}
if (isset($_POST['go'])) {
    extract($_POST);
    $login=new login($user);
    $l=$login->checkLogin($password);
    $d=$login->details;
    $role=$d['user_type'];
    if ($l=="SUCCESS") {
        $_SESSION['username']=$user;
        $_SESSION['password']=$password;
        $_SESSION['user_role']=$role;
        header("Location: home.php");
    }else{
        $error="<div class='alert alert-danger'>incorrect username/password.</div>";
    }
}
 ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>CLOUD 8 | LOGIN</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="assets/icons/fontawesome/styles.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/tether.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/app.min.js"></script>
</head>

<body>
    <div class="page-container">
        <!-- PAGE CONTENT -->
        <style type="text/css">
           @media (max-width: 502px) {
            .content{
                margin-top: 105%;
            }
           }

        </style>
        <form method="POST">
        <div class="content h-100" style="margin-top: 45px;">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="login card auth-box mx-auto my-auto">
                        <div class="card-block text-center">
                            <div class="user-icon">
                                <i class="fa fa-user-circle"></i>
                            </div>

                            <h4 class="text-light">Login</h4>

                            <div class="user-details">
                                <div class="form-group">
                                    <?php echo $error; ?>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" name="user">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" name="password">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="go" class="btn btn-primary btn-lg btn-block">LOGIN</button>

                            <div class="user-links">
                                <a href="#" class="pull-left">Forgot Password?</a>
                                <a href="create-account.php" class="pull-right">Register</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</body>

</html>