<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/8/2017
 * Time: 3:36 PM
 */
include_once('connection.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
  if(isset($_POST['save']) && isset($_GET['id']))
  {
      $id=$_GET['id'];
      $nname=$_POST['name'];
      $nrole=$_POST['role'];
      $sql="UPDATE tbl_role SET name='$nname', role='$nrole' WHERE role_id='$id'";
      $result=$connection->query($sql);
      if($result==true)
      {
          header("location:rolelist.php?roleeditmsg");
      }
      else
      {
          $failed['edit']="Edit Failed";
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
                <div class="panel-heading myheading">Edit Role</div>
                <div class="panel-body">
                    <?php
                    echo isset($failed['edit'])? $failed['edit'] : '';
                        ?>
                    <form method="POST">
                        <?php
                          if(isset($_GET['edit'])&& isset($_GET['id']))
                          {
                              $id=$_GET['id'];
                              $sql_query="SELECT * FROM tbl_role WHERE role_id='$id'";
                              $result=$connection->query($sql_query);
                              if($result==true)
                              {
                                  foreach($result as $value)
                                  {
                        ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName" name="name" value="<?php echo $value['name'];?>" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputRole">Role</label>
                            <input list="role" name="role" class="form-control" id="exampleInputrole" placeholder="Select Role" value="<?php echo $value['role'];?>">
                            <datalist id="role" class="data">
                                <option value="hero">Hero</option>
                                <option value="heroin">Heroin</option>
                                <option value="villian">Villian</option>
                                <option value="singer">Singer</option>
                                <option value="director">Director</option>
                            </datalist>
                        </div>
                        <button type="submit" class="btn btn-success" name="save" style="margin-left:20px; width:100px;">Save</button>
                        <button type="submit" class="btn btn-warning" style="margin-left:20px; width:100px;" formaction="movielist.php">Cancel</button>
                    <?php

                                  }
                              }
                          }
                        ?>
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
