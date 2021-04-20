<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0; text-align: center;">
            <a href="<?php echo base_url()?>admin" class="site_title header_logo" style="background-color:#2a3f54; margin-bottom:10px; height:75px;">
                <span class="big_logo" style="text-align: center;">Yoga</span>
                <span class="small_logo" style="display:none; padding-left:10px">Yoga</span>
            </a>
        </div>
        <div class="clearfix"></div>


        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="<?php echo base_url()?>assets/images/admin/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />
        

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>&nbsp;</h3>
                <ul class="nav side-menu">
                    <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                    <!-- <li><a href="<?php// echo base_url();?>admin/loginusers"><i class="fa fa-user"></i> Customers</a></li> -->
                    <li><a href="<?php echo base_url();?>admin/contactus"><i class="fa fa-envelope"></i> Contact Us</a></li>
                    <li><a href="<?php echo base_url();?>admin/register"><i class="fa fa-users"></i>Registerd Users</a></li><!-- 
                    <li><a href="<?php echo base_url();?>admin/RegPlans"><i class="fa fa-users"></i>Selected Plans</a></li> --><!-- 
                    <li><a href="<?php// echo base_url();?>admin/free_testers"><i class="fa fa-users"></i>Free Testers</a></li> -->
                    <li><a href="<?php echo base_url();?>admin/newsletter"><i class="fa fa-users"></i>Newsletter</a></li>
                    <!-- <li><a href="<?php //echo base_url();?>admin/Orders"><i class="fa fa-list"></i> Orders</a></li> -->
                    
                    <li><a><i class="fa fa-file"></i> Pages<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Pages">Pages</a></li>
                            <li><a href="<?php echo base_url();?>admin/Pages/addPage">Add Page</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i>Live Stream Page<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Live_stream">Manage Live Stream</a></li>
                            <li><a href="<?php echo base_url();?>admin/Live_stream/addLive_stream">Add Live Stream</a></li>
                        </ul>
                    </li><!-- 
                    <li><a><i class="fa fa-user"></i>Favourites Page<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php// echo base_url();?>admin/Favourites">Manage Favourites</a></li>
                            <li><a href="<?php //echo base_url();?>admin/Favourites/add">Add Favourites</a></li>
                        </ul>
                    </li>  
                    <li><a><i class="fa fa-newspaper-o"></i>Categories<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php// echo base_url();?>admin/Category">Manage Categories</a></li>
                            <li><a href="<?php// echo base_url();?>admin/Category/add">Add Category</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-newspaper-o"></i>Products<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">

                            <li><a href="<?php// echo base_url();?>admin/products">Manage Products</a></li>
                            <li><a href="<?php// echo base_url();?>admin/products/addProduct">Add Products</a></li>
                        </ul>
                    </li>-->
					<li><a><i class="fa fa-image"></i>Thanks Slider Images <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Sliderimages">Manage Slider Images</a></li>
                            <li><a href="<?php echo base_url();?>admin/sliderimages/addSliderImage">Add Slider Images</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-image"></i> Instagram images<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Instagram">Manage Instagram</a></li>
                            <!-- <li><a href="<?php //echo base_url();?>admin/Instagram/addInstagram">Add Instagram Image</a></li> -->
                        </ul>
                    </li>
                    <li><a><i class="fa fa-image"></i> Practice With Me<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Pages_crud">Manage Practice With Me</a></li>
                            <li><a href="<?php echo base_url();?>admin/Pages_crud/addPages_crud">Add Practice With Me</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-star"></i>Testimonials<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Testimonials">Manage Testimonials</a></li>
                            <li><a href="<?php echo base_url();?>admin/Testimonials/addTestimonials">Add testimonials</a></li>
                        </ul>
                    </li> 
                    <li><a><i class="fa fa-pencil"></i>Plans<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Plans">Manage Plans</a></li>
                            <li><a href="<?php echo base_url();?>admin/Plans/add">Add Plans</a></li>
                        </ul>
                    </li> 
                    <li><a><i class="fa fa-pencil"></i>Retreats<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Retreats">Manage Retreats</a></li>
                            <li><a href="<?php echo base_url();?>admin/Retreats/add">Add Retreats</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pencil"></i>Retreats Photos<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Retreatsphotos">Manage Retreats Photos</a></li>
                            <li><a href="<?php echo base_url();?>admin/Retreatsphotos/add">Add Retreats Photos</a></li>
                        </ul>
                    </li> 
                    <li><a><i class="fa fa-pencil"></i>Journal<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Journal">Manage Journal</a></li>
                            <li><a href="<?php echo base_url();?>admin/Journal/add">Add Journal</a></li>
                        </ul>
                    </li> <!-- 
                    <li><a><i class="fa fa-pencil"></i>Yoga Rituals<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php //echo base_url();?>admin/Yoga_rituals">Manage Yoga Rituals</a></li>
                            <li><a href="<?php //echo base_url();?>admin/Yoga_rituals/add">Add Yoga Rituals</a></li>
                        </ul>
                    </li>  -->
                    <li><a><i class="fa fa-pencil"></i>Home Video<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Home_video">Manage Home Video</a></li>
                            <li><a href="<?php echo base_url();?>admin/Home_video/add">Add Home Video</a></li>
                        </ul>
                    </li> 

                    <li><a><i class="fa fa-pencil"></i>Posts<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Posts">Manage Posts</a></li>
                            <li><a href="<?php echo base_url();?>admin/Posts/add">Add Posts</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pencil"></i>Posts Purchases Page<span class="fa fa-chevron-down"></span>
                    </a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Book_now">Manage Posts Purchases</a></li>
                            <li><a href="<?php echo base_url();?>admin/Book_now/add">Add Posts Purchases</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pencil"></i>In Studio Purchases<span class="fa fa-chevron-down"></span>
                    </a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Dubai_studio">Manage In Studio</a></li>
                            <li><a href="<?php echo base_url();?>admin/Dubai_studio/add">Add In Studio</a></li>
                        </ul>
                    </li> <!--
                    <li><a><i class="fa fa-image"></i> Media <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php //echo base_url();?>admin/News">Manage Media</a></li>
                            <li><a href="<?php //echo base_url();?>admin/News/addNews">Add Media</a></li>
                        </ul>
                    </li>  
                    <li><a><i class="fa fa-image"></i>Partners <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php //echo base_url();?>admin/Follow">Manage Partners</a></li>
                            <li><a href="<?php //echo base_url();?>admin/Follow/add">Add Partners</a></li>
                        </ul>
                    </li>  -->
					<li><a><i class="fa fa-asterisk"></i> Preferences <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/Preferences">Preferences</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-gear"></i> Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url();?>admin/adminUsers/changePassword">Change Password</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url()?>admin/login/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>