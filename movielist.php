<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/7/2017
 * Time: 4:55 PM
 */
include_once('connection.php');
ob_start();
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
                   <div class="panel-heading myheading">Movies List</div>
                   <div class="panel-body">
                       <?php
                       echo isset($_GET['deleted'])?"<strong>Deleted Sucessfully</strong>": '';
                       echo isset($_GET['editmessage'])?"<strong>Edited Sucessfully</strong>":'';
                       ?>
                       <div class="table-responsive">
                           <table class="table">
                               <tr>
                                   <th>S.N</th>
                                   <th>Title</th>
                                   <th>Release Date</th>
                                   <th>Langugae</th>
                                   <th>Status</th>
                                   <th>Posture</th>
                                   <th>Action</th>
                               </tr>
                               <?php
                               $sql= "SELECT movie_id,movie_name,release_date, language, published, image from tbl_moviedetail";
                               $result=$connection->query($sql);
                               if($result) {
                                   $i=1;
                                   foreach ($result as $value) {
                                       ?>
                                       <tr>
                                           <td><?php echo $i;
                                               ?></td>
                                           <td><a href="moviedetail.php?detail&&id=<?php echo $value['movie_id'];?>"> <?php echo $value['movie_name']; ?></a></td>
                                           <td><?php echo $value['release_date']; ?></td>
                                           <td><?php echo $value['language'];?></td>
                                           <td><?php echo $value['published']; ?></td>
                                           <td>
                                               <?php
                                               $image=$value['image'];
                                               if(!empty($value['image']))
                                               {
                                                   ?>
                                                   <img src="upload/<?php echo $value['image']?>" height="100" width="200">
                                                        <?php
                                               }
                                               else
                                               {
                                                   ?>
                                                   <img src="image/download.png"  "height="100" width="200">
                                                   <?php
                                               }
                                               ?>
                                           </td>
                                           <td><a href="movielist.php?delete&id=<?=$value['movie_id']?>"><img src="image/delete.png" style="margin-left:5px;"></a>
                                               <a href="edit.php?edit&id=<?= $value['movie_id']?>"><img src="image/edit.png" style="margin-left:20px;"></a></td>
                                       </tr>
                                       <?php
                                       $i++;
                                   }
                               }
                               ?>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
        </div>
</div>
<?php
if(isset($_GET['delete']))
{
    $id = $_GET['id'];
    $sql1="DELETE FROM movieandrole WHERE movie_id='$id'";
    $result1=$connection->query($sql1);
    $sql="DELETE FROM tbl_moviedetail WHERE movie_id='$id'";
    $result=$connection->query($sql);
    if($result>0)
    {
        unlink("upload/".$image);
        header("location:movielist.php?deleted");
    }
    else
    {
        $delete['failed']="<h1>Delete Failed</h1>";
    }
}
?>

<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
