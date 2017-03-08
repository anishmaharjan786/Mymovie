<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/21/2017
 * Time: 5:32 PM
 */
include_once('connection.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Lists</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/flexslider.css">
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
                    $roleid=$_GET['id'];
                    $sql="SELECT * FROM tbl_role WHERE role_id='$roleid'";
                    $result=$connection->query($sql);
                    foreach($result as $item)
                    {
                $rolename=$item['name'];
                $role=$item['role'];
                ?>
                <div class="panel-heading myheading"><?php echo $item['name']."'s";?> Detail</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <img src="upload/<?php echo $item['role_image'];?>" height="200" class="img-responsive">
                            </div>
                            <div class="col-md-6">
                                <label>Name:</label><span class="text"><?php echo $item['name'];?></span><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2><u>Movies Played By <?php echo $item['name'];?></u></h2>
                            <?php
                            }
                            }
                            ?>                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">                                                                  
                            <div class="flexslider col-md-12">
                                      <ul class="slides">
                                            <?php
                                                $sql_query="SELECT tbl_moviedetail.movie_name, tbl_moviedetail.detail, tbl_moviedetail.image from tbl_moviedetail INNER JOIN movieandrole on(tbl_moviedetail.movie_id=movieandrole.movie_id) WHERE movieandrole.role_id='$roleid'";
                                                $sucess=$connection->query($sql_query);
                                                foreach($sucess as $value)
                                                {  
                                                  ?>    
                                        <li>
                                          <img src="upload/<?php echo $value['image'];?>" style="height:500px;">
                                          <div class="">
                                          <label style="display:inline-block; width:150px;font-size:larger;">Movie Name:</label><span class="text"><?php echo $value['movie_name'];?></span><br>
                                          <label style="display:inline-block; width:150px;font-size:larger;">Role:</label><span class="text" style="font-size: larger;"><?php echo $role;?></span><br>
                                          <label style="display:inline-block; width:150px;font-size:larger;">Detail:</label><span class="text" style="font-size: larger;"><?php echo $value['detail'];?></span><br>


                                          </div>
                                        </li>
                                           <?php
                            }  
                            ?>
                                      </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>
// Can also be used with $(document).ready()
$(document).ready(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});
</script>
</body>
</html>
