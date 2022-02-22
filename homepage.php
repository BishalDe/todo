<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header('Location: index.php');
  exit();
}
?>

<?php
require 'partials/_database.php';
$sql = 'CREATE TABLE IF NOT EXISTS data (sno int(200) auto_increment primary key,name varchar(20) not null,title varchar(100) NOT NULL, description varchar(255) NOT NULL,postdate date not null,posttime time not null)';
$result = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $title = $_POST['title'];
  $description = $_POST['desc'];
  $sql = "INSERT INTO data (title,name,description,postdate,posttime) VALUES ('$title','$name','$description',CURRENT_DATE(),CURRENT_TIME());";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>SUCCESS!</strong> Added Successfully..!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>FAILED!</strong> Not Saved...!!!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do Application</title>
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

</head>

<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">ToDOApplication</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">LOGIN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.instagram.com/bishal_de/" target="_blank">ContactUS</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container my-5">
    <h1>Welcome <?php echo $_SESSION['username']; ?>..!  Add your Notes Here</h1>
    <form action='homepage.php' method='post'> 
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter Title" name="title">
        <small id="emailHelp" class="form-text text-muted">Title For Your Work..!</small>
      </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name" name="name">
      </div>
      <div class="form-group">
        <label for="Description">Description</label>
        <textarea class="form-control" id="Description" placeholder="Add Description" rows="3" name="desc"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-4">Add Note</button>
      <button type="reset" class="btn btn-primary my-4">Reset</button>
    </form>
  </div>
  <div class="container">
    <table class="table table-striped table-hover" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Name</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Post Date</th>
          <th scope="col">Post Time</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = 'SELECT * FROM data';
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        echo '<h5> Total number Of Records : ' . $num . '</h5><br>';
        if ($num > 0) {
          $sno = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                        <th scope="row">' . $sno . '</th>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['title'] . '</td>
                        <td>' . $row['description'] . '</td>
                        <td>' . $row['postdate'] . '</td>
                        <td>' . $row['posttime'] . '</td>
                        <td><button class="edit btn btn-sm btn-primary">Edit</button> <a href="/delete">Delete</a></td>
                  </tr>';
            $sno += 1;
          }
        }
        
        ?>
      </tbody>
    </table>
  </div>

</body>
<script>
    edits=document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=>{
      element.addEventListener('click',(e)=>{
         console.log("edit",e);
      })
    })
  </script>
</html>