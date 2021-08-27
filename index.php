<!-- INSERT INTO `notes` (`sno`, `title`, `descscripation`, `tstamp`) VALUES (NULL, 'dont buy book', 'please dont buy book\r\nnot buy book', current_timestamp()); -->


<?PHP

$insert = false;
$update = false;
$delete = false;

// CONECTION TO DATABASE
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// CREATE CONENTATION
$conn = mysqli_connect($servername,$username,$password,$database);

// checking connection
if(!$conn){
  echo "Error to creating <br>".mysqli_connect_error();
}

// connating to from server 
// requesting information 
// echo $_POST['snoEdit'];
// echo $_GET['update'];
// exit();

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete =true;
  $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = $sno ";
  // $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn,$sql);
}

if($_SERVER['REQUEST_METHOD']== 'POST'){
  if(isset($_POST['snoEdit'])){
    // update the recored
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $descscripation = $_POST["descscripationEdit"];

    // sql query to be execute
    $sql = "UPDATE `notes` SET `title`= '$title' , `descscripation`= '$descscripation'  WHERE `notes`.`sno`= $sno";
    //stored connection into variable 
    $result = mysqli_query($conn,$sql);
    if($result){
      $update = true;
    }
    else{
      echo "Eerror updating";
    }
  }
  else{
    // taking inforamtion and stored in variable
    $title = $_POST["title"];
    $descscripation = $_POST["descscripation"];

    // sql query to be execute
    $sql = "INSERT INTO `notes`(`title`,`descscripation`) VALUES ('$title', '$descscripation')";

    //stored connection into variable 
    $result = mysqli_query($conn,$sql);

    // checking 
    if($result){
    // echo "Recored have been insert succesfully <br>";
    $insert = true;
     }else{
    echo "Error ".mysqli_error($conn);
     }
  }
}
?>

<!doctype html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
			crossorigin="anonymous">
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

		<title>PHP CRUD Project-1</title>

	</head>

	<body>

		<!-- Edit modal -->
		<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Editmodal">
Edit modal
</button> -->

		<!-- Edit modal -->
		<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="EditmodalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="EditmodalLabel">EDIT This Note</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
					<form action="/CRUD APPLICATION/index.php" method="POST">
						<div class="modal-body">
							<input type="hidden" name="snoEdit" id="snoEdit">
							<div class="mb-3">
								<label for="title" class="form-label">Note Title
									Here</label>
								<input type="text" class="form-control" id="titleEdit"
									name="titleEdit" aria-describedby="emailHelp">
							</div>
							<div class="form-floating ">
								<div class="mb-3">
									<label for="descscripation">Note
										Descripation</label>
									<textarea class="form-control"
										id="descscripationEdit"
										name="descscripationEdit"
										style="height: 100px"></textarea>
									<label for="floatingTextarea2"></label>
								</div>
							</div>

						</div>
						<div class="modal-footer d-block mr-auto">
							<button type="button" class="btn btn-secondary"
								data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save
								changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="#"><img src="image.png" height="38px" alt=""> </a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page"
								href="/CRUD APPLICATION">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Contact us</a>
						</li>
					</ul>
					<form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search"
							aria-label="Search">
						<button class="btn btn-outline-success" type="submit">Search</button>
					</form>
				</div>
			</div>
		</nav>

		<?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> You notes have been inserted successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
		<?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> You notes have been update  successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
		<?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> You notes have been deleted successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>

		<div class="container my-4">
			<h2>Add A Note</h2>
			<form action="/CRUD APPLICATION/index.php" method="POST">
				<div class="mb-3">
					<label for="title" class="form-label">Note Title Here</label>
					<input type="text" class="form-control" id="title" name="title"
						aria-describedby="emailHelp">
				</div>
				<div class="form-floating ">
					<div class="mb-3">
						<label for="descscripation">Note Descripation</label>
						<textarea class="form-control" id="descscripation" name="descscripation"
							style="height: 100px"></textarea>
						<label for="floatingTextarea2"></label>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Add Note</button>
			</form>
		</div>

		<div class="container my-4">

			<table class="table" id="myTable">
				<thead>
					<tr>
						<th scope="col">S.No</th>
						<th scope="col">Title</th>
						<th scope="col">Descripation</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
  $sql = "SELECT * FROM `notes`";
  $result =mysqli_query($conn,$sql);
  $sno=0;
  while($row = mysqli_fetch_assoc($result)){
    $sno+=1;
    echo " <tr>
    <th scope='row'>".$sno."</th>
    <td>". $row['title']."</td>
    <td>". $row['descscripation']."</td>
    <td><button class='edit btn btn-sm btn-primary' id=". $row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d". $row['sno'].">Delete</button> </td>
  </tr> ";
    
  }
  ?>
				</tbody>
			</table>
		</div>
		<hr>
		<!-- Optional JavaScript; choose one of the two! -->

		<!-- Option 1: Bootstrap Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
			crossorigin="anonymous"></script>

		<!-- Option 2: Separate Popper and Bootstrap JS -->
		<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

		<script src="https://code.jquery.com/jquery-3.6.0.js"
			integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
		</script>
		<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
		<script>
		$(document).ready(function() {
			$('#myTable').DataTable();
		});
		</script>
		<script>
		edits = document.getElementsByClassName('edit');
		Array.from(edits).forEach((element) => {
			element.addEventListener("click", (e) => {
				console.log("edit", );
				tr = e.target.parentNode.parentNode;
				title = tr.getElementsByTagName("td")[0].innerText;
				descscripation = tr.getElementsByTagName("td")[1].innerText;
				console.log(title, descscripation);
				titleEdit.value = title;
				descscripationEdit.value = descscripation;
				snoEdit.value = e.target.id;
				console.log(e.target.id);
				//  myModal.toggle();  
				$('#editmodal').modal('toggle');
			})
		})

		deletes = document.getElementsByClassName('delete');
		Array.from(deletes).forEach((element) => {
			element.addEventListener("click", (e) => {
				console.log("edits", );
				sno = e.target.id.substr(1, )

				//  tr = e.target.parentNode.parentNode;
				//  title = tr.getElementsByTagName("td")[0].innerText;
				//  descscripation = tr.getElementsByTagName("td")[1].innerText;
				if (confirm("Are you sure you want to delete this notes")) {
					console.log("yes");
					window.location = `/CRUD APPLICATION/index.php?delete=${sno}`;
					//  create a from and used  post request  to submit from
				} else {
					console.log("No");
				}

			})
		})
		</script>

	</body>

</html>
