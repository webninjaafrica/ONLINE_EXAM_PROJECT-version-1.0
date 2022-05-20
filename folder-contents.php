<?php
include_once("top.php");
include_once("includes/autoload.php");
$folder=$count=$fid="";
if (isset($_GET['id'])) {
  $folder=$_GET['id']; $fid=$_GET['id'];
  $fol=new filemanager($username,$folder);
  $details=$fol->folderdetails;
  $datas=$fol->details;
  $folder=$details['folder_name'];
  $count=$fol->file_exist." Files found in this folder";

}

 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-folder-o"></i> <?php echo $details['folder_name']; ?></h1>
          <p></i> <?php echo $count; ?></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-building fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="my-tools.php">My Tools</a></li>

          <li class="breadcrumb-item"><i class="fa fa-folder-open fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="my-files.php">File Manager</a></li>

          <li class="breadcrumb-item"><i class="fa fa-folder fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#"><?php echo $folder; ?></a></li>

          <li class="breadcrumb-item"><i class="fa fa-folder fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#"><?php echo $folder; ?></a></li>
        </ul>
      </div>
      <style type="text/css">
        #b1{display:none;}
      </style>
      <button id="b2" onclick="togle('#b1','block')">Upload</button>
      <div class="row" id="b1">
        <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
              <a onclick="togle('#b1','none','#b2');" style="font-weight: bold;font-size: 22px;cursor:pointer;">&times</a>
              <form method="POST" class="form-inline" name="f2" enctype="multipart/form-data">
              <label for="fl">
              <button type="button" onclick="upload();"><i class="fa fa-upload"></i></button>
              <input type="file" id="fl" name="fl">
            </label> <input type="text" name="title" value="<?php echo 'New-file'.mt_rand(0,99999); ?>" class="form-control" required> <input type="hidden" id="fid" name="fid">
            <input type="hidden" name="fid" value="<?php echo $_GET['id']; ?>">

            

            </form>
            <div class="progress mb-2" style="margin-top: 6px;">
                <div id="progress" class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div><span id='dg'></span>

            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body" id="di">
              
              <ul class="list-group">
              <?php for ($i=0; $i <count($datas); $i++) { ?>
                <li class="list-group-item">
                  <a href="<?php echo $datas[$i]['path']; ?>"><b class="fa fa-file"></b> <i> <?php echo $datas[$i]['filename']; ?></i></a>
                </li>
              <?php } ?>
            </ul>
            </div>
          </div>
        </div>
        
      </div>
      <script type="text/javascript">
        function upload(){
          var a=document.forms['f2'];
          var fd=new FormData(a);
          var s=new XMLHttpRequest();
          s.onreadystatechange=function(){

            if (this.readyState==4 && this.status==200) {
              document.querySelector("#di").innerHTML=s.responseText;
            }else{
            s.upload.onprogress=function(e){
              var load=e.total;
              var ldd=e.loaded;
              var res=eval((ldd/load)*100);
              document.querySelector("#progress").style.width=res+"%";
              document.querySelector("#dg").innerHTML=res+"% Complete";
            }
          }


          };
          s.open("POST","upload-ajax.php",true);
          s.send(fd);
        }


        function togle(elem,disp,l3="x"){
          document.querySelector(elem).style.display=disp;
          if (l3!=="x") {
            document.querySelector(l3).style.display="block";
          }
        }
      </script>
<?php include_once("bottom.php"); ?>