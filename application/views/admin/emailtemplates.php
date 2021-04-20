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
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th style="width:10%">Name</th>
                                <th style="width:15%">From name</th>
                                <th style="width:10%">From Email</th>
                                <th style="width:40%">Subject</th>
                                <th align="right" class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pages as $page){?>
                            <tr class="odd pointer">
                                <td class=""><?php echo $page->name;?></td>
                                <td class=""><?php echo $page->from_name?></td>
                                <td class=""><?php echo $page->from_email?></td>
                                <td class=""><?php echo $page->subject?></td>
                                <td align="left" class=" last">
                                    <a href="<?php echo base_url()?>admin/emailtemplates/edit?id=<?php echo $page->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
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