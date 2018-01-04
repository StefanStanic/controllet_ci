<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Profile</title>
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
            <div class="navbar-brand navbar-brand-centered"><a href="<?php echo base_url();?>dashboard">Controllet</a></div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-brand-centered">
            <ul class="nav navbar-nav">
                <li><a href="#">Logged in as: <?php print_r($this->session->userdata('email'));?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>/dashboard/profile">My profile</a></li>
                <li><a href="<?php echo base_url();?>home_page/logout">Log Out</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <h2 align="center">Update profile</h2>
    <?php echo '<div class="col-lg-offset-4 col-md-4 col-sm-12 col-xs-12">';?>
    <?php echo form_open_multipart('dashboard/update_profile_validation');?>
    <?php

    foreach ($profile as $row) {

        echo '<p align="center">Full Name: </p>'. form_input(['name' => 'full_name', 'id' => 'full_name', 'class' => 'form-control', 'value' => $row->full_name, 'placeholder' => 'Full Name']);
        echo '<p align="center">Phone Number: </p>'.form_input(['name' => 'phone_number', 'id' => 'phone_number', 'class' => 'form-control', 'value' => $row->phone_number, 'placeholder' => 'Phone Number']);
        echo '<p align="center">City: </p>'.form_input(['name' => 'location_city', 'id' => 'location_city', 'class' => 'form-control', 'value' => $row->location_city, 'placeholder' => 'City']);
        echo '<p align="center">Country: </p>'.form_input(['name' => 'location_country', 'id' => 'location_country', 'class' => 'form-control', 'value' => $row->location_country, 'placeholder' => 'Country']);
        echo '<input type="file" name="userpictures">';
        echo form_hidden('id_user', $row->id_user);
        echo '<br/>';
        echo '<p align="center"><button class="btn btn-lg btn-primary" type="submit">Update Profile</button></p>';
    }
    ?>
    <?php echo form_close();?>
    <?php echo validation_errors(); ?>
    <?php echo "</div>";?>
</div>
</body>
</html>