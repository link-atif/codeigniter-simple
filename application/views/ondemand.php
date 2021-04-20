<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
<style type="text/css">
	.range-slider {
  width: 300px;
  margin: auto;
  text-align: center;
  position: relative;
  height: 4em;
}

.range-slider input[type=range] {
  position: absolute;
  left: 0;
  bottom: 0;
}

input[type=number] {
  border: 1px solid #ddd;
  text-align: center;
  font-size: 1.6em;
  -moz-appearance: textfield;
}

input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

input[type=number]:invalid,
input[type=number]:out-of-range {
  border: 2px solid #ff6347;
}

input[type=range] {
  -webkit-appearance: none;
  width: 100%;
}

input[type=range]:focus {
  outline: none;
}

input[type=range]:focus::-webkit-slider-runnable-track {
  background: #ccc;
}

input[type=range]:focus::-ms-fill-lower {
  background: #ccc;
}

input[type=range]:focus::-ms-fill-upper {
  background: #ccc;
}

input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 3px;
  cursor: pointer;
  animate: 0.2s;
  background: #ccc;
  border-radius: 1px;
  box-shadow: none;
  border: 0;
}

input[type=range]::-webkit-slider-thumb {
  z-index: 2;
  position: relative;
  box-shadow: 0px 0px 0px #000;
  border: 1px solid #f26122;
  height: 10px;
  width: 10px;
  border-radius: 25px;
  background: #f26122;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -4px;
}

.range-slider-text{
	width: 320px;
    margin: 10px auto;
    display: flex;
    justify-content: space-between;

}

