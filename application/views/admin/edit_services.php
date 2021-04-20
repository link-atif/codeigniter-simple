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
                        <form method="post" name="frm" action="" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
                            <input type="hidden" name="id" value="<?php echo isset($sliderDetail['id']) ? $sliderDetail['id'] : '';?>">
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Title <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['title']) ? $sliderDetail['title'] : '';?>" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <textarea id="detail" name="detail" class="form-control col-md-7 col-xs-12"><?php echo isset($sliderDetail['detail']) ? $sliderDetail['detail'] : '';?></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Icon Name <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['name']) ? $sliderDetail['name'] : '';?>" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Link <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="link" name="link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['link']) ? $sliderDetail['link'] : '';?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
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
                                "div#myId",{ 
                                dictDefaultMessage: "Drag image here",
                                uploadMultiple: false,
                                parallelUploads: 1,
                                clickable: true,
                                maxFiles: 1,
                                url: "<?php echo base_url()?>admin/news/uploadAddImage/"
                            });
        myDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#picture_name").val(obj.picture_name);
            }else{
                alert(obj.error);
            }
        });
        myDropzone.on("canceled",function(file,response){
            alert('Only one file upload is allowed');
        })
         var myDropzone1 = new Dropzone(
                                 "div#myId2",{ 
                                  dictDefaultMessage: "Drag image here",
                                  uploadMultiple: false,
                                  parallelUploads: 1,
                                  clickable: true,
                                  maxFiles: 1,
                                  url: "<?php echo base_url()?>admin/news/uploadAddImage/"
                              });
          myDropzone1.on("success", function(file,response) {
              var obj = jQuery.parseJSON(response);
              if(obj.error==''){
                  $("#picture_1").val(obj.picture_name);
              }else{
                  alert(obj.error);
              }
          });
          myDropzone1.on("canceled",function(file,response){
              alert('Only one file upload is allowed');
          })

          var myDropzone2 = new Dropzone(
                                 "div#myId6",{ 
                                 dictDefaultMessage: "Drag image here",
                                  uploadMultiple: false,
                                 parallelUploads: 1,
                                 clickable: true,
                                 maxFiles: 1,
                                 url: "<?php echo base_url()?>admin/news/uploadAddImage/"
                             });
         myDropzone2.on("success", function(file,response) {
             var obj = jQuery.parseJSON(response);
             if(obj.error==''){
                 $("#picture_2").val(obj.picture_name);
             }else{
                 alert(obj.error);
             }
         });
         myDropzone2.on("canceled",function(file,response){
             alert('Only one file upload is allowed');
         })

          var myDropzone3 = new Dropzone(
                                 "div#myId3",{ 
                                 dictDefaultMessage: "Drag image here",
                                 uploadMultiple: false,
                                 parallelUploads: 1,
                                 clickable: true,
                                 maxFiles: 1,
                                 url: "<?php echo base_url()?>admin/news/uploadAddImage/"
                             });
         myDropzone3.on("success", function(file,response) {
             var obj = jQuery.parseJSON(response);
             if(obj.error==''){
                 $("#picture_3").val(obj.picture_name);
             }else{
                 alert(obj.error);
             }
         });
         myDropzone3.on("canceled",function(file,response){
             alert('Only one file upload is allowed');
         })
        
         var myDropzone4 = new Dropzone(
                                 "div#myId4",{ 
                                 dictDefaultMessage: "Drag image here",
                                 uploadMultiple: false,
                                 parallelUploads: 1,
                                 clickable: true,
                                 maxFiles: 1,
                                 url: "<?php echo base_url()?>admin/news/uploadAddImage/"
                             });
         myDropzone4.on("success", function(file,response) {
             var obj = jQuery.parseJSON(response);
             if(obj.error==''){
                 $("#picture_4").val(obj.picture_name);
             }else{
                 alert(obj.error);
             }
         });
         myDropzone4.on("canceled",function(file,response){
             alert('Only one file upload is allowed');
         })
         var myDropzone5 = new Dropzone(
                                 "div#myId5",{ 
                                 dictDefaultMessage: "Drag image here",
                                 uploadMultiple: false,
                                 parallelUploads: 1,
                                 clickable: true,
                                 maxFiles: 1,
                                 url: "<?php echo base_url()?>admin/news/uploadAddImage/"
                             });
         myDropzone5.on("success", function(file,response) {
             var obj = jQuery.parseJSON(response);
             if(obj.error==''){
                 $("#picture_5").val(obj.picture_name);
             }else{
                 alert(obj.error);
             }
         });
         myDropzone5.on("canceled",function(file,response){
             alert('Only one file upload is allowed');
         })
         var myDropzone6 = new Dropzone(
                                 "div#myId7",{ 
                                 dictDefaultMessage: "Drag image here",
                                 uploadMultiple: false,
                                 parallelUploads: 1,
                                 clickable: true,
                                 maxFiles: 1,
                                 url: "<?php echo base_url()?>admin/news/uploadAddImage/"
                             });
         myDropzone6.on("success", function(file,response) {
             var obj = jQuery.parseJSON(response);
             if(obj.error==''){
                 $("#brand_detail_picture").val(obj.picture_name);
             }else{
                 alert(obj.error);
             }
         });
         myDropzone6.on("canceled",function(file,response){
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