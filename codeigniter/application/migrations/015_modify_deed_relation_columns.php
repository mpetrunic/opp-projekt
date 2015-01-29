<?php

class Migration_Modify_deed_relation_columns extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->drop_column("deeds", "author");
        $this->dbforge->drop_column("deeds", "genre");
        $this->dbforge->add_column("deeds", array(
            "author_id" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            )
        ));
        $this->dbforge->add_column("deeds", array(
            "genre_id" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            )
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column("deeds", "author_id");
        $this->dbforge->drop_column("deeds", "genre_id");
        $this->dbforge->add_column("deeds", array(
            "author" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            )
        ));
        $this->dbforge->add_column("deeds", array(
            "genre" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            )
        ));
    }
}
/* End of file 015_modify_deed_relation_columns.php */
/* Location: ./application/migrations/015_modify_deed_relation_columns.php */