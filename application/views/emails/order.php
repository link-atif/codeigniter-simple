<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="<?php echo (isset($meta_description)) ? $meta_description : "";?>">
      <meta name="keywords" content="<?php echo (isset($meta_keywords)) ? $meta_keywords : ""; ?>">
      <link rel="shortcut icon" href="assets/img/favicon.png"> 
      <style type="text/css">
         <?php if($this->router->fetch_class()=='home' && $this->router->fetch_method()=='index'){?>
         .static_banner_outer{ float: left; margin: 0px; padding: 42px 0 0 0; width: 100%; 
            background: url(<?php echo base_url()."uploads/data/".$this->Preferences_model->getValue('logo_picture'); ?>) 0px 0px no-repeat; 
            background-size: 100% auto; background-color: #010101;
         }
         <?php }else{?>
         .static_banner_outer{ float: left; margin: 0px; padding: 42px 0 0 0; width: 100%; 
            background: url(<?php echo base_url();?>assets/home/images/inner_pages_bg.png) 0px 0px no-repeat; 
            background-size: 100% auto; background-color: #010101;
         }
         <?php }?>
      </style>
   </head>
<body style="background-color: #f8f3f3; ">
<div>
<div >

		<div style="min-height:750px"> <br />
			<div>
			<?php if(isset($_GET['msg']) && $_GET['msg']!=''){?>
            <br>
            <br>
			<div><?php echo $_GET['msg']?></div>
			<?php }?>
			<div>
				<div>
                    <div>
                        <h3 align="center">Thank You !!</h3>
                        <p align="center" style="color: MediumSeaGreen;">Thank you for ordering the featured selection this month.<br>This is an automatically generated message to confirm receipt of your order via the Internet. <br>You do not need to reply to this e-mail, but you may wish to save it for your records.<br>Your order should arrive soon. Thank you.</p>
                    </div>
                </div>		 
				 <div>
					<div >
						<table align="center" style=" border-collapse: collapse;border-spacing: 0; width: 60%; border: 1px solid #ddd;" >
							<tr style="background-color: #eae7e7;">
								<h3 align="" style="padding-left: 20%; border-collapse: collapse;border-spacing: 0; width: 60%; border: 1px;">Cusromers Detail</h3>
								<th style=" text-align: left;padding: 8px; ">Name</th>
								<td style=" text-align: left;padding: 8px;"><?php echo $order->full_name?></td>
								<th style=" text-align: left;padding: 8px;">Email</th>
								<td style=" text-align: left;padding: 8px; color: blue;"> <?php echo $order->email?></td>
							</tr>
							<tr style="background-color: #eae7e7;">
								<th style=" text-align: left;padding: 8px;">Phone</th>
								<td style=" text-align: left;padding: 8px;"><?php echo $order->contact_num?></td>
								<th style=" text-align: left;padding: 8px;">Discount Code</th>
								<td style=" text-align: left;padding: 8px;"><?php echo $order->discount_code?></td>
							</tr>
							<tr style="background-color: #eae7e7;">
								<th style=" text-align: left;padding: 8px;">Payment Method</th>
								<td style=" text-align: left;padding: 8px;"><?php echo $order->payment_method?></td>
								<th style=" text-align: left;padding: 8px;">Total</th>
								<td style=" text-align: left;padding: 8px;">AED <?php echo $order->total?></td>
							</tr>
							<tr style="background-color: #eae7e7;">
								<th style=" text-align: left;padding: 8px;">Discount Amount</th>
								<td style=" text-align: left;padding: 8px;">AED <?php echo $order->discount_amount?></td>

								
							</tr>
						</table>
						<table align="center" id="example"  style=" border-collapse: collapse;border-spacing: 0; width: 60%; border: 1px solid #ddd;">
							<thead>
								<h3 align="left" style=" padding-left: 20%; color: #333333; border-collapse: collapse;border-spacing: 0; width: 60%; border: 1px;">Order Detail</h3>
								<tr style="background-color: #eae7e7;">
									<th style=" text-align: left;padding: 8px;">Product Name</th>
									<th style=" text-align: left;padding: 8px;">Product price</th>
									<th style=" text-align: left;padding: 8px;">Product Quantity</th>
									<th  style=" text-align: left;padding: 8px;"><span>Total</span>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($orders as $user){?>
								<tr style="background-color: #eae7e7;">
									<td style=" text-align: left;padding: 8px;"><?php echo $user->product_name?></td>
									<td style=" text-align: left;padding: 8px;">AED<?php echo $user->product_price?></td>
									<td style=" text-align: left;padding: 8px;"><?php echo $user->product_quantity?></td>
									<td style=" text-align: left;padding: 8px;">
										AED<?php echo $user->product_price*$user->product_quantity ?>
									</td>
								</tr>
								<?php }?>
								<tr style="background-color: #f2f2f2">
									<td colspan="3" align="right"><b>Total</b></td>
									<td>AED<?php echo $order->total;?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div> 
			</div>
			<!-- footer content -->
			<!-- /footer content --> 
		</div>
		<!-- /page content --> 
	</div>
</div>
<!-- /datepicker -->
</body>
</html>