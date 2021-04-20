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
                    <div class="x_content">
                        <div class="x_panel">
                            <?php
                                if(isset($success)){
                            ?>
                            <div class="success_message"><?php echo $success; ?></div>
                            <?php }
                                if(validation_errors() || isset($error)) {
                            ?>
                            <div class="clear"></div>
                            <div class="error_message"><?php echo validation_errors(); echo isset($error) ? $error : ''; ?></div>
                            <?php }?>
                           
                            <br/>
                            <form method="post" name="frm" action="" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
                                <input type="hidden" name="clover_id" id="clover_id" value="<?php echo isset($productDetail['clover_id']) ? $productDetail['clover_id'] : ''; ?>">
                                        
                                        <!--  <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Category<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <select class="form-control" name="category_id">
                                                    <option value="">Select Category</option>
                                                    <?php //foreach ($categories as $key => $c) { ?>
                                                        <option value="<?php //echo $c->clover_id ?>"><?php //echo $c->tittle ?></option>
                                                    <?php //} ?>
                                                </select>
                                                <script type="text/javascript">
                                                    document.frm.category_id.value='<?php //echo $productDetail['category_id']?>';
                                                </script>
                                            </div>
                                        </div> -->
                                        <!-- <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Modifier Group<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <select class="form-control" name="modifiergroup_id">
                                                    <option value="">Select ModifierGroup</option>
                                                    <?php //foreach ($modifiergroups as $m) { ?>
                                                        <option value="<?php //echo $m['mId'] ?>"><?php //echo $m['name'] ?></option>
                                                    <?php //} ?>
                                                </select>
                                                <script type="text/javascript">
                                                    document.frm.modifiergroup_id.value='<?php //echo $productDetail['modifiergroup_id']?>';
                                                </script>
                                            </div>
                                        </div> -->
                                        <!-- <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Branch<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <select class="form-control" name="branch_id">
                                                    
                                                    <?php //foreach ($branches as $key => $c) { ?>
                                                        <option value="<?php //echo $c->id ?>"><?php //echo $c->name ?></option>
                                                    <?php //} ?>
                                                </select>
                                                <script type="text/javascript">
                                                    document.frm.branch_id.value='<?php //echo $productDetail['branch_id']?>';
                                                </script>
                                            </div>
                                        </div> -->
                                         <!-- <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Category Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" name="category_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php// echo isset($productDetail['category_name']) ? $productDetail['category_name'] : '';?>" />
                                            </div>
                                        </div> -->
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="title">Categories<span class="required">* </span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12"> 
                                                <select class="form-control col-md-7 col-xs-12" name="category" id="category">
                                                    <option value="">Select Category</option>
                                                    <?php foreach($categories as $category){?>
                                                    <option  value="<?php echo $category->id?>"><?php echo $category->title_english?></option>
                                                <?php }?>
                                                </select>
                                                <?php if(isset($productDetail['category'])){?>
                                                <script type="text/javascript">
                                                document.frm.category.value = "<?php echo $productDetail['category']?>";
                                                </script>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Name English<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" name="product_name_english" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['product_name_english']) ? $productDetail['product_name_english'] : '';?>" />
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description English<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="description_english" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['description_english']) ? $productDetail['description_english'] : '';?></textarea>
                                            </div>
                                        </div><div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Second English<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="description_sec_english" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['description_sec_english']) ? $productDetail['description_sec_english'] : '';?></textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail English<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="detail_english" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['detail_english']) ? $productDetail['detail_english'] : '';?></textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Name Arabic<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" name="product_name_arabic" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['product_name_arabic']) ? $productDetail['product_name_arabic'] : '';?>" />
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Arabic<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="description_arabic" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['description_arabic']) ? $productDetail['description_arabic'] : '';?></textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Second Arabic<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="description_sec_arabic" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['description_sec_arabic']) ? $productDetail['description_sec_arabic'] : '';?></textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail Arabic<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="detail_arabic" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['detail_arabic']) ? $productDetail['detail_arabic'] : '';?></textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Sort Order <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="sort_order" name="sort_order" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['sort_order']) ? $productDetail['sort_order'] : '';?>" />
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Price<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="price" name="price" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['price']) ? $productDetail['price'] : '';?>" />
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Book An Experience Price<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="book_an_experience_price" name="book_an_experience_price" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['book_an_experience_price']) ? $productDetail['book_an_experience_price'] : '';?>" />
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Quantity<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="quantity" name="quantity" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['quantity']) ? $productDetail['quantity'] : '';?>" />
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Status<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <select type="text" id="status" name="status" class="form-control col-md-7 col-xs-12">
                                                    <option value="1" <?php if ($productDetail['status'] =='1') {?> selected <?php } ?>>Enabled</option>
                                                    <option value="0"<?php if ($productDetail['status'] =='0') {?> selected <?php } ?>>Disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="picture_main" id="picture_main">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail Page Main Picture(1245×699)<span>*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                                <div id="main" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                            </div>
                                        </div>
                                            <?php if(isset($productDetail['picture_main']) && $productDetail['picture_main']!=''){?>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <a href="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_main']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_main']?>" width="100px" height="100px" /></a>
                                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/products/deleteimageFirst?id=<?php echo $productDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <input type="hidden" name="old_main_picture" id="old_main_picture" value="<?php echo $productDetail['picture_main']?>">
                                            <input type="hidden" name='merchandise_id' value="<?php echo $productDetail['id'] ?>">


                                        <h3>Detail Page Additional Pictures</h3>

                                        <div class="form-group">
                                            <input type="hidden" name="picture_add1" id="picture_add1">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail Page Main Picture(1245×699)<span>*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                                <div id="additional1" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                            </div>
                                        </div>
                                            <?php if(isset($productDetail['picture_add1']) && $productDetail['picture_add1']!=''){?>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <a href="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_add1']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_add1']?>" width="100px" height="100px" /></a>
                                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/products/deleteimageAdd1?id=<?php echo $productDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <input type="hidden" name="old_add1_picture" id="old_add1_picture" value="<?php echo $productDetail['picture_add1']?>">
                                            <input type="hidden" name='merchandise_id' value="<?php echo $productDetail['id'] ?>">

                                            <div class="form-group">
                                            <input type="hidden" name="picture_add2" id="picture_add2">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail Page Main Picture(1245×699)<span>*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                                <div id="additional2" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                            </div>
                                        </div>
                                            <?php if(isset($productDetail['picture_add2']) && $productDetail['picture_add2']!=''){?>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <a href="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_add2']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_add2']?>" width="100px" height="100px" /></a>
                                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/products/deleteimageAdd2?id=<?php echo $productDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <input type="hidden" name="old_add2_picture" id="old_add2_picture" value="<?php echo $productDetail['picture_add2']?>">
                                            <input type="hidden" name='merchandise_id' value="<?php echo $productDetail['id'] ?>">

                                            <div class="form-group">
                                            <input type="hidden" name="picture_add3" id="picture_add3">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail Page Main Picture(1245×699)<span>*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                                <div id="additional3" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                            </div>
                                        </div>
                                            <?php if(isset($productDetail['picture_add3']) && $productDetail['picture_add3']!=''){?>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <a href="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_add3']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_add3']?>" width="100px" height="100px" /></a>
                                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/products/deleteimageAdd3?id=<?php echo $productDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <input type="hidden" name="old_add3_picture" id="old_add3_picture" value="<?php echo $productDetail['picture_add3']?>">
                                            <input type="hidden" name='merchandise_id' value="<?php echo $productDetail['id'] ?>">






                                        <div class="form-group">
                                            <input type="hidden" name="picture_s1" id="picture_s1">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Product Page Mian Picture(251×143)<span>*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                                <div id="s1" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                            </div>
                                        </div>
                                            <?php if(isset($productDetail['picture_s1']) && $productDetail['picture_s1']!=''){?>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <a href="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_s1']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_s1']?>" width="100px" height="100px" /></a>
                                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/products/deleteimageSecond?id=<?php echo $productDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <input type="hidden" name="old_s1_picture" id="old_s1_picture" value="<?php echo $productDetail['picture_s1']?>">
                                            <input type="hidden" name='merchandise_id' value="<?php echo $productDetail['id'] ?>">


                                        <div class="form-group">
                                            <input type="hidden" name="picture_s2" id="picture_s2">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Picture 3(251×143)<span>*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                                <div id="s2" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                            </div>
                                        </div>
                                            <?php if(isset($productDetail['picture_s2']) && $productDetail['picture_s2']!=''){?>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <a href="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_s2']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_s2']?>" width="100px" height="100px" /></a>
                                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/products/deleteimageThird?id=<?php echo $productDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <input type="hidden" name="old_s2_picture" id="old_s2_picture" value="<?php echo $productDetail['picture_s2']?>">
                                            <input type="hidden" name='merchandise_id' value="<?php echo $productDetail['id'] ?>">
                                        <div class="form-group">
                                            <input type="hidden" name="picture_s3" id="picture_s3">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Picture 4(251×143)<span>*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                                <div id="s3" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                            </div>
                                        </div>
                                            <?php if(isset($productDetail['picture_s3']) && $productDetail['picture_s3']!=''){?>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <a href="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_s3']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php echo $productDetail['picture_s3']?>" width="100px" height="100px" /></a>
                                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/products/deleteimageForth?id=<?php echo $productDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <input type="hidden" name="old_s3_picture" id="old_s3_picture" value="<?php echo $productDetail['picture_s3']?>">
                                            <input type="hidden" name='merchandise_id' value="<?php echo $productDetail['id'] ?>">              
                                        
                                    
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                                <input name="image" type="file" id="upload" class="hidden" onChange="">
                            </form>
                        </div>
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
    
    <!-- /datepicker -->
</body>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>

<script src="<?php echo base_url();?>assets/js/custom.js"></script>



<!-- dropzone -->

<script type="text/javascript" src="<?php echo base_url()?>assets/js/dropzone/dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        paste_data_images: true,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        file_picker_callback: function(callback, value, meta) {
            if (meta.filetype == 'image') {
                $('#upload').trigger('click');
                $('#upload').on('change', function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        callback(e.target.result, {
                            alt: ''
                        });
                    };
                    reader.readAsDataURL(file);
                });
            }
        },
        templates: [{title: 'Test template 1',content: 'Test 1'}, {title: 'Test template 2',content: 'Test 2'}]
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var myDropzone = new Dropzone(
                                "div#main",{ 
                                dictDefaultMessage: "Drag image here",
                                uploadMultiple: false,
                                parallelUploads: 1,
                                clickable: true,
                                maxFiles: 1,
                                url: "<?php echo base_url()?>admin/products/uploadAddImage/"
                            });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture_main").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
        
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var myDropzone = new Dropzone(
                                "div#additional1",{ 
                                dictDefaultMessage: "Drag image here",
                                uploadMultiple: false,
                                parallelUploads: 1,
                                clickable: true,
                                maxFiles: 1,
                                url: "<?php echo base_url()?>admin/products/uploadAddImage1/"
                            });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture_add1").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
        
    });
</script><script type="text/javascript">
    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var myDropzone = new Dropzone(
                                "div#additional2",{ 
                                dictDefaultMessage: "Drag image here",
                                uploadMultiple: false,
                                parallelUploads: 1,
                                clickable: true,
                                maxFiles: 1,
                                url: "<?php echo base_url()?>admin/products/uploadAddImage/"
                            });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture_add2").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
        
    });
