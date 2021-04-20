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
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th style="width:20%">UserName</th>
                                <th style="width:30%">Email</th>
                                <th style="width:20%">Country</th>
                                <th style="width:15%">Account Type</th>
                                <th align="right" class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user){?>
                            <tr class="odd pointer">
                                <td class=""><?php echo $user->username;?></td>
                                <td class=""><?php echo $user->email?></td>
                                <td class=""><?php echo $user->country?></td>
                                <td class=""><?php echo $user->account_type?></td>
                                <td align="left" class=" last">
                                    <a href="<?php echo base_url()?>admin/Users/detail?id=<?php echo $user->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Detail </a>
                                    <a href="<?php echo base_url()?>admin/Users/delete/<?php echo $user->id?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure to delete this user ?')"><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php echo $links; ?>
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