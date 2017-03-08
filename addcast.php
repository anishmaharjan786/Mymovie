<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/7/2017
 * Time: 5:27 PM
 */
include_once('connection.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Casts</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .data option
        {
            color:darkolivegreen;
        }
    </style>
</head>
<body>
<?php
  if(isset($_POST['save']))
  {
      $name=$_POST['name'];
      $role=$_POST['role'];
      $role_image=$_FILES['roleimage']['name'];
      $save="upload/".$role_image;
      $upload=move_uploaded_file($_FILES['roleimage']['tmp_name'],$save);
      $sql_query="INSERT INTO tbl_role(name, role, role_image) VALUES('$name', '$role', '$role_image')";
      $result=$connection->query($sql_query);
      if($result==true)
      {
          header("location:rolelist.php?addmessage");
      }
      else
      {
          echo "failed";
      }
  }
?>
<div class="container">
    <div class="row">
        <?php
        include('navbar.php');
        ?>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-primary mypan">
                <div class="panel-heading myheading">Movies Casting Group</div>
                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputRole">Role</label>
                            <input list="role" name="role" class="form-control" id="exampleInputrole" placeholder="Select Role">
                            <datalist id="role" class="data">
                                <option value="hero">Hero</option>
                                <option value="heroin">Heroin</option>
                                <option value="villian">Villian</option>
                                <option value="singer">Singer</option>
                                <option value="director">Director</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" name="roleimage" id="exampleInputFile">
                            <p class="help-block">Choose Image of Casts</p>
                        </div>
                        <button type="submit" class="btn btn-success" name="save" style="margin-left:20px; width:100px;">Save</button>
                        <button type="submit" class="btn btn-warning" style="margin-left:20px; width:100px;" formaction="movielist.php">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>

