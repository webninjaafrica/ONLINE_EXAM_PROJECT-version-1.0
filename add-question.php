<?php 
session_start();
$_SESSION['user']='admin';
$created_by=$_SESSION['user'];
 include_once("autoload.php");
$id="";
if (isset($_GET['id'])) {
	$id=$_GET['id'];
}
$quiz_id=$id;
$qs=new question("");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
		
	</style>
</head>
<body>


<div class="container-fluid">
	<div class="row" style="margin-top:113px;">
		<div class="col-sm-5 col-md-5 col-xs-5 col-lg-5">
			
			<form method="POST" class="form" action="<?php if (isset($_GET['id']) && isset($_GET['edit'])) { echo '?id='.$_GET['id'].'&edit='.$_GET['edit']; }
			if (isset($_GET['id']) && !isset($_GET['edit'])) { echo '?id='.$_GET['id']; } ?>">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<i class="fa fa-info-circle"></i>
						   QUESTION INFO.
					</div>
					<div class="panel-body">
						<?php
						$question=$option_1=$option_2=$option_3=$option_4=$correct_answer="";
						if (isset($_GET['id']) && isset($_GET['edit'])) {
							$question_id=$_GET['edit'];
							$q=new question($question_id);
							$de=$q->question_details_by_id;
							extract($de);
							$correct_answer="<option value='".$correct_answer."'>".$correct_answer."</option>";
						}
			if (isset($_POST['go'])) {
				extract($_POST);
				$q=new question('');
				echo "<div class='alert alert-info'>".$q-> create($question,$option_1,$option_2,$option_3,$option_4,$correct_answer,$quiz_id,$created_by)."</div>";
				if (isset($_GET['id']) && isset($_GET['edit'])) {
					$quiz_id=$_GET['id'];
					$question_id=$_GET['edit'];
					$q=new question($question_id);
					echo "<div class='alert alert-info'>".$q-> update($question,$option_1,$option_2,$option_3,$option_4,$correct_answer,$quiz_id,$created_by)."</div>";
				}
			}
			 ?>
				<div class="row form-group">
					<div class="col-12 col-sm-3">
						Question
					</div>
					<div class="col-12 col-sm-9">
						<textarea name="question" class="form-control" required="required"><?php echo $question; ?></textarea>

					</div>
				</div>


				<div class="row form-group">
					<div class="col-12 col-sm-3">
					A.
					</div>
					<div class="col-12 col-sm-9">
						<textarea name="option_1" class="form-control" required="required"><?php echo $option_1; ?></textarea>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-12 col-sm-3">
						B.
					</div>
					<div class="col-12 col-sm-9">
						<textarea name="option_2" class="form-control" required="required"><?php echo $option_2; ?></textarea>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-12 col-sm-3">
						C.
					</div>
					<div class="col-12 col-sm-9">
						<textarea name="option_3" class="form-control" required="required"><?php echo $option_3; ?></textarea>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-12 col-sm-3">
						D.
					</div>
					<div class="col-12 col-sm-9">
						<textarea name="option_4" class="form-control" required="required"><?php echo $option_4; ?></textarea>
					</div>
				</div>


				<div class="row form-group">
					<div class="col-12 col-sm-3">
						Correct Answer
					</div>
					<div class="col-12 col-sm-9">
						<select name="answer" class="form-control" required="required">
							<?php echo $correct_answer; ?>
							<option>Choose</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
						</select>
					</div>
				</div>



				<div class="row form-group">
					<div class="col-12 col-sm-12">
						
					</div>
				</div>

				</div>

				<div class="panel-footer">
					<button type="submit" name="go" class="btn btn-primary">
							<i class="fa fa-save"></i> SAVE
						</button>
				</div>
			</div>




			</form>

		</div>
		<div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
			<div class="panel panel-primary">
				<div class="panel-heading">Questions</div>
				<div class="panel-body">
					<form method="POST">
						<?php if (isset($_POST['go'])) {
							print_r($_POST);
						} ?>
					<ol>
						<?php
						$tot=$qs->listQuestions($_GET['id']);
						for ($i=0; $i < count($tot); $i++) { 
							echo "<li>".$tot[$i]['question']."
							<ol class='list-group'>
							<li class='list-group-item'><input type='radio' name='".$tot[$i]['question_id']."'  value='".$tot[$i]['option_1']."' checked>&nbsp;&nbsp;".$tot[$i]['option_1']."</li>
							<li class='list-group-item'><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_2']."' >&nbsp;&nbsp;".$tot[$i]['option_2']."</li>
							<li class='list-group-item'><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_3']."' >&nbsp;&nbsp;".$tot[$i]['option_3']."</li>
							<li class='list-group-item'><input type='radio' name='".$tot[$i]['question_id']."' value='".$tot[$i]['option_4']."' >&nbsp;&nbsp;".$tot[$i]['option_4']."</li>
							</ol></li>";
						}
						 ?>
					</ol>
					<button type="submit" name="go">SUBMIT</button>
				</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row"></div>
	<div class="row"></div>
</div>

</body>
</html>