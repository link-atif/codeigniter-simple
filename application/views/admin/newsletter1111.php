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

                    <div class="row">

                        <div class="col-md-2">

                           <a href="<?php echo base_url()?>admin/newsletter/add" class="btn btn-danger"><i class="fa fa-plus"></i> Add Media </a> 

                        </div>

                    </div> 

                    <div class="table-responsive">

                    <table id="example" class="table table-striped responsive-utilities jambo_table">

                        <thead>

                            <tr class="headings">

								<th>&nbsp;</th>

								<th>Picture</th>

								<th>Title</th>

								<th>Link</th>

                                <th style="width: 15%" class=" no-link last"><span class="nobr">Action</span></th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php 

								$i=1;

								foreach($mediaRow as $media){

									$image_name = $media->image;

							?>

                            <tr class="odd pointer">

                                <td><?php echo $i++;?></td>

                                <td><?php if($image_name!=''){?><img src="<?php echo base_url()?>uploads/data/<?php echo $image_name;?>" width="100" /><?php }?></td>

                                <td><?php echo $this->Newsletter_model->firstlangTittle($media->id);?></td>

                                <td><?php echo substr(strip_tags($media->link),0,80);?></td>

                                <td class=" last" width="100" nowrap>

                                    <a href="<?php echo base_url()?>admin/newsletter/edit/<?php echo $media->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>

									<a href="<?php echo base_url()?>admin/newsletter/delete?id=<?php echo $media->id?>" onClick="return confirm('Are you sure to delete this ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>

                                </td>

                            </tr>

                            <?php }?>

                        </tbody>

                    </table></div>

                    <p><?php echo $links; ?></p>

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