</style>
	<div class="wrapper-content">
		<div class="container-fluid p-0 ">
			<div class="col-sm-6 mx-auto">
				<div class="text-center tr-text od-text">
					<h1 class="h32b"><?php echo $this->Preferences_model->getValue('ondemand_heading');?></h1>
					<div class="p14b"><?php echo $this->Preferences_model->getValue('ondemand_desc');?></div>
					<?php if($this->session->userdata('user_id')=='') { ?>
					<a href="javascript:;" type="button" onclick="pricingModal('join_now');" class="green-btn pricingBtn1">Start My Free Trial</a>
					<?php }else{ ?>
						<a href="<?php echo base_url() ?>favourites" class="green-btn">My Favorites</a>
						<?php } ?>
				</div>
			</div>
			<div id="error_here"></div>
			<div class="col-sm-12">
				<div class="text-center">

					<select id="duaration" name="duaration" class="mr-100 mr-50" onchange="filter_duaration()">
						<option>Duration</option>
						<option data-option_value_key="10" value="10">10</option>
						<option data-option_value_key="20" value="20">20</option>
						<option data-option_value_key="30" value="30">30</option>
						<option data-option_value_key="40" value="40">40</option>
						<option data-option_value_key="50" value="50">50</option>
						<option data-option_value_key="60" value="60">60</option>
						<option data-option_value_key="70" value="70">70</option>
						<option data-option_value_key="80" value="80">80</option>
						<option data-option_value_key="90" value="90">90</option>
						<option data-option_value_key="100" value="100">100</option>
						<option data-option_value_key="110" value="100">110</option>
						<option data-option_value_key="120" value="100">120</option>
					</select>
					<select id="style" name="style" class="mr-100 mr-50" onchange="filter_style()">
						<option>Style</option>
						<?php foreach($style as $row){ ?>
						<option data-option_value_key="<?php echo $row->video_style; ?>" value="<?php echo $row->video_style; ?>"><?php echo $row->video_style; ?></option>
						<?php }?>

					</select>
					<select id="diff" name="diff" onchange="filter_difficulti()">
						
						<option>Difficulty</option>
						<?php foreach($difficulity as $row){ ?>
						<option data-option_value_key="<?php echo $row->video_difficulity; ?>" value="<?php echo $row->video_difficulity; ?>"><?php echo $row->video_difficulity; ?></option>
						<?php }?>
					</select>
				</div>
			</div>

			<div id="app">
  				<div class='range-slider'>
    				<input  type="range" value="0" step="1" v-model="sliderMin" id="minSlider" onchange="filterData(this.value, 'min')">
    				<input  type="range" value="100" step="1" v-model="sliderMax" id="maxSlider" onchange="filterData(this.value, 'max')"> 
				</div>
				<div class="range-slider-text">
					<span>0 min</span>
					<span>durtaiton</span>
					<span>90+min</span>
				</div>
			</div>
		<div class="container">
			<div style="display: none; font-size: 20px; margin: 20px 0;"  id="register_error_" class="alert alert-danger"></div>
			<div style="display: none; font-size: 20px; margin: 20px 0;"  id="register_success_" class="alert alert-success"></div>
		</div>


		<div class="container-fluid">
			<div id="filter_Products"></div>
			<div class="row" id="hide_products">
				<?php foreach($home_video as $row){ 
                  //$picture_name = $this->Common_model->resize($row->picture_main,400,318);
                  if($row->videoType == "youtubeLink"){
                  	$video_link = $row->video_link;
                  }
                  else{
                  		$video_link = base_url('uploads/videos/').$row->file_name;
                  }
                  //echo $picture_name;
                  //die();
					?>

				<div class="col-md-4 col-sm-12 mt-5 ">
					<div class="video">
						<img src="<?php echo base_url()?>uploads/slider/<?php echo $row->picture_main; ?>">

						<div class="overlay">
						    <div class="text text-center">
						    <?php 
						    	if (in_array( array('id' => $row->{'id'}), $selectedvideos,TRUE)) {  
						    ?>
                                	<a href="javascript:void(0)" class="pull-right"><img id="like" src="<?php echo base_url(); ?>assets/home/img/like-filled.png"></a>	
						    <?php }else{ 
						    ?> 
						    		<a href="javascript:void(0);" class="pd-add-wish-list pull-right" data-type="plus" data-field="" data-productid='<?php echo $row->{'id'};?>' ><img id="like" src="<?php echo base_url(); ?>assets/home/img/like.png"></a> 
						    <?php } 
						    ?>
						    		<a href="<?php echo $row->{'spotify_link'};?>" target="_blank"><img class="pull-right" src="<?php echo base_url(); ?>assets/home/img/spotify.png" style="width: 19px; height: 19px; margin-right: 7px"></a>
						    <?php 
						    	if($this->session->userdata('user_id')!='' && $this->session->userdata('is_premium') == 1) {
									if($row->videoType == "uploadVideo"){ 
							?>
										<div class="title"><a href="javascript:void(0);" onclick="lightbox_open('<?php echo $row->id ?>','<?php echo $row->file_name ?>')"><?php echo $row->title;?></a></div>
							<?php
									} if($row->videoType == "youtubeLink"){ ?>
									<div class="title"><a href="javascript:;" onclick="lightbox_open('<?php echo $row->id ?>','<?php echo $row->video_link ?>')"><?php echo $row->title;?></a></div>
							<?php   }
								}else if($this->session->userdata('user_id')!='' && $this->session->userdata('is_premium') == 0){
							?>
								<div class="title"><a href="javascript:void(0);" class="resubscribe" ><?php echo $row->title;?></a></div>
							<?php 
								}else{
							?>
								<div class="title"><a href="javascript:void(0);" class="for-video" onclick="pricingModal('join');"><?php echo $row->title;?></a></div>
						    <?php
						    	}
						    ?>
						    	<div class="duration"><?php echo $row->video_duaration; ?></div>
						    	<div class="desc p14w"><?php echo $row->{'description'};?></div>
						    	
						    </div>
						 </div>
						<div class="duration-bright"><?php echo $row->video_duaration; ?></div>
					</div>
				</div>
				<?php }?>
			</div>
			</div>
			<?php if($total_videos > 12){?> 
            <div style="text-align: center!important; margin-top: 60px;" id="load">
                <input type="hidden" name="" id="result_no" value="12">
                <a href="javascript:void(0)" type="button" class="green-btn">MORE CLASSES </a>
            </div>
            <?php }?>
		</div>
	</div>
