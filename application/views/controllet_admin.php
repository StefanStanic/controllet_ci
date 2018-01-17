<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin dashboard</title>
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
            <div class="navbar-brand navbar-brand-centered" style="font-size: 15pt"><a href="<?php echo base_url();?>admins/admin_dashboard">Controllet Admin Page!</a></div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-brand-centered">
            <ul class="nav navbar-nav">
                <li><a href="#">Logged in as: <?php print_r($this->session->userdata('admin_username'));?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>admins/logout">Log Out</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <h2 align="center">Welcome to admin dashboard</h2><br>
        <h3 align="center">Edit Categories</h3>
    <?php
    echo ' <table class="table table-hover">
    <thead>
      <tr>
        <th>Category id</th>
        <th>Category name</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>';
if(isset($categories)){
        foreach ($categories as $row){
            echo "<tr>";
            echo '<td>'.$row->id_category.'</td>';
            echo '<td>'.$row->category_name.'</td>';
            echo '<td>'.'<a class="btn btn-danger" role="button" href="'.base_url().'admins/delete_category/'.$row->id_category.'">Delete</a>'.'</td>';
            echo "</tr>";
        }
    }
    echo '
    </tbody>
  </table>';
    echo form_open('admins/add_category');
    echo form_input(['name' => 'category', 'id' => 'category', 'class' => 'form-control', 'value' => set_value('Category'), 'placeholder' => 'Enter new category']);
    echo '<br/>';
    echo '<p align="center"><button class="btn btn-lg btn-primary" type="submit">Add category</button></p>';
    form_close();
    ?>
    <?php if(isset($_GET['category_added'])){
        if($_GET['category_added']=='no'){
            echo '<p align="center" style="color:red">Category was not added</p>';
        }
        else{
            echo '<p align="center" style="color:green">Category was succesfully added</p>';
        }
    }
    ?>
    <br><br>
    <h2 align="center">Current company statistics</h2><br>
    <div class="row">
        <div class="col-lg-4">
            <h3 align="center">Number of users</h3>
            <p align="center"><i style="font-size: 45pt" class="fa fa-user" aria-hidden="true"></i></p>
            <p style="font-size: 25pt" align="center"><?php echo $user_statistics ?></p>
        </div>
        <div class="col-lg-4">
            <h3 align="center">Number of transactions</h3>
            <p align="center"><i style="font-size: 45pt" class="fa fa-money" aria-hidden="true"></i></p>
            <p style="font-size: 25pt" align="center"><?php echo $transactions_statistics ?></p>
        </div>
        <div class="col-lg-4">
            <h3 align="center">Number of recurring bills</h3>
            <p align="center"><i style="font-size: 45pt" class="fa fa-credit-card" aria-hidden="true"></i></p>
            <p style="font-size: 25pt" align="center"><?php echo $bills_statistics ?></p>
        </div>
    </div>
</div>
</body>
</html>