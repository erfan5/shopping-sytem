 <?php
class view_orders extends CI_Controller {
    function index(){
         $this->load->helper('url');
         $this->load->library(['encryption','session']);
        if(!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
          $this->load->model('admin/CRUD_model','order');
            $orders =  $this->order->view_orders();
        $this->load->view('admin/view_orders',compact('orders'));
   
   
}}
    ?>