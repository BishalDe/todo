<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header('Location: index.php');
  exit();
}
?>

<?php
require 'partials/_database.php';
$tablename=$_SESSION['username'];
/*$sql = 'CREATE TABLE IF NOT EXISTS data (sno int(200) auto_increment primary key,title varchar(100) NOT NULL, description varchar(255) NOT NULL,postdate DATETIME)';*/
$sql = "CREATE TABLE IF NOT EXISTS $tablename (sno int(200) auto_increment primary key,title varchar(100) NOT NULL, description varchar(255) NOT NULL,postdate DATETIME)";
$result = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_SESSION['username'];
  $title = $_POST['title'];
  $description = $_POST['desc'];
  if(!($title == '' || $description == '')){
  $sql = "INSERT INTO $name (title,description,postdate) VALUES ('$title','$description',CURRENT_TIMESTAMP());";
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
  }}
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>FAILED!</strong> Please Enter title and Description!!!
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
<?php
require 'partials/_nav.php';
?>
  <div class="container my-5">
    <h1>Welcome <strong><?php echo $_SESSION['username']; ?></strong>..!</h1>  <h3>Add your Notes Here</h3>
    <form action='homepage.php' method='post'> 
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter Title" name="title">
        <small id="emailHelp" class="form-text text-muted">Title For Your Work..!</small>
      </div>
      <div class="form-group">
        <label for="Description">Description</label>
        <textarea class="form-control" id="Description" placeholder="Add Description" rows="3" name="desc"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-4">Add Note</button>
      <button type="reset" class="btn btn-dark my-4">Reset</button>
    </form>
  </div>
  <div class="container">
    <table class="table table-striped table-hover" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Post Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $name = $_SESSION['username'];
        $sql = "SELECT * FROM $name";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        echo '<h5> Total number Of Records : ' . $num . '</h5><br>';
        if ($num > 0) {
          $sno = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                        <th scope="row">' . $sno . '</th>
                        <td>' . $row['title'] . '</td>
                        <td>' . $row['description'] . '</td>
                        <td>' . $row['postdate'] . '</td>
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