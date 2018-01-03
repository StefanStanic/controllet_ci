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
<nav class="navbar navbar-default navbar-nav-custom" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand navbar-brand-centered">Controllet</div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-brand-centered">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">Testemonials</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                $id_user=$this->session->userdata('id');
                if(isset($id_user)){
                    echo '<li><a href="'.base_url().'dashboard">Dashboard</a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>';
                }
                else{
                    echo '<li><a href="'.base_url().'users/register">Register</a></li>
                <li><a href="'.base_url().'users/login">Login</a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>';
                }

                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="first-slide" src="<?php echo base_url();?>pictures/slider1.jpg" alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="second-slide" src="<?php echo base_url();?>pictures/slider2.jpg" alt="Second slide">
            <div class="container">
                <div class="carousel-caption">
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn More</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="third-slide" src="<?php echo base_url();?>pictures/slider3.jpg" alt="Third slide">
            <div class="container">
                <div class="carousel-caption">
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Contact</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->

<div class="container">
    <h2 class="parts-title">About us</h2><br><br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p align="center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto at deleniti eos exercitationem
                expedita explicabo, fugit id illum ipsum laudantium, natus nemo omnis placeat sed, sequi. Beatae dignissimos fuga illo.
            </p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p align="center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto at deleniti eos exercitationem
                expedita explicabo, fugit id illum ipsum laudantium, natus nemo omnis placeat sed, sequi. Beatae dignissimos fuga illo.
            </p>
        </div>
    </div>

    <br><br><br><br><br>
    <h2 class="parts-title">Best Features</h2><br><br>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="thumbnail">
                <img src="<?php echo base_url();?>pictures/calculator.jpeg" alt="...">
                <div class="caption">
                    <h3 align="center">Expenses</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos magni neque ratione sed!
                        Accusantium aspernatur consequuntur cum eligendi, eum, inventore, mollitia
                        nam nisi nobis odio odit pariatur placeat quod veniam?
                    </p>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="thumbnail">
                <img src="<?php echo base_url();?>pictures/use_anywhere.jpeg" alt="...">
                <div class="caption">
                    <h3 align="center">Convinient Design</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos magni neque ratione sed!
                        Accusantium aspernatur consequuntur cum eligendi, eum, inventore, mollitia
                        nam nisi nobis odio odit pariatur placeat quod veniam?
                    </p>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="thumbnail">
                <img src="<?php echo base_url();?>pictures/team.jpeg" alt="...">
                <div class="caption">
                    <h3 align="center">Top-class Team</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos magni neque ratione sed!
                        Accusantium aspernatur consequuntur cum eligendi, eum, inventore, mollitia
                        nam nisi nobis odio odit pariatur placeat quod veniam?
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="thumbnail">
                <img src="<?php echo base_url();?>pictures/24_hour_support.jpg" alt="...">
                <div class="caption">
                    <h3 align="center">24/7 Team</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos magni neque ratione sed!
                        Accusantium aspernatur consequuntur cum eligendi, eum, inventore, mollitia
                        nam nisi nobis odio odit pariatur placeat quod veniam?
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="parts-title">Contact us</h2><br><br>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <iframe width="600" height="350" frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJlcSZ0tZmQ0cRdj7BHKg61Qg&key=AIzaSyCyHcNFFKk0aJS5mQnZLdmsZBXRmBYCKyE "
                        allowfullscreen>
                </iframe>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h3 align="center"><i class="fa fa-map-marker" aria-hidden="true"></i></h3>
                <h3 align="center">Subotica, SU 24000, SRBIJA</h3>
                <h3 align="center"><i class="fa fa-phone" aria-hidden="true"></i></h3>
                <h3 align="center">+381064222222</h3>
                <h3 align="center"><i class="fa fa-envelope" aria-hidden="true"></i></h3>
                <h3 align="center">contact@controllet.com</h3>
            </div>


        </div>

    <br><br>
    </div>
<div class="container container-full" style="background-color: #212121; color:#ffffff;">
    <p align="center">© 2017 Copyright: Controllet.com </p>
</div>


</body>
</html>