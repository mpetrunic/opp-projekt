<?php

class Migration_Modify_comments_columns extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->drop_column("comments", "book");
        $this->dbforge->drop_column("comments", "user");
        $this->dbforge->add_column("comments", array(
            "book_id" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            "user_id" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column("comments", "book_id");
        $this->dbforge->drop_column("comments", "user_id");
        $this->dbforge->add_column("comments", array(
            "book" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            "user" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
        ));
    }
}
/* End of file 017_modify_comments_columns.php */
/* Location: ./application/migrations/017_modify_comments_columns.php */