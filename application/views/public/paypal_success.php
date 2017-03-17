<html>
    <head>
        <title>Payment Successful!</title>
    </head>

    <body>
        <?php
          if ($cart_setting !== 'cookie') {
        $total_price = $total_bill[0]->total;
          }else{
              $total_price =$total_bill;
          }

        $c_name = $c_detail[0]->customer_name;


        if ($amount == $total_price) {

            echo "<h2>Welcome:" . $c_name . "<br>" . "Your Payment was successful!</h2>";
            echo "<a href='http://localhost/shoping'>Go back to site for more shoping</a>";
        } else {

            echo "<h2>Welcome Guest, Payment was failed</h2><br>";
            echo "<a href='http://localhost/shoping'>Go to Back to shop</a>";
        }

             //this mail system is for online server

//			$headers = "MIME-Version: 1.0" . "\r\n";
//			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//			$headers .= 'From: <sales@onlinetuting.com>' . "\r\n";
//			
//			$subject = "Order Details";
//			
//			$message = "<html> 
//			<p>
//			
//			Hello dear <b style='color:blue;'>$cname</b> you have ordered some products on our website onlinetuting.com, please find your order details, your order will be processed shortly. Thank you!</p>
//			
//				<table width='600' align='center' bgcolor='#FFCC99' border='2'>
//			
//					<tr align='center'><td colspan='6'><h2>Your Order Details from onlinetuting.com</h2></td></tr>
//					
//					<tr align='center'>
//						<th><b>S.N</b></th>
//						<th><b>Product Name</b></th>
//						<th><b>Quantity</b></th>
//						<th><b>Paid Amount</th></th>
//						<th>Invoice No</th>
//					</tr>
//					
//					<tr align='center'>
//						<td>1</td>
//						<td> $pro_name</td>
//						<td>$qty</td>
//						<td>$amount</td>
//						<td>$invoice</td>
//					</tr>
//			
//				</table>
//				
//				<h3>Please go to your account and see your order details!</h3>
//				
//				<h2> <a href='http://localhost/shoping'>Click here</a> to login to your account</h2>
//				
//				<h3> Thank you for your order @ - www.onlineshoping.com</h3>
//				
//			</html>
//			
//			";
        //	mail($c_email,$subject,$message,$headers);
        ?>
    </body>
</html>







