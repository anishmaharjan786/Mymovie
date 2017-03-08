<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/8/2017
 * Time: 12:47 PM
 */
include_once('connection.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
if(isset($_GET['remove']))
{
    $image=$_GET['image'];
    $id=$_GET['id'];
    $sql_del="UPDATE tbl_moviedetail SET image='' WHERE movie_id='$id'";
    $result=$connection->query($sql_del);
    unlink("upload/".$image);

}

?>
<?php
if(isset($_POST['edit']) && !empty($_GET['id']))
{
    $id = $_GET['id'];
    $nmoviename=$_POST['moviename'];
    $nlanguage=$_POST['language'];
    $nurl=$_POST['newurl'];
    $nrelease=$_POST['releasedate'];
    $ndetail=$_POST['detail'];
    $npublish=$_POST['publish'];
    $newcast=$_POST['cast'];
    $sql="SELECT image FROM tbl_moviedetail WHERE movie_id='$id'";
    $sucess=$connection->query($sql);
    foreach($sucess as $key)
    {
        $image=$key['image'];
    }
    if($_FILES['newposter']['error']== UPLOAD_ERR_OK)
    {
        unlink("upload/".$image);
        $newposter=$_FILES['newposter']['name'];
        $save="upload/".$newposter;
        $upload=move_uploaded_file($_FILES['newposter']['tmp_name'],$save);

    }
    else{
        $newposter=$image;
    }

    $sql_query="UPDATE tbl_moviedetail SET movie_name='$nmoviename', language='$nlanguage', url='$nurl', release_date='$nrelease',detail='$ndetail',
    published='$npublish', image='$newposter' WHERE movie_id='$id'";
    $result=$connection->query($sql_query);
    if($result==true)
    {    $delete_sql="DELETE FROM movieandrole WHERE movie_id=$id";
         $res=$connection->query($delete_sql);
         foreach($newcast as $value1)
         {
             $insert_sql="INSERT INTO movieandrole(role_id,movie_id) VALUES('$value1', $id)";
             $res1=$connection->query($insert_sql);
         }

        header("location:movielist.php?editmessage");
    }
    else
    {
        $edit['failed']="Edit Failed";
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
                <div class="panel-heading myheading">Edit Movies Detail</div>
                <div class="panel-body">
                    <?php
                    echo isset($edit['failed'])? $edit['failed'] : '';
                    ?>
                    <form method="POST" enctype="multipart/form-data">
                        <?php
                          if(isset($_GET['edit']) && isset($_GET['id']))
                          {
                              $id= $_GET['id'];
                              $sql="SELECT * FROM tbl_moviedetail WHERE movie_id='$id'";
                              $result=$connection->query($sql);
                              if($result)
                              {
                                  foreach($result as $value)
                                  {

                         ?>
                        <div class="form-group">
                            <label for="exampleInputname">Movie Name</label>
                            <input type="text" class="form-control" id="exampleInputname" name="moviename" value="<?php echo $value['movie_name'];?>"
                                   placeholder="Movie Name" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputlanguage">language</label>
                            <input type="text" class="form-control" id="exampleInputlanguage" name="language" value="<?php echo $value['language'];?>"
                                   placeholder="Language" required>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputlanguage">Url For Youtube</label>
                             <input type="text" class="form-control" id="exampleInputlanguage" name="newurl" value="<?php echo $value['url'];?>"
                                   placeholder="Link For Youtube" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputreleasedate">Release Date</label>
                            <input type="date" class="form-control" id="exampleInputdate" name="releasedate" value="<?php echo $value['release_date'];?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" name="newposter" id="exampleInputFile" value="<?php echo $value['image'];?>">
                            <a href="edit.php?remove&image=<?php echo $value['image'];?>&edit&id=<?php echo $value['movie_id'];?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                            <p class="help-block">Remove Image</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdetail">Details</label>
                            <textarea class="form-conrol col-md-12" name="detail" placeholder="Enter Detail About Movie......" required><?php echo $value['detail'];?></textarea>
                        </div>

                        <br><br>
                        <label for="exampleInputpublish" style="margin-top:20px;">Publish</label><br>
                        <input type="radio" name="publish" value="Published" style="margin-left:20px;"<?php if($value['published']=="Published"){echo "checked";}?>>Yes
                        <input type="radio" name="publish"  value="Not Published" style="margin-left:20px;" <?php if($value['published']=="Not Published"){echo "checked";}?>>No
                                      <?php
                                  }
                              }
                          }
                        ?>
                        <br>
                        <br>
                        <label for="role">Select Casts</label><br>
                        <?php
                            $id=$_GET['id'];
                            $sql = "SELECT name,role_id FROM tbl_role";
                            $result = $connection->query($sql);
                            $sql_query = "SELECT role_id FROM movieandrole WHERE movie_id='$id'";
                            $result1=$connection->query($sql_query);
                            $checked = [];
                            foreach ($result1 as $item) {
                                $checked[] = $item['role_id'];
                            }
                            if ($result) {
                                foreach ($result as $value) {
                                    ?>
                                    <input type="checkbox" name="cast[]" value="<?php echo $value['role_id']; ?>"<?php if(in_array($value['role_id'],$checked)){ echo "checked";}?>
                                    ><span><?php echo $value['name']; ?></span>

                                    <?php
                                }
                        }

                        ?>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-success" name="edit" style="margin-left:20px; width:80px;">Save</button>
                        <button type="submit" class="btn btn-danger" name="cancel" style="margin-left:20px;  width:80px;" formaction="movielist.php">Cancel</button>

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
