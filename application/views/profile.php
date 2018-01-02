<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <?php
    foreach ($profile as $row){
        if($row->picture==null){

            $picture="/default-profile.png";
        }
        else{
            $picture=$row->picture;
        }
        echo '<p align="center"><img height="150" width="150" src="'.base_url().'pictures/profile_pictures/'.$picture.'"></p>';
        echo '<p align="center" style="font-size: 20pt">Full Name: '.$row->full_name.'</p>';
        echo '<p align="center" style="font-size: 20pt">Email: '.$row->email.'</p>';
        echo '<p align="center" style="font-size: 20pt">Phone Number: '.$row->phone_number.'</p>';
        echo '<p align="center" style="font-size: 20pt">City: '.$row->location_city.'</p>';
        echo '<p align="center" style="font-size: 20pt">Country: '.$row->location_country.'</p>';
        echo '<br>';
        echo '<p align="center"><a class="btn btn-warning" role="button" href="'.base_url().'dashboard/update_profile/'.$row->id_user.'">Edit Profile</a></p>';
    }
    ?>
</div>
</body>
</html>