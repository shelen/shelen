<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
    <head profile="http://gmpg.org/xfn/11">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
        <meta name="generator" content="WordPress 3.4.2" /> <!-- leave this for stats please -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

        <title>
            شيلينات دوت كوم  </title>

        <?php include 'tempelet/links.php'; ?>

    </head>
    <body class="page page-id-9 page-template page-template-_contact-php">


        <div id="container">



            <!-- HEADER -->
            <div class="header left">
                <div class="head-parallax">
                    <div id="parallax" class="parallax-viewport">
                        <ul>
                            <li class="parallax-layer">
                                <img src="<?php echo base_url(); ?>images/rays.png" alt="background rays" />
                            </li>
                        </ul>
                    </div>
                    <div class="bg-header-shadow left">
                        <div class="wrapper zindex">

                            <!--LOGO-->
                            <div class="logo left">
                                <a href="<?php echo base_url(); ?>site/" >
                                    <img src="<?php echo base_url(); ?>images/logo.png"  alt="logo" />
                                </a>
                            </div><!--/logo-->

                            <!--MENU-->
                            <div class="bg-menu right">
                                <div class="bg-menu-left left"></div>

                                <?php include('header.php'); ?>

                                <div class="bg-menu-right left"></div>
                            </div><!--/bg-menu-->


                        </div><!--/wrapper-->
                        <div class="bg-blue-top left"></div><!--/bg-blue-top-->

                    </div><!--/bg-header-shadow-->

                </div>
            </div><!--/header-->

            <!-- BG BLUE -->
            <div class="blue-page left">
                <div class="bg-blue-center-title left">
                    <div class="wrapper">
                        <div class="title-pages left" style="font-family:myfont;text-transform:capitalize"> المدونه</div><!--/wrapper-->
                        <div class="breadcrumbs-content"><ul>
                                <li>المدونه</li> <li><a href="<?php echo base_url(); ?>site/"> الرئيسيه</a></li>  <li style="background: none; padding: 0;">: انت في</li>

                            </ul>
                        </div>            </div><!--/wrapper-->
                </div><!--/bg-blue-center-title-->
                <div class="bg-blue-down left"></div><!--/bg-blue-down-->
            </div><!--/blue-page-->

            <!-- CONTENT -->
            <div class="content left">
                <div class="wrapper">

                    <div class="left-page left">
                        <!---------------------------------------->
                        <!--                        <div id="blog_box">
                                                    <div class="gallery-home-images-content left" style="float:right">
                                                        <div class="gallery-home-images left"> 
                                                            <img src="<?php echo base_url(); ?>images/ga5-176x151.jpg"  class="attachment-gallery-front wp-post-image" />
                                                            <a href="<?php echo base_url(); ?>site/blog_details" >
                                                                <p></p>
                                                            </a> 
                                                        </div>
                                                        /gallery-home-images 
                                                    </div>
                        
                                                    <h4 id="blog_name"><a href="<?php echo base_url(); ?>site/blog_details" >name</a></h4>
                        
                                                    <div id="clear"></div>
                                                    <p id="blog_desc">disc</p>
                        
                                                </div>-->
                        <!---------------------------------------->

                        <?php
//                        $this->load->model('sitead');
                        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                            $c_id = $this->uri->segment(3);
                            $sc_id = $this->uri->segment(4);
                            $this->db->from('service');
                            $this->db->where('sc_id', $sc_id);
                            $query = $this->db->get();
                        } else if ($this->uri->segment(3) != '') {
                            $c_id = (int) $this->uri->segment(3);
                            $this->db->from('service');
                            $this->db->where('c_id', $c_id);
                            $query = $this->db->get();
                        } else {
                            $query = $this->db->get('topic');
                        }
                        if (isset($query)) {
                            if ($query->num_rows() > 0) {
                                $rows = $query->result();
                                foreach ($rows as $row) {
                                    ?>
                                    <div id="blog_box">
                                        <div class="gallery-home-images-content left" style="float:right">
                                            <div class="gallery-home-images left">
                                                <p><?php echo $row->title; ?></p>
                                                <img src="<?php echo base_url(); ?>images/profile/thumb_profile/<?php echo $row->t_photo_name; ?>"  class="attachment-gallery-front wp-post-image" />
                                                <a href="<?php echo base_url(); ?>site/blog_details/<?php echo $row->id; ?>" >
                                                    <p><?php echo $row->title; ?></p>
                                                </a> 
                                            </div>
                                            <!--/gallery-home-images--> 
                                        </div>
                                        <div id="clear"></div>
                                        <p id="blog_desc">

                                            <p>
                                                <?php
                                                $this->db->from('user');
                                                $this->db->where('id', $row->user_id);
                                                $user_query = $this->db->get();
                                                if ($user_query->num_rows() > 0) {
                                                    $user_rows = $user_query->result();
                                                    foreach ($user_rows as $user_row) {
                                                        ?>
                                                        <p>تمت اضافته بواسطة <?php echo $user_row->username; ?></p>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </p>
                                            <?php echo $row->content; ?>
                                        </p>

                                    </div>


                                    <?php
                                }
                            }
                        }
                        ?>

                        <!----------------------------------------------->

                    </div>
                    <!--/gal
    
                    <!--SIDEBAR-->
                    <div class="bg-sidebar right">
                        <div class="sidebar-top left"></div><!--/sidebar-top-->


                        <div id="sidebar" class="right">
                            <div class="sidebar_widget_holder"><form method="get"  class="submit-search-form" action="http://demo.themeskingdom.com/dreamy/">
                                    <div class="search-wrap"><input type="text" name="s" class="search-input" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value=""/></div>
                                    <div class="searchform-right left"><input type="submit" class="submit-button" value="" /></div>
                                </form> </div>
                            <div class="sidebar_widget_holder">


                                <?php include 'tempelet/blog_menu.php'; ?>


                                <div id="clear"></div>
                                <?php include 'tempelet/most_buy.php'; ?>
                            </div>
                        </div><!--/#sidebar-->
                        <div class="sidebar-down left"></div><!--/sidebar-down-->
                    </div><!--/bg-sidebar-->

                </div>
            </div><!--/content-->

            <?php include('footer.php'); ?>

        </div>
        </div>
        <!--/container--> 
    </body>
</html>