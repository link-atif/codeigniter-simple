<?php $this->load->view('admin/common/common-header');?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php $this->load->view('admin/common/left-nav');?>
            <?php $this->load->view('admin/common/top-nav');?>
            <div class="right_col" role="main">
                <div class="x_content content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?php echo $page_heading;?></h3>
                        </div>
                        <div class="title_right">
                            <form name="frm">
                                <input type="hidden" name="per_page" value="<?php if(isset($_REQUEST['per_page'])){ echo $_REQUEST['per_page'];}?>" />
                                <div class="col-md-10 col-sm-5 col-xs-12 pull-right top_search">
                                    <div class="col-md-5 col-sm-5 col-xs-12 pull-right top_search">
                                        <div class="input-group">
                                        <input type="text" class="form-control" name="name" placeholder="Search Products..." value="<?php echo ($this->input->get('name')) ?$this->input->get('name') : ''; ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Go!</button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <form id="import_frm" name="import_frm" method="post" action="<?php echo base_url() ?>admin/modifiergroup/import_modifiergroup">
                                <div class="col-md-3">
                                    <div id="branch">
                                        <select name="branch_id" id="branch_id" class="form-control input-sm">
                                            <option value="">Select Branch</option>
                                            <?php foreach ($branches as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0)" onclick="document.getElementById('import_frm').submit();" class="btn btn-info btn-sm">Import</a>
                                </div>
                            </form>
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
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th class=" no-link last"><span class="nobr">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($detail as $d) { 
                                $branch_name = $this->Location_model->getLocationById($d->branch_id);
                            ?>
                                <tr>
                                    <td><b><?php echo $d->name; ?></b></td>
                                    <td><b><?php echo $branch_name; ?></b></td>
                                    <td><a href="<?php echo base_url() ?>admin/modifiergroup/edit_modifiergroup?id=<?php echo $d->id; ?>" class="btn btn-xs btn-default btn-falt"><i class="fa fa-edit"></i></a><a href="<?php echo base_url('admin/modifiergroup/delete_modifiergroup') ?>/<?php echo $d->id; ?>" class="btn btn-xs btn-default btn-falt"><i class="fa fa-remove"></i></button></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <p><?php echo $links; ?> </p>
                    </div>
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