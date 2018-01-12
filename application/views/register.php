<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
        <?php echo form_open_multipart('home_page/register_validation');?>
        <?php
        echo form_input(['name' => 'full_name', 'id' => 'full_name', 'class' => 'form-control', 'value' => set_value('full_name'), 'placeholder' => 'Full_name']);
        echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'value' => set_value('email'), 'placeholder' => 'Email']);
        echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']);
        echo form_password(['name' => 'cpassword', 'id' => 'cpassword', 'class' => 'form-control', 'placeholder' => 'Repeat Password']);
        echo form_input(['name' => 'phone', 'id' => 'phone', 'class' => 'form-control', 'value' => set_value('phone'), 'placeholder' => 'Phone']);
        echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control', 'value' => set_value('city'), 'placeholder' => 'City']);
        echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'form-control', 'value' => set_value('country'), 'placeholder' => 'Country']);
        echo '<p align="center">Unesite profilnu sliku:</p>';
        echo '<p align="center"><input type="file" name="userpicture"/></p>';
        echo '<br/>';
        echo '<p align="center"><button class="btn btn-lg btn-primary" type="submit">Register</button></p>';
        ?>
        <?php echo form_close();?>
        <?php echo validation_errors(); ?>
</div>
</body>
</html>