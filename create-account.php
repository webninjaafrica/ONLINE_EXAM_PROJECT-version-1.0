<?php session_start();
include_once("includes/autoload.php");
$error="";
$username="";
if (isset($_SESSION['username'])) {
   $username=$_SESSION['username'];
}
if (isset($_SESSION['password']) && isset($_SESSION['username'])) {
    header("Location: home.php");
}
if (isset($_POST['go'])) {
    extract($_POST);
    $user_type=$_POST['user_type'];
    $login=new login($user);
    if($cpassword!==$password){
    $error="<div class='alert alert-danger'>Registration failed. Passwords did not match.</div> ";
}else{
    if(empty($first_name) || empty($last_name) || empty($other_names) || empty($email) || empty($password) || $_POST['county']=="x" || empty($tel)){
   

    $error="<div class='alert alert-danger'>Please fill the empty fields.</div> ";
}else{
    $e="";
    if ($user_type=="student") {
       $e=$_POST['class'];
    }
    $error= "<div class='alert alert-success'>".$login->registerForLogin($user,$first_name,$last_name,$other_names,$email,$password,$user_type,$tel,"Kenya",$e,$county)." <br>Please <a href='index.php'>Click Here To Login To Your Account.</a></div> ";    
}
}
}
 ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>CREATE ACCOUNT</title>
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
        <form method="POST" style="">
        <div class="content h-100">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="register card auth-box mx-auto my-auto">
                        <div class="card-block text-center">
                            <div class="user-icon">
                                <i class="fa fa-user-circle-o"></i>
                            </div>

                            <h4 class="text-light">SIGN UP</h4>
                            <?php echo $error; ?>

                            <div class="user-details">
                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-user"></i>
                                                    </span>

                                                <input type="text" class="form-control" placeholder="First Name" aria-describedby="basic-addon1" name="first_name"  required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon12">
                                                        <i class="fa fa-user"></i>
                                                    </span>

                                            <input type="text" class="form-control" placeholder="Other Names" aria-describedby="basic-addon12" name="other_names">
                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-user"></i>
                                                    </span>

                                                <input type="text" class="form-control" placeholder="Last Name" aria-describedby="basic-addon1" name="last_name"  required="required">
                                            </div>
                                        </div>
                                    </div>



                     <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-globe"></i>
                                                    </span>

                                 <select class="form-control"  aria-describedby="basic-addon1" name="county" id="county" onchange="showCode();">
                                    <option>--Select County----</option>
                                       <option value="Mombasa">Mombasa</option>
                                       <option value="Kwale">Kwale</option>
                                       <option value="Kilifi">Kilifi</option>
                                       <option value="Tana River">Tana River</option>
                                       <option value="Lamu">Lamu</option>
                                       <option value="Taita Taveta">Taita Taveta</option>
                                       <option value="Garissa">Garissa</option>
                                       <option value="Wajir">Wajir</option>
                                       <option value="Mandera">Mandera</option>
                                       <option value="Marsabit">Marsabit</option>
                                       <option value="Isiolo">Isiolo</option>
                                       <option value="Meru">Meru</option>
                                       <option value="Tharaka Nithi">Tharaka Nithi</option>
                                       <option value="Embu">Embu</option>
                                       <option value="Kitui">Kitui</option>
                                       <option value="Machakos">Machakos</option>
                                       <option value="Makueni">Makueni</option>
                                       <option value="Nyandarua">Nyandarua</option>
                                       <option value="Nyeri">Nyeri</option>
                                       <option value="Kirinyaga">Kirinyaga</option>
                                       <option value="Murang'a">Murang'a</option>
                                       <option value="Kiambu">Kiambu</option>
                                       <option value="Turkana">Turkana</option>
                                       <option value="West Pokot">West Pokot</option>
                                       <option value="Samburu">Samburu</option>
                                       <option value="Trans-Nzoia">Trans-Nzoia</option>
                                       <option value="Uasin-Gishu">Uasin-Gishu</option>
                                       <option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
                                       <option value="Nandi">Nandi</option>
                                       <option value="Baringo">Baringo</option>
                                       <option value="Laikipia">Laikipia</option>
                                       <option value="Nakuru">Nakuru</option>
                                       <option value="Narok">Narok</option>
                                       <option value="Kajiando">Kajiando</option>
                                       <option value="Kericho">Kericho</option>
                                       <option value="Bomet">Bomet</option>
                                       <option value="Kakamega">Kakamega</option>
                                       <option value="Vihiga">Vihiga</option>
                                       <option value="Bungoma">Bungoma</option>
                                       <option value="Busia">Busia</option>
                                       <option value="Siaya">Siaya</option>
                                       <option value="Kisumu">Kisumu</option>
                                       <option value="Homabay">Homabay</option>
                                       <option value="Migori">Migori</option>
                                       <option value="Kisii">Kisii</option>
                                       <option value="Nyamira">Nyamira</option>
                                       <option value="Nairobi">Nairobi</option>
                                       
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-envelope-o"></i>
                                                    </span>

                                                <input type="text" class="form-control" placeholder="Email Address" aria-describedby="basic-addon1" name="email"  required="required" onkeyup="loadData('#email','#username');" id="email">
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-phone"></i>
                                                    </span>

                                                <input type="text" class="form-control" placeholder="Tel No." aria-describedby="basic-addon1" name="tel"  required="required" id="tel">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" name="user" required="required" id="username">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-graduation-cap"></i>
                                            </span>
                                        <select id="acc" class="form-control" aria-describedby="basic-addon1" name="user_type" required="required" id="user_type"  onchange="accc();">
                                            <!--<option>--SELECT ACCOUNT--</option> -->
                                            <option value="student">STUDENT ACCOUNT</option>
                                           <!-- <option value="admin">TEACHER ACCOUNT</option> -->
                                        </select>
                                    </div>
                                </div>


                                <style type="text/css">
                                    #stu{
                                        display: none;
                                    }
                                </style>
                                <div class="form-group" id="stu">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-graduation-cap"></i>
                                            
                                            </span>
                                        <select  class="form-control" required="required" name="class">
             
              <optgroup label="PRIMARY SCHOOL">
                <option value="std 1">Grade 1</option>
                <option value="std 2">Grade 2</option>
                <option value="std 3">Grade 3</option>
                <option value="std 4">Grade 4</option>
                <option value="std 5">Std 5</option>
                <option value="std 6">Std 6</option>
                <option value="std 7">Std 7</option>
                <option value="std 8">Std 8</option>
              </optgroup>
             
              <!--<optgroup label="SECONDARY SCHOOL">
                <option class="Form 1">Form 1</option>
                <option class="Form 2">Form 2</option>
                <option class="Form 3">Form 3</option>
                <option class="Form 4">Form 4</option>
              </optgroup>
              <optgroup label="COLLEGE/UNIVERSITY">
                  <option class="First Year">First Year</option>
                  <option class="Second Year">Second Year</option>
                  <option class="Third Year">Third Year</option>
                  <option class="Fourth Year">Fourth Year</option>
              </optgroup>
              <optgroup label="OTHER INSTITUTION">
                <option class="Other">Other</option>
              </optgroup> -->
              

            </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-key"></i>
                                                    </span>

                                                <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" name="password" required="required" id="password" onkeyup="passwordStrength();"  minlength="8">
                                            </div>
                                            <span id="error1"></span>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-key"></i>
                                                    </span>

                                                <input type="password" class="form-control" placeholder="Repeat Password" aria-describedby="basic-addon1" name="cpassword"  required="required" id="cpassword" onkeyup="passwordsCompare();" minlength="8">
                                            </div>
                                            <span id="error2"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="go" class="btn btn-primary btn-lg btn-block">REGISTER</button>

                            <div class="user-links">
                                <a href="index.php" class="pull-left">Back To Login</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /PAGE CONTENT -->
    </div>
     <script src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        function loadData(frm,t){
    document.querySelector(t).value=document.querySelector(frm).value;
        }

        function showCode(){
            document.querySelector("#tel").value="07";
            /*var d= document.querySelector('#country');
            var country=d.options[d.options.selectedIndex].value;
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if (this.readyState==4 && this.status==200) {
                    document.querySelector("#tel").value="+254";
                    document.querySelector('#tel').focus();
                }
            };
            xhr.open("GET","includes/country-ajax.php?nm="+country,false);
            xhr.send(); */

        }

        function passwordStrength(){
            var f=document.querySelector('#password').value;
            var d=eval((f.length/12)*100);
            if (d <=50) {
                document.querySelector('#error1').innerHTML="Weak Password detected";
                document.querySelector('#error1').style.color="red";
            }
            if (d >=51 && d<=69) {
                document.querySelector('#error1').innerHTML="Medium Password detected";
                document.querySelector('#error1').style.color="orange";
            }

            if (d >=70) {
                document.querySelector('#error1').innerHTML="";
                document.querySelector('#error1').style.color="green";
            }
        }

        function passwordsCompare(){
            var a1=document.querySelector('#password').value;
            var a2=document.querySelector('#cpassword').value;
            if (a1!==a2) {
                document.querySelector('#error2').innerHTML="Passwords do not match!";
                document.querySelector('#error2').style.color="red";
            }else{
                document.querySelector('#error2').innerHTML="";
            }
        }


        function accc(){
            var cv=document.querySelector("#acc");
            var sel=cv.options[cv.options.selectedIndex].value;
            if (sel=="student") {
                $(document).ready(function(){
                    $("#stu").show('slow'); 
                });
            }
            if (sel=="admin") {
                $(document).ready(function(){
            $("#stu").fadeOut('slow');
             }); }


        }
    </script>
</body>

</html>