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
                    <div class="x_content">
                        <div class="x_panel">
                        <?php
                            if(isset($success)){
                        ?>
                        <div class="success_message"><?php echo $success; ?></div>
                        <?php }
                            if(validation_errors() || isset($error)) {
                        ?>
                        <div class="clear"></div>
                        <div class="error_message"><?php echo validation_errors(); echo isset($error) ? $error : ''; ?></div>
                        <?php }?>
                        <form method="post" action="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            <input type="hidden" name="id" value="<?php echo isset($userDetail['id']) ? $userDetail['id'] : '';?>">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Full Name 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:9px;">
                                    <?php echo ucwords($userDetail['full_name']);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:8px;">
                                    <?php echo $userDetail['email']?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username </label>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:8px;">
                                    <?php echo $userDetail['username']?>
                                    <br><br>
                                    <a href="<?php echo base_url()?>admin/adminUsers/editProfile" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                </div>

                            </div>
                        </form>
                        </div>
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