<?php

class view_payments extends CI_Controller {

    function index() {
        $this->load->helper('url');
        $this->load->library(['encryption', 'session']);
        if (!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
        $this->load->model('admin/CRUD_model', 'payment');
        $payment = $this->payment->view_payments();
        $this->load->view('admin/view_payments', ['payment' => $payment]);
    }

}

?>