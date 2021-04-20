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
                            
                            <br/>
                            <form method="post" name="frm" action="" id="demo-form2" class="form-horizontal form-label-left">
                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input type="text" name="name" class="form-control col-md-7 col-xs-12" value="<?php echo isset($detail['name']) ? $detail['name'] : '';?>" />
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Alternate Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input type="text" name="alternate_name" class="form-control col-md-7 col-xs-12" value="<?php echo isset($detail['alternate_name']) ? $detail['alternate_name'] : '';?>" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
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
    <!-- /datepicker -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/custom.js"></script>
    </body>
</html>