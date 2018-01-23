<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset password</title>
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
    <?php echo form_open('/users/check_reset_password');?>
    <?php
    echo form_input(['name' => 'email', 'id' => 'Email', 'class' => 'form-control', 'value' => set_value('email'), 'placeholder' => 'Email']);
    echo '<br/>';
    echo '<p align="center"><button class="btn btn-lg btn-primary" type="submit">Reset Password</button></p>';
    ?>
    <?php if(isset($_GET['emailsent'])){
        if($_GET['emailsent']=='bad'){
            echo '<p align="center" style="color:red">Email not valid, or does not exist</p>';
        }
        else{
            echo '<p align="center" style="color:green">Email valid, if accounts exists, reset password was sent!</p>';
        }
    }
    ?>
    <?php if(isset($_GET['codebad'])){
        if($_GET['codebad']=='yes'){
        echo '<p align="center" style="color:red">Reset password code not valid!</p>';
        }
    }
    ?>
    <?php if(isset($_GET['emailExists'])){
        if($_GET['emailExists']=='bad'){
            echo '<p align="center" style="color:red">This email is not valid, or may not exist!</p>';
        }
    }?>
</div>
</body>
</html>