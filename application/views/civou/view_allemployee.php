
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>لوحة الأدمن</title>
        <?php include 'tempelet/links.php'; ?>
    </head>
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
                        <h4><span class="bold">Employee</span></h4>
                        <table border="5" >
                            <?php
//                            $this->db->where('id',$this->uri->segment(4));
                            $this->db->from('employee');
                            $query = $this->db->get();
                            if ($query->num_rows() > 0) {
                                $rows = $query->result();
                                foreach ($rows as $row) {
                                    ?>
                                    <tr>
                                        <td><h6><?php echo $row->name; ?></h6></td>
                                        <td style="width: 100px;"></td>
                                        <?php
                                        $this->db->where('id', $row->c_id);
                                        $this->db->from('category');
                                        $queryy = $this->db->get();
                                        if ($queryy->num_rows() > 0) {
                                            $rowss = $queryy->result();
                                            foreach ($rowss as $roww) {
                                                ?>
                                                <td style="width: 100px;"><?php echo $roww->name; ?></td>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        $this->db->where('id', $row->sc_id);
                                        $this->db->from('sub_categ');
                                        $queryy = $this->db->get();
                                        if ($queryy->num_rows() > 0) {
                                            $rowss = $queryy->result();
                                            foreach ($rowss as $roww) {
                                                ?>
                                                <td style="width: 100px;"><?php echo $roww->name; ?></td>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <td><h6><a style="color: #1a1a1a;" href="<?php echo base_url(); ?>civou/c_employee/delete/<?php echo $row->id; ?>">Delete</a></h6></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>

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