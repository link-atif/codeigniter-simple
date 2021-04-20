
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
                        <!-- <div class="row">
                            <form id="import_frm" name="import_frm" method="post" action="<?php //echo base_url() ?>admin/products/import_products">
                                <div class="col-md-3">
                                    <div id="branch">
                                        <select name="branch_id" id="branch_id" class="form-control input-sm">
                                            <option value="">Select Branch</option>
                                            <?php //foreach ($branches as $key => $value) { ?>
                                            <option value="<?php //echo $value->id; ?>"><?php //echo $value->name; ?></option>
                                            <?php //} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0)" onclick="document.getElementById('import_frm').submit();" class="btn btn-info btn-sm">Import</a>
                                </div>
                            </form>
                        </div> -->
                    </div>
                    <div class="clearfix"></div>
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
    								<th>Picture</th>
    								<th>Name</th>
                                    <!-- <th>Category Name</th>
                                    <th>ModifierGroup</th> -->
                                    <th>Price</th>
                                    <th>Status</th>
    								<!-- <th>Branch</th> -->
                                    <th class=" no-link last"><span class="nobr">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
    								foreach($products as $product){
                                       // $cat_name = $this->Media_model->getCategoryName($product->category_id);
                                       // $mod_name = $this->Modifiergroup_model->getNameById($product->modifiergroup_id);
                                       // $branch_name = $this->Location_model->getLocationById($product->branch_id);
                                ?> 
                                <tr class="odd pointer">
                                    <td><?php if($product->picture_s1!=''){?><img src="<?php echo base_url()?>uploads/slider/<?php echo $product->picture_s1;?>" width="100px" height="100px" /><?php }?></td>
                                    <td><?php echo $product->product_name_english; ?></td>
                                   <!--  <td><?php //if(isset($cat_name->tittle)) { echo $cat_name->tittle; } ?></td>
                                    <td><?php// if(isset($mod_name->name)) { echo $mod_name->name; } ?></td> -->
                                    <td><?php echo $product->price; ?></td>
                                    <td><?php if($product->status == 1)
                                    {echo "Enabled";}else {
                                        echo "Disabled";
                                    }; ?></td>
                                   <!--  <td><?php// echo substr(strip_tags($branch_name),0,50);?></td> -->
                                    <td class=" last" width="100">
                                        <a href="<?php echo base_url()?>admin/products/editProduct/<?php echo $product->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
    									<a href="<?php echo base_url()?>admin/products/deleteProduct?id=<?php echo $product->id?>" onClick="return confirm('Are you sure to delete this product ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <p> <?php echo $links; ?></p>
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