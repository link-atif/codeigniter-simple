<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
<div class="container">
		<div class="col-sm-8 mx-auto">
			<div class="text-center tr-text">
				<h1 class="h32b" style="color: #333"><?php echo $this->Preferences_model->getValue('membership_heading');?></h1>
				<div class="p16b"><?php echo $this->Preferences_model->getValue('membership_desc');?></div><?php if($this->session->userdata('user_id')=='') { ?>
					<a href="javascript:;" type="button" onclick="pricingModal('join_now');" class="green-btn pricingBtn1">Start My Free Trial</a>
					<?php }else{ ?>
						<a href="<?php echo base_url() ?>home/favourites" class="green-btn">My Favorites</a>
						<?php } ?>
			</div>
		</div>
	</div>

	<div class="pricing">
		<div class="pricing-header px-3 pt-md-5 pt-md-4 mx-auto text-center w-60 mb-0">
	      	<h1 class="h28b-mont"><?php echo $this->Preferences_model->getValue('membership_heading_2');?></h1>
	      	<div class="p14b"><?php echo $this->Preferences_model->getValue('membership_desc_2');?></div>
	    </div>


	<?php if($this->session->userdata('user_id')=='') { ?>



	    <div class="container ">
	        <div class="row pt-4 w-90 mx-auto justify-content-center mr4">
	  				<?php foreach($plans as $plan){ ?>
	            <div class="col-md-3 col-sm-12 p-0 pricing">
	                <div class="card mb-4 box-shadow">
	                    <div class="">
		                        <img src="<?php echo base_url()?>uploads/slider/<?php 
                        			$picture_name = $this->Common_model->resize($plan->picture_main,291,155);
                        			 echo $picture_name; ?>" class="img-responsive">
	                    </div>
	                    <div class="card-body text-center">
	                        <p><b><?php echo $plan->{'title'};?></b></p>
		                        <h1>$ <?php echo $plan->{'price'};?> /<small><?php echo $plan->{'heading'};?></small></h1>
		                        <div class="about-aed"></div>
		                        <ul class="list-unstyled mt-3 mb-3 ml-0">
		                            <?php echo $plan->{'details'};?>
		                          
		                        </ul>
		                         <?php if($this->session->userdata('user_id')=='') { ?>
		                        <button type="button" class="btn btn-lg btn-block green-btn" onclick="location.href='<?php echo base_url()?>home/checkout/<?php echo $plan->slug?>';"><a class="text-white" >Choose</a></button>
		                        <?php }else{ ?>
		                        	<a class="text-white" ><button type="button" class="btn btn-lg btn-block green-btn" onclick="location.href='<?php echo base_url()?>user/myAccount/<?php echo $plan->slug?>';">Choose</button></a>
		                        	<?php } ?>
	                    </div>
	                </div>
	            </div>

	        		<?php }?>
	        </div>
	    </div>



	<?php }else{ ?>


	   <div class="container">
	        <div class="row pt-4 w-60 mx-auto justify-content-center mr5">
	  				<?php foreach($planssecond as $plan){ ?>
	            <div class="col-md-5 col-sm-12 p-0">
	                <div class="card mb-4 box-shadow">
	                    <div class="">
		                        <img src="<?php echo base_url()?>uploads/slider/<?php 
                        			$picture_name = $this->Common_model->resize($plan->picture_main,291,155);
                        			 echo $picture_name; ?>" class="img-responsive">
	                    </div>
	                    <div class="card-body text-center">
	                        <p><b><?php echo $plan->{'title'};?></b></p>
		                        <h1><b>$ <?php echo $plan->{'price'};?> </b>/<small><?php echo $plan->{'heading'};?></small></h1>
		                        <div class="about-aed"></div>
		                        <ul class="list-unstyled mt-3 mb-3 ml-0">
		                            <?php echo $plan->{'details'};?>
		                          
		                        </ul>
		                          <?php if($this->session->userdata('user_id')=='') { ?>
		                        <button type="button" class="btn btn-lg btn-block green-btn" onclick="location.href='<?php echo base_url()?>home/checkout/<?php echo $plan->slug?>';"><a class="text-white" >Choose</a></button>
		                        <?php }else{ ?>
		                        	<a class="text-white" ><button type="button" class="btn btn-lg btn-block green-btn" onclick="location.href='<?php echo base_url()?>user/myAccount/<?php echo $plan->slug?>';">Choose</button></a>
		                        	<?php } ?>
	                    </div>
	                </div>
	            </div>
	            
	        		<?php }?>
	        </div>
	    </div>
	<?php } ?>

</div>


	<div class="container-fluid my-5">
		<div class="row listen-on-spotify">
			<div class="col-md-6 py-5 pl-74 pr-95">
				<h3 class="h28b"><?php echo $this->Preferences_model->getValue('membership_heading_3');?></h3>
				<div class="mt-3 p16b"><?php echo $this->Preferences_model->getValue('membership_desc_3');?></div>
				<div class="mt-5"><a href="<?php echo base_url('ondemand')?>" class="green-btn">VIEW ONLINE CLASSES</a></div>
			</div>
			<div class="col-md-6 col-sm-12 p-0 my-auto">
                <?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue('picture_membership'),570,384);?>
				<img src="<?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>">
			</div>
		</div>
	</div>

	<div class="container-fluid my-5">
		<div class="row listen-on-spotify">
			<div class="col-md-6 col-sm-12 p-0 pr-45 my-auto">
                <?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue('picture_membership_1'),570,384);?>
				<img src="<?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>">
			</div>
			<div class="col-md-6 py-5 pl-74 pr-95">
				<h3 class="h28b"><?php echo $this->Preferences_model->getValue('membership_heading_4');?></h3>
				<div class="mt-3 p16b"><?php echo $this->Preferences_model->getValue('membership_desc_4');?></div>
				<div class="mt-5"><a href="<?php echo $this->Preferences_model->getValue('spotify_link');?>" target="_blank" class="green-btn">Listen on Spotify</a></div>
			</div>
		</div>
	</div>

	<div class="container-fluid" style="background-color: #127dbd">
		<div class="row">
			<div class="col-lg-10 mx-auto testi">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Carousel indicators -->
					<!-- <ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol> -->   
					<!-- Wrapper for carousel items -->
					<div class="carousel-inner col-md-8 mx-auto">
                        <?php foreach($testimonials as $key => $t){?>
						<div class="carousel-item <?php if($key == 0){ ?> active <?php } ?>">
							<div class="testimonial"><b><?php echo $t->{'testimonial_message'};?></b></div>
							<div class="overview"><b><?php echo $t->{'name'};?></b></div>
						</div>
						<?php }?>
					</div>
					<!-- Carousel controls -->
					<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
						<img src='assets/home/img/back.png'>
					</a>
					<a class="carousel-control-next" href="#myCarousel" data-slide="next">
						<img src='assets/home/img/forward.png'>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>