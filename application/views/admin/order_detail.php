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
                            <h3><?php echo $page_heading;?></h3>

                        </div>
                    </div>
					
					 <div class="title_right">
                            <form name="frm">
                                <input type="hidden" name="per_page" value="<?php if(isset($_REQUEST['per_page'])){ echo $_REQUEST['per_page'];}?>" />
                                <div class="col-md-10 col-sm-5 col-xs-12 pull-right top_search">
                                    <div class="col-md-5 col-sm-5 col-xs-12 pull-right top_search">
                                        <div class="input-group">

                                        <input type="text" class="form-control" name="reference" placeholder="Search Collection By Name" value="<?php echo ($this->input->get('reference')) ?$this->input->get('reference') : ''; ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Go!</button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
				 <div class="row">
					<div class="col-md-12">
						
						<table id="example" class="table table-striped responsive-utilities jambo_table">
							<thead>
								<tr class="headings">
									<th> Name</th>
									<th>Phone</th>
									<th>Detail</th>
									<th>Status</th>
									<th class=" no-link last"><span class="nobr">Action</span></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($order as $user){?>
								<tr class="odd pointer">
									<td class=" "><?php echo $user->full_name?></td>
									<td class=" "><?php echo $user->contact_num?></td>
									<td class=" ">
										Delievery Time : <br> <?php echo $user->delievery_time?><br>
										City : <?php echo $user->city?>
									</td>
									
									<td class=" "><?php echo $user->status?></td>
									<td class=" last">
										<a href="<?php echo base_url()?>admin/Orders/delete/<?php echo $user->id?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure to delete this record ?')"><i class="fa fa-trash-o"></i> Delete </a>
										<a href="<?php echo base_url()?>admin/Orders/showDetail/<?php echo $user->id?>" class="btn btn-success btn-xs"><i class="fa "></i> Show Detail </a>
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