
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
                        <!-- <div class="row">
                            <form id="import_frm" name="import_frm" method="post" action="<?php //echo base_url() ?>admin/products/import_products">
                                <div class="col-md-3">
                                    <div id="branch">
                                        <select name="branch_id" id="branch_id" class="form-control input-sm">
                                            <option value="">Select Branch</option>
                                            <?php //foreach ($branches as $key => $value) { ?>
                                            <option value="<?php //echo $value->id; ?>"><?php //echo $value->name; ?></option>
                                            <?php //} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0)" onclick="document.getElementById('import_frm').submit();" class="btn btn-info btn-sm">Import</a>
                                </div>
                            </form>
                        </div> -->
                    </div>
                    <div class="clearfix"></div>
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>Picture</th>
                                    <th>Type</th>
                                    <th class=" no-link last"><span class="nobr">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                            if(count($sliderImages)>0){
                                            foreach($sliderImages as $row){
                                            $picture_name = $this->Common_model->resize($row->picture,250,150);
                                        ?>
                                <tr class="odd pointer">
                                    <td><?php if($row->picture!=''){?><img src="<?php echo base_url()?>uploads/slider/<?php echo $picture_name; ?>" width="100px" height="100px" /><?php }?></td>
                                    <td><?php if($row->type == 'ondemand')
                                            {echo "Main Subscription";
                                    }elseif($row->type == 'dubai') {
                                        echo "Dubai Studio";
                                    }else{
                                        echo "Retreats";
                                    }
                                    ; ?></td>
                                    <td class=" last" width="100">
                                        <a href="<?php echo base_url()?>admin/sliderimages/edit/<?php echo $row->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                        <a href="<?php echo base_url()?>admin/sliderimages/delete/<?php echo $row->id?>" onClick="return confirm('Are you sure to delete this image ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                    </td>
                                </tr>
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
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
</body>

</html>