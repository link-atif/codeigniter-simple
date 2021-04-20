<style type="text/css">
	header{
	background-image: url(<?php echo base_url() ?>uploads/data/<?php echo $this->Preferences_model->getValue('header_picture');?>);
	background-repeat: no-repeat;
	background-position: center center;
	background-size: cover;
}
</style>
<body>
	<div class="main-nav">
      	<ul class="nav">
	        <li><a href="<?php echo base_url(); ?>about">about</a></li>
	        <li><a href="<?php echo base_url(); ?>home/retreats">Retreats</a></li>
	        <li><a href="<?php echo base_url(); ?>home/memberships">Membership</a></li>
	        <li class="active">
	        	<a href="#">classes</a>
	        	<ul class="s-nav">
		        	<li><a href="<?php echo base_url(); ?>home/ondemand">On Demand</a></li>
		        	<li><a href="<?php echo base_url(); ?>home/live_stream">LIVE Stream</a></li>
		        	<li><a href="<?php echo base_url(); ?>home/dubai_studio">In Studio</a></li>
		        	<li><a href="<?php echo base_url(); ?>home/private_corporate">Private & Corporate</a></li>
		        </ul>
	        </li>
	        <li><a href="#"><img src="<?php echo base_url(); ?>assets/home/img/logo.svg"></a></li>
      	</ul>
 	</div>
	<header>
		<nav class="navbar navbar-expand-md">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-expanded="false">
	      		<span class="navbar-toggler-icon"></span>
	      	</button>
	      	<div class="collapse navbar-collapse">
	        	<ul class="navbar-nav ml-auto nav-menu">
	          		<li class="nav-item login">
	            		<a class="" href="<?php echo base_url()?>login">Login</a>
	        		</li>
	        		<li class="nav-item join">
	            		<a class="" href="<?php echo base_url()?>home/plans">Join Now</a>
	        		</li>
	    		</ul>
			</div>
		</nav>
		<div class="container">
			<div class="col-sm-12">
				<div class="header-text">
					<h2><?php echo $page_title;?></h2>
				</div>
			</div>
		</div>
	</header>