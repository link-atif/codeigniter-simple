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
                            <form method="post" name="frm" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
                                 <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">title<span class="required">*</span>
                                    </label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($posts['title']) ? $posts['title'] : '';?>" />
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Sort Order <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input type="number" id="sort_order" name="sort_order" min="1" class="form-control col-md-7 col-xs-12" value="<?php echo isset($posts['sort_order']) ? $posts['sort_order'] : '';?>" />
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Status<span class="required">*</span>
                                    </label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <select type="text" id="status" name="status" class="form-control col-md-7 col-xs-12">
                                            <option value="1" <?php if ($posts['status'] =='1') {?> selected <?php } ?>>Enabled</option>
                                            <option value="0"<?php if ($posts['status'] =='0') {?> selected <?php } ?>>Disabled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="picture" id="picture">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Picture<span>*</span></label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                        <div id="myId" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                    </div>
                                </div>
                                <?php if(isset($posts['picture']) && $posts['picture']!=''){?>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <a href="<?php echo base_url();?>uploads/slider/<?php echo $posts['picture']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php
                                        $picture_name = $this->Common_model->resize($posts['picture'],250,150);
                                         echo $picture_name;?>" width="100px" height="100px" /></a>
                                    </div>
                                </div>
                                <?php }?>
                                <input type="hidden" name="old_picture" id="old_picture" value="<?php echo $posts['picture']?>">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                                <input name="image" type="file" id="upload" class="hidden" onChange="">
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
    
    <!-- /datepicker -->
</body>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>

<script src="<?php echo base_url();?>assets/js/custom.js"></script>

<!-- dropzone -->

<script type="text/javascript" src="<?php echo base_url()?>assets/js/dropzone/dropzone.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var myDropzone = new Dropzone(
            "div#myId",{ 
            dictDefaultMessage: "Drag image here",
            uploadMultiple: false,
            parallelUploads: 1,
            clickable: true,
            maxFiles: 1,
            url: "<?php echo base_url()?>admin/Retreatsphotos/uploadAddImage/"
        });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
        
    });
</script>
</html>