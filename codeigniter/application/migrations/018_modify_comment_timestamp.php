<?php

class Migration_Modify_comment_timestamp extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->drop_column("comments", "created_on");
        $this->dbforge->add_column("comments", array(
            "created_on" => array(
                'type' => "DATETIME",
                'null' => false
            )
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column("comments", "created_on");
        $this->dbforge->add_field("created_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
    }
}
/* End of file 018_modify_comment_timestamp.php */
/* Location: ./application/migrations/018_modify_comment_timestamp.php */