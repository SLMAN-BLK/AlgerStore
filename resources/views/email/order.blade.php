<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    <p>Telephone: {{ $order->tel }}</p>
    <p>Address: {{ $order->address }}</p>
    <p>Order Name: {{ $order->nomachteur }}</p>
    <p>Title: {{ $order->title }}</p>
</body>
</html>
