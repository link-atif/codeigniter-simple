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
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_content content">
                                    <div class="row">
                                        <?php 
                                            if(count($posts)>0){
                                            foreach($posts as $row){
                                        ?>
                                        <div class="col-md-3">
                                            <div class="thumbnail">
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
                                                            <a href="<?php echo base_url()?>admin/Retreatsphotos/edit/<?php echo $row->id?>"><i class="fa fa-pencil"></i></a>
                                                            <a onclick="return confirm('Are you sure?')" href="<?php echo base_url()?>admin/Retreatsphotos/delete/<?php echo $row->id?>"><i class="fa fa-trash"></i></a>
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