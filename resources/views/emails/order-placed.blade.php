
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order - Takbir Gadgets</title>
</head>
<body style="margin:0; padding:20px; background:#f4f4f4; font-family:Arial,sans-serif;">

<div style="max-width:650px; margin:auto; background:#fff; border-radius:10px; overflow:hidden;">

    <div style="background:#111; padding:25px; text-align:center;">
        <h1 style="color:#fff; margin:0;">TAKBIR GADGETS</h1>
        <p style="color:#ddd; margin-bottom:0;">New Order Notification</p>
    </div>

    <div style="padding:25px;">

        <h2 style="color:#16a34a;">New Order Received!</h2>

        <p>A new customer has placed an order on your website.</p>

        <div style="background:#f5f5f5; padding:15px; border-radius:8px;">
            <strong>Order Number:</strong>
            #{{ $order->order_number }}<br><br>

            <strong>Order Status:</strong>
            <span style="color:#d97706;">{{ ucfirst($order->status) }}</span>
        </div>

        <h3 style="margin-top:25px;">Customer Information</h3>

        <table width="100%" cellpadding="8" cellspacing="0">
            <tr>
                <td><strong>Name</strong></td>
                <td>{{ $order->customer_name }}</td>
            </tr>
            <tr>
                <td><strong>Phone</strong></td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td><strong>District</strong></td>
                <td>{{ $order->district ?: 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Thana</strong></td>
                <td>{{ $order->thana ?: 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Address</strong></td>
                <td>{{ $order->address }}</td>
            </tr>
        </table>

        <h3 style="margin-top:25px;">Product Information</h3>

        <table width="100%" cellpadding="10" cellspacing="0"
               style="border-collapse:collapse; text-align:left;">

            <tr style="background:#f5f5f5;">
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
            </tr>

            <tr>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>৳{{ number_format($order->unit_price, 2) }}</td>
            </tr>

        </table>

        <h3 style="margin-top:25px;">Payment Summary</h3>

        <table width="100%" cellpadding="8">
            <tr>
                <td>Subtotal</td>
                <td align="right">
                    ৳{{ number_format($order->unit_price * $order->quantity, 2) }}
                </td>
            </tr>

            <tr>
                <td>Delivery Fee
                    ({{ ucfirst($order->delivery_zone) }})
                </td>
                <td align="right">
                    ৳{{ number_format($order->delivery_fee, 2) }}
                </td>
            </tr>

            <tr style="background:#f5f5f5;">
                <td><strong>Total Amount</strong></td>
                <td align="right">
                    <strong style="color:#e30000; font-size:20px;">
                        ৳{{ number_format($order->total, 2) }}
                    </strong>
                </td>
            </tr>
        </table>

        <p style="margin-top:25px;">
            Please contact the customer and process this order.
        </p>

    </div>

    <div style="background:#111; padding:20px; text-align:center;">
        <p style="color:#fff; margin:0;">
            Takbir Gadgets
        </p>
        <p style="color:#aaa; font-size:12px;">
            Automated Order Notification
        </p>
    </div>

</div>

</body>
</html>
