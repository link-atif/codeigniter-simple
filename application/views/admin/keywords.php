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
                <div class="success_message"><?php echo $msg; ?></div>
                <?php }?>
                <div class="x_content">
                    <div class="x_panel">
                        <?php if(isset($success) && $success!=''){?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php }if(validation_errors() || isset($error)) {?>
                        <div class="clear"></div>
                        <div class="alert alert-danger"><?php echo validation_errors(); echo isset($error) ? $error : ''; ?></div>
                        <?php }?>
                        <ul class="nav nav-tabs">
                            <?php foreach ($language as $key => $value) { ?>
                                <li <?php if($key==0){ ?> class="active" <?php } ?> ><a data-toggle="tab" href="#<?php echo $value->name; ?>"><?php echo ucfirst($value->name); ?></a></li>
                            <?php } ?>
                        </ul>
                        <br/>
                        <form method="post" action="" id="demo-form2" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
                            <div class="tab-content">
                                <?php foreach ($language as $key => $v) { ?> 
                                <div id="<?php echo $v->name; ?>" class="tab-pane fade <?php if($key==0){ ?> in active <?php } ?>">
                                    <input name="language_id[]" type="hidden" value="<?php echo $v->language_id; ?>">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading Merchandize<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="heading_mer<?php echo $v->name; ?>" name="heading_mer<?php echo $v->name; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $heading_mer[$key]; ?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Merchandize Description<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="mer_des<?php echo $v->name; ?>" name="mer_des<?php echo $v->name; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $mer_des[$key]; ?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Merchandize key<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="mer_key<?php echo $v->name; ?>" name="mer_key<?php echo $v->name; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $mer_key[$key]; ?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading Franchize<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="heading_fra<?php echo $v->name; ?>" name="heading_fra<?php echo $v->name; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $heading_fra[$key]; ?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Franchize Discription<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="fra_des<?php echo $v->name; ?>" name="fra_des<?php echo $v->name; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $fra_des[$key]; ?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Franchize Key<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="fra_key<?php echo $v->name; ?>" name="fra_key<?php echo $v->name; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $fra_key[$key]; ?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">We take your junk Heading<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="heading_junk<?php echo $v->name; ?>" name="heading_junk<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $heading_junk[$key]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Junk Description<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="junk_des<?php echo $v->name; ?>" name="junk_des<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $junk_des[$key]; ?>"/>
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Junk Key<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="junk_key<?php echo $v->name; ?>" name="junk_key<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $junk_key[$key]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading About<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="heading_about<?php echo $v->name; ?>" name="heading_about<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $heading_about[$key]; ?>"/>
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">About Description<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="about_des<?php echo $v->name; ?>" name="about_des<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $about_des[$key]; ?>"/>
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">About Key<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="about_key<?php echo $v->name; ?>" name="about_key<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $about_key[$key]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Heading Media<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="heading_media<?php echo $v->name; ?>" name="heading_media<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $heading_media[$key]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Media Discription<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="media_des<?php echo $v->name; ?>" name="media_des<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $media_des[$key]; ?>"/>
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Media key<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="media_key<?php echo $v->name; ?>" name="media_key<?php echo $v->name; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $media_key[$key]; ?>"/>
                                        </div>
                                    </div>
                                    
                                </div>
                            <?php } ?>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
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
</body>
</html><script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo base_url()?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo base_url()?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo base_url()?>assets/js/icheck/icheck.min.js"></script>
<script src="<?php echo base_url()?>assets/js/custom.js"></script>
<!-- dropzone -->
<script src="<?php echo base_url()?>assets/js/validator/validator.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/dropzone/dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.colorbox-min.js"></script>
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
<script type="text/javascript">

     $(document).ready(function(){
        //Examples of how to assign the Colorbox event to elements
        $(".group1").colorbox({rel:'group1'});
    });
</script>
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