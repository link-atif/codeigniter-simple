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
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?>
                    <div class="table-responsive">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th style="width:45%" nowrap="nowrap">First Name</th>
                                <th style="width:45%" nowrap="nowrap">Last Name</th>
                                <th style="width:10%">Adress</th>
                                <th style="width:10%">Phone</th>
                                <th style="width:10%">Email</th>
                                <th style="width:10%">city</th>
                                <th style="width:10%">sate</th>
                                <th style="width:10%">country</th>
                                <th style="width:10%">Zip Code</th>

                                <th align="right" class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pages as $page){?>
                                
                            <tr class="odd pointer">
                                <td class=""><?php echo $page->first_name;?></td>
                                <td class=""><?php echo $page->last_name;?></td>
                                <td class=""><?php echo $page->adress;?></td>
                                <td class=""><?php echo $page->phone;?></td>
                                <td class=""><?php echo $page->email;?></td>
                                <td class=""><?php echo $page->city;?></td>
                                <td class=""><?php echo $page->state;?></td>
                                <td class=""><?php echo $page->country;?></td>
                                <td class=""><?php echo $page->zip_code;?></td>
                                <td align="left" class=" last">
                                    <a href="<?php echo base_url()?>admin/Customers/edit?id=<?php echo $page->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="<?php echo base_url()?>admin/Customers/delete/<?php echo $page->id?>" onClick="return confirm('Are you sure to delete this ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                   
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