<?php
session_start();
$_SESSION['user']='admin';
$created_by=$_SESSION['user'];
include_once("autoload.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-5 col-md-5 col-xs-5 col-lg-5">
			<?php
			if (isset($_GET['remove'])) {
				$id=$_GET['remove'];
				$lquiz=new quiz("");
				$lquiz->remove($id);
				echo "<script>window.location.href='hom.php';</script>";

			}
			$category_id=$deadline_date=$quizname="";
			if (isset($_GET['edit'])) {
				$id=$_GET['edit'];
				$lquiz=new quiz($id);
				$de=$lquiz->quiz_details_by_id;
				echo $lquiz->quiz_exists_by_id;
				$deadline_date=$de['deadline_date'];
				$quizname=$de['quiz_name'];
				$category_id="<option value='".$de['category_id']."'>".$de['category_id']."</option>";

			}
if (isset($_POST['go'])) {
	extract($_POST);
	
	if (isset($_GET['edit'])) {
		$quiz=new quiz($_GET['edit']);
		
		echo "<div>".$quiz->update($quizname,$deadline_date,$category_id)."</div>";
	}else{
		$quiz=new quiz($quizname);
	echo "<div>".$quiz->create($created_by,$deadline_date,$category_id)."</div>";
}
} ?>
			<form method="POST" class="form" action="<?php if(isset($_GET['edit'])){ echo '?edit='.$_GET['edit']; } ?>">
				<div class="row form-group">
					<div class="col-12 col-sm-3">Class</div>
					<div class="col-12 col-sm-9">
						<select name="category_id" class="form-control" required="required">
							<?php echo $category_id; ?>
							<option value="std 1">Std 1</option>
							<option value="std 2">Std 2</option>
							<option value="std 3">Std 3</option>
							<option value="std 4">Std 4</option>
							<option value="std 5">Std 5</option>
							<option value="std 6">Std 6</option>
							<option value="std 7">Std 7</option>
							<option value="std 8">Std 8</option>
						</select>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-12 col-sm-3">Quiz Title</div>
					<div class="col-12 col-sm-9">
						<input type="text" name="quizname" class="form-control" required="required" value="<?php echo $quizname; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-12 col-sm-3">Deadline Date</div>
					<div class="col-12 col-sm-9">
						<input type="deadline_date" name="deadline_date" class="form-control" required="required" value="<?php echo $deadline_date; ?>">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-12 col-sm-12">
						<button type="submit" class="btn btn-info" name="go">
							<i class="fa fa-save"></i> SAVE
						</button>
					</div>
					
				</div>
			</form>
		</div>
		<div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
			<h3>Quiz Categories</h3><p><hr><p>
		<table class="table" border='1'>
			<thead>
				<tr> <th>S/No.</th> <th>Class</th> <th>Quiz Title</th>  <th>Deadline Date</th> <th>Questions</th> <th>Edit</th> <th>Remove</th></tr>
			</thead>
			<tbody>
			<?php
			$quiz=new quiz("");
			$cat=$quiz->listQuizTypes($created_by);
				for ($i=0; $i <count($cat) ; $i++) { 
					echo "<tr> <td>".$cat[$i]['id']."</td> 
					<td>".$cat[$i]['class']."</td> 
					<td>".$cat[$i]['name']."</td> 

					<td>".$cat[$i]['deadline']."</td> <td><a class='btn btn-info' href='add-question.php?id=".$cat[$i]['id']."'> <i class='fa fa-plus'></i> ADD</a></td>

					<td><a class='btn btn-info' href='?edit=".$cat[$i]['id']."'> <i class='fa fa-edit'></i> UPDATE</a></td>

					<td><a class='btn btn-info' href='?remove=".$cat[$i]['id']."'> <i class='fa fa-trash'></i> Delete</a></td>

					 </tr>";
				}

			 ?>
			</tbody>
		</table>
		</div>
	</div>
</div>
</body>
</html>