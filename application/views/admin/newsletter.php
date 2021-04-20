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
				 	<div class="title_right" style="width: 100%">
		                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
		                    <div class="input-group pull-right" style="text-align: right;">
		                        <span class="input-group-btn"><a href="javascript:void(0);" id="export" class="btn btn-primary" type="button">Export Newsletters</a></span>
		                    </div>
		                </div>
		            </div>
					<div class="col-md-12">
						<h3>Newsletter</h3>
						<table id="example" class="table table-striped responsive-utilities jambo_table">
							<thead>
								<tr class="headings">
									<th>Name</th>
									<th>Email</th>
									<th class=" no-link last"><span class="nobr">Action</span>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($news as $user){?>
								<tr class="odd pointer">
									<td class=" "><?php echo $user->name?></td>
									<td class=" "><?php echo $user->email?></td>
									<td class=" last">
										<a href="<?php echo base_url()?>admin/Newsletters/delete/<?php echo $user->id?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure to delete this record ?')"><i class="fa fa-trash-o"></i> Delete </a>
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
<script type="text/javascript">
    $(document).ready(function () {
 		var base_url = '<?php echo base_url(); ?>';
        $('#export').click(function () {
            $.ajax({
                url: '<?php echo base_url('admin/newsletter/export') ?>',
                type: "POST",
                data: {},
            }).done(function (response) {
                 if (response.filename != undefined && response.filename.length > 0) {

                  window.open(base_url+'admin/newsletter/download?filename='+response.filename);
                }
            });
        });
    });
</script>
<!-- /datepicker -->
</body>
</html>