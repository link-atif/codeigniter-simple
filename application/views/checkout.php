<?php $this->load->view('common/common-header');?>
<?php $this->load->view('common/header');?>
<section id="checkout">
		<div class="container user-detail">
			<div class="row">
				<div class="col-md-8">
					<div class="text-left co-heading pull-left"><h5>Create an account</h5></div>
					<div class=" login-here pull-right">
						<h6>Already have an account? <a href="javascript:;" onclick="loginModal();">Log in here</a></h6>
					</div>
					<div style="clear: both;"></div>
					<div style="display: none;" id="register_error_div" class="alert alert-danger"></div>
                    <div style="display: none;" id="register_success_div" class="alert alert-success"></div>
					<form id="user-detail" method="POST">
					  	<div class="row">
					  		<div class="col-md-6 mb-3">
						  	 	<label for="f_name">First name</label><br>
							  	<input type="text" id="f_name" name="f_name"><br>
							 </div>
							<div class="col-md-6">
							  	<label for="l_name">Last name</label><br>
							  	<input type="text" id="l_name" name="l_name"><br><br>
						  	</div>
						  	<div class="col-md-6 mt-40 mb-3">
						  	 	<label for="email">Email</label><br>
							  	<input type="email" name="email" id="email"><br>
							</div>
							<div class="col-md-6 mt-40">
							  	<label for="password">Password</label><br>
							  	<input type="password" id="password" name="password"><br><br>
						  	</div>
					  	</div>

					    <input id="plan_heading" type="hidden" value="<?php echo $plansChechout['title'];?>">
              <input id="plan_price" type="hidden" value="<?php echo $plansChechout['price'];?>">
              <input id="plan_duration" type="hidden" value="<?php echo $plansChechout['heading'];?>">
              <input id="stripe_plan_id" type="hidden" value="<?php echo $plansChechout['stripe_plan_id'];?>">
              <input id="type" type="hidden" value="membership">
          </form>
          <div class="row">
            <div class="col-md-8 payment">
              <form id="payment-card">
                <div id="checkbox"><input type="checkbox" name="radioBtn" id="radioBtn"> I agree to the <a href="<?php echo base_url(); ?>privacy_terms"> Privacy & Terms</a></div>
                <div class="continue-btn"><a href="javascript:;" class="green-btn" onclick="register();">CONTINUE</a></div> 
                <input id="type" type="hidden" value="membership">
              </form>
            </div>
            <div class="col-md-4"></div>
          </div>
				</div>
				<div class="col-md-4">
					<div class="text-left co-heading mt-xs-5"><h5>Selected Plan</h5></div>
					<div class="selected-plan">
						<p id="heading" name="heading"><?php echo $plansChechout['title'];?></p>
						<p id="price" name="price">$<?php echo $plansChechout['price'];?> /<span id="duration" name="duration"><?php echo $plansChechout['heading'];?></span></p>
					</div>
				</div>
			</div> 
		</div>
	</section>
	<script type="text/javascript">
  function register(){
    var f_name 			    = $("#f_name").val();
    var l_name 			    = $("#l_name").val();
    var email 				    = $("#email").val();
    var plan_heading     = $("#plan_heading").val();
    var plan_price 		  = $("#plan_price").val();
    var plan_duration 	  = $("#plan_duration").val();
    var stripe_plan_id    = $("#stripe_plan_id").val();
    var password 		    = $("#password").val();
     /*var card_number 	    = $("#card_number").val();
     var expiry_date 	    = $("#debit_expiryDate").val();
     var cvc 	            = $("#debit_securityCode").val();
     var type             = $("#type").val();*/
      // Returns successful data submission message when the entered information is stored in database.
    var dataString = {'f_name':f_name, 'l_name': l_name, 'email':email, 'stripe_plan_id':stripe_plan_id, 'plan_heading':plan_heading, 'plan_price': plan_price, 'plan_duration':plan_duration, 'password': password};
      if(f_name=='' || l_name=='' || email=='' || password==''){
      	$('html,body').animate({
				 scrollTop: $("#register_error_div").offset().top
				}, 'slow');
          $("#register_error_div").html("Please fill out all required fields.");
          $("#register_error_div").show();
      }else{
        $("#register_error_div").hide();
        if ($('#radioBtn').is(':checked')==false) { 
          $("#register_error_div").html("Please select terms and conditions.");
          $("#register_error_div").show();
          $('html, body').animate({
               scrollTop: $("#register_error_div").offset().top
            }, 500);
          return false;
        }else{
          $("#register_error_div").hide();
          $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>user/register",
            data: dataString,
            success: function(result){
              var obj = JSON.parse(result);
              if(obj.success==true){
                  $("#register_success_div").html(obj.message);
                  $("#register_success_div").show();
                  $.ajax({
                    type: "POST",
                    url: "<?php echo base_url()?>user/login",
                    data: {'email': email, 'password' : password },
                    success: function(result){
                      window.location.href = "<?php echo base_url()?>user/payment";
                    }
                  });

                  //$("#stripe-form").show();
                  //$(".stripe-button").data('email',email);
                //window.location.href = "<?php echo base_url()?>home/thankyou";
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
      }
      return false;    
  }
</script>
	<?php $this->load->view('common/footer');?>
	<script src="https://vitalets.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>
<script type="text/javascript">
	var app;
(function() {
  'use strict';
  app = {
    monthAndSlashRegex: /^\d\d \/ $/, // regex to match "MM / "
    monthRegex: /^\d\d$/, // regex to match "MM"
    el_cardNumber: '.ccFormatMonitor',
    el_expDate: '#debit_expiryDate',
    el_cvv: '.cvv',
    el_ccUnknown: 'cc_type_unknown',
    el_ccTypePrefix: 'cc_type_',
    el_monthSelect: '#monthSelect',
    el_yearSelect: '#yearSelect',
    cardTypes: {
      'American Express': {
        name: 'American Express',
        code: 'ax',
        security: 4,
        pattern: /^3[47]/,
        valid_length: [15],
        formats: {
          length: 15,
          format: 'xxxx xxxxxxx xxxx'
        }
      },
      'Visa': {
				name: 'Visa',
				code: 'vs',
        security: 3,
				pattern: /^4/,
				valid_length: [16],
				formats: {
						length: 16,
						format: 'xxxx xxxx xxxx xxxx'
					}
			},
      'Maestro': {
				name: 'Maestro',
				code: 'ma',
        security: 3,
				pattern: /^(50(18|20|38)|5612|5893|63(04|90)|67(59|6[1-3])|0604)/,
				valid_length: [16],
				formats: {
						length: 16,
						format: 'xxxx xxxx xxxx xxxx'
					}
			},
      'Mastercard': {
				name: 'Mastercard',
				code: 'mc',
        security: 3,
				pattern: /^5[1-5]/,
				valid_length: [16],
				formats: {
						length: 16,
						format: 'xxxx xxxx xxxx xxxx'
					}
			} 
    }
  };
  
  app.addListeners = function() {
      $(app.el_expDate).on('keydown', function(e) {
        app.removeSlash(e);
      });

      $(app.el_expDate).on('keyup', function(e) {
        app.addSlash(e);
      });

      $(app.el_expDate).on('blur', function(e) {
        app.populateDate(e);
      });

      $(app.el_cvv +', '+ app.el_expDate).on('keypress', function(e) {
        return e.charCode >= 48 && e.charCode <= 57;
      });  
  };
  
  app.addSlash = function (e) {
    var isMonthEntered = app.monthRegex.exec(e.target.value);
    if (e.key >= 0 && e.key <= 9 && isMonthEntered) {
      e.target.value = e.target.value + " / ";
    }
  };
  
  app.removeSlash = function(e) {
    var isMonthAndSlashEntered = app.monthAndSlashRegex.exec(e.target.value);
    if (isMonthAndSlashEntered && e.key === 'Backspace') {
      e.target.value = e.target.value.slice(0, -3);
    }
  };
  
  app.populateDate = function(e) {
    var month, year;
    
    if (e.target.value.length == 7) {
      month = parseInt(e.target.value.slice(0, -5));
      year = "20" + e.target.value.slice(5);
      
      if (app.checkMonth(month)) {
        $(app.el_monthSelect).val(month);
      } else {
        $(app.el_monthSelect).val(0);
      }
      
      if (app.checkYear(year)) {
        $(app.el_yearSelect).val(year);
      } else {
        $(app.el_yearSelect).val(0);
      }
      
    }
  };
  
  app.checkMonth = function(month) {
    if (month <= 12) {
      var monthSelectOptions = app.getSelectOptions($(app.el_monthSelect));
      month = month.toString();
      if (monthSelectOptions.includes(month)) {
        return true; 
      }
    }
  };
  
  app.checkYear = function(year) {
    var yearSelectOptions = app.getSelectOptions($(app.el_yearSelect));
    if (yearSelectOptions.includes(year)) {
      return true; 
    }
  };
          
  app.getSelectOptions = function(select) {
    var options = select.find('option');
    var optionValues = [];
    for (var i = 0; i < options.length; i++) {
      optionValues[i] = options[i].value;
    }
    return optionValues;
  };
  
  app.setMaxLength = function ($elem, length) {
    if($elem.length && app.isInteger(length)) {
      $elem.attr('maxlength', length);
    }else if($elem.length){
      $elem.attr('maxlength', '');
    }
  };
  
  app.isInteger = function(x) {
    return (typeof x === 'number') && (x % 1 === 0);
  };

  app.createExpDateField = function() {
    $(app.el_monthSelect +', '+ app.el_yearSelect).hide();
    $(app.el_monthSelect).parent().prepend('<input type="text" class="ccFormatMonitor">');
  };
  
  
  app.isValidLength = function(cc_num, card_type) {
    for(var i in card_type.valid_length) {
      if (cc_num.length <= card_type.valid_length[i]) {
        return true;
      }
    }
    return false;
  };

  app.getCardType = function(cc_num) {
    for(var i in app.cardTypes) {
      var card_type = app.cardTypes[i];
      if (cc_num.match(card_type.pattern) && app.isValidLength(cc_num, card_type)) {
        return card_type;
      }
    }
  };

  app.getCardFormatString = function(cc_num, card_type) {
    for(var i in card_type.formats) {
      var format = card_type.formats[i];
      if (cc_num.length <= format.length) {
        return format;
      }
    }
  };

  app.formatCardNumber = function(cc_num, card_type) {
    var numAppendedChars = 0;
    var formattedNumber = '';
    var cardFormatIndex = '';

    if (!card_type) {
      return cc_num;
    }

    var cardFormatString = app.getCardFormatString(cc_num, card_type);
    for(var i = 0; i < cc_num.length; i++) {
      cardFormatIndex = i + numAppendedChars;
      if (!cardFormatString || cardFormatIndex >= cardFormatString.length) {
        return cc_num;
      }

      if (cardFormatString.charAt(cardFormatIndex) !== 'x') {
        numAppendedChars++;
        formattedNumber += cardFormatString.charAt(cardFormatIndex) + cc_num.charAt(i);
      } else {
        formattedNumber += cc_num.charAt(i);
      }
    }

    return formattedNumber;
  };

  app.monitorCcFormat = function($elem) {
    var cc_num = $elem.val().replace(/\D/g,'');
    var card_type = app.getCardType(cc_num);
    $elem.val(app.formatCardNumber(cc_num, card_type));
    app.addCardClassIdentifier($elem, card_type);
  };

  app.addCardClassIdentifier = function($elem, card_type) {
    var classIdentifier = app.el_ccUnknown;
    if (card_type) {
      classIdentifier = app.el_ccTypePrefix + card_type.code;
      app.setMaxLength($(app.el_cvv), card_type.security);
    } else {
      app.setMaxLength($(app.el_cvv));
    }

    if (!$elem.hasClass(classIdentifier)) {
      var classes = '';
      for(var i in app.cardTypes) {
        classes += app.el_ccTypePrefix + app.cardTypes[i].code + ' ';
      }
      $elem.removeClass(classes + app.el_ccUnknown);
      $elem.addClass(classIdentifier);
    }
  };

  
  app.init = function() {

    $(document).find(app.el_cardNumber).each(function() {
      var $elem = $(this);
      if ($elem.is('input')) {
        $elem.on('input', function() {
          app.monitorCcFormat($elem);
        });
      }
    });
    
    app.addListeners();
    
  }();
  
})();
</script>