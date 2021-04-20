<div id="pricingModal" class="modal pricingModal" style="display: block;">
	<div class="modal-dialog pricing-popup">
		<div class="modal-content container">
			<div class="m-header">
				<label for="show" class="close-btn fa fa-times" title="close" onclick="closePlans();"></label>     			
  				<div class="pricing-header px-3 mx-auto text-center">
  					<h1><?php echo $this->Preferences_model->getValue('plans_heading');?></h1>
  				</div>
  			</div>
  			<div class="m-body">
	  			<div class="row pt-3">
	  				<?php foreach($plans as $plan){ 
	  					if(($trial == 'join_now') || ($trial == 'join') || ($trial!= 'join' && $plan->trial_period > 0)){
	  						//$picture_name = $this->Common_model->resize($plan->picture_main,291,155);
	  					?>
		            <div class="col-md-4">
		                <div class="card box-shadow">
		                    <div class="">
		                        <img src="<?php echo base_url()?>uploads/slider/<?php 
                        			
                        			 echo $plan->picture_main; ?>" class="img-responsive">
		                    </div>
		                    <div class="card-body text-center">
		                    	<p><b><?php echo $plan->{'title'};?></b></p>
		                        <h1><b>$ <?php echo $plan->{'price'};?> </b>/<small class=""><?php echo $plan->{'heading'};?></small></h1>
		                        <div class="about-aed"></div>
		                        <ul class="list-unstyled mt-3 mb-3 ml-0">
		                            <?php echo $plan->{'details'};?>
		                          
		                        </ul>
		                        <?php if($this->session->userdata('user_id')=='') { ?>
		                        <button type="button" class="btn btn-lg btn-block green-btn" onclick="location.href='<?php echo base_url()?>home/checkout/<?php echo $plan->slug?>';"><a class="text-white" >Choose</a></button>
		                        <?php }else{ ?>
		                        	<a class="text-white" ><button type="button" class="btn btn-lg btn-block green-btn" onclick="location.href='<?php echo base_url()?>user/myAccount/<?php echo $plan->slug?>';">Choose</a></button>
		                        	<?php } ?>
		                    </div>
		                </div>
		            </div>
	        		<?php } }?>
		        </div>
		    </div>
		    <div class="login-link"><p>Already have an account? <a href="javascript:void(0)" onclick="loginModal();">Log In here</a></p></div>
		</div>
	</div>
</div>