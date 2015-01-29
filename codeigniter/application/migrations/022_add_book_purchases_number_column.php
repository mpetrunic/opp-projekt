<?php

class Migration_Add_book_purchases_number_column extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->add_column("books", array(
            "purchases_number" => array(
                "type" => "SMALLINT",
                "default" => 0
            )
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column("books", "purchases_number");
    }
}
/* End of file 022_add_book_purchases_number_column.php */
/* Location: ./application/migrations/022_add_book_purchases_number_column.php */