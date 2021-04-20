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
                                
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['name']) ? $productDetail['name'] : '';?>" />
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Adress <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="adress" name="adress" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($pageDetail['adress']) ? $pageDetail['adress'] : '';?>" />
                                            </div>    
                                        </div>
                                         <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Phone <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="phone" name="phone" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($pageDetail['phone']) ? $pageDetail['phone'] : '';?>" />
                                            </div>    
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Email <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($pageDetail['email']) ? $pageDetail['email'] : '';?>" />
                                            </div>    
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Latitude <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="latitue" name="latitue" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($pageDetail['latitue']) ? $pageDetail['latitue'] : '';?>" />
                                            </div>    
                                        </div>
                                         <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Longitude <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="longitude" name="longitude" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($pageDetail['longitude']) ? $pageDetail['longitude'] : '';?>" />
                                            </div>    
                                        </div>
                                       
                                         
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Time Starts<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input id="basicExample" name="time_starts" type="text" class="time" />                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Time End <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input id="basicExamples" name="time_end" type="text" class="time" />
                                            </div>
                                        </div>
                                        

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
    
    <!-- /datepicker -->
</body>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>

<script src="<?php echo base_url();?>assets/js/custom.js"></script>



<!-- dropzone -->
<script type="text/javascript" src="datepair.js"></script>
<script type="text/javascript" src="jquery.datepair.js"></script>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/jquery.timepicker.css" />

<script>
    $(function() {
                $('#basicExample').timepicker();
            });
</script>
<script>
    $(function() {
                $('#basicExamples').timepicker();
            });
</script>