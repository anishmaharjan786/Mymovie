<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/7/2017
 * Time: 12:23 PM
 */
include_once('connection.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Movie App</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
if(isset($_POST['save']))
{
    $name=$_POST['moviename'];
    $language=$_POST['language'];
    $url=$_POST['url'];
    $releasedate=$_POST['releasedate'];
    $detail=$_POST['detail'];
    $posture=$_FILES['posture']['name'];
    $save='upload/'.$posture;
    $upload=move_uploaded_file($_FILES['posture']['tmp_name'],$save);
    $publish=$_POST['publish'];
    $cast=$_POST['cast'];
    $sql_query="INSERT INTO tbl_moviedetail(movie_name, language, url, release_date, detail, published, image) VALUES('$name', '$language','$url', '$releasedate', '$detail','$publish', '$posture')";
    $result=$connection->query($sql_query);
    if($result>0)
    {
        $lastid=$connection->insert_id;
        foreach($cast as $item)
        {
            $sql1 = "INSERT INTO movieandrole(role_id, movie_id) VALUES('$item','$lastid')";
            $result1 = $connection->query($sql1);
        }
        $sucess['add']="<strong>Sucessfully Inserted</strong>";
        header("location:movielist.php");
    }
    else{
        $failed['add']="Failed To Insert";
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
                    <div class="panel-heading myheading">Add New Movies</div>
                    <div class="panel-body">
                        <?php
                        echo isset($sucess['add'])?$sucess['add']:'';
                        echo isset($failed['add'])?$failed['add']:'';
                        ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputname">Movie Name</label>
                                <input type="text" class="form-control" id="exampleInputname" name="moviename"
                                       placeholder="Movie Name" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlanguage">language</label>
                                <input type="text" class="form-control" id="exampleInputlanguage" name="language"
                                       placeholder="Language" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlanguage">Url For Youtube</label>
                                <input type="text" class="form-control" id="exampleInputlanguage" name="url"
                                       placeholder="Link For Youtube" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputreleasedate">Release Date</label>
                                <input type="date" class="form-control" id="exampleInputdate" name="releasedate" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" name="posture" id="exampleInputFile">
                                <p class="help-block">Choose Posture For Movie</p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputdetail">Details</label>
                                <textarea class="form-conrol col-md-12" name="detail" placeholder="Enter Detail About Movie......" required></textarea>
                            </div>
                            <br>
                            <br>
                                <label for="role">Select Casts</label><br>
                                <?php
                                $sql="SELECT name,role_id FROM tbl_role";
                                $result=$connection->query($sql);
                                if($result)
                                {
                                    foreach($result as $value)
                                    {
                                ?>
                                <input type="checkbox" name="cast[]" value="<?php echo $value['role_id'];?>"style="margin-left:20px;"><span ><?php echo $value['name'];?></span>

                                <?php
                                }

                                }

                                ?>
                            <br>
                            <label for="exampleInputpublish" style="margin-top:20px;">Publish</label><br>
                            <input type="radio" name="publish" value="Published" style="margin-left:20px;">Yes
                            <input type="radio" name="publish" value="Not Published" style="margin-left:20px;">No
                            <br>
                            <br>

                            <button type="submit" class="btn btn-success" name="save" style="margin-left:20px; width:80px;">Save</button>
                            <button type="submit" class="btn btn-danger" name="cancel" style="margin-left:20px;  width:80px;" formaction="index.php">Cancel</button>
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
