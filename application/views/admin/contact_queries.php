<?php $this->load->view('admin/common/common-header');?>

<body class="nav-md">
<div class="container body">
	<div class="main_container">
		<?php $this->load->view('admin/common/left-nav');?>
		<!-- top navigation -->
		<?php $this->load->view('admin/common/top-nav');?>
		<!-- /top navigation --> 
		
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="x_content content">
				<div class="page-title">
					<div class="title_left">
						<h3><?php echo $page_heading;?></h3>
					</div>
				</div>
				<div class="clearfix"></div>
				<?php if(isset($msg) && $msg!=''){?>
				<div class="alert alert-success"><?php echo $msg; ?></div>
				<?php }?>
				<div class="table-responsive">
					<form name="frm" id="frm" method="post">
					<input type="button" value="Delete All" class="btn btn-primary" onClick="deleteData()" >
					<table id="example" class="table table-striped responsive-utilities jambo_table">
						<thead>
							<tr class="headings">
								<th><input type="checkbox" id="select_all" /></th>
								<th>Name</th>
								<th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
								<th>Detail</th>
								<th>Created Date</th>
								<th class=" no-link last"><span class="nobr">Action</span> </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($users as $user){?>
							<tr class="odd pointer">
								<td><input type="checkbox" class="checkbox" name="ids[]" value="<?php echo $user->id?>" /></td>
								<td class=" "><?php echo $user->full_name?></td>
								<td class=" "><?php echo $user->subject?></td>
								<td class=" "><?php echo $user->contact?></td>
								<td class=" "><?php echo $user->email?></td>
								<td width="400"><?php echo $user->message?></td>
								<td class=" "><?php echo $user->date_created?></td>
								<td class=" last"><a href="<?php echo base_url()?>admin/contactQueries/delete/<?php echo $user->id?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure to delete this user ?')"><i class="fa fa-trash-o"></i> Delete </a></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
					</form>
				</div>
				<p><?php echo $links; ?></p>
			</div>
			<div class="clear"></div>
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
<script type="text/javascript">
$("#select_all").change(function(){  //"select all" change
    $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
});

//".checkbox" change
$('.checkbox').change(function(){
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
    }
    //check "select all" if all checkbox items are checked
    if ($('.checkbox:checked').length == $('.checkbox').length ){
        $("#select_all").prop('checked', true);
    }
});
function deleteData(){
	if(confirm("Are you sure to delete this contact queries?")){
		var str = $("#frm").serializeArray();
		$.ajax({
			type: "POST",  
			url: "<?php echo base_url()?>admin/ContactQueries/deleteData/",  
			data: str,  
			success: function(data) {
				window.location = '<?php echo base_url()?>admin/ContactQueries?msg=Deleted successfully';
			}
			
		});
	}
	return false;
}
</script>
</body>
</html>