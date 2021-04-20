 <?php $this->load->view('admin/common/common-header');?>

<body class="nav-md">
<div class="container body">
	<div class="main_container">
		<?php $this->load->view('admin/common/left-nav');?>
		
		<!-- top navigation -->
		<?php $this->load->view('admin/common/top-nav');?>
		<!-- /top navigation --> 
		
		<!-- page content -->
		<div class="right_col" role="main" style="min-height:750px"> <br />
			<div class="">
			<?php if(isset($_GET['msg']) && $_GET['msg']!=''){?>
            <br>
            <br>
			<div class="alert alert-success"><?php echo $_GET['msg']?></div>
			<?php }?>
			<div class="row top_tiles">
				<div class="page-title">
                    <div class="title_left">
                        <h3>Order Detail</h3>
                    </div>
                </div>
                
					<form class="pull-right" method="post" action="<?php echo base_url()?>admin/orders/addstatus/" >
					<label >Status:</label>
					<input type="hidden" name=" order_id" value="<?php echo $order->id?>">
					  <select class="status" name="status">
					     <option value="pending">Pending</option>
					     <option value="approved">Approved</option>
					     <option value="cancel">Cancel</option>
					     <option value="complete">Complete</option>
					    </select>
					    <button type="submit" value="submit">Submit</button>
					</form>			 
				 <div class="row">
					<div class="col-md-12">
						<table class="table table-striped responsive-utilities jambo_table">
							 <tr>
                                <th class="headings" style="text-align: left;">Name</th>
                                <td style="text-align: left;"><?php echo $order->full_name?></td>
                                 <!-- <th class="headings">Email</th>
                                <td> <?php //echo $order->email?></td>  -->
                                <!-- <th class="headings">Payment Method</th>
                                <td><?php //echo $order->payment_method?></td> -->
                            </tr>
                            
                            <tr>
                                <th class="headings" style="text-align: left;">Email</th>
                                <td style="text-align: left;"><?php echo $order->email?></td>
                                <!-- <th class="headings">Discount Code</th>
                                <td><?php //echo $order->discount_code?></td> -->
                            </tr>
                            <tr>
                                <th class="headings" style="text-align: left;">Phone</th>
                                <td style="text-align: left;"><?php echo $order->contact_num?></td>
                                <!-- <th class="headings">Discount Code</th>
                                <td><?php //echo $order->discount_code?></td> -->
                            </tr>
                            <!-- <tr>
                                
                                <th class="headings" style="text-align: left;">Discount Code</th>
                                <td style="text-align: left;"><?php //echo $order->discount_code?></td>
                            </tr> -->
                           <!--  <tr>
                                
                                <th class="headings" style="text-align: left;">Discount Amount</th>
                                <td style="text-align: left;"><?php //echo $order->discount_amount?></td>
                            </tr> -->
                            <tr>
                                <!-- <th class="headings">Payment Method</th>
                                <td><?php //echo $order->payment_method?></td> -->
                                <th class="headings" style="text-align: left;">Sub Total</th>
                                <td style="text-align: left;">$ <?php echo $order->sub_total?></td>
                            </tr>
                             <tr>
                                <!-- <th class="headings">Payment Method</th>
                                <td><?php //echo $order->payment_method?></td> -->
                                <th class="headings" style="text-align: left;">Total</th>
                                <td style="text-align: left;">$ <?php echo $order->sub_total?></td>
                            </tr>
                            <tr>
                                <!-- <th class="headings">Discount Amount</th>
                                <td>AED <?php echo $order->discount_amount?></td> -->
                                <th class="headings" style="text-align: left;">Status</th>
                                <td style="text-align: left;"><?php echo $order->status?></td>
                            </tr>
                            <!-- <tr>
                               
                                <th class="headings" style="text-align: left;">Payment Method</th>
                                <td style="text-align: left;"><?php //echo $order->payment_method?></td>
                            </tr> -->
						</table>
						<table id="example" class="table table-striped responsive-utilities jambo_table">
							 <thead>
                                <tr class="headings">
                                    <th>Product Name</th>
                                    
                                    <th>Product price</th>
                                    
                                    <th>Product Quantity</th>
                                    <th class=" no-link last"><span class="nobr">Total</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $user){?>
                                <tr class="odd pointer">
                                    <td class=" "><?php echo $user->product_name?></td>
                                    
                                    <td class=" ">$<?php echo $user->product_price?></td>
                                    
                                    <td><?php echo $user->product_quantity?></td>
                                    <td class=" last">
                                        $<?php echo $user->product_price*$user->product_quantity ?>
                                    </td>
                                </tr>
                                <?php }?>
                                <tr>
                                    <td colspan="3" align="right"><b>Sub Total</b></td>
                                    <td>$<?php echo $order->sub_total;?></td>
                                </tr>
                                
                                 <tr>
                                    <td colspan="3" align="right"><b>Total</b></td>
                                    <td>$<?php echo $order->sub_total;?></td>
                                </tr>
                            </tbody>
						</table>
					</div>
				</div> 
			</div>
			<!-- footer content -->
			<?php $this->load->view('admin/common/footer');?>
			<!-- /footer content --> 
		</div>
		<!-- /page content --> 
	</div>
</div>
<div id="custom_notifications" class="custom-notifications dsp_none">
	<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
	</ul>
	<div class="clearfix"></div>
	<div id="notif-group" class="tabbed_notifications"></div>
</div>
<script>
$(document).ready(function(){
    $("select.status").change(function(){
        var selectedstatus = $(this).children("option:selected").val();
       // alert("You have selected the country - " + selectedstatus);
    });
});
</script>
<?php $this->load->view('admin/common/common-scripts.php')?>
<!-- /datepicker -->
</body>
</html>