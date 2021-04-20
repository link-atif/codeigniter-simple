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

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3> <?php echo $page_heading;?></h3>
                        </div>
                        <div class="clearfix"></div>
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?>
                        <!--<div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn"><button class="btn btn-default" type="button">Go!</button></span>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_content content">
                                    <div class="row">
                                        <?php 
                                            if(count($secondslider)>0){
                                            foreach($secondslider as $row){
                                        ?>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img  style="width: 100%; display: block;" src="<?php echo base_url()?>uploads/data/<?php echo $row->picture ;?>" alt="image" />
                                                    <div class="mask">
                                                        <p>&nbsp;</p>
                                                        <div class="tools tools-bottom">                                                            
                                                            <a href="<?php echo base_url()?>admin/secondslider/delete/<?php echo $row->id?>" onClick="return confirm('Are you sure to delete this image ?')"><i class="fa fa-times"></i></a>
                                                            <a href="<?php echo base_url()?>admin/secondslider/edit/<?php echo $row->id?>"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><?php echo $row->tittle_english;?></p>
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