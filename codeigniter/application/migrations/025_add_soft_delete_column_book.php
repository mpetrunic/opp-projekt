<?php

class Migration_Add_soft_delete_column_book extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->add_column("books", array(
            "deleted" => array(
                "type" => "BOOLEAN",
                "default" => 0
            )
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column("books", "deleted");
    }
}
/* End of file 025_add_soft_delete_column_book.php */
/* Location: ./aplication/migrations/025_add_soft_delete_column_book.php */