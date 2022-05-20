<?php
session_start();
include_once("autoload.php");
if (isset($_SESSION['username'])) {
	$username=$_SESSION['username'];
	$f=new filemanager($_SESSION['username']);
	extract($_POST); 
	$f->addFolder($folder_name,$_SESSION['username'],$has_password,$password);

	?>

	<?php $filemanager=new filemanager($username);
              $f=$filemanager->listFolders($username);
              for ($i=0; $i < count($f); $i++) { 
                
                ?>
              <style type="text/css">
                #t{
                  margin-left: 64px;
                }
              </style>

              <div class="thumbnail t" style="margin-left: 34px;">
                <a href="folder-contents.php?id=<?php echo $f[$i]['folder_id']; ?>"><h2 class="fa fa-folder-open fa-5x"></h2></a>
                <div class="caption"><i><?php echo $f[$i]['folder_name']; ?></i>(<?php $filemanagerc=new filemanager($username,$f[$i]['folder_id']); echo $filemanagerc->file_exist; ?>)</div>
              </div>

             <?php } ?>

<?php }else{
	echo "<div class='alert alert-danger'>folder error</div>";
}

?>