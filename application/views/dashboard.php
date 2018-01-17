<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!--Linking style || linking JS-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/css/mdb.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/js/mdb.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css">
    <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
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
            <div class="navbar-brand navbar-brand-centered"><a href="<?php echo base_url(); ?>dashboard">Controllet</a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-brand-centered">
            <ul class="nav navbar-nav">
                <li><a href="#">Logged in as: <?php print_r($this->session->userdata('email')); ?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url(); ?>/dashboard/profile">My profile</a></li>
                <li><a href="<?php echo base_url(); ?>home_page/logout">Log Out</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <h3>Overview</h3>
    <?php
    if($this->agent->mobile()){
        echo '<a href="'.base_url().'dashboard/custom_bill"><p align="center"><button class="btn btn-lg btn-primary" type="submit">Add a bill</button></p></a>';
        echo '<a href="'.base_url().'dashboard/one_time_bills"><p align="center"><button class="btn btn-lg btn-primary" type="submit">Show onetime bills</button></p></a>';
    }else{?>
      <nav class="navbar navbar-default navbar-no" role="navigation">
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-brand-centered">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Overview</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard/add_new_bill"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp Add a new bill</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard/control_bills"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp All my bills</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard/add_my_income"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbsp;&nbsp;Add My Income</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard/one_time_bills"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbsp;&nbsp;All onetime transactions</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <?php
    }
    ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default heightFix">
                <div class="panel-heading">
                    <h3 class="panel-title">Transaction Last 7 Days</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if ($transactions) {
                        foreach ($transactions as $row) {
                            echo '<div class="col-lg-6 col-sm-12">';
                            echo '<b>Date of transaction: </b><span>' . $row->date_of_transaction . '</span>' . '<br/>';
                            echo '<b>Category: </b><span>' . $row->category_name . '</span>' . '<br/>';
                            echo '<b>Transaction amount: </b><span>' . $row->transaction_amount . '</span>' . '<br/>' . '<br/>';
                            echo '</div>';
                        }
                    } else {
                        echo '<h3 align="center">No transaction data!</h3>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default heightFix">
                <div class="panel-heading">
                    <h3 class="panel-title">Recurring Montly Bills</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if ($bills) {
                        foreach ($bills as $row) {
                            echo '<div class="col-lg-6 col-sm-12">';
                            echo '<b>Date of bill: </b><span>' . $row->recurring_date . '</span>' . '<br/>';
                            echo '<b>Category: </b> <span>' . $row->category_name . '</span>' . '<br/>';
                            echo '<b>Amount to pay: </b><span>' . $row->amount . ' eur</span>' . '<br/>';
                            echo '<b>Description: </b><span>' . $row->description . '</span>' . '<br/>' . '<br/>';
                            echo '<p><a class="btn btn-warning" role="button" href="' . base_url() . 'dashboard/pay_bill/' . $row->id_montly_bills . '">Clear Bill</a></p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<h3 align="center">All bills payed!</h3>';
                    }

                    ?>

                </div>
                <?php if(isset($_GET['rec_bill_add'])){
                    if($_GET['rec_bill_add']=='no'){
                        echo '<p align="center" style="color:red">Recurring Bill could not be added</p>';
                    }
                    else{
                        echo '<p align="center" style="color:green">Recurring Bill was succesfully added</p>';
                    }
                }
                ?>
                <?php if(isset($_GET['rec_bill_payed'])){
                    if($_GET['rec_bill_payed']=='no'){
                        echo '<p align="center" style="color:red">Recurring Bill could not be payed</p>';
                    }
                    else{
                        echo '<p align="center" style="color:green">Recurring Bill was succesfully payed</p>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default heightFix">
                <div class="panel-heading">
                    <h3 class="panel-title">My Budget</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $tot_budget = 0;
                    foreach ($budget as $row) {
                        $tot_budget = $row->budget_amount;
                    }
                    echo '<h3 align="center">Total monthly budget: </h3><p align="center">' . $tot_budget . ' eur' . '<br/>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6" id="myincome">
            <div class="panel panel-default heightFix">
                <div class="panel-heading">
                    <h3 class="panel-title">My Income</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if ($income) {
                        foreach ($income as $row) {
                            echo '<b><h4 align="center">Company: </h4></b><p align="center">' . $row->company . '</p>';
                            echo '<b><h4 align="center">Date of income:</h4></b> <p align="center">' . $row->date_of_monthly_income . '</p>';
                            echo '<b><h4 align="center">Amount of income: </h4></b><p align="center">' . $row->amount_of_monthly_income . ' eur</p>';
                            echo '<b><h4 align="center">Job Category: </h4></b><p align="center">' . $row->job_category . '</p>' . '<br/>';
                            echo '<hr>';
                        }
                    } else {
                        echo '<h3 align="center">No income set, please set an income at add income page!</h3>';
                    }

                    ?>
                    <?php if(isset($_GET['add_new_income'])){
                        if($_GET['add_new_income']=='no'){
                            echo '<p align="center" style="color:red">Income could not be added</p>';
                        }
                        else{
                            echo '<p align="center" style="color:green">Income was succesfully added</p>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default heightFix">
                <div class="panel-heading">
                    <h3 align="center" class="panel-title">Statistics</h3>
                </div>
                <div class="panel-body">
                    <h3 align="center">Compare two months</h3><br><br>
                        <?php echo form_open('dashboard/get_selected_data');?>
                        <?php
                        $option=array();
                        $option[1]="custom";
                        foreach($categories as $category) {
                            $option[$category->id_category] = $category->category_name;
                        }
                        $date=array(
                            '01'=>"January",
                            '02'=>"February",
                            '03'=>"March",
                            '04'=>"April",
                            '05'=>"May",
                            '06'=>"June",
                            '07'=>"July",
                            '08'=>"August",
                            '09'=>"Semptember",
                            '10'=>"October",
                            '11'=>"November",
                            '12'=>"December"
                        );
                        ?>
                        <div class="col-lg-6">
                            <?php
                            echo '<p align="center">';
                            echo form_dropdown('category1',$option,'0','id="cat1"');
                            echo form_dropdown('date1',$date,'0','id="date1"');
                            echo '</p>';
                            ?>
                            <h3 align="center">In this month you spent:</h3>
                            <p align="center" style="font-size: 15pt" id="Amount1"></p>
                        </div>
                        <div class="col-lg-6">
                            <?php
                            echo '<p align="center">';
                            echo form_dropdown('category2',$option,'0','id="cat2"');
                            echo form_dropdown('date2',$date,'0','id="date2"');
                            echo '</p>';
                            ?>
                            <h3 align="center">In this month you spent:</h3>
                            <p align="center" style="font-size: 15pt" id="Amount2"></p>
                        </div>
                    <br><br><br>
                        <?php echo '<p align="center">'.form_submit('submit', 'Submit', "class='submit'").'</p>'; ?>
                        <?php echo form_close();?>
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">

    // Ajax post
    $(document).ready(function() {
        $(".submit").click(function(event) {
            event.preventDefault();
            var cat1 = $("#cat1").val();
            var date1 = $("#date1").val();
            var cat2 = $("#cat2").val();
            var date2 = $("#date2").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "dashboard/get_selected_data",
                dataType: 'json',
                data: {
                    category1: cat1,
                    category2: cat2,
                    date1:date1,
                    date2:date2
                },
                success: function(res) {
                    if (res)
                    {
                        var costSummary1=0;
                        var costSummary2=0;
                        $.each(res[0], function(index, value){
                            costSummary1+=parseInt(value.transaction_amount);
                        });
                        $.each(res[1], function(index, value){
                            costSummary2+=parseInt(value.transaction_amount);
                        });
                        $('#Amount1').text(costSummary1+" eur");
                        $('#Amount2').text(costSummary2+" eur");
                    }
                }
            });
        });
    });
</script>
</body>
</html>