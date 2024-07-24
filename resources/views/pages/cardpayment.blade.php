<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 - Stripe Payment Gateway Integration Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    
<div class="container mx-auto py-6">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Payment Details</h3>

                    @if (Session::has('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center mb-4">
                            <span class="close cursor-pointer absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="close">&times;</span>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form 
                        role="form" 
                        action="{{ route('stripe.post', ['id'=>$id]) }}" 
                        method="post" 
                        class="require-validation"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                        id="payment-form">
                        @csrf
                  

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Name on Card</label>
                            <input type="text" class="form-control w-full px-3 py-2 border rounded" size="4">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Card Number</label>
                            <input type="text" autocomplete="off" class="form-control w-full px-3 py-2 border rounded card-number" size="20">
                        </div>

                        <div class="flex mb-4 space-x-4">
                            <div class="w-1/3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">CVC</label>
                                <input type="text" autocomplete="off" class="form-control w-full px-3 py-2 border rounded card-cvc" placeholder="ex. 311" size="4">
                            </div>
                            <div class="w-1/3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Expiration Month</label>
                                <input type="text" class="form-control w-full px-3 py-2 border rounded card-expiry-month" placeholder="MM" size="2">
                            </div>
                            <div class="w-1/3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Expiration Year</label>
                                <input type="text" class="form-control w-full px-3 py-2 border rounded card-expiry-year" placeholder="YYYY" size="4">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" autocomplete="off" class="form-control w-full px-3 py-2 border rounded card-number">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                            <input type="number" name="amount" autocomplete="off" class="form-control w-full px-3 py-2 border rounded card-number">
                        </div>

                        <div class="mb-4 hidden error">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                Please correct the errors and try again.
                            </div>
                        </div>

                        <div>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" type="submit">Pay Now</button>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>
    
</body>

<script src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hidden');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hidden');
                e.preventDefault();
            }
        });
     
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });
      
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hidden')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
});
</script>
</html>
