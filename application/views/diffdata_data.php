<div class="row">
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

            <script>
          $(".play-1").yu2fvl();
        </script>