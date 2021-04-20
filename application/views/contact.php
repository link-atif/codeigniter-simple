<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
<script async src='https://www.google.com/recaptcha/api.js'></script>
<div class="container-fluid my-5">
		<div class="row">
			<div class="col-md-6 col-sm-12 p-0">
				<?php $picture_name = $this->Common_model->resize($this->Preferences_model->getValue('picture_contact'),750,600);?>
				<img src="<?php echo base_url() ?>uploads/slider/<?php echo $picture_name; ?>" class="img-responsive pr-45">
			</div>
			<div class="col-md-6 px-5 c-form">
				<div id="for-msg">
            	<div style="clear: both;"></div>
            	<?php if(isset($msg) && $msg!=''){?>
                	<div class="alert alert-success"><?php echo $msg?></div>
            	<?php }?>
            	<?php if(isset($error) && $error!=''){?>
                	<div class="alert alert1 alert-danger"><?php echo strip_tags($error)?></div>
            	<?php }?>
            	</div>
				<h3 class="h18b text-left mt-xs-5"><?php echo $this->Preferences_model->getValue('connect_title');?></h3>
				<form method="post" name="frm" class="contacty-form" id="frm">
					<div class="form-group">
					    <label for="fname">Name</label>
					    <input class="form-control" type="text" id="name" name="name" placeholder="" required value="<?php echo isset($contactDetail['name']) ? $contactDetail['name'] : '';?>" />
					</div>
					<div class="form-group">
					    <label for="email">Email</label>
	    				<input class="form-control" type="email" id="email" name="email" placeholder="" required value="<?php echo isset($contactDetail['email']) ? $contactDetail['email'] : '';?>" />
	    			</div>
					<div class="form-group">
					    <label for="subject">Subject</label>
					    <input class="form-control" type="text" id="subject" name="subject" placeholder="" required value="<?php echo isset($contactDetail['subject']) ? $contactDetail['subject'] : '';?>" />
					</div>
					<div class="form-group">
					    <label for="subject">Message</label>
	    				<textarea id="message" name="message" placeholder="" style="height:107px;border: 0.5px solid rgba(242, 97, 34, 0.5); resize:none; margin-bottom: 29px;" ><?php echo isset($contactDetail['message']) ? $contactDetail['message'] : '';?></textarea>
	    				<div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="g-recaptcha" data-sitekey="6LeYXIAaAAAAAGRUw1wrk0escKK5GEJym3tDEGTF"></div>

                            </div>

                        </div>
	    				<input type="submit" value="SEND MESSAGE" class="green-btn my-3">
	    			</div>
				</form>					
			</div>
		</div>
	</div>
	<section style="background: #FCFBF7;">
<div id="retreats-carousel" class="about-carousel">
        <div class="container-fluid py-5">
            <div class="owl-carousel owl-theme">
                <?php  foreach($instagram as $gram){ 
                 ?>
                <div class="item"><a target="_blank" href="<?php echo $gram->permalink; ?>"><img src="<?php echo $gram->media_url; ?>"></a></div><?php }?>
            </div>
        </div>
    </div>
</section>

	<div id="newsletter">
        <div class="container text-center my-4 p-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3><?php echo $this->Preferences_model->getValue('newsletter_title');?></h3>
                    <div id="newsletter_desc"><p ><?php echo $this->Preferences_model->getValue('newsletter_desc');?></p></div>
                </div>
            </div>
          <div class="row justify-content-center" id="form_fields">
                <div class="col-md-12 col-lg-12">
                     <div style="display: none;" id="forget_error_div11" class="alert alert-danger"></div>
                    <div style="display: none;" id="news_success_message" class="alert alert-success"></div>
                    <form action="" method="">
                        <input type="text" name="uname" id="for_name1" placeholder="Your Name" class="mb-3">
                        <input type="email" name="email" id="for_email1" placeholder="Email Address" class="mb-3">
                        <input type="button" value="Sign Up" id="sign-up" class="mb-3">
                    </form>
                </div>
          </div>
        </div>
    </div><!-- End newsletter Section-->
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
	<?php $this->load->view('common/footer');?>