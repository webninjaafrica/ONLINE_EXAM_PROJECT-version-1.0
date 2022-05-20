<?php
include_once("top.php");
include_once("includes/autoload.php");
 ?>
 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Spread Sheets</h1>
          <p>New Sheet File</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-building fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="my-tools.php">My Tools</a></li>

          <li class="breadcrumb-item"><i class="fa fa-folder-open fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#.php">Spread Sheers</a></li>

          <li class="breadcrumb-item"><i class="fa fa-folder fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">New Sheet</a></li>

          
        </ul>
      </div>
      <style type="text/css">
         a { color:#46b3ff; text-decoration:dotted; }

        .gridContainer {

            position:relative;
            width:700px;
            height:500px;
        }

        #sheet {

            width:100%;
            height:100%;
            /*overflow-x: scroll;*/
        }
      </style>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="gridContainer">
              <div id="sheet"></div>
            </div>
            </div>
          </div>
        </div>
      </div>
<?php include_once("bottom.php"); ?>