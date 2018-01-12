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
    }else{
      echo '
      <nav class="navbar navbar-default navbar-no" role="navigation">
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-brand-centered">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Overview</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard/add_new_bill"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp Add a new bill</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard/control_bills"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp All my bills</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard/add_my_income"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbsp;&nbsp;Add My Income</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>';
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
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default heightFix">
                <div class="panel-heading">
                    <h3 class="panel-title">Statistics</h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <h3 align="center">Statistics of current month spendings!</h3>
                        <canvas id="current_monthly_spending"></canvas>
                    </div>
                    <div class="col-lg-6">
                        <h3 align="center">Statistics of previous month spendings!</h3>
                        <canvas id="previous_monthly_spending"></canvas>
                    </div>
                        <?php

                        /*
                         * Category id's
                         * 1=>Water
                         * 2=>Electricity
                         * 3=>Mortgage
                         * 4=>Phone
                         * 5=>Internet
                         * 6=>Car Payment
                        */
                        //Current month spendings
                        $costPhone = 0;
                        $costInternet = 0;
                        $costElectricity = 0;
                        $costWater = 0;
                        $costMortgage = 0;
                        $costCarPayment = 0;
                        foreach ($current_month_statistics as $row) {
                            foreach ($row as $object) {
                                //                                echo gettype($object->transaction_amount);
                                if ($object->category == "4") {
                                    $costPhone += (int)$object->transaction_amount;
                                } elseif ($object->category == "5") {
                                    $costInternet += (int)$object->transaction_amount;
                                } elseif ($object->category == "2") {
                                    $costElectricity += (int)$object->transaction_amount;
                                } elseif ($object->category == "1") {
                                    $costWater += (int)$object->transaction_amount;
                                } elseif ($object->category == "3") {
                                    $costMortgage += (int)$object->transaction_amount;
                                } else {
                                    $costCarPayment += (int)$object->transaction_amount;
                                }
                            }
                        }
                        //previous month
                        $prevPhone = 0;
                        $prevInternet = 0;
                        $prevElectricity = 0;
                        $prevWater = 0;
                        $prevMortgage = 0;
                        $prevCarPayment = 0;
                            foreach ($previous_month_statistics as $row) {
                                foreach ($row as $object) {
                                    //                                echo gettype($object->transaction_amount);
                                    if ($object->category == "Phone") {
                                        $prevPhone += (int)$object->transaction_amount;
                                    } elseif ($object->category == "Internet") {
                                        $prevInternet += (int)$object->transaction_amount;
                                    } elseif ($object->category == "Electricity") {
                                        $prevElectricity += (int)$object->transaction_amount;
                                    } elseif ($object->category == "Water") {
                                        $prevWater += (int)$object->transaction_amount;
                                    } elseif ($object->category == "Mortgage") {
                                        $prevMortgage += (int)$object->transaction_amount;
                                    } else {
                                        $prevCarPayment += (int)$object->transaction_amount;
                                    }
                                }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var ctxP = document.getElementById("current_monthly_spending").getContext('2d');
    var myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
            labels: ["Phone", "Internet", "Electricity", "Water", "Mortgage", "Car Payment", "Available to spend"],
            datasets: [
                {
                    data: [<?php echo $costPhone?>, <?php echo $costInternet?>, <?php echo $costElectricity?>, <?php echo $costWater?>,
                        <?php echo $costMortgage ?>,<?php echo $costCarPayment ?>,<?php echo $tot_budget?>],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#4D5222", "#FFCC22"],
                    hoverBackgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#4D5222", "#FFCC22"]
                }
            ]
        },
        options: {
            responsive: true
        }
    });
</script>

<script>
    var ctxP = document.getElementById("previous_monthly_spending").getContext('2d');
    var myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
            labels: ["Phone", "Internet", "Electricity", "Water", "Mortgage", "Car Payment"],
            datasets: [
                {
                    data: [<?php echo $prevPhone?>, <?php echo $prevInternet?>, <?php echo $prevElectricity?>, <?php echo $prevWater?>,
                        <?php echo $prevMortgage ?>,<?php echo $prevCarPayment ?>],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#4D5222"],
                    hoverBackgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#4D5222"]
                }
            ]
        },
        options: {
            responsive: true
        }
    });
</script>
</body>
</html>