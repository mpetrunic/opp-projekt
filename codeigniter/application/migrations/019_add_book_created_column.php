<?php

class Migration_Add_book_created_column extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->add_column("books", array(
            "created_on" => array(
                'type' => "DATETIME",
                'null' => false
            )
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column("books", "created_on");
    }
}
/* End of file 019_add_book_created_column.php */
/* Location: ./application/migrations/019_add_book_created_column.php */