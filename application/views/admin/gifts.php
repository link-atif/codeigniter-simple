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
                        <div class="title_right">
                            <form name="frm">
                                <input type="hidden" name="per_page" value="<?php if(isset($_REQUEST['per_page'])){ echo $_REQUEST['per_page'];}?>" />
                                <div class="col-md-10 col-sm-5 col-xs-12 pull-right top_search">
                                    <div class="col-md-5 col-sm-5 col-xs-12 pull-right top_search">
                                        <div class="input-group">
                                        <input type="text" class="form-control" name="name" placeholder="Search Collection by Tittle" value="<?php echo ($this->input->get('name')) ?$this->input->get('name') : ''; ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Go!</button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?> <div class="table-responsive">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>&nbsp;</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sort Order</th>
                                <th>Date Created</th>
                                <th class=" no-link last"><span class="nobr">Action</span></th> 
                            </tr>
                        </thead> 
                        <tbody>
                            <?php 
                                $i=1;
                                foreach($details as $d){
                                    $image_name = $d->picture;
                                    $name = $this->Modifiergroup_model->getcategoryby_Id($d->category_id);
                            ?>
                            <tr class="odd pointer">
                                <td><?php echo $i++; ?></td>
                                <td><?php if($image_name!=''){?><img src="<?php echo base_url()?>uploads/data/<?php echo $image_name;?>" width="100" height="100" /><?php }?></td>
                                <td><?php echo $d->name; ?></td>
                                <td><?php if(isset($name->tittle)) { echo $name->tittle; } ?></td>
                                <td><?php echo $d->sort_order; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($d->date_created)); ?></td>
                                 <td class=" last" width="100" nowrap>
                                    <a href="<?php echo base_url($this->prefix.'/'.$this->controller.'/edit/'.$d->id)?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="<?php echo base_url($this->prefix.'/'.$this->controller.'/delete?id='.$d->id)?>" onClick="return confirm('Are you sure to delete this Item?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                    
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table></div>
                    <p> <?php echo $links; ?></p>
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