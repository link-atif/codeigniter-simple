<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.modal-backdrop{
			z-index: 0 !important;
		}
	</style>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Yoga with Emilia | Home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/home/fonts/stylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" href="<?php echo base_url('assets/home/img/Logo.svg') ?>" sizes="32x32" />
    <!-- Theme CSS -->
    <link href="<?php echo base_url(); ?>assets/home/css/style-copy.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/home/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/home/css/home-responsive.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style type="text/css">
    	.f-left a{
    		color: #fff;
    	}
    </style>
</head>
<body>

	<div id="forgot"></div>
	<div id="login"></div>
	<div id="plans"></div>
	<div id="newsletModal" class="newsletModal" style="display: none;">
	<div class="newslet-popup">
		<div class="container">
			    			
  			<div id="newsletter">
  				<label for="show" class="close-btn fa fa-times" title="close" id="nclose" onclick="$('#newsletModal').modal('hide');"></label> 
	        	<div class="text-center my-4 py-5">
	            	<div class="row justify-content-center">
	                	<div class="col-lg-12">
	                    	<h3><?php echo $this->Preferences_model->getValue('newsletter_title');?></h3>
	                    	<div class="" id="newsletter_desc"><?php echo $this->Preferences_model->getValue('newsletter_desc');?></div>
	                	</div>
	            	</div>
	         		<div class="row justify-content-center" id="form_fields">
	         			<div class="col-lg-12">
		            		<div style="display: none;" id="forget_error_div11" class="alert alert-danger"></div>
	                    	<form action="" method="">
	                        	<input type="text" name="uname" id="for_name1" placeholder="Your Name" class="mb-3 pr-lg-5">
	                        	<input type="email" name="email" id="for_email1" placeholder="And Email Address" class="mb-3 pr-lg-5">
	                        	<input type="button" value="Sign Up" id="sign" class="mb-3" style="padding-top: 16px">
	                    	</form>
		                </div>
	          		</div>
	        	</div>
	    	</div>
		</div>
	</div>
	</div>
	<?php if($this->session->userdata('user_id')=='') { ?>
	<div class="booking-mobile">
		<div class="booking-button menu" data-slug="mobile-booking" id="pricingBtn">Join Now</div>
	</div>
	<?php }?>
	<div class="header">
	<?php if($this->session->userdata('user_id')=='') { ?>
		<div id="tNotification-bar">
			<p><?php echo $this->Preferences_model->getValue('trial_headings');?></p>
		</div>
	<?php }?>
		<div class="container-fluid">
			<div class="header-left">
				<div class="header-logo">
					<a class="navbar-brand text-white desktop-only" href="javascript:void(0)">yoga with emilia <img src="<?php echo base_url(); ?>assets/home/img/Logo.svg" class="ml-2"></a>
					<a class="navbar-brand mobile-only" href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/home/img/Logo.svg" class="ml-2"></a>
				</div>
				
				<a class="header-menu-item active" id="newsletBtn" href="javascript:void(0)" data-toggle="modal" data-target="#newsletModal">Newsletter</a>
				<a class="header-menu-item" href="<?php echo base_url(); ?>connect">Contact</a>
			</div>
			<div class="header-right">
				<?php if($this->session->userdata('user_id')=='') { ?>
				<button class="login my-2 my-sm-0 text-white" onclick="loginModal();" type="button"><a>Log In</a></button>
		      	<button class="home-join my-2 my-sm-0 jn-desktop-only" id="pricingBtn1" type="button">Join Now</button> 
		      	<?php }else{ ?>
		      	<ul>
		      		<li class="my-account ml-1 mt-1">
        			<div class="navbar-nav">
			            <div class="nav-item dropdown">

		      		<!-- <button class="btn btn-primary my-2 my-sm-0 jn-desktop-only" onclick="location.href='<?php //echo base_url() ?>home/favourites';" type="button"> -->

		      			<a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown">My Account</a>

		      			<!-- </button> -->

		      		
			                
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
        		</ul>
		      		<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="explore">
		<div class="video-background">
			<!-- <iframe width="100%" height="100%" src="<?php //echo $this->Preferences_model->getValue('home_page_video_link');?>?rel=0&playlist=sdkZu_L39r4&loop=1&modestbranding=1&autohide=1&showinfo=0&controls=0&mute=1&autoplay=1" frameborder="0" allowfullscreen></iframe> --><iframe width="100%" height="100%" src="<?php echo $this->Preferences_model->getValue('home_page_video_link');?>?rel=0&playlist=oJPfCXolmVs&loop=1&modestbranding=0&loop=1&autoplay=1&mute=1&showinfo=0&controls=0" frameborder="0" allowfullscreen sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin allow-top-navigation"></iframe>


			<!-- <video autoplay="" loop="" src="<?php //echo base_url(); ?>uploads/videos/Homepage.mp4" muted="" playsinline="" __idm_id__="977848321"></video> -->
		</div>
		<div class="explore-container container">
			<div class="explore-menu home-menu">
				<a class="explore-menu-item desktop w-underline" href="<?php echo base_url(); ?>about" data-id="about">
				about </a>
				<a class="explore-menu-item desktop w-underline" href="<?php echo base_url(); ?>ondemand" data-id="classes">
				classes </a>
				<a class="explore-menu-item desktop w-underline" href="<?php echo base_url(); ?>memberships" data-id="membership">
				membership </a>
				<a class="explore-menu-item desktop w-underline" href="<?php echo base_url(); ?>retreats" data-id="retreats">
				retreats </a>
				<a class="explore-menu-item desktop w-underline" href="https://<?php echo $this->Preferences_model->getValue('menue_link');?>"><?php echo $this->Preferences_model->getValue('menue_title');?> </a>
				<a href="<?php echo base_url(); ?>ondemand"><button class="mt-4" type="button">view online classes</button></a>
			</div>
			<footer class="footer footer-mobile-only">
				<div class="container-fluid pb-5 mb-3">
					<div class="d-block footer-left f-left">
						<ul>
							<li><a class="a14w" href="<?php echo base_url(); ?>journal">Journal</a></li>
							<li><a class="a14w" href="<?php echo base_url(); ?>connect">Privacy & Terms</a></li>
							<li><a href="<?php echo $this->Preferences_model->getValue('spotify_link');?>" target="_blank"><img src="<?php echo base_url(); ?>assets/home/img/spotify-white.png"></a></li>
							<li><a href="<?php echo $this->Preferences_model->getValue('insta_link');?>" target="_blank" ><img src="<?php echo base_url(); ?>assets/home/img/instagram-white.png"></a></li>
							<li><a href="<?php echo $this->Preferences_model->getValue('facebook_link');?>" target="_blank"><img src="<?php echo base_url(); ?>assets/home/img/fb-white.png"></a></li>
						</ul>
					</div>
					<div class="d-block f-right">
						<span class="text-white">&#169;<?php echo $this->Preferences_model->getValue('footer_copyright')." Site By: ";?></span><span class="text-white"><a class="" target="_blank" href="https://www.gcc-marketing.com/">GCC MARKETING</a></span>
					</div>
				</div>
			</footer>
		</div>
		<div class="explore-menu-text">
			<div class="explore-title"></div>
			<div class="explore-menu-title"><?php echo $this->Preferences_model->getValue('home_page_heading');?></div>
			<div class="explore-menu-description"><p><?php echo $this->Preferences_model->getValue('home_page_desc');?></p></div>
		</div>
		
		<div class="explore-detail" id="about">
                <?php //$picture_name = $this->Common_model->resize($this->Preferences_model->getValue('about_hover_picture'),1920,1080);?>
			<div class="explore-detail-item" style="background-image: url('<?php echo base_url() ?>uploads/slider/<?php echo $this->Preferences_model->getValue('about_hover_picture'); ?>')">
				<div class="explore-inner">
					<div class="explore-title"><?php echo $this->Preferences_model->getValue('about_section_heading');?></div>
					<div class="explore-description"><p><?php echo $this->Preferences_model->getValue('about_section_desc');?></p></div>
				</div>
			</div>
		</div>
		<div class="explore-detail" id="classes">
                <?php //$picture_name = $this->Common_model->resize($this->Preferences_model->getValue('classes_hover_picture'),1920,1080);?>
		   <div class="explore-detail-item" style="background-image: url('<?php echo base_url() ?>uploads/slider/<?php echo $this->Preferences_model->getValue('classes_hover_picture'); ?>')">
				<div class="explore-inner">
					<div class="explore-title"><?php echo $this->Preferences_model->getValue('classes_section_heading');?></div>
					<div class="explore-description"><p><?php echo $this->Preferences_model->getValue('classes_section_desc');?></p></div>
				</div>
			</div>
		</div>
		<div class="explore-detail" id="membership">
                <?php //$picture_name = $this->Common_model->resize($this->Preferences_model->getValue('membership_hover_picture'),1920,1080);?>
			<div class="explore-detail-item" style="background-image: url('<?php echo base_url() ?>uploads/slider/<?php echo $this->Preferences_model->getValue('membership_hover_picture'); ?>'); opacity: 1; ">
				<div class="explore-inner">
					<div class="explore-title" style="opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);"><?php echo $this->Preferences_model->getValue('membership_section_heading');?></div>
					<div class="explore-description" style="opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);"><p><?php echo $this->Preferences_model->getValue('membership_section_desc');?></p></div>
				</div>
			</div>
		</div>
		<div class="explore-detail" id="retreats">
                <?php //$picture_name = $this->Common_model->resize($this->Preferences_model->getValue('retreats_hover_picture'),1920,1080);?>
			<div class="explore-detail-item" style="background-image: url('<?php echo base_url() ?>uploads/slider/<?php echo $this->Preferences_model->getValue('retreats_hover_picture'); ?>'); opacity: 1; ">
				<div class="explore-inner">
					<div class="explore-title" style="opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);"><?php echo $this->Preferences_model->getValue('retreats_section_heading');?></div>
					<div class="explore-description" style="opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);"><p><?php echo $this->Preferences_model->getValue('retreats_section_desc');?></p></div>
				</div>
			</div>
		</div>
		<footer class="footer footer-desktop-only">
			<div class="container-fluid">
				<div class="footer-left f-left">
					<ul>
						<li><a class="a14w w-underline" style="line-height: normal;" href="<?php echo base_url(); ?>journal">Journal</a></li>
						<li><a class="a14w w-underline" style="line-height: normal;" href="<?php echo base_url(); ?>privacy_terms">Privacy & Terms</a></li>

						<style type="text/css">
							.footer-left li a img{
								opacity: 0.5
							}

							.footer-left li a img:hover{
								opacity: 1;
							}
						</style>
						<li><a href="<?php echo $this->Preferences_model->getValue('spotify_link');?>" target="_blank"><img src="<?php echo base_url(); ?>assets/home/img/spotify-white.png"></a></li>
						<li><a href="<?php echo $this->Preferences_model->getValue('insta_link');?>" target="_blank"><img src="<?php echo base_url(); ?>assets/home/img/instagram-white.png"></a></li>
						<li><a href="<?php echo $this->Preferences_model->getValue('facebook_link');?>" target="_blank"><img src="<?php echo base_url(); ?>assets/home/img/fb-white.png"></a></li>
					</ul>
				</div>
				<div class="d-block f-right">
					<span class="text-white">&#169;<?php echo $this->Preferences_model->getValue('footer_copyright')." Site By: ";?></span><span class="text-white"><a class="text-white" target="_blank" href="https://www.gcc-marketing.com/">GCC MARKETING</a></span>
				</div>
			</div>
		</footer>
	</div>
</body>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script type="text/javascript">
	$(".explore-menu a").hover(function () {
	    var data_id = $(this).data('id');
	    $('.explore-detail').each(function() {
	        var el = $(this);
	        if(el.attr('id') == data_id){
	        	el.addClass("active");
	            el.show();
	        }else{
	            el.hide();
	            el.removeClass("active");
	        }
	    });
	});
</script>
<script type="text/javascript">
	///// Login model /////
	var modal = document.getElementById("loginModal");
	var login = document.getElementById("login");
	//var btn = document.getElementById("loginBtn");
	var span = document.getElementById("close-btn");
	function loginModal() {
		$.ajax({
      		type: "GET",
      		url: '<?php echo base_url()?>home/login', 
	      	success: function(response){
		    	console.log('success');
		    	$("#plans").hide();
		      	$("#login").show();
		      	//login.style.display = "block";
		      	$('#login').html(response);
	    	},
			error: function(){
		      console.log('failed');
		    }
    	});
	}
	///// forgot model /////
	var fmodal = document.getElementById("forgotModal");
	var forgot = document.getElementById("forgot");
	//var btn = document.getElementById("loginBtn");
	var fspan = document.getElementById("fclose-btn");
	function forgotModal() {
		$.ajax({
      		type: "GET",
      		url: '<?php echo base_url()?>user/forgotpassword', 
	      	success: function(response){
		    	console.log('success');
		    	$("#login").hide();
		      	$("#forgot").show();
		      	//login.style.display = "block";
		      	$('#forgot').html(response);
	    	},
			error: function(){
		      console.log('failed');
		    }
    	});
	}
	///// Pricing Model ////////////
	var pmodal = document.getElementById("pricingModal");
	var plans = document.getElementById("plans");
	var pbtn = document.getElementById("pricingBtn");
	var pbtn1 = document.getElementById("pricingBtn1");
	var pspan = document.getElementById("pclose-btn");
	var trial = 'join_now';
	pbtn.onclick = function() {
		$.ajax({
	      	type: "GET",
	      	url: '<?php echo base_url()?>home/plans/'+trial, 
	      	success: function(response){
	      	console.log('success');
	      	$("#login").hide();
		    $("#forgot").hide();
	      	plans.style.display = "block";
	      		$('#plans').html(response);
    		},
	    	error: function(){
	      		console.log('failed');
	    	}
    	});
	}
	pbtn1.onclick = function() {
		$.ajax({
	      	type: "GET",
	      	url: '<?php echo base_url()?>home/plans/'+ trial, 
	      	success: function(response){
	      	console.log('success');
	      	plans.style.display = "block";
	      		$('#plans').html(response);
    		},
	    	error: function(){
	      		console.log('failed');
	    	}
    	});
	}
	///// newsletter Model ////////////
	var nmodal = document.getElementById("newsletModal");
	var newsletter = document.getElementById("newsletter");
	var nbtn = document.getElementById("newsletBtn");
	var nspan = document.getElementById("nclose");
	/*nbtn.onclick = function() {
		$.ajax({
	      	type: "GET",
	      	url: '<?php echo base_url()?>home/newsletter', 
	      	success: function(response){
	      	console.log('success');
	      	newsletter.style.display = "block";
	      		$('#newsletter').html(response);
    		},
	    	error: function(){
	      		console.log('failed');
	    	}
    	});
	}
	*///plans close button
	function closePlans(){
		plans.style.display = "none";
	}
	//forgot close button
	function closeForgot(){
		forgot.style.display = "none";
	}
	//fogot close button
	window.onclick = function(event) {
	  if (event.target == fspan) {
	    forgot.style.display = "none";
	  }
	}
	//login close button
	function closeLogin(){
		$("#login").hide();
	}
	//newsletter close button
	function closeNewslet(){
		$("#newsletter").hide();
	}
</script>

<script type="text/javascript">
    $(document).ready(function(){
    	$("#sign").click(function(){
	    	var email = $("#for_email1").val();
	    	var name = $("#for_name1").val();
      		var dataString = {'email':email,'name':name};
		    if(email==''|| name==''   ){
		    	$("#forget_error_div11").html("Name Or Email is missing");
		        $("#forget_error_div11").show();
		    }else{
        		$("#forget_error_div11").hide();
	        	$.ajax({
	          		type: "POST",
	          		url: "<?php echo base_url()?>user/newsletters_subscription",
	          		data: dataString,
	          		success: function(result){
	            		var obj = JSON.parse(result);
	            		if(obj.success==true){
	            			$("#newsletter_desc").empty();
	                 		$("#newsletter_desc").html('<p>'+obj.message+'</p>');
	              			$('#for_name1').val('');
	              			$('#for_email1').val('');
	              			$("#form_fields").hide();
	            		}else{
	              			$("#forget_error_div11").html(obj.message);
	              			$("#forget_error_div11").show();
	            		}
	          		}
	        	});
	      	}
	      	return false;      
	    });
  });
</script>
<script>
  $(document).ready(function () {
    $(".block.child-menu.megamenu.active ul li").hover(
      function () {
        $(this).addClass("child-menu-active");
      },
      function () {
        $(this).removeClass("child-menu-active");
      }
    );
  });
</script>
</html>