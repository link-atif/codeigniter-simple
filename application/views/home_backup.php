 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Yoga | Home</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/home/fonts/stylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Theme CSS -->
    <link href="<?php echo base_url(); ?>assets/home/css/style-copy.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/home/css/responsive.css" rel="stylesheet">

    <style type="text/css">
    	.f-left a{
    		color: #fff;
    	}
    	#home-main{
	background-image: url(<?php echo base_url() ?>uploads/data/<?php echo $this->Preferences_model->getValue('home_back_pic');?>);
	background-repeat: no-repeat;
	background-position: center;
	/*background-size: cover;*/
	width: 100%;
}
    </style>
</head>
<body>
	<div id="tNotification-bar">
		<p>Join the Library, FREE for 7 days. [Applicable to both memberships]</p>
	</div>
	<div id="home-main">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar-dark">
	  			<a class="navbar-brand" href="javascript:void(0)">yoga with emilia <img src="<?php echo base_url(); ?>assets/home/img/logo.svg" class="ml-2"></a>
	  			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="true">
	    			<span class="navbar-toggler-icon"></span>
	  			</button>

			  	<div class="navbar-collapse collapse show" id="navb" style="">
			    	<ul class="navbar-nav mr-auto">
			      		<li class="nav-item">
			        		<a class="nav-link" href="<?php echo base_url(); ?>connect">Contact</a>
			      		</li>
			      		<li class="nav-item">
			        		<a class="nav-link" href="javascript:void(0)">Newsletter</a>
			      		</li>
			    	</ul>
			    	<form class="form-inline my-2 my-lg-0">
			      		<button class="btn my-2 my-sm-0 text-white" type="button">Login</button>
			      		<button class="btn btn-primary my-2 my-sm-0" type="button">Join Now</button>
			    	</form>
			  	</div>
			</nav>
			<div id="home-main-content" class="row p-0">
				<div class="col-sm-12 col-md-6 text-left home-menu">
					<a href="<?php echo base_url(); ?>about">about</a>
					<a href="<?php echo base_url(); ?>home/live_stream_classes">classes</a>
					<a href="<?php echo base_url(); ?>home/memberships">membership</a>
					<a href="<?php echo base_url(); ?>home/retreats">retreats</a>
					<a href="#">mentorship</a>
					<a href="<?php echo base_url(); ?>home"><button class="btn btn-success mt-4" type="button">view online classes</button></a>
				</div>
				<div class="col-sm-12 col-md-6 text-white my-auto">
					<div class="col-md-9 ml-auto">
						<h6 class="h20w my-3">Welcome to Yoga with Emilia</h6>
						<p class="p16w">Some text goes here I offer creatively sequenced classes exploring anatomy and breath.<br>
						With a focus on feeling the sensations within a pose rather than making a shape, my classes encourage you to move more deeply, fluidly, and mindfully.<br>
						My flow is a “moving meditation” aimed at purifying the body,  and shifting our awareness to the present moment.</p>
					</div>
				</div>
			</div>
			<footer>
				<div class="row py-4 py-lg-5">
					<div class="col-md-6 col-sm-12 f-left">
						<a href="<?php echo base_url(); ?>home/journal">Journal</a>
						<a href="<?php echo base_url(); ?>connect">Contact</a>
						<a href="<?php echo $this->Preferences_model->getValue('spotify_link');?>"><img src="<?php echo base_url(); ?>assets/home/img/spotify-white.png"></a>
						<a href="<?php echo $this->Preferences_model->getValue('insta_link');?>"><img src="<?php echo base_url(); ?>assets/home/img/instagram-white.png"></a>
						<a href="<?php echo $this->Preferences_model->getValue('facebook_link');?>"><img src="<?php echo base_url(); ?>assets/home/img/fb-white.png"></a>
					</div>
					<div class="col-md-6 col-sm-12 text-right f-right">
						<span>&#169; <?php echo $this->Preferences_model->getValue('footer_text');?> </span><span class="text-white"><a class="text-white" href="<?php echo $this->Preferences_model->getValue('site_by_link');?>"><?php echo $this->Preferences_model->getValue('site_by');?></span>
					</div>
				</div>
			</footer>
		</div>
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>