<style type="text/css">
	.modal-backdrop{
		z-index: 0 !important;
	}
</style>
<footer class="ap-footer">
				<div class="container plg0 ap-container">
					<div class="row py-lg-4">
						<div class="col-md-8 col-xs-12 f-left my-2">
							<a id="newsletBtn" class="underline" href="javascript:void(0)" data-toggle="modal" data-target="#newsletModal">Newsletter</a>
							<a href="<?php echo base_url(); ?>journal" class="underline">Journal</a>
							<a href="<?php echo base_url(); ?>connect" class="underline">Contact</a>
							<a href="<?php echo $this->Preferences_model->getValue('spotify_link');?>" target="_blank"><img src="<?php echo base_url(); ?>assets/home/img/spotify.svg" width="20px;" height="19px;" class="hover-op"></a>
							<a href="<?php echo $this->Preferences_model->getValue('insta_link');?>" target="_blank"><img src="<?php echo base_url(); ?>assets/home/img/instagram.svg" width="20px;" height="19px;" class="hover-op"></a>
							<a href="<?php echo $this->Preferences_model->getValue('facebook_link');?>" target="_blank"><img src="<?php echo base_url(); ?>assets/home/img/facebook.svg" width="20px;" height="19px;" class="hover-op"></a>
							<div class="col-sm-12 p-0"><a class="underline" href="<?php echo base_url(); ?>privacy_terms">Privacy & Terms</a></div>
						</div>
						<div class="col-md-4 col-sm-12 text-right my-3 f-right">
							<span>&#169;<?php echo $this->Preferences_model->getValue('footer_copyright')." Site By:";?></span><span>&nbsp &nbsp<a class="" target="_blank" href="https://www.gcc-marketing.com/">GCC MARKETING</a></span>
						</div>
					</div>
				</div>
			</footer>
		</div>
		</div>
		</div>
	</div>
	
<div id="newsletModal" class="newsletModal" style="display: none;">
	<div class="newslet-popup">
		<div class="container">			    			
  			<div id="newsletter">
  				<label for="show" class="close-btn fa fa-times" title="close" id="nclose" onclick="$('#newsletModal').modal('hide');"></label> 
	        	<div class="text-center my-4 py-5">
	            	<div class="row justify-content-center">
	                	<div class="col-lg-12">
	                    	<h3><?php echo $this->Preferences_model->getValue('newsletter_title');?></h3>
	                    	<div class="p-2" id="newsletter_text"><?php echo $this->Preferences_model->getValue('newsletter_desc');?></div>
	                	</div>
	            	</div>
	         		<div class="row justify-content-center" id="form_fields">
	         			<div class="col-lg-12">
                			<div style="display: none; padding-bottom: 10px;" id="news_error_message11" class="alert alert-danger"></div>
			            	<div style="display: none; padding-bottom: 10px;" id="news_success_message11" class="alert alert-success"></div>
	                    	<form action="" method="">
	                        	<input type="text" name="uname" id="for_name11" placeholder="Your Name" class="mb-3 pr-lg-5">
	                        	<input type="email" name="email" id="for_email11" placeholder="And Email Address" class="mb-3 pr-lg-5">
	                        	<input type="button" value="Sign Up" id="sign" onclick="newsleetersyscriptionpopup();" class="mb-3" style="padding-top: 16px">
	                    	</form>
			            </div>
			        </div>
	        	</div>
	    	</div>
		</div>
	</div>
	<script type="text/javascript">
        function newsleetersyscription(){
        		var email = $("#for_email1").val();
      			var name = $("#for_name1").val();
		      	var dataString = {'email':email,'name':name};
		      	if(email==''|| name==''   ){
			        $("#news_success_message").hide();
			        $("#news_error_message").html("Please enter your name and Email address.");
			        $("#news_error_message").show();
		      	}else{
			        $("#news_error_message").hide();
			        $.ajax({
			          type: "POST",
			          url: "<?php echo base_url()?>user/newsletters_subscription",
			          data: dataString,
			          success: function(result){
			            var obj = JSON.parse(result);
			            if(obj.success==true){
			              	$("#form_fields").hide();
	              			$("#newsletter_desc").empty();
	              			$("#newsletter_desc").html('<p>'+obj.message+'</p>');
			              	$('#for_name1').val('');
			              	$('#for_email1').val('');
			            }else{
			              $("#news_error_message").html(obj.message);
			              $("#news_error_message").show();
			            }
			          }
			        });
		      }
      return false; 
        }


    function newsleetersyscriptionpopup(){
    	var email = $("#for_email11").val();
      	var name = $("#for_name11").val();
      	var dataString = {'email':email,'name':name};
      	if(email==''|| name==''){
	        $("#news_error_message11").html("Please enter your name and Email address.");
	        $("#news_error_message11").show();
	    }else{
	        $("#news_error_message").hide();
	        $.ajax({
	          	type: "POST",
	          	url: "<?php echo base_url()?>user/newsletters_subscription",
	          	data: dataString,
	          	success: function(result){
	            var obj = JSON.parse(result);
	            if(obj.success==true){
	            	$("#form_fields").hide();
	              	$('#for_name11').val('');
	              	$('#for_email11').val('');
	              	$("#newsletter_text").empty();
	              	$("#newsletter_text").html('<p>'+obj.message+'</p>');
	            }else{
	              $("#news_error_message11").html(obj.message);
	              $("#news_error_message11").show();
	            }
	          }
	        });
	    }
	    return false; 
	}
