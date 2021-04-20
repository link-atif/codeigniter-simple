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
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Title<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['title']) ? $sliderDetail['title'] : '';?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Video Type</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <select name="videoType" id="videoType" class="form-control">
                                        <option value="">Select type</option>
                                        <option value="uploadVideo">Upload Video</option>
                                        <option value="youtubeLink">Video Link</option>
                                    </select>
                                    <?php if(isset($sliderDetail['videoType'])){?>
                                    <script type="text/javascript">
                                        document.frm.videoType.value='<?php echo $sliderDetail["videoType"] ?>';
                                    </script>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="item form-group" id="youtubeLink">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="video_link">Video Link<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="video_link" name="video_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['video_link']) ? $sliderDetail['video_link'] : '';?>" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="video_link">Spotify Link<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="spotify_link" name="spotify_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['spotify_link']) ? $sliderDetail['spotify_link'] : '';?>" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="video_duaration">Duaration (00:00:00)<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="video_duaration" name="video_duaration" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['video_duaration']) ? $sliderDetail['video_duaration'] : '';?>" />
                                </div>
                            </div>
                             
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="video_style">Style<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="video_style" name="video_style" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['video_style']) ? $sliderDetail['video_style'] : '';?>" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="video_difficulity">Difficulity<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" id="video_difficulity" name="video_difficulity" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($sliderDetail['video_difficulity']) ? $sliderDetail['video_difficulity'] : '';?>" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <textarea id="description" name="description" class="form-control col-md-7 col-xs-12"><?php echo isset($sliderDetail['description']) ? $sliderDetail['description'] : '';?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="picture_main" id="picture_main">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Main Picture(400×318)
                                    <span>*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                    <div id="main" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                </div>
                            </div>
                            <?php if(isset($sliderDetail['picture_main']) && $sliderDetail['picture_main']!=''){?>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <a href="<?php echo base_url();?>uploads/slider/<?php echo $sliderDetail['picture_main']?>" class="group1"><img src="<?php echo base_url();?>uploads/slider/<?php
                                    $picture_name = $this->Common_model->resize($sliderDetail['picture_main'],250,250);
                                     echo $picture_name;?>" width="100px" height="100px" /></a>
                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/home_video/deleteimageFirst?id=<?php echo $sliderDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                </div>
                            </div>
                            <?php }?>
                            <input type="hidden" name="old_main_picture" id="old_picture" value="<?php echo $sliderDetail['picture_main']?>">
                            <div id="uploadVideo"> 
                            <div class="form-group">
                                <input type="hidden" name="file_name" id="file_name">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Upload Vieo
                                    <span>*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>
                                    <div id="video" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>
                                </div>
                            </div>
                            <?php if(isset($sliderDetail['file_name']) && $sliderDetail['file_name']!=''){?>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <a href="<?php echo base_url();?>uploads/videos/<?php echo $sliderDetail['file_name']?>" class="group1"><?php echo $sliderDetail['file_name']?></a>
                                    <div style="margin-top:5px;"><a href="<?php echo base_url()?>admin/home_video/deleteVideoFile?id=<?php echo $sliderDetail['id'] ?>" onClick="return confirm('Are you sure to delete this picture?')"><i class="fa fa-trash"></i>&nbsp;Delete Image</a></div>
                                </div>
                            </div>
                            <input type="hidden" name="old_file_name" id="old_file_name" value="<?php echo $sliderDetail['file_name']?>">
                            <?php }?>
                            </div>
                            <input type="hidden" name='merchandise_id' value="<?php echo $sliderDetail['id'] ?>">
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
    $(document).ready(function(){
        $("#youtubeLink").hide();
        $("#uploadVideo").hide();        
    });
</script>
<?php if(isset($sliderDetail['videoType'])){?>
<script type="text/javascript">
    $(document).ready(function(){
        videoType = '<?php echo $sliderDetail['videoType'] ?>';
        $("#"+videoType).show();
    });
</script>
<?php }?>
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
                                url: "<?php echo base_url()?>admin/home_video/uploadAddImage/"
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

    $(document).ready(function(){
        //$("div#myId").dropzone({ url: "upload.php" });
        var vDropzone = new Dropzone(
            "div#video",{ 
            dictDefaultMessage: "Drag Video Here",
            uploadMultiple: false,
            parallelUploads: 1,
            clickable: true,
            maxFiles: 1,
            maxFilesize: 1024,
            url: "<?php echo base_url()?>admin/home_video/uploadVideo/"
        });
        vDropzone.on("success", function(file,response) {
            var obj = jQuery.parseJSON(response);
            if(obj.error==''){
                $("#file_name").val(obj.file_name);
            }else{
                alert(obj.error);
            }
        });
        vDropzone.on("canceled",function(file,response){
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

    $("#videoType").change(function(){
        var videoType = $("#videoType").val();
        if(videoType == ""){
            $("#youtubeLink").hide();
            $("#uploadVideo").hide();
        }
        if(videoType == 'youtubeLink'){
            $("#youtubeLink").show();
            $("#uploadVideo").hide();
        }
        if(videoType == 'uploadVideo'){
            $("#youtubeLink").hide();
            $("#uploadVideo").show();
        }
    });

</script>