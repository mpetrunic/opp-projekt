<?php

class Migration_Modify_book_deed_column extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->drop_column("books", "deed");
        $this->dbforge->add_column("books", array(
            "deed_id" => array(
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
        $this->dbforge->drop_column("books", "deed_id");
        $this->dbforge->add_column("books", array(
            "deed" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            )
        ));
    }
}
/* End of file 016_modify_book_deed_column.php */
/* Location: ./application/migrations/016_modify_book_deed_column.php */