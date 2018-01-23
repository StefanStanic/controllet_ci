<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <!--Linking style || linking JS-->
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default " role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand navbar-brand-centered"><a href="<?php echo base_url();?>home_page">Controllet</a></div>
        </div>
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <?php echo '<div class="col-lg-offset-4 col-md-4 col-sm-12 col-xs-12">';?>
    <?php echo form_open('/home_page/login_validation');?>
       <?php
        echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'value' => set_value('email'), 'placeholder' => 'Email']);
        echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']);
        echo '<br/>';
        echo '<p align="center"><button class="btn btn-lg btn-primary" type="submit">Sign in</button></p>';
    ?>
    <?php if(isset($_GET['updatepass'])){
        if($_GET['updatepass']=='ok'){
            echo '<p align="center" style="color:green">New password has been set! Enjoy your time at Controllet!</p>';
        }
    }

    ?>
    <?php if(isset($_GET['user_login'])){
        if($_GET['user_login']=='no'){
            echo '<p align="center" style="color:red">Username or password not matching!</p>';
        }
    }
    ?>
    <?php echo form_close();?>
    <?php echo '<p align="center">'.validation_errors();'</p> '?>
    <?php echo '<p align="center">Dont have an account? Register<a style="color: #2e6da4" href="';?><?php echo base_url();?><?php echo 'users/register"> here</a></p>';?>
    <?php echo '<p align="center">Forgot your password? Reset <a style="color: #2e6da4" href="';?><?php echo base_url();?><?php echo 'Users/forgotten_password"> here</a></p>';?>
    <?php echo '</div>'?>
</div>
</body>
</html>