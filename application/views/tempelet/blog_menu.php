<div class="main_menu" >

    <ul class="nav2" style="margin-top:-10px">
        <h3 id="dept">المدونة</h3>
        <?php
        $query1 = $this->db->get('blog_category');
        if ($query1->num_rows() > 0) {
            $rows = $query1->result();
            foreach ($rows as $row) {
                //site/blog_details
                $base = base_url() . "site/blog/";
//                                    echo $rows->num_rows();
                $this->db->where('b_c_id', $row->id);
                $query2 = $this->db->get('blog_sub_categ');
                if ($query2->num_rows() > 0) {
                    echo "<li><a>$row->name</a></li>";
                    ?>
                    <div class="sub_links" style="display: none; ">

                        <?php
                        $rowsSub = $query2->result();
                        foreach ($rowsSub as $rowSub) {
                            echo "<p><a href=\"$base$rowSub->b_c_id/$rowSub->id\">$rowSub->name</a></p> ";
                        }
                        ?> 
                    </div>

                    <?php
                } else {
                    echo "<li><a href=\"$base$row->id\">$row->name</a></li>";
                }
            }
        }
        ?>
    </ul>  
</div>