</script>

	</div>
</body>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/slick.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/idjp.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/lightbox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/owl-gallery.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function(){
	    $("#sign-up").click(function(){
	      var email = $("#for_email1").val();
	      var name = $("#for_name1").val();
	      var dataString = {'email':email,'name':name};
	      if(email==''|| name==''){
	        $("#forget_error_div11").html("Please enter your name and Email address.");
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
	                $("#form_fields").hide();
	                $("#newsletter_desc").empty();
             		$("#newsletter_desc").html('<p>'+obj.message+'</p>');
          			$('#for_name1').val('');
          			$('#for_email1').val('');
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
<script type="text/javascript">
	// $(".site-nav li").hover(function() {
	// 	alert("afslfjsf");
	// 	function() {
	//         $(this).children(".child-menu").addClass('active');
	//     }, function() {
	//         $(this).children(".child-menu").removeClass('active');
	//     };
	// });
	$(".site-nav li").hover(function () {
	    var data_id = $(this).data('id');
	    $('.child-menu').each(function() {
	        var el = $(this);
	        if(el.attr('id') == data_id){
	        	el.addClass("active");
	            el.show();
	        }else{
	            el.hide();
	        }
	    });
	});
	$(".site-nav li, .child-menu").mouseover(function(){
	  $(".child-menu").addClass("active");
	});
	$(".site-nav li, .child-menu").mouseleave(function(){
	  $(".child-menu").removeClass("active");
	});
	$(document).ready(function() {
		data_id = $('.site-nav-active-new').data('id');
		$('.child-menu').each(function() {
	        var el = $(this);
	        if(el.attr('id') == data_id){
	        	el.addClass("active");
	            el.show();
	        }else{
	            el.hide();
	        }
	    });

        $(".return-button").click(function(){
          $(".sleep").toggleClass("active");
        }); 
      });


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
		      	$("#forgot").hide();
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
	// var pbtn = document.getElementById("pricingBtn");
	var pspan = document.getElementById("pclose-btn");
	
	function pricingModal(trial) {
		$.ajax({
	      	type: "GET",
	      	url: '<?php echo base_url()?>home/plans/'+trial, 
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
	//nbtn.onclick = function() {
		
		/*$.ajax({
	      	type: "GET",
	      	url: '<?php echo base_url()?>home/newsletter', 
	      	success: function(response){
	      	console.log('success');*/
	      	//alert('adf');	
	      	//$("#newsletModal").modal("show");
	      		//newsletter.style.display = "block";
	      		//$('#newsletter').html(response);
    		/*},
	    	error: function(){
	      		console.log('failed');
	    	}
    	});*/
	//}	
	//plans close button
	function closePlans(){
		plans.style.display = "none";
	}
	//forgot page close button
	function closeForgot(){
		forgot.style.display = "none";
	}
	//forgot page close button
	window.onclick = function(event) {
	  if (event.target == fspan) {
	    forgot.style.display = "none";
	  }
	}
	//login page close button
	function closeLogin(){
		$("#login").hide();
	}
	//newsletter close button
	function closeNewslet(){
		$("#newsletter").hide();
	}
    $('#tyCarousel .carousel-item').each(function(){
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
      
        if (next.next().length>0) {
            next.next().children(':first-child').clone().appendTo($(this));
        }
        else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });


    function cancelSubscription() {
    	var r = confirm("Are you suer to cancel your subscription?");
		if (r == true) {
		 	$.ajax({
		      	type: "GET",
		      	url: '<?php echo base_url()?>user/cancelSubscription', 
		      	success: function(response){
		      		if(response.success = true){
		      			window.location.href = '<?php echo  base_url('home/purchase_history'); ?>';
	    			}
	    		},
		    	error: function(){
		      		console.log('failed');
		    	}
	    	}); 
		} else {
		  return false;
		}
	}
        
</script>

 <script type="text/javascript">
    $(document).ready(function(){
        
        $(".thy-slider").slick({
      centerMode: true,
      autoplay: false,
      arrows: true,
      centerPadding: '14%',
      slidesToShow: 1,
       prevArrow: $('.prev'),
        nextArrow: $('.next'),
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '10%',
            slidesToShow: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
    });
        });

</script>

<!-- <script type="text/javascript">
	const scroller = new LocomotiveScroll({
	  el: document.querySelector('[data-scroll-container]'),
	  smooth: true
	});
</script> -->

<script type="text/javascript">
	var loader = document.getElementById("loading");
	window.addEventListener ("load", function() {
	    setTimeout(function(){loader.style.transform = 'translateX(-100%)';}, 500);
	});
</script>
