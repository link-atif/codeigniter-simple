<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
	<div class="container">
		<div class="col-sm-12">
			<div class="text-center tr-text">
				<h1 class="h32b"><?php echo $this->Preferences_model->getValue('live_title');?></h1>
				<div class="p16b"><?php echo $this->Preferences_model->getValue('live_desc');?></div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row justify-content-center">
        	 <?php 
                 foreach($live_stream as $row){
             ?>
			<div class="col-md-3 col-sm-12 p-3 mr-md-3 mb-2 class-shedule text-white text-center">
				<div class="h18w" style="text-align: center;"><?php echo $row->tittle;?></div>
				<p><!-- <img src="<?php //echo base_url(); ?>assets/home/img/calendar.png"> --><?php echo $row->days;?></p>
				<p><!-- <img src="<?php //echo base_url(); ?>assets/home/img/clock.png"> --><?php echo $row->time_pdt;?>am PDT / <?php echo $row->time_bst;?>pm BST </p>
				<a href="#" type="submit">Book now</a>
			</div>
			<?php }?>
		</div>
	</div>

	<div class="container my-5">
		<div class="row listen-on-spotify">
			<div class="col-md-6 col-sm-12 p-0 my-auto">
				<img src="<?php echo base_url() ?>uploads/data/<?php echo $this->Preferences_model->getValue('picture_1');?>">
			</div>
			<div class="col-md-6 py-4 pl-lg-5">
				<h3 class="h32b"><?php echo $this->Preferences_model->getValue('live_title_2');?></h3>
				<div class="mt-3 h14b"><?php echo $this->Preferences_model->getValue('live_desc_2');?></div>
				<div class="mt-4"><a href="#" class="green-btn">Listen on Spotify</a></div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
