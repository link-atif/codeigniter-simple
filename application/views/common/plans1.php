<div id="pricingModal1" class="pricingModal" style="display: block;">
	<div class="pricing-popup">
		<div class="container">
			<label for="show" class="close-btn fa fa-times" title="close" onclick="closePlans1();"></label>     			
  			<div class="pricing-header px-3 mx-auto text-center">
  				<h1><?php echo $this->Preferences_model->getValue('plans_heading');?></h1>
  			</div>
  			<div class="row pt-3">
  				<?php foreach($plans as $plan){ ?>
	            <div class="col-md-4">
	                <div class="card box-shadow">
	                    <div class="">
	                        <img src="<?php echo base_url()?>uploads/slider/<?php 
                        			$picture_name = $this->Common_model->resize($plan->picture_main,291,155);
                        			 echo $picture_name; ?>" class="img-responsive">
	                    </div>
	                    <div class="card-body text-center">
	                    	<p><b><?php echo $plan->{'title'};?></b></p>
	                        <h1><b>$ <?php echo $plan->{'price'};?> </b>/<small class="text-muted"><?php echo $plan->{'heading'};?></small></h1>
	                        <ul class="list-unstyled mt-3 mb-3">
	                            <?php echo $plan->{'details'};?>
	                          
	                        </ul>
	                        <button type="button" class="btn btn-lg btn-block green-btn"><a class="text-white" href="<?php echo base_url()?>home/checkout/<?php echo $plan->slug?>">Choose</a></button>
	                    </div>
	                </div>
	            </div>
        		<?php }?>
	        </div>
		</div>
		</div>
</div>