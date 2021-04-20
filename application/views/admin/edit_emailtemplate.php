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
                        <form method="post" name="frm" action="" id="demo-form2" class="form-horizontal form-label-left" novalidate>
                            <input type="hidden" name="id" value="<?php echo isset($emailTemplateRow['id']) ? $emailTemplateRow['id'] : '';?>" />
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">From Name <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="from_name" name="from_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($emailTemplateRow['from_name']) ? $emailTemplateRow['from_name'] : '';?>" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">From Email <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="from_email" name="from_email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($emailTemplateRow['from_email']) ? $emailTemplateRow['from_email'] : '';?>" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Subject <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="subject" name="subject" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($emailTemplateRow['subject']) ? $emailTemplateRow['subject'] : '';?>" />
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Detail <span class="required">*</span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <textarea name="message" id="descr" class="form-control" style="height:300px"><?php echo isset($emailTemplateRow['message']) ? $emailTemplateRow['message'] : '';?></textarea>
                                </div>
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
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url()?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo base_url()?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>


<script src="<?php echo base_url()?>assets/js/custom.js"></script>


<script type="text/javascript" src="<?php echo base_url()?>assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">

tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
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