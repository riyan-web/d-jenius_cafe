<?php

class Overview extends CI_Controller {
    // public function __construct()
    // {
	// 	parent::__construct();
	// }

	public function index()
	{
        // load view template/overview.php
        $this->load->view("template/overview");
	}
}