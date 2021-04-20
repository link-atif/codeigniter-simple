<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
<section id="checkout">
		<div class="container user-detail">
			<!-- <div class="row">
				<div class="col-md-4 col-sm-12 text-left co-heading">
					
				</div>
				<div class="col-md-4 col-sm-12 text-center login-here">
					<h6>&nbsp;</h6>
				</div>
				<div class="col-md-4 col-sm-12 text-left co-heading">
					
				</div>
			</div> -->
			<div class="row">
				<div class="col-md-8">
					<h5 class="co-heading">Personal info</h5>
					<div style="display: none;" id="register_error_div" class="alert alert-danger"></div>
                    <div style="display: none;" id="register_success_div" class="alert alert-success"></div>
					<form id="user-detail" method="POST">
					  	<div class="row">
                <div class="col-md-6">
                  <label for="f_name">First name</label><br>
                  <input type="text" id="f_name" name="f_name" value="<?php echo $users['f_name']; ?>"><br>
              </div>
              <div class="col-md-6">
                  <label for="l_name">Last name</label><br>
                  <input type="text" id="l_name" name="l_name" value="<?php echo $users['l_name']; ?>"><br><br>
                </div>
                <div class="col-md-6 mt-40">
                  <label for="email">Email</label><br>
                  <input type="email" name="email" id="email" value="<?php echo $users['email']; ?>"><br>
              </div>
              <div class="col-md-6 mt-40">
                  <label for="password">Password</label><br>
                  <input type="password" id="password" name="password" value="<?php echo $users['password']; ?>"><br><br>
                </div>
              </div>
					</form>
				</div>
				
				<div class="col-md-4">
					<h5 class="co-heading">Selected Retreat</h5>
					<div class="selected-plan">
						<p><?php echo $plansCheckout['title'];?></p>
						<p><?php echo $plansCheckout['heading'];?></p>
						<p><?php echo $plansCheckout['plan_heading'];?></p>
						<p>£<?php echo $plansCheckout['plan_price'];?> / <?php echo $plansCheckout['plan_duration'];?></p>
					</div>
				</div>
			</div> 
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 payment">
					<h5 class="co-heading">Payment Details</h5>
					<p>Please provide the payment details below to continue the checkout process.</p>
					<form id="payment-card">
						<div class="card-details"><input type="text" name="card_number" id="card_number" placeholder="Card Number" maxlength = "16">
							<input type="text" name="expiry_date" id="debit_expiryDate" placeholder="MM/YY">
							<input type="text" name="cvc" id="debit_securityCode" placeholder="CVC">
						</div><!-- 
						<div id="checkbox"><input type="checkbox" id="t&c" name="t&c" value="t&c"> I agree to the <a href="#">terms & privacy policy</a></div>  -->
						<div class="continue-btn"><a href="javascript:;" type="button" class="green-btn" onclick="bookregister();">Submit</a></a></div>	

						<input id="plan_heading" type="hidden" value="<?php echo $plansCheckout['plan_heading'];?>">
						<input id="plan_price" type="hidden" value="<?php echo $plansCheckout['plan_price'];?>">
						<input id="plan_duration" type="hidden" value="<?php echo $plansCheckout['plan_duration'];?>">
						<input id="type" type="hidden" value="dubai-studio">
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
  function bookregister(){
     var f_name 			= $("#f_name").val();
     var l_name 			= $("#l_name").val();
     var email 				= $("#email").val();
     var plan_heading 		= $("#plan_heading").val();
     var plan_price 		= $("#plan_price").val();
     var plan_duration 		= $("#plan_duration").val();
     var password 			= $("#password").val();
     var card_number 		= $("#card_number").val();
     var type 				= $("#type").val();
     var expiry_date 		= $("#debit_expiryDate").val();
     var cvc 				= $("#debit_securityCode").val();
     var dubaistudio_id     = '<?php echo $plansCheckout['id'];?>';
      // Returns successful data submission message when the entered information is stored in database.
      var dataString = {'f_name':f_name, 'l_name': l_name, 'email':email, 'plan_heading':plan_heading, 'plan_price': plan_price, 'plan_duration':plan_duration, 'password': password, 'card_number':card_number, 'expiry_date': expiry_date, 'cvc': cvc , 'type': type , 'dubaistudio_id': dubaistudio_id };
      if(f_name=='' || l_name=='' || email=='' || password=='' || card_number=='' || expiry_date=='' || cvc=='' ){
      	$('html,body').animate({
				 scrollTop: $("#register_error_div").offset().top
				}, 'slow');
         $("#register_error_div").html("Please fill all requried fields!");
        $("#register_error_div").show();
      }else{
        $("#register_error_div").hide();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>user/Bookinstudio",
          data: dataString,
          success: function(result){
            var obj = JSON.parse(result);
            if(obj.success==true){
               $("#register_success_div").html(obj.message);
              $("#register_success_div").show();
              window.location.href = "<?php echo base_url()?>home/dubai_thanks";
             
             // alert(obj.message);
            }else{

              $("#register_error_div").html(obj.error);
              $("#register_error_div").show();
              $('html,body').animate({
				    scrollTop: $("#register_error_div").offset().top
				}, 'slow');
            }
          }
        });
      }
      return false;    
  }
</script>
	<?php $this->load->view('common/footer');?>