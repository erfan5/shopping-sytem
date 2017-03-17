<table width="795" align="center" bgcolor="pink"> 


    <tr align="center">
        <td colspan="6"><h2>View all payments here</h2></td>
    </tr>

    <tr align="center" bgcolor="skyblue">
        <th>S.N</th>
        <th>Customer Email</th>
        <th>Order ID</th>
        <th>Paid Amount</th>
        <th>Transaction ID</th>
        <th>Payment Date</th>
    </tr>
    <?php
    if (count($var)):
        $i = 0;
        foreach ($var as $payments):
           
            $i++;
            ?>
            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $payments->c_email; ?></td>
                <td><?php echo $payments->order_id; ?></td>
<!--                <td>
                    <?php // echo $payments->product_title; ?><br>
                    <img src="<?php //echo base_url('admin/product_images/'); ?><?php //echo $payments->product_image; ?>" width="50" height="50" />
                </td>-->
                <td><?php echo $payments->amount; ?></td>
                <td><?php echo $payments->trx_id; ?></td>
                <td><?php echo $payments->payment_date; ?></td>

            </tr>
            <?php
        endforeach;
    else:
        ?>
        <table>
            <tr>
                <td colspan="3">
                    No record found
                </td>
            </tr>
        </table>
    <?php endif; ?>
</table>