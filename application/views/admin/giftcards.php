<?php $this->load->view('admin/common/common-header');?>
<style type="text/css">
.thumb{
  margin: 24px 5px 20px 0;
  width: 150px;
  float: left;
}
#blah {
  border: 2px solid;
  display: block;
  background-color: white;
  border-radius: 5px;
}

.img-wraps {
    position: relative;
    display: inline-block;
   
    font-size: 0;
}
.img-wraps .closes {
    position: absolute;
    top: 5px;
    right: 8px;
    z-index: 100;
    background-color: #FFF;
    padding: 4px 3px;
    
    color: #000;
    font-weight: bold;
    cursor: pointer;
   
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
    border:1px solid red;
}
.img-wraps:hover .closes {
    opacity: 1;
}
</style>
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
                            <h3><?php echo $page_heading." of ".$name ; ?></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?>
                    <form method="post" name="frm_reg" enctype="multipart/form-data" action="<?php echo base_url($this->prefix.'/'.$this->controller.'/multipleImageStore') ?>" id="demo-form2" novalidate>
                        <input type="hidden" name="gift_id" id="gift_id" value="<?php echo $gift_id; ?>">
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Pictures <span class="required">*</span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="file" name="files[]" multiple="multiple" required="required" class="form-control col-md-5 col-xs-12" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1" style="padding-top: 10px;">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="row" style="margin-top: 20px;">
                        <?php 
                        if(count($giftCards) > 0){
                            foreach ($giftCards as $key => $g) { ?>
                            <div class="col-md-3" style="margin-top: 5px;">
                                <div class="img-wraps">
                                    <a href="<?php echo base_url() ?>admin/gifts/deleteGiftCard/<?php echo $g->id ?>/<?php echo $gift_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><span class="closes" title="Delete">&times;</span></a>
                                    <img height="150px;" width="150px;" style="padding-top: 10px;" src="<?php echo base_url() ?>/uploads/giftCards/<?php echo $g->card_picture; ?>">
                                </div>
                            </div>
                        <?php 
                            }
                        } ?>
                    </div>
                </div>
                <!-- /page content -->
            </div>
            <div class="clear"></div>
            <!-- footer content -->
            <?php //$this->load->view('admin/common/footer');?>
            <!-- /footer content -->
        </div>
    </div>
    <?php $this->load->view('admin/common/common-scripts.php')?>
    <!-- /datepicker -->
</body>
</html>