<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Sent Confirmation</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-md mx-auto bg-white shadow-md p-6 rounded-md">
        <p class="text-lg font-semibold text-gray-800">Hello {{ $name }},</p>
        
        <p class="mt-4 text-base text-gray-700">This is to confirm that a payment of ₱{{ number_format($amount, 2) }} has been sent.</p>

        <p class="mt-4 text-base text-gray-700">Thank you for your business!</p>

        <p class="mt-6 text-base text-gray-700">Best regards,<br>
        Esteban Company</p>
    </div>
</body>
</html>
