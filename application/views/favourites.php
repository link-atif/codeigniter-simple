<?php $this->load->view('common/common-header'); ?>
<?php $this->load->view('common/header'); ?>
	<div class="container-fluid">
			<div class="row">
				<?php if (!empty($favourites)) {?>
				<?php foreach($favourites as $row){ 
                  //$picture_name = $this->Common_model->resize($row['picture_main'],400,318);
                   ?>
				<div class="col-md-4 col-sm-12 mt-5">
					<div class="video">
						<img src="<?php echo base_url()?>uploads/slider/<?php echo $row['picture_main']; ?>">
						<div class="overlay">
						    <div class="text text-center">
						    	<a href="javascript:void(0)" class="pull-right"><img id="like" src="<?php echo base_url(); ?>assets/home/img/like-filled.png"></a>
						    	<a href="<?php echo $row['spotify_link'];?>" target="_blank"><img class="pull-right" src="<?php echo base_url(); ?>assets/home/img/spotify.png" style="width: 19px; height: 19px;margin-right: 5px"></a>
						    	<?php 
						    	if($this->session->userdata('user_id')!='' && $this->session->userdata('is_premium') == 1) {
									if($row['videoType'] == "uploadVideo"){ 
							?>
										<div class="title h18w px-5"><a href="javascript:void(0);" onclick="lightbox_open('<?php echo $row["id"] ?>','<?php echo $row["file_name"] ?>')"><?php echo $row['title'];?></a></div>
							<?php
									} if($row['videoType'] == "youtubeLink"){ ?>
									<div class="title h18w px-5"><a href="javascript:;" onclick="lightbox_open('<?php echo $row['id'] ?>','<?php echo $row['video_link'] ?>')"><?php echo $row['title'];?></a></div>
							<?php   }
								}else if($this->session->userdata('user_id')!='' && $this->session->userdata('is_premium') == 0){
							?>
								<div class="title h18w px-5"><a href="javascript:void(0);" class="resubscribe" ><?php echo $row['title'];?></a></div>
							<?php 
								}else{
							?>
								<div class="title h18w px-5"><a href="javascript:void(0);" class="for-video" ><?php echo $row['title'];?></a></div>
						    <?php
						    	}
						    ?>
						    	<div class="duration"><?php echo $row['video_duaration']; ?></div>
						    	<div class="desc p14w"><?php echo $row['description'];?></div>
						    	
						    </div>
						 </div>
						<div class="duration-bright"><?php echo $row['video_duaration']; ?></div>
					</div>
				</div>
				<?php }?>
				<?php }else{ ?>
				<p style="font-size: 30px; text-align: center; margin-top: 40px; margin-left: 450px;">You have not selected any favorite classes yet.</p>
			<?php } ?>
			</div>
		</div>

	<?php $this->load->view('common/footer');?>
</body>
	<script src="https://player.vimeo.com/api/player.js"></script>
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
				var src = filename; //"<?php echo base_url('uploads/videos/') ?>" + filename;
			  	//var lightBoxVideo = document.getElementById("VisaChipCardVideo");
			  	var source = document.getElementById("link");
			  	document.getElementById('light').style.display = 'block';
			  	document.getElementById('fade').style.display = 'block';
				source.setAttribute('src', src);
				//lightBoxVideo.load();
				//lightBoxVideo.play();
			  	/*setTimeout(function(){
	          		source.removeAttribute('src');   
	         	}, 3000);*/
			}

			function lightbox_close() {
			var iframe = document.querySelector('iframe');
    		var videoPlayer = new Vimeo.Player(iframe); 
			  //var lightBoxVideo = document.getElementById("VisaChipCardVideo");
			  document.getElementById('light').style.display = 'none';
			  document.getElementById('fade').style.display = 'none';
			  //lightBoxVideo.pause();
			  videoPlayer.unload();
			}
	      </script>

	    <!-- <script>
		  $(".play-1").yu2fvl();
		</script> -->

		<script type="text/javascript">
	        $(document).on('click','.for-video',function() { 
	            $("#register_error_").html("Please Login to watch video!");
	            $("#register_error_").show();
	            $('html, body').animate({
	     		   scrollTop: $("#error_here").offset().top
	   			}, 500);
	      	});

	        $(document).on('click','.resubscribe',function() { 
	            $("#register_error_").html("Please upgrade your subscription!");
	            $("#register_error_").show();
	            $('html, body').animate({
	     		   scrollTop: $("#error_here").offset().top
	   			}, 500);
	      	});
 		</script>
</html>