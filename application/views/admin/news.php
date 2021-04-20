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
                    </div>
                        <div class="clearfix"></div>
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="table-responsive">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>Picture</th>
                                <th>Title</th>
                                <th>Details</th>
                                <th class=" no-link last"><span class="nobr">Action</span></th> 
                            </tr>
                        </thead> 
                        <tbody>
                            <?php 
                                 if(count($sliderImages)>0){
                                 foreach($sliderImages as $row){
                                    $image_name = $row->picture_main;
                            ?>
                            <tr class="odd pointer">
                                <td><?php if($image_name!=''){?><img src="<?php echo base_url()?>uploads/slider/<?php echo $image_name;?>" width="100" /><?php }?></td>
                                <td><?php echo $row->tittle_english?></td>
                                <td><?php echo substr(strip_tags($row->description_english),0,80);?></td>
                                 <td class=" last" width="100" nowrap>
                                    <a href="<?php echo base_url()?>admin/news/edit/<?php echo $row->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="<?php echo base_url()?>admin/News/delete/<?php echo $row->id?>?>" onClick="return confirm('Are you sure to delete this ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                </td>
                            </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table></div>
                    <!--<div class="table-responsive">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                     <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_content content">
                                    <div class="row">
                                        <?php 
                                           // if(count($sliderImages)>0){
                                           // foreach($sliderImages as $row){
                                        ?>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img  style="width: 100%; display: block;" src="<?php //echo base_url()?>uploads/slider/<?php //echo $row->picture_main ;?>" alt="image" />
                                                    <div class="mask">
                                                        <p>&nbsp;</p>
                                                        <div class="tools tools-bottom">                                                            
                                                            <a href="<?php// echo base_url()?>admin/News/delete/<?php //echo $row->id?>" onClick="return confirm('Are you sure to delete this image ?')"><i class="fa fa-times"></i></a>
                                                            <a href="<?php// echo base_url()?>admin/News/edit/<?php// echo $row->id?>"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><?php// echo $row->tittle_english;?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                         // }  
                                       // }else{
                                        //    echo "<div style='color:red;font-size:20px'>No Record Found</div>";
                                      //  }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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