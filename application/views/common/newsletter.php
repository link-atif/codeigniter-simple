<div id="newsletModal" class="newsletModal" style="display: block;">
	<div class="newslet-popup">
		<div class="container">
			<label for="show" class="close-btn fa fa-times" title="close" id="nclose" onclick="closeNewslet();"></label>     			
  			<div id="newsletter">
	        <div class="text-center my-4 py-5">
	            <div class="row justify-content-center">
	                <div class="col-lg-8">
	                    <h3><?php echo $this->Preferences_model->getValue('newsletter_title');?></h3>
	                    <p><?php echo $this->Preferences_model->getValue('newsletter_desc');?></p>
	                </div>
	            </div>
	          <div class="row justify-content-center">
	                <div class="col-lg-8">
	                	<div style="display: none;" id="forget_error_div11" class="alert alert-danger"></div>
	                    <form action="" method="">
	                        <input type="text" name="uname" id="for_name1" placeholder="Your Name" class="mb-3">
	                        <input type="email" name="email" id="for_email1" placeholder="And Email Address" class="mb-3">
	                        <input type="button" value="Sign Up" id="sign-up" class="mb-3">
	                    </form>
	                </div>
	          </div>
	        </div>
	    </div>
		</div>
	</div>
</div>
<script type="text/javascript">
        $(document).ready(function(){
    $("#sign").click(function(){
      var email = $("#for_email1").val();
      var name = $("#for_name1").val();
      
      var dataString = {'email':email,'name':name};
      if(email==''|| name==''   ){
        $("#forget_error_div11").html("Email Or Name is missing");
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
                 $("#forget_error_div11").html(obj.message);
              $("#forget_error_div11").show();
              $('#for_name1').val('');
              $('#for_email1').val('');
                 //alert(obj.message);
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
