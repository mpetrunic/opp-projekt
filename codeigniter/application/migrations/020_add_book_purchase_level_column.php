<?php

class Migration_Add_book_purchase_level_column extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->add_column("books", array(
            'max_purchase_level' => array(
                'type' => 'SMALLINT'
            )
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column("books", "max_purchase_level");
    }
}
/* End of file 020_add_book_purchase_level_column.php */
/* Location: ./application/migrations/020_add_book_purchase_level_column.php */