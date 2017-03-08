<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/20/2017
 * Time: 5:41 PM
 */
include_once('connection.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Lists</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
    <?php
    include('navbar.php');
    ?>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-primary mypan">
                <?php
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                    $sql_query="SELECT * FROM tbl_moviedetail WHERE movie_id='$id'";
                    $result=$connection->query($sql_query);
                    foreach($result as $value)
                    {
                 $url="http://www.youtube.com/embed/";
                $youtubeurl=$url.$value['url'];

                ?>
                <div class="panel-heading myheading"><?php echo $value['movie_name'];?></div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <iframe src="<?php echo $youtubeurl; ?>" class="img-responsive col-md-8" style="height:450px;" frameborder="1" allowfullscreen></iframe>
                            <div class="col-md-4">
                                <h2 style="color:darkred">About Movie</h2>
                                <p><h3><?php echo $value['detail'];?></h3></p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-span-12 detail" >
                                <label>Movie Name:</label><span class="text"><?php echo $value['movie_name'];?></span><br>
                                <label>Status:</label> <span class="text"><?php echo $value['published'];?></span><br>
                                <label>Release Date:</label> <span class="text"> <?php echo $value['release_date'];?></span><br>
                                <?php
                                }
                                }
                                ?>
                                <?php
                                $sql_join="SELECT * FROM tbl_role LEFT JOIN movieandrole ON tbl_role.role_id = movieandrole.role_id where movieandrole.movie_id='$id'";
                                $result=$connection->query($sql_join);
                                foreach($result as $item) {
                                    ?>
                                    <label><?php echo $item['role'];?></label>
                                <a class="text" href="castdetail.php?castdetail&id=<?php echo $item['role_id'];?>"> <?php echo $item['name']; ?></a>
                                    <br>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>

