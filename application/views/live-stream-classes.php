<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
<div class="container">
		<div class="col-sm-12 col-md-8 mx-auto">
			<div class="text-center tr-text">
				<h1 class="h32b" style="color: #333"><?php echo $this->Preferences_model->getValue('live_classes_title');?></h1>
				<div class="p16b"><?php echo $this->Preferences_model->getValue('live_classes_desc');?></div>
				<?php if($this->session->userdata('user_id')=='') { ?>
					<a href="javascript:;" type="button" onclick="pricingModal();" class="green-btn pricingBtn1">Start My Free Trial</a>
					<?php }else{ ?>
						<a href="<?php echo base_url() ?>home/favourites" class="green-btn">My Favourites</a>
						<?php } ?>
				<div id="here"></div>
			</div>
		</div>
	</div>
	<div class="container">
	<div style="clear: both;"></div>
    <?php if(isset($msg) && $msg!=''){?>
        <div class="alert alert-success text-center"><?php echo $msg?></div>
    <?php }?>
    </div>
	<div class="container my-5">
		<h1 class="my-4 text-center h32b"><?php echo $this->Preferences_model->getValue('live_classes_heading');?></h1>
		<div class="row justify-content-center">
			<?php 
                 foreach($live_stream as $row){
             ?>
			<div class="col-md-3 col-sm-12 p-3 mr-md-3 mb-2 class-shedule text-white text-center ">
				<div class="title" style="text-align: center;"><?php echo $row->tittle;?></div>
				<div class="date"><!-- <img src="<?php //echo base_url(); ?>assets/home/img/calendar.png"> --><?php $originalDate = $row->{'days'}; echo $newDate = date("l, jS F", strtotime($originalDate)); ?></div>
				<div class="time"><!-- <img src="<?php //echo base_url(); ?>assets/home/img/clock.png"> --><?php echo $row->time_pdt;?>am PDT / <?php echo $row->time_bst;?>pm BST </div>
				<a href="<?php echo base_url();?>Home/booking/<?php echo $row->id?>" type="button">Book now</a>
			</div>
			<?php }?>
		</div>
	</div>

	<div class="container-fluid my-5">
		<div class="row listen-on-spotify">
			<div class="col-md-6 py-4 pl-lg-5 pr-lg-5">
				<h3 class="h32b text-lg-left"><?php echo $this->Preferences_model->getValue('live_classes_title_2');?></h3>
				<div class="mt-3 p16b"><?php echo $this->Preferences_model->getValue('live_classes_desc_2');?></div>
				<div class="mt-5"><a href="javascript:;" onclick="pricingModal('free');" class="green-btn">JOIN ME LIVE</a></div>
			</div>
			<div class="col-md-6 col-sm-12 p-0 my-auto">
                <?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue('picture_classes'),570,384);?>
				<img src="<?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>">
			</div>
		</div>
	</div>

	<div class="container-fluid my-5">
		<div class="row listen-on-spotify">
			<div class="col-md-6 col-sm-12 p-0 pr-45 my-auto">
                <?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue('picture_classes_2'),570,384);?>
				<img src="<?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>">
			</div>
			<div class="col-md-6 py-4 pl-lg-5 pr-95">
				<h3 class="h32b text-lg-left"><?php echo $this->Preferences_model->getValue('live_classes_title_3');?></h3>
				<div class="mt-3 p16b"><?php echo $this->Preferences_model->getValue('live_classes_desc_3');?></div>
				<div class="mt-5"><a target="_blank" href="<?php echo $this->Preferences_model->getValue('spotify_link');?>" class="green-btn">Listen on Spotify</a></div>
			</div>
		</div>
	</div>

	<div class="container-fluid" style="background-color: #127dbd">
		<div class="row">
			<div class="col-xs-12 col-lg-10 mx-auto testi">
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
							<div class="testimonial"><?php echo $t->{'testimonial_message'};?></div>
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