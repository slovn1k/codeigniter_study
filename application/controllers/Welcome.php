<?php

defined('BASEPATH') or exit('No direct script access allowed');

include APPPATH . 'libraries/Admin.php'; // include Admin controller functionality in this class, as extends functionality
include APPPATH . 'libraries/BaseController.php';

// here we extend the new base controller
class Welcome extends \App\BaseController

{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index()
    {
        $username = 'Alex';

        $data = array(
            'user_name' => $username,
        );

        $user = array(
            'first_name' => 'Alexandr',
            'last_name' => 'Turcanu',
        );

        // load more data
        $data = array(
            'current_user' => 'Someone',
            'user_theme' => 'Default theme',
        );

        $this->load->vars($data);

        // passing data to view
        // $this->load->view('welcome_message', $data);

        // another way to pass data
        $this->load->view('welcome_message', array('user' => $user));

        // Make all of the data available for all views...

		$this->data['some_value'] = 'Hello world';

        $this->load->vars($this->data);
        $this->load->view('layouts/header');

        $this->load->view('layouts/site_navigation');

        $this->load->view('layouts/the_actual_page_content');

        $this->load->view('layouts/footer');
    }
}
