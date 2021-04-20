  <script type="text/javascript">
        $(document).ready(function(){
    $("#sign-up").click(function(){
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
                 $("#forget_succes_div11").html(obj.message);
              $("#forget_succes_div11").show();
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
  <footer>
    <div class="container">
      <div class="row py-5">
        <div class="col-md-6 col-sm-12 f-left">
          <a href="<?php echo base_url(); ?>home/journal">Journal</a>
          <a href="<?php echo base_url(); ?>connect">Contact</a>
          <a href="<?php echo $this->Preferences_model->getValue('spotify_link');?>"><img src="<?php echo base_url(); ?>assets/home/img/spotify.png"></a>
          <a href="<?php echo $this->Preferences_model->getValue('insta_link');?>"><img src="<?php echo base_url(); ?>assets/home/img/instagram.png"></a>
          <a href="<?php echo $this->Preferences_model->getValue('facebook_link');?>"><img src="<?php echo base_url(); ?>assets/home/img/facebook.png"></a>
        </div>
        <div class="col-md-6 col-sm-12 text-right f-right">
          <span>&#169; <?php echo $this->Preferences_model->getValue('footer_text');?> </span><span><a href="<?php echo $this->Preferences_model->getValue('site_by_link');?>"><?php echo $this->Preferences_model->getValue('site_by');?></a></span>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>