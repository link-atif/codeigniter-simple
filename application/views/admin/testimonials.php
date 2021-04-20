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
                    <?php if(isset($msg)){?>
                    <div class="success_message"><?php echo $msg; ?></div>
                    <?php }?>
                    <div class="table-responsive">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>ID</th>
                                <th>Testimonials Page</th>
                                <th>Name</th>
                                <th>Review Messages</th>
                                <th align="right" class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($testimonials as $testimonial){
                                if ($testimonial->testimonial_page == 0) {
                                    $product_name_english = "Retreats";
                                }elseif($testimonial->testimonial_page == 1){
                                    $product_name_english = "Membership";
                                }else{
                                    $product_name_english = "Live stream Classes";
                                    }
                                ?>
                            <tr class="odd pointer">
                                <td class=""><?php echo $testimonial->id;?></td>
                                <td class=""><?php echo $product_name_english?></td>
                                <td class=""><?php echo $testimonial->name?></td>
                                <td class=""><?php echo $testimonial->testimonial_message?></td>
                                <td align="left" class=" last">
                                    <a href="<?php echo base_url()?>admin/Testimonials/editTestimonial?id=<?php echo $testimonial->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="<?php echo base_url()?>admin/Testimonials/delete/<?php echo $testimonial->id?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure to delete this testimonial ?')"><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table></div>
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