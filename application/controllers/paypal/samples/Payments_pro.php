<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments_pro extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		// Load helpers
		$this->load->helper('url');
		 
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(array('form_validation', 'encryption', 'session'));
        $this->load->helper('date');
    
		// Load PayPal library
		$this->config->load('paypal');
		
		$config = array(
			'Sandbox' => $this->config->item('Sandbox'), 			// Sandbox / testing mode option.
			'APIUsername' => $this->config->item('APIUsername'), 	// PayPal API username of the API caller
			'APIPassword' => $this->config->item('APIPassword'), 	// PayPal API password of the API caller
			'APISignature' => $this->config->item('APISignature'), 	// PayPal API signature of the API caller
			'APISubject' => '', 									// PayPal API subject (email address of 3rd party user that has granted API permission for your app)
			'APIVersion' => $this->config->item('APIVersion')		// API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
		);
		
		// Show Errors
		if($config['Sandbox'])
		{
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}
		
		$this->load->library('paypal/Paypal_pro', $config);	
	}
	
	
	function index()
	{
		$this->load->view('paypal/samples/payments_pro');
	}

	
	function Do_direct_payment()
	{
        if(isset($_POST)){  
        $cardNumber =   $_POST['cardNumber'];
        $cardType =   $_POST['card_type'];
        $cardExpiry =    $_POST['cardExpiry'];
        $cardCVC =  $_POST['cardCVC'];
        $couponCode =  $_POST['couponCode'];
        }
        //Get Customer Detail from DB
         $customer_id = $this->session->userdata('customer_id');
         $this->load->model('public/CRUD_model', 'customerDetail');
         $c_detail = $this->customerDetail->custom_detail($customer_id);
         $c_name = $c_detail[0]->customer_name;
         $c_email = $c_detail[0]->customer_email;
         $c_city = $c_detail[0]->customer_city;
         $c_country = $c_detail[0]->customer_country;
         $c_contact = $c_detail[0]->customer_contact;
         
         //Get Cart Details
        $ip = $this->input->ip_address();
        $this->load->model('public/CRUD_model', 'getPrice');
        $total_price = $this->getPrice->total_price($ip);
        
        //Get Total Bill of cart
        $this->load->model('public/CRUD_model', 'billDetail');
        $total_bill = $this->billDetail->total_bill($ip);
        $total_amt = $total_bill[0]->total;
       
		$DPFields = array(
							'paymentaction' => 'Sale', 						// How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
							'ipaddress' => $_SERVER['REMOTE_ADDR'], 							// Required.  IP address of the payer's browser.
							'returnfmfdetails' => '1' 					// Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
						);
						
		$CCDetails = array(
							'creditcardtype' => 'Visa', 					// Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
							'acct' => '4032038931190502', 								// Required.  Credit card number.  No spaces or punctuation.  
							'expdate' => '012022', 							// Required.  Credit card expiration date.  Format is MMYYYY
							'cvv2' => $cardCVC, 								// Requirements determined by your PayPal account settings.  Security digits for credit card.
							'startdate' => '', 							// Month and year that Maestro or Solo card was issued.  MMYYYY
							'issuenumber' => ''							// Issue number of Maestro or Solo card.  Two numeric digits max.
						);
						
		$PayerInfo = array(
							'email' => $c_email, 								// Email address of payer.
							'payerid' => '', 							// Unique PayPal customer ID for payer.
							'payerstatus' => '', 						// Status of payer.  Values are verified or unverified
							'business' => '' 							// Payer's business name.
						);
						
		$PayerName = array(
							'salutation' => 'Mr.', 						// Payer's salutation.  20 char max.
							'firstname' => $c_name, 							// Payer's first name.  25 char max.
							'middlename' => '', 						// Payer's middle name.  25 char max.
							'lastname' => '', 							// Payer's last name.  25 char max.
							'suffix' => ''								// Payer's suffix.  12 char max.
						);
						
		$BillingAddress = array(
								'street' => 'test', 						// Required.  First street address.
								'street2' => 'test', 						// Second street address.
								'city' => $c_city, 							// Required.  Name of City.
								'state' => 'US', 							// Required. Name of State or Province.
								'countrycode' => '', 					// Required.  Country code.
								'zip' => '', 							// Required.  Postal code of payer.
								'phonenum' => $c_contact 						// Phone Number of payer.  20 char max.
							);
							
		$ShippingAddress = array(
								'shiptoname' => '', 					// Required if shipping is included.  Person's name associated with this address.  32 char max.
								'shiptostreet' => '', 					// Required if shipping is included.  First street address.  100 char max.
								'shiptostreet2' => '', 					// Second street address.  100 char max.
								'shiptocity' => '', 					// Required if shipping is included.  Name of city.  40 char max.
								'shiptostate' => '', 					// Required if shipping is included.  Name of state or province.  40 char max.
								'shiptozip' => '', 						// Required if shipping is included.  Postal code of shipping address.  20 char max.
								'shiptocountry' => '', 					// Required if shipping is included.  Country code of shipping address.  2 char max.
								'shiptophonenum' => ''					// Phone number for shipping address.  20 char max.
		
                                                        );
                    
		$PaymentDetails = array(
                     
								'amt' => $total_amt, 							// Required.  Total amount of order, including shipping, handling, and tax.  
								'currencycode' => 'USD', 					// Required.  Three-letter currency code.  Default is USD.
								'itemamt' => '', 						// Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
								'shippingamt' => '', 					// Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
								'shipdiscamt' => '', 					// Shipping discount for the order, specified as a negative number.  
								'handlingamt' => '', 					// Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
								'taxamt' => '', 						// Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. 
								'desc' => '', 							// Description of the order the customer is purchasing.  127 char max.
								'custom' => '', 						// Free-form field for your own use.  256 char max.
								'invnum' => '', 						// Your own invoice or tracking number
								'notifyurl' => ''						// URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.
							
                                                                        );	
				
		$OrderItems = array();
                						
                if (count($total_price)):
                $i = 0;
                foreach ($total_price as $total):
                   // print_r($total); 
                   
                    $i++;
                    $price = $total->product_price;
                    $title = $total->product_title;
                    $product_id = $total->product_id;
                    $qty = $total->qty;	
                    $product_desc  = $total->product_desc;
                    $final_price = $price * $qty;
                   
		$Item	 = array(
					     	        '1_name' => $title, 						// Item Name.  127 char max.
							'1_desc' => $product_desc, 						// Item description.  127 char max.
							'1_amt' => $price, 							// Cost of individual item.
							'1_number' => $product_id, 						// Item Number.  127 char max.
							'1_qty' => $qty, 							// Item quantity.  Must be any positive integer.  
							 				// eBay order ID for the item.
					);
                                       
                array_push($OrderItems, $Item);
                  
            endforeach;
            endif;
           
            
          
		
		
		$Secure3D = array(
						  'authstatus3d' => '', 
						  'mpivendor3ds' => '', 
						  'cavv' => '', 
						  'eci3ds' => '', 
						  'xid' => ''
						  );
               	  
		$PayPalRequestData = array(
								'DPFields' => $DPFields, 
								'CCDetails' => $CCDetails, 
								'PayerInfo' => $PayerInfo, 
								'PayerName' => $PayerName, 
								'BillingAddress' => $BillingAddress, 
								'ShippingAddress' => $ShippingAddress, 
								'PaymentDetails' => $PaymentDetails, 
								'OrderItems' => $OrderItems, 
								'Secure3D' => $Secure3D
		
                        );
                
							
		$PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
                    $errors = array('Errors'=>$PayPalResult['ERRORS']);
			$this->load->view('paypal/samples/error',$errors);
		}
		else
		{
			// Successful call.  Load view or whatever you need to do here.
		      $data = array('PayPalResult'=>$PayPalResult);
                      
                         
                          
                      $trx_id = $PayPalResult['TRANSACTIONID'];
                      $amount = $PayPalResult['AMT'];
                      $currency = $PayPalResult['CURRENCYCODE'];
                      $invoice = mt_rand();
                      $date = date('Y-m-d H:i:s');
                      
                      //Load model to insert data into  DB table 
                       $this->load->model('public/CRUD_model', 'payment');
                       $this->load->model('public/CRUD_model', 'order');
       
                     // inserting the order into DB table
                     $dataa = ['c_id' => $customer_id,'c_name' => $c_name,'c_email' => $c_email,'invoice_no' => $invoice, 'order_date' => $date, 'status' => 'in Progress'];
                     $add_order = $this->order->add_order($dataa);
        
         // add payment 
         $data = ['amount' => $amount, 'customer_id' => $customer_id, 'order_id' => $add_order, 'currency' => $currency, 'trx_id' => $trx_id, 'payment_date' => $date];
         $add_payment = $this->payment->add_payment($data);
                      
              //Get All Products store in Cart 
        $this->load->model('public/CRUD_model', 'getPrice');
        $cart_product = $this->getPrice->total_price($ip);
        foreach ($cart_product as $total):
          
            $p_id = $total->p_id;
            $qty = $total->qty;
           $pro_name = $total->product_title;
          $pro_price = $total->product_price;
          $final_price = $pro_price * $qty;
            
       //Insert into ordr items table     
       $dataaa = ['order_id' => $add_order, 'item_id' => $p_id, 'qty' => $qty, 'pro_name' => $pro_name, 'each_price' => $pro_price,'total_price' => $final_price];
             $this->load->model('public/CRUD_model', 'items');  
             $add_payment = $this->items->add_order_items($dataaa);
          
             
             
        $this->load->model('public/CRUD_model', 'products');
        $products = $this->products->products_stock($p_id);
        foreach ($products as $product):

            $stock = $product->stock;

       
        $set_stock = $stock - $qty;


        //Minimize stock IN DB After Checkout (paypal success)

        $this->load->model('public/CRUD_model', 'stock');
        $dell_stock = $this->stock->dell_stock($set_stock, $p_id);
       
          endforeach;
          endforeach;
          //Get Cart Setting
        $this->load->model('settings');
        $cart_setting = $this->settings->getCartCettings();
        $this->load->view('public/paypal_success', compact('cart_product', 'total_bill', 'c_detail', 'amount', 'currency', 'trx_id', 'invoice','cart_setting'));
        //Unset Cookie after paypal success
        if ($cart_setting == 'cookie') {
      
           delete_cookie('cart');
            
        }else{
        //Delete Cart After Checkout
         
        $this->load->model('public/CRUD_model', 'cart');
        $delete_cart = $this->cart->dell_cart($ip);
}
                //$this->load->view('paypal/samples/do_direct_payment',$data);
		}
	}

	
	function Get_balance()
	{		
		$GBFields = array('returnallcurrencies' => '1');
		$PayPalRequestData = array('GBFields'=>$GBFields);
		$PayPalResult = $this->paypal_pro->GetBalance($PayPalRequestData);
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			$this->load->view('paypal/samples/error',$errors);
		}
		else
		{
			// Successful call.  Load view or whatever you need to do here.
			$data = array('PayPalResult'=>$PayPalResult);
			$this->load->view('paypal/samples/get_balance',$data);
		}
	}

	
}

/* End of file Payments_pro.php */
/* Location: ./system/application/controllers/paypal/samples/Payments_pro.php */