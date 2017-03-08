<?php
/**
 * Created by PhpStorm.
 * User: iu
 * Date: 2/7/2017
 * Time: 4:10 PM
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Navbar</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class col-md-12>
            <nav class="navbar navbar-default mynav">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand myimg"><strong></strong><img src="image/3.jpg"></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="movielist.php?home" style="margin-left:70px;"><strong><i class="fa fa-home fa-2x" aria-hidden="true"></i>Home</strong></a></li>
                            <li><a href="index.php" style="margin-left:70px;"><strong><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i>Add Movies</strong></a></li>
                            <li><a href="addcast.php" style="margin-left:70px;"><strong><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>Add Casts</strong></a></li>
                            <li><a href="rolelist.php" style="margin-left:70px;"><strong><i class="fa fa-list fa-2x" aria-hidden="true"></i>List Of Casting Group</strong></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

        </div>
    </div>

</div>
<?php
if(isset($_GET['home']))
{
}
?>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
