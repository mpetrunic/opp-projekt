<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

/**
 * Class Migrate used for executing database migration. It is only accessible
 * through CLI(Command Line interface).
 * Command: php index.php migrate
 */
class Migrate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->input->is_cli_request()
        or exit("Execute via command line: php index.php migrate");
    }

    public function index()
    {
        $this->load->library('migration');
        if(!$this->migration->latest())
        {
            show_error($this->migration->error_string());
        }
    }

    public function version($migration_version = 0) {
        $this->load->library('migration');
        if(!$this->migration->version($migration_version))
        {
            show_error($this->migration->error_string());
        }
    }
}