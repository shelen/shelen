<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>لوحة الأدمن</title>
        <?php include 'tempelet/links.php'; ?>
    </head>
    <style type="text/css">
        h3{font-weight: bold;text-align: right;}
        table tr td a{color: #fff;text-align: right; font-family: cursive; color: #000;}

    </style>
    <body>

        <div id="wrapper">
            <!-- start of section top -->
            <section id="top">
                <div id="top-wrapp">
                    <?php include('tempelet/header.php') ?>
                </div>
            </section>
            <?php include 'tempelet/news.php'; ?>

            <div id="content">
                <div id="left">
                    <div id="profile_half1">
                        <table border="1"  style="width: 850px; border: 5px #0084b4; ">
                            <tr>
                                <td>
                                    <p><a style="font-size: 20px;">Admin</a></p>
                                    <p><a href="<?php echo base_url(); ?>civou/c_admin/loadAddAdmin">Add New Admin</a></p> 
                                    <p><a href="<?php echo base_url(); ?>civou/c_admin/allAdmin">Show All Admins</a></p> 

                                </td>
                                <td>
                                    <p style="font-size: 20px;"><a>Service</a></p>
                                    <p><a href="<?php echo base_url(); ?>civou/c_category/loadAddCategory">Add Category</a></p>
                                    <p><a href="<?php echo base_url(); ?>civou/c_category/allcategory">Show All Category</a></p> 
                                    <p><a href="<?php echo base_url(); ?>civou/c_subcategory/addSubCategory">Add Sub Category</a></p> 
                                    <p><a href="<?php echo base_url(); ?>civou/c_service/loadAddService">Add Service</a></p> 
                                    <p><a href="<?php echo base_url(); ?>civou/c_service/loadAddService">Show All Service</a></p> 
                                </td>
                                <td>
                                    <p style="font-size: 20px;"><a>Blog</a></p>
                                    <p><a href="<?php echo base_url(); ?>civou/c_b_category/loadaddBCategory">Add Category</a></p> 
                                    <p><a href="<?php echo base_url(); ?>civou/c_b_subcategory/addbSubCategory">Add Sub Category</a></p> 

                                </td>
                                <td>
                                    <p style="font-size: 20px;"><a>Employee</a></p>
                                    <p><a href="<?php echo base_url(); ?>civou/c_employee/loadAddemployee">Add New Employee</a></p> 
                                    <p><a href="<?php echo base_url(); ?>civou/c_employee/allemployee">Show All</a></p> 

                                </td>
                            </tr>
                            <td>
                                <p style="font-size: 20px;"><a>Members</a></p>
                                <p><a href="<?php echo base_url(); ?>#">Add New Member</a></p> 
                                <p><a href="<?php echo base_url(); ?>#">Show All</a></p> 

                            </td>
                            <td>
                                <p style="font-size: 20px;"><a>News</a></p>
                                <p><a href="<?php echo base_url(); ?>#">Add News</a></p> 
                                <p><a href="<?php echo base_url(); ?>#">Show All</a></p> 

                            </td>
                            <td>
                                <p style="font-size: 20px;"><a>Advirtise</a></p>
                                <p><a href="<?php echo base_url(); ?>#">Add Adv</a></p> 
                                <p><a href="<?php echo base_url(); ?>#">Show All</a></p> 

                            </td>
                            <td>
                            <p style="font-size: 20px;"><a>Blocks</a></p>
                                <p><a href="<?php echo base_url(); ?>#">Add new Block</a></p> 
                                <p><a href="<?php echo base_url(); ?>#">Show All</a></p> 
                            
                            </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>

                    </div>
                </div>
                <div id="right">
                    <?php include 'tempelet/menu.php'; ?>
                    <div id="clear"></div>
                    <?php include 'tempelet/serv_block.php'; ?>
                </div>
            </div>
            <?php include('tempelet/footer.php') ?>
        </div>
    </body>
</html>