<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
    <div class="container">
        <div class="col-sm-12">
        	<div class="text-center ty-text thank-you my-5">
        		<h1 class="h32b">Thank you for Booking (Retreat title)</h1>
        		<p style="margin-top: 30px"><?php echo $this->Preferences_model->getValue('retreats_thanks_desc');?></p>
        	</div>
        </div>
    </div>
    <section class="thy-slider-container">
        <div class="thy-slider row">
            <?php foreach($slider as $row){ 
                $picture_name = $this->Common_model->resize($row->picture,1920,736);
                 ?>
            <div><img src="<?php echo base_url()?>uploads/slider/<?php echo $picture_name; ?>" class="img-responsive"></div>
            <?php }?>
        </div>
        <div class="paginator-center text-color text-center">
            <ul>
                <li class="prev"></li>
                <li class="next"></li>
            </ul>
        </div>
    </section>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:20,
            nav:true,
            navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>
<?php $this->load->view('common/footer');?>