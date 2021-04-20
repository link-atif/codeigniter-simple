<div id="forgotModal" class="forgotModal" style="display: block;">
      <div class="forgot-form">
        <div class="container">
            <label for="show" class="close-btn fa fa-times" title="close" id="fclose-btn" onclick="closeForgot()"></label>
            <div class="heading"> Forgot Password</div>
            <div style="display: none;" id="forget_error_div" class="alert alert-danger"></div>
                <div style="display: none;" id="forget_succes_div" class="alert alert-success"></div>
            <form action="#">
              <div class="data">
                  <label>Email</label>
                  <input type="email" id="for_email" required> 
                </div>
              <div class="btn">
                  <div class="inner"> </div>
                  <button type="submit" id="Forget">Submit</button>
              </div>
               <div class="signup-link"> Already a member! <a href="javascript:void(0)" onclick="loginModal();">Log In</a></div> 
            </form>
        </div>
      </div>
  </div>
  <script type="text/javascript">
        $(document).ready(function(){ 
    $("#Forget").click(function(){
      var email = $("#for_email").val();
      var dataString = {'email':email};
      if(email==''   ){
        $("#forget_error_div").html("Please enter email");
        $("#forget_error_div").show();
      }else{
        $("#forget_error_div").hide();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>user/forgetPasswordmail",
          data: dataString,
          success: function(result){
            var obj = JSON.parse(result);
            if(obj.success==true){
                 $("#forget_succes_div").html(obj.message);
              $("#forget_succes_div").show();
                 //alert(obj.message);
            }else{
              $("#forget_error_div").html(obj.message);
              $("#forget_error_div").show();
            }
          }
        });
      }
      return false;      
    });
  });
</script>