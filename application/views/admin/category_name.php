<?php $this->load->view('admin/common/common-header');?>

<body class="nav-md">

    <div class="container body">
        <div class="main_container">
            <?php $this->load->view('admin/common/left-nav');?>
            <!-- top navigation -->
            <?php $this->load->view('admin/common/top-nav');?>
            <!-- /top navigfation -->
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
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>Title</th>
                                    <th>Date Created</th>
                                    <th class=" no-link last"><span class="nobr">Action</span></th> 
                                </tr>
                            </thead> 
                            <tbody>
                                <?php                                     
                                foreach($media as $m){
                                //$branch_name = $this->Location_model->getLocationById($m->location);
                                ?>
                                <tr class="odd pointer">
                                    <td><?php echo $m->tittle; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($m->date_created)); ?></td>
                                    <td class=" last" width="100" nowrap>
                                        <a href="<?php echo base_url()?>admin/category_name/edit/<?php echo $m->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                        <a href="<?php echo base_url()?>admin/category_name/delete?id=<?php echo $m->id?>" onClick="return confirm('Are you sure to delete this Item?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                    </td>
                                </tr>
                                <?php }?>
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
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    <?php $this->load->view('admin/common/common-scripts.php')?>
<!-- /datepicker -->
</body>

</html>