<?php 
	$page =  $this->uri->segment(1);
 	$picture_value = main_banner($page);
 ?>
<style type="text/css">
	.banner-hero{
	background-image: url(
                <?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue($picture_value),1920,1280);?>
                <?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>);
	background-repeat: no-repeat;
	background-position: center center;
	background-size: cover;
}

.loading h3{
	color: #fff;
	text-transform: lowercase;
	text-align: right;
	margin-top: 15px;
	/*margin-left: -20px;*/

}

</style>
<body>
	<div id="forgot"></div>
	<div id="login"></div>
	<div id="plans"></div>
	<div class="loading" id="loading">
		<div class="logo">
			<img src="<?php echo base_url(); ?>assets/home/img/Logo.svg" alt="logo-full-color">
			<h3>Yoga with emilia</h3>
		</div>
	</div>
	<div class="loader" id="loader" style="display: none;">
		<div class="logo">
			<img src="<?php echo base_url(); ?>assets/home/img/loader.gif" alt="logo-full-color">
		</div>
	</div>

	<div id="fade" onClick="lightbox_close();"></div>
	<!-- <div id="light">
	  <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
	  <video id="VisaChipCardVideo" width="600" controls>
	      <source src="" id="link">
	    </video>
	</div> -->
	<div id="light">
	  <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
	  	<iframe src="" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen;" id="link"></iframe>
	</div>	

	<?php if($this->session->userdata('user_id')=='') { ?>
	<div class="booking-mobile">
		<div class="booking-button menu" data-slug="mobile-booking" id="pricingBtn" onclick="pricingModal('join');">Join Now</div>
	</div>
	<?php }?>
	<div class="main-wrapper-post no-child-menu megamenu">
		<div class="block top-menu megamenu">
			<div class="logo">
				<a href="<?php echo base_url(); ?>"> 
					<img src="<?php echo base_url(); ?>assets/home/img/Logo.svg" alt="logo-full-color">
				</a>
			</div>
			<nav class="active">
				<ul class="site-nav">
					<li class="<?php echo ($page == 'about') ? 'site-nav-active-new': ''  ?>" data-id="about"> <a href="<?php echo base_url(); ?>about">about </a></li>
					<li class="<?php echo ($page == 'ondemand') ? 'site-nav-active-new': ''  ?>" data-id="classes"><a href="<?php echo base_url(); ?>ondemand">classes </a></li>
					<li class="<?php echo ($page == 'memberships') ? 'site-nav-active-new': ''  ?>" data-id="membership"> <a href="<?php echo base_url(); ?>memberships">membership </a></li>
					<li class="<?php echo ($page == 'retreats') ? 'site-nav-active-new': ''  ?>" data-id="retreats"> <a href="<?php echo base_url(); ?>retreats">retreats </a></li>
					<li><a class="" href="https://<?php echo $this->Preferences_model->getValue('menue_link');?>"><?php echo $this->Preferences_model->getValue('menue_title');?> </a></li>
				</ul>
				<div class="other-menu"> </div>
			</nav>
		</div>
		<div class="block child-menu megamenu" id="classes">
			<ul>
				<li><a href="<?php echo base_url(); ?>ondemand" class="w-underline">On Demand</a></li>
		        <li><a href="<?php echo base_url(); ?>live_stream_classes" class="w-underline">LIVE Stream Classes</a></li>
		        <li><a href="<?php echo base_url(); ?>in_studio" class="w-underline">In Studio</a></li>
		        <li><a href="<?php echo base_url(); ?>private_corporate" class="w-underline">Private + Corporate</a></li>
			</ul>
		</div>


		<div class="mobile-header">
			<div class="return-button menu"> 
				<img src="<?php echo base_url(); ?>assets/home/img/prev.svg" alt="prev"> <span>Menu</span> 
			</div>
			<a href="<?php echo base_url(); ?>">
				<div class="logo"> 
					<img class="logo" src="<?php echo base_url(); ?>assets/home/img/Logo.svg" alt="logo-full-color"> 
				</div>
			</a>
		</div>

		<div class="menu mobile sleep">
			<div class="menu-wrapper">
				<div class="nav">
					<div class="return-button"> <img src="<?php echo base_url(); ?>assets/home/img/icon-back-black.svg" alt="icon-back-black"> </div>
					<div class="title">Menu</div>
				</div>
				<div class="menu-mobile-scroller">
					<ul class="list">
						<li class="list-parent"> <a href="<?php echo base_url(); ?>about">about </a> </li>
						<li> <a href="<?php echo base_url(); ?>ondemand">classes </a></li>
						<li> <a href="<?php echo base_url(); ?>memberships">membership </a></li>
						<li> <a href="<?php echo base_url(); ?>retreats">retreats </a></li>
						<li><a class="" href="<?php echo $this->Preferences_model->getValue('menue_link');?>"><?php echo $this->Preferences_model->getValue('menue_title');?> </a></li>
					</ul>
					<ul class="list">
						<li class="list-parent"> <a href="<?php echo base_url(); ?>ondemand">On Demand</a></li>
						<li> <a href="<?php echo base_url(); ?>live_stream_classes">LIVE Stream Classes</a></li>
						<li> <a href="<?php echo base_url(); ?>in_studio">In Studio</a></li>
						<li> <a href="<?php echo base_url(); ?>private_corporate">Private + Corporate</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="header-sticky-btns hidden-md">			
        	<ul class="header-btns">
        		<?php if($this->session->userdata('user_id')=='') { ?>
        		<li class="login">
            		<a class="" href="javascript:void(0)" onclick="loginModal();">Log In</a>
        		</li>
        		<li class="join jn-desktop-only" onclick="pricingModal('join_now');" style="cursor: pointer;">
            		<a class="" href="javascript:void(0)" id="pricingBtn">Join Now</a>
        		</li>
                <?php }else{ ?>
        		<li class="my-account ml-1">
        			<div class="navbar-nav">
			            <div class="nav-item dropdown">
			                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">My Account</a>
			                <div class="dropdown-menu">
			                    <a href="<?php echo base_url(); ?>favourites" class="dropdown-item">Favorites</a>
			                    <a href="<?php echo base_url(); ?>purchase_history" class="dropdown-item">Membership + Billing</a>
			                    <a href="<?php echo base_url(); ?>retreats_book" class="dropdown-item">Retreats</a>
			                    <a href="<?php echo base_url(); ?>change_password" class="dropdown-item">Change Password</a>
			                    <a href="<?php echo base_url(); ?>user/logout" class="dropdown-item">Log Out</a>
			                </div>
			            </div>
			        </div>
        		</li>
        	<?php } ?>
    		</ul>
		</div>

		<div class="block main-content vs-section" >
			<div class="banner-hero" id="about">
				<div class="container">
					<div class="col-sm-12">
						<div class="header-text">
							<h2><?php echo $page_title;?></h2>
						</div>
					</div>
				</div>
			</div>
