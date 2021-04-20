<?php $this->load->view('admin/common/common-header');?>
</style>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php $this->load->view('admin/common/left-nav');?>
            <!-- top navigation -->
            <?php $this->load->view('admin/common/top-nav');?>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3> <?php echo $page_heading;?></h3>
                        </div>
                        <div class="clearfix"></div>
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?>
                    <div class="title_right" style="width: 100%">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <div class="input-group pull-right" style="text-align: right;">
                                <span class="input-group-btn"><a href="<?php echo base_url('admin/instagram/instagramPosts'); ?>" class="btn btn-primary" type="button">Load Posts</a></span>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_content content">
                                    <div class="row">
                                        <?php 
                                            if(count($instagram)>0){
                                            foreach($instagram as $row){
                                        ?>
                                        <div class="col-md-3">
                                            <div class="thumbnail" style="height: 300px !important;">
                                                <div class="image view view-first" style="height: auto;">
                                                    <?php if (!empty($row->picture)) { ?>
                                                        <img  style="width: 100%; display: block;" src="<?php echo base_url()?>uploads/slider/<?php echo $row->picture ?>" alt="image" />
                                                  <?php   }else{ ?>
                                                    <img  style="width: 100%; display: block;" src="<?php echo $row->media_url ?>" alt="image" />
                                                <?php } ?>
                                                    <div class="mask">
                                                        <p>&nbsp;</p>
                                                        <h3 style="color:white;"><?php echo $row->sort_order ?></h3>
                                                        <div class="tools tools-bottom">
                                                            <a href="<?php echo $row->permalink; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                                            <a href="<?php echo base_url()?>admin/instagram/edit/<?php echo $row->id?>"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                          }  
                                        }else{
                                            echo "<div style='color:red;font-size:20px'>No Record Found</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer content -->
                <?php $this->load->view('admin/common/footer.php')?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
    <?php $this->load->view('admin/common/common-scripts.php')?>

</body>
</html>