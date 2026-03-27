<h1>Order Confirmation</h1>
<p>Hello {{ $order->user->name }},</p>
<p>Your order #{{ $order->id }} from <strong>{{ $order->vendor->name }}</strong> has been placed successfully.</p>
<p>Total Amount: ₹{{ $order->total }}</p>
<p>Thank you for shopping with us!</p>