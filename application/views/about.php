<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
<style type="text/css">
	
</style>
<div class="container-fluid mt-5">
		<div class="row listen-on-spotify">
			<div class="col-md-6 py-4 py-lg-5 pl-lg-5 pr-lg-5">
				<h3 class="h32b text-md-left"><?php echo $this->Preferences_model->getValue('about_title');?></h3>
				<div class="mt-3 p14b"><?php echo $this->Preferences_model->getValue('about_desc');?></div> 

				<div class="p14b"><?php echo $this->Preferences_model->getValue('about_details');?></div>
			</div>
			<div class="col-md-6 col-sm-12 p-0 my-auto">
                <?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue('picture_about'),570,384);?>
				<img src="<?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>">
			</div>
		</div>
	</div>

	<div class="container-fluid py-5 practice">
		<h2 class="text-center h32b"><?php echo $this->Preferences_model->getValue('about_practice_title');?></h2>
		<div class="row">
            <?php foreach($pages_crud as $page){ 
            //$picture_name = $this->Common_model->resize($page->picture,187,184);
            	?>
			<div class="pr-col about-col-one">
				<a href="<?php echo $page->link;?>">
					<img src="<?php echo base_url()?>uploads/slider/<?php echo $page->picture; ?>" class="img-responsive pwm">
					<div class="txt-p">
						<h2><?php echo $page->title;?></h2>
					</div>
				</a>
			</div>
			<?php }?>
		</div>
	</div>

	<div class="container-fluid mb-5">
		<div class="row listen-on-spotify">
			<div class="col-md-6 col-sm-12 p-0 my-auto">
                <?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue('picture_about_2'),570,384);?>
				<img src="<?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>">
			</div>
			<div class="col-md-6 pl-74 pr-104 spotify-col-2">
				<h3 class="h32b text-md-left"><?php echo $this->Preferences_model->getValue('about_title_2');?></h3>
				<div class="mt-3 p14b"><?php echo $this->Preferences_model->getValue('about_desc_2');?></div>
				<div class="mt-5"><a href="<?php echo base_url() ?>home/ondemand" class="green-btn">START PRACTICING</a></div>
			</div>
		</div>
	</div>

	<div id="newsletter">
        <div class="container text-center mt-75 mb-5 ptb-80">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h3><?php echo $this->Preferences_model->getValue('newsletter_title');?></h3>
                    <div id="newsletter_desc"><p><?php echo $this->Preferences_model->getValue('newsletter_desc');?></p></div>
                </div>
            </div>
          <div class="row justify-content-center" id="form_fields">
                <div class="col-md-12 col-lg-10">
                	<div style="display: none;" id="news_error_message" class="alert alert-danger"></div>
                	<div style="display: none;" id="news_success_message" class="alert alert-success"></div>
                    <form action="" method="">
                        <input type="text" name="uname" id="for_name1" placeholder="Your Name" class="mb-3">
                        <input type="email" name="email" id="for_email1" placeholder="And Email Address" class="mb-3">
                        <input type="button" value="SIGN UP" onclick="newsleetersyscription();" class="mb-3">
                    </form>
                </div>
          </div>
        </div>
    </div><!-- End newsletter Section-->
<section style="background: #FCFBF7;">
    <div id="retreats-carousel" class="about-carousel">
        <div class="container-fluid py-5 ">
            <div class="owl-carousel owl-theme">
                <?php  foreach($instagram as $gram){ ?>
                <div class="item"><a target="_blank" href="<?php echo $gram->permalink;  ?>"><img src="<?php echo $gram->media_url; ?>"></a></div><?php }?>
            </div>
        </div>
    </div>
</section>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/owl.carousel.min.js"></script>
	<script type="text/javascript">
		$('.owl-carousel').owlCarousel({
			stagePadding: 50,
		    loop:true,
		    margin:20,
		    nav:true,
		    navText : ["<img src='./assets/home/img/back.png'>", "<img src='./assets/home/img/forward.png'>"],
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:3
		        }
		    }
		})
	</script>
<script type="text/javascript">
		$('.txt-p').on('mouseover', function(){
			  $(this).parent().find(".pwm").addClass('is-hover');
			}).on('mouseout', function(){
			  $(this).parent().find(".pwm").removeClass('is-hover');
			})
	</script>	
<?php $this->load->view('common/footer');?>