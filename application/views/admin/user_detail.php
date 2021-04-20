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
                    <?php foreach ($userRow as $user) : ?>

                    
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            
                            <tr>
                                <th width="20%">Photo</th>
                                <td class=" ">
                                <img src="<?php echo base_url().'uploads/data/'. $user->photo; ?>" class="img-responsive img-circle" width="100" height="100" alt=""></td>
                            </tr>
                            <tr>
                                <th width="20%">User Name</th>
                                <td class=" "><?php echo $user->username?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td class=" "><?php echo $user->email?></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td class=" "><?php echo $user->country?></td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td class=" "><?php echo $user->location?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td class=" "><?php echo $user->address?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td class=" "><?php echo $user->contact?></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td class=" "><?php echo $user->date_of_birth?></td>
                            </tr>
                            <tr>
                                <th>Account Type</th>
                                <td class=" "><?php echo $user->account_type?></td>
                            </tr>
                            <tr>
                                <th>Latitude</th>
                                <td class=" "><?php echo $user->latitude?></td>
                            </tr>
                            <tr>
                                <th>Longitude</th>
                                <td class=" "><?php echo $user->longitude?></td>
                            </tr>

                        </table>
                    <?php endforeach ?>
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