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
					
					
					
				
				 <div class="row">
					<div class="col-md-12">
						<h3>Customers</h3>
						<table id="example" class="table table-striped responsive-utilities jambo_table">
							<thead>
								<tr class="headings">
									<th> First Name</th>
									<th> Last Name</th>
									<th>Email</th>
									<th>City</th>
									<th>Zip code</th>
									<th>Address</th>
									 <th align="right" class=" no-link last"><span class="nobr">Action</span></th>
									
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($contactqueries as $user){?>
								<tr class="odd pointer">
									<td class=" "><?php echo $user->first_name?></td>
									<td class=" "><?php echo $user->last_name?></td>
									<td class=" "><?php echo $user->email?></td>
									<td class=" "><?php echo $user->city?></td>
									<td class=" "><?php echo $user->post_code?></td>
									<td class=" "><?php echo $user->address?></td>
									
									<td align="left" class=" last">
                                    
                                    <a href="<?php echo base_url()?>admin/Loginusers/delete/<?php echo $user->id?>" onClick="return confirm('Are you sure to delete this ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                   
                                </td>
									
								</tr>
								<?php }?>
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
<?php $this->load->view('admin/common/common-scripts.php')?>
<!-- /datepicker -->
</body>
</html>