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
    <h2 align="center">Add a Recurring Montly Bill</h2>
    <?php echo '<div class="col-lg-offset-4 col-md-4 col-sm-12 col-xs-12">';?>
        <?php echo form_open('dashboard/new_rec_bill_validation');?>

            <?php
            $options = array(
                '1' => 'Phone',
                '2' => 'Internet',
                '3' => 'Electricity',
                '4' => 'Water',
                '5' => 'Mortgage',
                '6' => 'Car Payment'
            );

            echo form_input(['name' => 'recurring_date', 'id' => 'recurring_date', 'class' => 'form-control', 'value' => set_value('recurring_date'), 'placeholder' => 'Recuring date']);
            echo form_dropdown('category',$options,'Phone');
            echo form_input(['name' => 'amount', 'id' => 'amount', 'class' => 'form-control', 'value' => set_value('amount'), 'placeholder' => 'Amount']);
            echo form_input(['name' => 'description', 'id' => 'description', 'class' => 'form-control', 'value' => set_value('description'), 'placeholder' => 'Description']);
            echo form_hidden('id_user',$this->session->userdata('id'));
            echo '<br/>';
            echo '<p align="center"><button class="btn btn-lg btn-primary" type="submit">Add a bill</button></p>';
            ?>
        <?php echo form_close();?>
    <?php echo validation_errors(); ?>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-datepicker3.min.css">
<script>
    $(document).ready(function(){
        var date_input=$('input[name="recurring_date"]');
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
</body>
</html>