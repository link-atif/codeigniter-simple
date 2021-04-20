<div id="loginModal" class="loginModal" style="display: block;">
    	<div class="login-form">
    		<div class="container">
      			<label for="show" class="close-btn fa fa-times" title="close" id="close-btn" onclick="closeLogin();"></label>
      			<div class="heading"> Log In</div>
            <div style="display: none;" id="login_error_div" class="alert alert-danger"></div>
      			<form action="#">
        			<div class="data">
          				<label>Email</label>
          				<input type="email" id="email1" name="email" required> 
          			</div>
        			<div class="data" style="margin-top: 40px">
          				<label>Password</label>
          				<input type="password" id="password1" name="password" required> 
          			</div>
          				<!-- <div class="forgot-pass"> <a href="#">Forgot Password?</a></div> -->
        			<div class="btn">
          				<button type="button" onclick="login();">log in</button>
        			</div>
        			<div class="forgot-pass"> <a href="javascript:;" onclick="forgotModal();">Forgot Password?</a></div>
        			<!-- <div class="signup-link"> Not a member? <a href="#">Signup now</a></div> -->
      			</form>
    		</div>
  		</div>
	</div>
  <script type="text/javascript">
    function login(){
    
     var email = $("#email1").val();
    var password = $("#password1").val();
    var controller = '<?php echo $this->router->fetch_class() ?>';
    var dataString = {'email':email,'password': password};
    if(email=='' || password==''  ){
       $("#login_error_div").html("Please Fill all the Fields");
        $("#login_error_div").show();
    }else{
      $("#login_error_div").hide();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>user/login",
        data: dataString,
        success: function(result){
          var obj = JSON.parse(result);
          if(obj.success==true){
             if(controller == 'Booking'){ 
                window.location.href = "<?php echo base_url()?>Booking/Booking_1/";
              }else{
                if(obj.is_premium == 0){
                  window.location.href = "<?php echo base_url()?>user/payment";  
                }else{
                  window.location.href = "<?php echo base_url()?>favourites";
                }
              }
          }else{
            $("#login_error_div").html(obj.message);
            $("#login_error_div").show();
          }
        }
      });
    }
    return false;
  }
  
</script>
	