<?php $this->load->view('common/footer');?>
</body>
	<script src="https://player.vimeo.com/api/player.js"></script>
	<script type="text/javascript">
		function filter_duaration(){
			var duaration = $("#duaration option:selected").attr('data-option_value_key');
			$('#loader').show();
			$.ajax({
                url: "<?php echo base_url()?>home/filterduaration",
                method: "POST",
                data: {
                    duaration: duaration,
                },
                success:function(data){
	                $('#filter_Products').html(data);
	                $('#hide_products').hide();
	                $('#loader').fadeOut(2000);
	                $('#load').hide();
	            }
            });
		}

		function filterData(x, type){
			var duaration = x;
			$('#loader').show();
			var type = type;
			if(type == 'min'){
				$('#maxSlider').val(100);
			}
			if(type == 'max'){
				$('#minSlider').val(0);
			}
			$.ajax({
                url: "<?php echo base_url()?>home/getVideosByDuaration",
                method: "POST",
                data: {
                    duaration: duaration,
                    type: type
                },
	            success:function(data){
	                $('#filter_Products').html(data);
	                $('#hide_products').hide();
	                $('#loader').fadeOut(2000);
	                $('#load').hide();
	            }
            });

		}

		function filter_style(){
			var style = $("#style option:selected").attr('data-option_value_key');
			$('#loader').show();
			$.ajax({
                url: "<?php echo base_url()?>home/filterstyle",
                method: "POST",
                data: {
                    style: style,
                },
                success:function(data){
	                $('#filter_Products').html(data);
	                $('#hide_products').hide();
	                $('#loader').fadeOut(2000);
	                $('#load').hide();
	            }
            });
		}

		function filter_difficulti(){
			var diff = $("#diff option:selected").attr('data-option_value_key');
			$('#loader').show();
			$.ajax({
	            url: "<?php echo base_url()?>home/filterdiff",
	            method: "POST",
	            data: {
	                diff: diff,
	            },
	            success:function(data){
		            $('#filter_Products').html(data);
		            $('#hide_products').hide();
		            $('#loader').fadeOut(2000);
		            $('#load').hide();
		        }
	    	});
		}
		</script>
		<script type="text/javascript">
        $(document).on('click','.pd-add-wish-list',function() {
        	var product_id = $(this).data("productid");
            
            var fav = '<?php echo $this->session->userdata('fav') ?>';
            var type = '<?php echo $typeruser ?>';
            var id = '<?php echo $this->session->userdata('user_id') ?>';
        	 if (type == 'Week' && fav > 1) {        
		            $("#register_error_").html("You can only watch one video in a week ");
		            $("#register_error_").show();
		            $('html, body').animate({
		     		   scrollTop: $("#error_here").offset().top
		   			 }, 500);
		            setTimeout(function(){
   					window.location.reload(1);
					}, 500);
		            return false;
		        }
             if (id=='') {        
	            $("#register_error_").html("Please log in first to add this class to your favorites.");
	            $("#register_error_").show();
	            $('html, body').animate({
	     		   scrollTop: $("#error_here").offset().top
	   			}, 1000);
	   			/*setTimeout(function(){
   					window.location.reload(1);
					}, 500);*/
	   			return false;
	   		}


            
            
	        
             $.ajax({
                url: "<?php echo base_url()?>user/add_to_wishlist",
                method: "POST",
                data: {
                    product_id: product_id,
                    type: id
                    
                },
                success: function(result) {
                    var obj = JSON.parse(result);
                    if(obj.success==true){
                    $("#register_success_").html("This class has been added to your favorites");

                    $("#register_success_").show();
                    $('html, body').animate({
     		   			scrollTop: $("#error_here").offset().top
   			 		}, 500);
   			 		setTimeout(function(){
   					window.location.reload(1);
					}, 500);
					return true;
                }else{
                	$("#register_success_").html("Already Exists In Favourites");

                    $("#register_success_").show();
                    $('html, body').animate({
     		   			scrollTop: $("#error_here").offset().top
   			 		}, 500);
   			 		
					return false;
                }

            }
                    //$('#addon_cart').html(obj.cart_item);
                
            });
             return false;
      });
      
      </script>


      <script type="text/javascript">
      	window.document.onkeydown = function(e) {
		  if (!e) {
		    e = event;
		  }
		  if (e.keyCode == 27) {
		    lightbox_close();
		  }
		}

		function lightbox_open(video_id,filename) {
			var type = '<?php echo $this->session->userdata('type'); ?>';
			var video_id = video_id;
			if(type == "weekly"){
				$.ajax({
		    		type: 'post',
		    		url: "<?php echo base_url()?>Home/checkSelectedVideo",
		    		data: { video_id : video_id},
		    		success: function (response) {
		    			var obj = JSON.parse(response);
			    		if(obj.success == false){
				    		$("#register_error_").html("Please upgrade your subscription!");
				            $("#register_error_").show();
				            $('html, body').animate({
				     		   scrollTop: $("#error_here").offset().top
				   			}, 500);
		   				}else{
		   					playVideo(filename);
		   				}
		   			}
		   		});
			}else{
				playVideo(filename);
			}
		}

		function playVideo(filename){
			$('#loader').show();
			var src = filename; //"<?php //echo base_url('uploads/videos/') ?>" + filename;
		  	//var lightBoxVideo = document.getElementById("VisaChipCardVideo");
		  	var source = document.getElementById("link");
		  	document.getElementById('light').style.display = 'block';
		  	document.getElementById('fade').style.display = 'block';
			source.setAttribute('src', src);
			$('#loader').fadeOut(2000);
			/*var iframe = document.querySelector('iframe');
    		var videoPlayer = new Vimeo.Player(iframe);
			videoPlayer.play();*/
			//lightBoxVideo.load();
			//lightBoxVideo.play();
		  
		  	/*setTimeout(function(){
          		source.removeAttribute('src');   
         	}, 3000);*/
		}

		function lightbox_close() {
		  //var lightBoxVideo = document.getElementById("VisaChipCardVideo");
		  var iframe = document.querySelector('iframe');
    	  var videoPlayer = new Vimeo.Player(iframe);
		  document.getElementById('light').style.display = 'none';
		  document.getElementById('fade').style.display = 'none';
		  videoPlayer.unload();
		  var source = document.getElementById("link");
		  source.removeAttribute('src');
		  //lightBoxVideo.pause();
		}
    </script>
   	 <!-- <script>
	    $(".play-1").yu2fvl();
	</script> -->
			<script type="text/javascript">
		        /*$(document).on('click','.for-video',function() { 
		            $("#register_error_").html("Please Login to watch video!");
		            $("#register_error_").show();
		            $('html, body').animate({
		     		   scrollTop: $("#error_here").offset().top
		   			}, 500);
		      	});*/

		        $(document).on('click','.resubscribe',function() { 
		            $("#register_error_").html("Please upgrade your subscription");
		            $("#register_error_").show();
		            $('html, body').animate({
		     		   scrollTop: $("#error_here").offset().top
		   			}, 500);
		      	});
	 </script>
<script type="text/javascript">
  	$(document).ready(function(){
        count_total_news();
    	$("#load").click(function(){ 
      		loadmore();
    	}); 
  	});

  	function loadmore(){
  		var val = document.getElementById("result_no").value;
    	$.ajax({
    		type: 'post',
    		url: "<?php echo base_url()?>Home/loadmoredata",
    		data: { val:val },
    		success: function (response) {
	    		var content = document.getElementById("hide_products");
	    		content.innerHTML = content.innerHTML+response;
	    		document.getElementById("result_no").value = Number(val)+12;
	    		count_total_news();
	    		$(".play-1").yu2fvl();
   			}
   		});
  	}

  	function count_total_news(){
    	total = $("#result_no").val();
    	total_media = '<?php echo $total_videos ?>';
    	if(Number(total) > Number(total_media)){
      		$("#total_media").html(total_media);
    	}else{
      		$("#total_media").html(total);
    	}
    	if(Number(total) >= Number(total_media)){
    		$("#load").hide();	
    	}
  	}

</script>