</script><script type="text/javascript">
    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var myDropzone = new Dropzone(
                                "div#additional3",{ 
                                dictDefaultMessage: "Drag image here",
                                uploadMultiple: false,
                                parallelUploads: 1,
                                clickable: true,
                                maxFiles: 1,
                                url: "<?php echo base_url()?>admin/products/uploadAddImage/"
                            });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture_add3").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
        
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var myDropzone = new Dropzone(
                                "div#s1",{ 
                                dictDefaultMessage: "Drag image here",
                                uploadMultiple: false,
                                parallelUploads: 1,
                                clickable: true,
                                maxFiles: 1,
                                url: "<?php echo base_url()?>admin/products/uploadAddImage1/"
                            });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture_s1").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
        
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var myDropzone = new Dropzone(
                                "div#s2",{ 
                                dictDefaultMessage: "Drag image here",
                                uploadMultiple: false,
                                parallelUploads: 1,
                                clickable: true,
                                maxFiles: 1,
                                url: "<?php echo base_url()?>admin/products/uploadAddImage1/"
                            });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture_s2").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
        
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var myDropzone = new Dropzone(
                                "div#s3",{ 
                                dictDefaultMessage: "Drag image here",
                                uploadMultiple: false,
                                parallelUploads: 1,
                                clickable: true,
                                maxFiles: 1,
                                url: "<?php echo base_url()?>admin/products/uploadAddImage1/"
                            });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture_s3").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
        
    });
</script>
</html>
<script src="<?php echo base_url()?>assets/js/validator/validator.js"></script>
<script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
        .on('keyup blur', 'input', function () {
            validator.checkField.apply($(this).siblings().last()[0]);
        });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function (e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }

        if (submit)
            this.submit();
        return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function () {
        $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function () {
        validator.defaults.alerts = (this.checked) ? false : true;
        if (this.checked)
            $('form .alert').remove();
    }).prop('checked', false);
</script>