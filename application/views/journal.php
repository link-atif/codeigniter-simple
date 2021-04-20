<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>

<div class="container">
        <div class="col-sm-12">
        	<div class="text-center ty-text thank-you">
        		<h1 class="h32b"><?php echo $this->Preferences_model->getValue('journal_title');?></h1>
        		<div class="p14b" style="margin-top: 30px"><?php echo $this->Preferences_model->getValue('journal_desc');?></div>
        	</div>
        </div>
         <div class="col-md-12 text-center mb-4" id="signMe-up">
            <div style="display: none;" id="forget_error_div11" class="alert alert-danger"></div>
                    <div style="display: none;" id="news_success_message" class="alert alert-success"></div>
            <form action="" method="">
                <input type="text" name="uname" id="for_name1" placeholder="Your Name" class="mb-3">
                <input type="email" name="email" id="for_email1" placeholder="And Email Address" class="mb-3">
                <input type="button" value="Sign Me Up" id="sign-up" class="mb-3 sign-up">
            </form>
        </div>
    </div>

    <div class="container pr-45">
        <div class="row">
            <?php foreach($journal as $row){
                  $picture_name = $this->Common_model->resize($row->picture_main,350,232);
                ?>
            <div class="col-md-4 col-sm-12 mt-5">
                <a href="<?php echo base_url()?>home/journal_detail/<?php echo $row->slug?>">
                <div class="journal">
                    <img src="<?php echo base_url()?>uploads/slider/<?php echo $picture_name; ?>">
                    <div class="overlay">
                        <div class="text">
                            <div class="title"><?php echo $row->{'title'};?></div>
                            <div class="desc"><?php $originalDate = $row->{'date'}; echo $newDate = date("F m ,Y", strtotime($originalDate)); ?></div>
                        </div>
                     </div>
                </div>
            </a>
            </div>
        	<?php }?>
        </div>
    </div>

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
	
	<!-- <section id="ty-slider">
        <div class="container">
            <div class="row">
                <div id="tyCarousel" class="carousel slide" data-interval="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">                      
                           <div class="col-md-3 col-sm-12 ps-slide">
                                <img src="img/slide-image1.png">   
                            </div>
                        </div>
                        <div class="carousel-item">                         
                            <div class="col-md-3 col-sm-12 ps-slide">
                                <img src="img/slide-image2.png">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3 col-sm-12 ps-slide">
                                <img src="img/slide-image3.png">   
                            </div>
                        </div>
                        <div class="carousel-item">                         
                            <div class="col-md-3 col-sm-12 ps-slide">
                                <img src="img/slide-image1.png">
                            </div>
                        </div>
                    </div>
                </div>                                                
            </div>
            <a class="left carousel-control" href="#tyCarousel" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right carousel-control" href="#tyCarousel" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </section> -->

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