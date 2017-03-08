<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/8/2017
 * Time: 2:57 PM
 */
include_once('connection.php');
ob_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div class="container">
    <?php
    include('navbar.php');
    ?>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-primary mypan">
                <div class="panel-heading myheading">List Of Casting Groups</div>
                <div class="panel-body">
                    <?php
                        echo isset($_GET['delmessage'])?"<strong>Deleted Sucessfully</strong>":'';
                        echo isset($_GET['addmessage'])?"<strong>Sucessfully Added</strong>":'';
                        echo isset($_GET['roleeditmsg'])?"<strong>Updated Sucessfully</strong>": '';
                    ?>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Cast Image</th>
                                <th>Action</th>
                            </tr>
                            <?php
                              $sql_query="SELECT * FROM tbl_role";
                              $result=$connection->query($sql_query);
                              if($result)
                              {
                                  $i=1;
                                  foreach($result as $value)
                                  {
                                      $image=$value['role_image'];
                              ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><a href="castdetail.php?castdetail&id=<?php echo $value['role_id'];?>"><?php echo $value['name'];?></a></td>
                                <td><?php echo $value['role'];?></td>
                                <td><img src="upload/<?php echo $value['role_image'];?> " height="100" width="200"></td>
                                <td><a href="rolelist.php?delete&id=<?=$value['role_id'];?>"><img src="image/delete.png" style="margin-left:5px;"></a>
                                    <a href="editrole.php?edit&id=<?= $value['role_id']?>"><img src="image/edit.png" style="margin-left:20px;"></a></td>
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
     $id=$_GET['id'];
     $sql="DELETE FROM tbl_role WHERE  role_id='$id'";
     $result=$connection->query($sql);
     if($result==true)
     {
         unlink("upload/".$image);
         header("location:rolelist.php?delmessage");
     }
 }
?>
</body>
</html>
