</main>


<div class="modal fade" id="pkv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close pull-left" data-dismiss="modal">×</button>
                    
                    <style type="text/css">
                        
                    </style>
                </div>
                <div class="modal-body">
                    <center><h3><i class="fa fa-folder-open"></i> INVITE FOR EXAM TEST</h3></center><hr>
                    <?php
                    $invite="";
                     if (isset($_GET['invite'])) {
                        $invite=$_GET['invite'];
                    } ?>
                    <form method="GET" action="my-quiz.php">
                        
                        <div class="row form-group">
                            <div class="col-12 col-sm-3">Code</div>
                             <div class="col-12 col-sm-9">
                                 <input  type="text" name="id" value="<?php echo $invite; ?>">
                             </div>
                        </div>

                        <button type="submit" name="go" class="btn btn-primary" ><i id="loader" class="fa fa-plus-square"></i> CHECK</button>

                    </form>
                    
                
                    
                </div>
                <div class="modal-footer">
                   <!-- <a href="#" class="btn btn-default" data-dismiss="modal">Close</a> -->
                    
                </div>
            </div>
        </div>
    </div>





























<div class="modal fade" id="pk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close pull-left" data-dismiss="modal">×</button>
                    
                    <style type="text/css">
                        #s, #loader{
                            display: none;
                        }
                    </style>
                </div>
                <div class="modal-body">
                    <center><h3><i class="fa fa-folder-open"></i> NEW FOLDER</h3></center><hr>
                    <form method="POST" enctype="multipart/form-data" name="frr">
                        <div id="loader" class="form-group" style="border:1px dotted green;">
                            <b class="fa fa-spinner fa-spin fa-2x fa-fw"></b> creating folder...
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-sm-3">Folder Name</div>
                             <div class="col-12 col-sm-9">
                                 <input  type="text" name="folder_name">
                             </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-3">Set Passord</div>
                             <div class="col-12 col-sm-9">
                                <label>NONE <input  type="radio" name="has_password" value="FALSE" onclick="disp('#s','none');" checked></label>

                                <label>SET PASSWORD <input  type="radio" name="password" value="TRUE" onclick="disp('#s','block');"></label>
                             </div>
                        </div>

                        <div class="row form-group" id="s">
                            <div class="col-12 col-sm-3">Folder Password</div>
                             <div class="col-12 col-sm-9">
                                 <input  type="text" name="password">
                             </div>
                        </div>
                      


                    </form>
                    
                
                    
                </div>
                <div class="modal-footer">
                   <!-- <a href="#" class="btn btn-default" data-dismiss="modal">Close</a> -->
                    <button class="btn btn-primary" onclick="sbForm();"><i id="loader" class="fa fa-plus-square"></i> CREATE</button>
                </div>
            </div>
        </div>
    </div>





    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script type="text/javascript">
        function disp(elem,displ){
            document.querySelector(elem).style.display=displ;
        }

        function sbForm(){
            var a=new FormData(document.forms['frr']);
            $.ajax({
                url: "includes/folder-ajax.php",
                data:a,
                type: "POST",
                contentType:false,
                processData:false,
                beforeSend:function(){
                    $("#loader").show(130);
                },
                success:function(res){
                    $("#loader").hide(30);
                    $("#pk").modal('hide');
                    $("#folders").html(res);

                }

            });
        }


        function notifyy(){
            var a=new FormData(document.forms['frr']);
            $.ajax({
                url: "includes/notification-ajax.php",
                data:a,
                type: "POST",
                contentType:false,
                processData:false,
                beforeSend:function(){
                    $("#loader").show(10);
                    
                     
                },
                success:function(res){
                   $("#loader").hide(3000);
                    //$("#pk").modal('hide');
                    // $("#notify").show();
                    $("#notify").html(res);

                }

            });
            setTimeout(notifyy,600);
        }
        function popp(){
            $(document).ready(function(){
                $("#pkv").modal("show");
            });
        }


        function popx(){
            $(document).ready(function(){
                $("#f9").modal("show");
            });
        }
        window.onload=notifyy();
    </script>
</body>
</html>