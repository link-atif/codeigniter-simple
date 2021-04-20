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

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3> <?php echo $page_heading;?></h3>
                        </div>
                        <div class="title_right">
                            <form name="frm">
                                <input type="hidden" name="per_page" value="<?php if(isset($_REQUEST['per_page'])){ echo $_REQUEST['per_page'];}?>" />
                                <div class="col-md-10 col-sm-5 col-xs-12 pull-right top_search">
                                    <div class="col-md-5 col-sm-5 col-xs-12 pull-right top_search">
                                        <div class="input-group">
                                        <input type="text" class="form-control" name="name" placeholder="Search Title" value="<?php echo ($this->input->get('name')) ?$this->input->get('name') : ''; ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Go!</button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    <?php if(isset($msg) && $msg!=''){?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php }?>
            <div class="row top_tiles">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>Picture</th>
                                    <th>Title</th>
                                    <th>Days</th>
                                    <th>Time PDT</th>
                                    <th>Time BST</th>
                                    <th>Price</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                            if(count($live_stream)>0){
                                            foreach($live_stream as $row){
                                        ?>
                                <tr class="odd pointer">
                                    <td class=" "><img width="100px" src="<?php echo base_url()?>uploads/slider/<?php echo $row->picture ;?>" alt="image" /></td>
                                    <td class=" "><?php echo $row->tittle;?></td>
                                    <td class=" "><?php echo $row->days;?></td>
                                    <td class=" "><?php echo $row->time_pdt;?></td>
                                    <td class=" "><?php echo $row->time_bst;?></td>
                                    <td class=" "><?php echo $row->price;?></td>
                                    <td class=" "><a href="<?php echo base_url()?>admin/live_stream/delete/<?php echo $row->id?>" onClick="return confirm('Are you sure to delete this image ?')"><i class="fa fa-times"></i></a></td>
                                    <td class=" "><a href="<?php echo base_url()?>admin/live_stream/edit/<?php echo $row->id?>"><i class="fa fa-pencil"></i></a></td>
                                </tr>
                                <?php 
                                          }  
                                        }else{
                                            echo "<div style='color:red;font-size:20px'>No Record Found</div>";
                                        }
                                        ?>
                            </tbody>
                        </table>
                    </div>
                    <div style="padding-left: 10px">
                        <ul class="pagination"><?php echo $links; ?></ul>
                    </div>
                </div> 
            </div>
                <?php $this->load->view('admin/common/footer.php')?>
                <!-- /footer content -->
            </div>
                    <div class="clearfix"></div>
            <!-- /page content -->
        </div>
    </div>
    <?php $this->load->view('admin/common/common-scripts.php')?>

</body>
</html>