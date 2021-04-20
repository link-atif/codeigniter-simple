<?php $this->load->view('admin/common/common-header');?>



<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.3/themes/base/jquery-ui.css" />

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->

<script type="text/javascript" src="http://code.jquery.com/ui/1.8.3/jquery-ui.js"></script>

<script type="text/javascript">

    var currentTab = 0;

    $(function () {

        $("#tabs").tabs({

            select: function (e, i) {

                // currentTab = i.index;

                // console.log(e);

                // console.log(i);

                // if(i.index==2){

                //  $("#btnform").show();   

                // }else if(i.index==0){

                //     $("#btnform").hide();

                // }

            }

        });

    });

    $("#btnNext").live("click", function () {

        var tabs = $('#tabs').tabs();

        var c = $('#tabs').tabs("length");

        currentTab = currentTab == (c - 1) ? currentTab : (currentTab + 1);

        /*console.log(c);

        console.log(currentTab);*/



        // if(c==currentTab+1){

        //     $("#btnform").show();

        // }else if(c!=currentTab+1){

        //     $("#btnform").hide();  

        // }else{

        //      $("#btnform").hide(); 

        // }

        tabs.tabs('select', currentTab);

        $("#btnPrevious").show();

        

        if (currentTab == (c - 1)) {

            $("#btnNext").hide();

        } else {

            $("#btnNext").show();

        }

    });

    $("#btnPrevious").live("click", function () {

        var tabs = $('#tabs').tabs();

        var c = $('#tabs').tabs("length");

        currentTab = currentTab == 0 ? currentTab : (currentTab - 1);

        /*console.log(c);

        console.log(currentTab);*/

        // if(c==currentTab+1){

        //     $("#btnform").show();

        // }else if(c!=currentTab+1){

        //     $("#btnform").hide();  

        // }else{

        //      $("#btnform").hide(); 

        // }

        tabs.tabs('select', currentTab);

        if (currentTab == 0) {

            $("#btnNext").show();

            $("#btnPrevious").hide();

        }

        if (currentTab < (c - 1)) {

            $("#btnNext").show();



        }

    });

</script>



<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.datetimepicker.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/dropzone.css">

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

                    <?php

                    if(isset($_GET['msg']) && $_GET['msg'] != ''){



                        ?>

                        <div class="alert alert-success" role="alert">

                          <?php echo $_GET['msg'];?>

                      </div>

                  <?php } ?>

                  <div class="clearfix"></div>



                <!-- <div class="tab_btns"><input type="button" id="btnPrevious" value="Previous" style = "display:none"/>

                    <input type="button" id="btnNext" value="Next" /></div> -->









                    <form method="post" name="frm" action="" id="demo-form2" class="form-horizontal form-label-left" novalidate>

                        <button id="btnform"  style="margin-left: 1160px" type="submit" class="btn btn-success">Save</button>

                        <div id="tabs">

                            <ul>

                                <?php

                                foreach($mediaDetail as $language)

                                {

                                    $l_name = $this->Pages_model->languageName($language->language_id);

                                    echo '<li><a href="#tabs-'.$language->language_id.'">'.$l_name.'</a></li> '; 

                                }

                                ?>





                            </ul>





                            <?php

                            $oneTime = 0;

                            foreach($mediaDetail as $language)

                                { ?>

                                    <div id="tabs-<?php echo $language->language_id; ?>">

                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tittle<span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <input type="text" id="title" name="tittle[<?php echo $language->language_id ?>][tittle]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $language->tittle;?>" />



                                            </div>

                                        </div>

                                        <?php

                                        if($oneTime == '0')

                                        {

                                            ?>

                                            <div class="item form-group">

                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Link<span class="required">*</span>

                                                </label>

                                                <div class="col-md-7 col-sm-7 col-xs-12">

                                                    <input type="text" id="title" name="link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $this->Newsletter_model->getLink($language->media_id); ?>" />

                                                </div>

                                            </div>

                                            <?php

                                        }

                                            ?>

                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description <span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <textarea id="description" name="description[<?php echo $language->language_id ?>][description]" class="form-control col-md-7 col-xs-12"><?php echo $language->description;?></textarea>

                                            </div>

                                        </div>

                                        <?php

                                        if($oneTime == '0')

                                        {

                                        ?>

                                            <div class="form-group">

                                                <input type="hidden" name="picture_name" id="picture_name" value="<?php echo $this->Newsletter_model->getImage($language->media_id); ?>">

                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Image <span>*</span>

                                                </label>

                                                <div class="col-md-7 col-sm-7 col-xs-12">

                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>

                                                    <div id="myId" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>

                                                </div>

                                            <?php

                                            if($this->Newsletter_model->getImage($language->media_id)!=''){?><img src="<?php echo base_url()?>uploads/data/<?php echo $this->Newsletter_model->getImage($language->media_id);?>" width="100" /><?php } ?>

                                            </div>

                                        <?php

                                        } 

                                        ?>

                                        <div class="form-group" hidden>

                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                <button type="submit" class="btn btn-success">Submit</button>

                                            </div>

                                        </div>







                                    </div>

                                    <?php $oneTime++;} ?>

                                    <!-- <div class="tab_btns"><button id="btnform" type="submit" class="btn btn-success">Submit</button></div> -->

                                </form>  

                            </div>

                            <br />





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

        </html>

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

                url: "<?php echo base_url()?>admin/categories/uploadAddImage/"

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