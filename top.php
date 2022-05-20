<?php session_start();
if(!isset($_SESSION['username'])){
  header("Location: index.php");
  echo "<script>window.location.href='index.php';</script>";
}
include_once("includes/autoload.php");
$username=$picture=$names=$user_type=$last_login=$activated=$role=$classf="";
if(isset($_SESSION['username'])){
$username=$_SESSION['username'];
$login=new login($username);
$details=$login->details;
$names=$details['first_name'];
$picture=$details['picture'];
$last_login=$details['last_login'];
$user_type=$details['user_type'];
$activated=$details['status'];
$class=$details['classf'];
}
if(empty($picture)){
  $picture="images/default.png";
}

if(empty($names)){
  $names="JohnDoe";
}
if(empty($user_type)){
  $user_type="Developer";
}
$role=$user_type;
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="System Login">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="https://twitter.com/kelvinmagochi">
    <meta property="twitter:creator" content="kelvinmagochi">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Cloud 8 AF">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content=".">
    <title>Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/fonts/font-awesome.css">
    
    <link href="css/ip.grid.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/core.css" />
  </head>
  <body class="app sidebar-mini">
    <header class="app-header"><a class="app-header__logo" href="home.php">Reviser</a>
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      
      <ul class="app-nav">
        <li class="app-search">
         <span id="loader" style="color: white;"> <i class="fa fa-wifi" ></i></span>
        </li>
        <li class="app-search">
          
          <form>
          <input class="app-search__input" type="search" placeholder="Search" name="q">
          <button class="app-search__button" type="submit"><i class="fa fa-search"></i></button></form>
        </li>
        

        
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $picture; ?>" alt="User Image" style="width: 75px;height: 75px;">
        <div>
          <p class="app-sidebar__user-name"><?php echo $names; ?></p>
          <p class="app-sidebar__user-designation"><?php echo ucwords($user_type); ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="home.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Home</span></a></li>

        <style type="text/css">
          #loader{display: none;}
        </style>
        <li><a class="app-menu__item" href="notifications.php"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Notifications <b  style="color: tomato;" id="notify">(<?php $n=new notification("NO");
                                echo $n->getCount($username); ?>)</b></span></a></li>

        <?php if ($role=="admin") {?>
          

          <li><a class="app-menu__item" href="subjects.php"><i class="app-menu__icon fa fa-folder-open-o"></i><span class="app-menu__label">Subjects</span></a></li>


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-building"></i><span class="app-menu__label">Teachers Info</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item"   href="add-teacher.php"><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;Add Teacher</a></li>
            <li><a class="treeview-item" href="teachers.php"><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;&nbsp;All Teachers</a></li>
            
          </ul>
        </li>

            

         <?php } ?>












<?php if ($role=="teacher") {?>



   <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-building"></i><span class="app-menu__label">Exams</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item"   href="quiz-types.php"><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;EXAM TYPES</a></li>


            <li><a class="treeview-item"   href="submitted-exams.php"><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;SUBMITTED EXAMS</a></li>
            
            <li><a class="treeview-item" href="performance.php"><i class="fa fa-line-chart"></i>&nbsp;&nbsp;&nbsp;PERFORMANCE REPORT</a></li>



            
          </ul>
        </li>


          



          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-graduation-cap"></i><span class="app-menu__label">Students Info</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item"   href="add-student.php"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Student</a></li>
            <li><a class="treeview-item" href="students.php"><i class="fa fa-table"></i>&nbsp;&nbsp;&nbsp;All Students</a></li>
            
          </ul>
        </li>


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-building"></i><span class="app-menu__label">Homework</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item"   href="homework-types.php"><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;Create H/Work</a></li>
            
            <li><a class="treeview-item" href="submittedhw.php"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;&nbsp;Submitted H/Works</a></li>

            
          </ul>
        </li>




           

            

         <?php } ?>














          <?php if ($role=="student" && $activated=="YES") {?>
          <li><a class="app-menu__item" href="my-exam-list.php"><i class="app-menu__icon fa fa-table"></i><span class="app-menu__label">My Exams</span></a></li>

           <li><a class="app-menu__item" href="results.php"><i class="app-menu__icon fa fa-line-chart"></i><span class="app-menu__label">Exam Results</span></a></li>


           <li><a class="app-menu__item" href="my-hw-list.php"><i class="app-menu__icon fa fa-briefcase"></i><span class="app-menu__label">My Home/Work</span></a></li>

            <li><a class="app-menu__item" href="#revision.php"><i class="app-menu__icon fa fa-graduation-cap"></i><span class="app-menu__label">Revision Papers</span></a></li>

         <?php } ?>


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">My Profile</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item"   href="settings.php"><i class="fa fa-cog"></i>&nbsp;&nbsp;&nbsp;Settings</a></li>
            <li><a class="treeview-item" href="profile.php"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Profile</a></li>
            
          </ul>
        </li>

        <li><a class="app-menu__item" href="logout.php"><i class="app-menu__icon fa fa-sign-out"></i><span class="app-menu__label">Log Out</span></a></li>


        
       
      </ul>
    </aside>
    <main class="app-content">
      