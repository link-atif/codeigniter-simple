<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
<div class="container">
		<div class="col-sm-12 col-md-8 mx-auto">
			<div class="text-center tr-text">
				<h1 class="h32b" style="color: #333"><?php echo $this->Preferences_model->getValue('dubai_studio_title');?></h1>
				<div class="p16b"><?php echo $this->Preferences_model->getValue('dubai_studio_desc');?></div>
				<!-- <div class="mt-4"><a href="<?php //echo base_url() ?>connect" class="green-btn">Contact Me</a></div> -->
			</div>
		</div>
	</div>

	<div class="container-fluid my-5">
		<div class="row listen-on-spotify dub-studio">
			<div class="col-md-6  mb-3 plr-50">

				<h5 class="h18-g ml-15">DUBAI CLASS SCHEDULE</h5>
				<?php foreach($dubai_studio as $dubai){ ?>
				<div class="row bg-bianca p-3 mb-3 ">					
					<div class="col-xs-12 col-md-8 text-left">
						<h5 class="h16b"><?php echo $dubai->{'title'};?></h5>					
						<div class="p16b"><?php echo $dubai->{'heading'};?></div>
						<div class="p16b"><?php echo $dubai->{'plan_price'};?></div>
						<div class="p16b"><?php echo $dubai->{'plan_heading'};?></div>
						<div class="p16b"><?php echo $dubai->{'plan_duration'};?></div>
					</div>
					<div class="col-xs-12 col-md-4 text-right pl-0 pr-0">
						<div class="my-5 mx-1"><a target="_blank" href="<?php echo $dubai->{'button_link'};?>" class="px-12 green-btn"><?php echo $dubai->{'button_text'};?></a></div>
					</div>
				</div>
				<?php }?>
			</div>
			<div class="col-md-6 col-sm-12">
                <?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue('picture_table'),570,384);?>
				<img src="<?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>">
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>