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
                        <!--<div class="title_right">
                            <form>
                                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" placeholder="Search queryDetail..." value="<?php echo ($this->input->get('name')) ?$this->input->get('name') : ''; ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Go!</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>-->
                    </div>
                    <div class="clearfix"></div>
                    <?php if(isset($msg)){?>
                    <div class="success_message"><?php echo $msg; ?></div>
                    <?php }?>
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        
                            <tr>
                                <th width="20%">Contact Name</th>
                                <td class=" "><?php echo $queryDetail->contact_name?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td class=" "><?php echo $queryDetail->email?></td>
                            </tr>
                            <tr>
                                <th>Reason</th>
                                <td class=" "><?php echo $queryDetail->reason?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td class=" "><?php echo $queryDetail->telephone?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td class=" "><?php echo $queryDetail->address?></td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td class=" "><?php echo $queryDetail->city?></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td class=" "><?php echo $queryDetail->state?></td>
                            </tr>
                            <tr>
                                <th>Zip</th>
                                <td class=" "><?php echo $queryDetail->zip?></td>
                            </tr>
                            <tr>
                                <th>Created Date</th>
                                <td class=" "><?php echo $queryDetail->date_created?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td class=" "><?php echo $queryDetail->description?></td>
                            </tr>
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