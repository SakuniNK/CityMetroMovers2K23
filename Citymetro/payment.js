function paymentGateWay(){
    $.ajax({
        url : "payhereprocess.php",
        method : "POST",
        success: function (data){
            var obj = $.parseJSON(data);
            alert(obj['amount']);

            // Payment completed. It can be a successful failure.
            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + orderId);
                location.href = "payment.php?u=1";
                // Note: validate the payment and show success or failure page to the customer
            };

            // Payment window closed
            payhere.onDismissed = function onDismissed() {
                // Note: Prompt user to pay again or show an error page
                console.log("Payment dismissed");
            };

            // Error occurred
            payhere.onError = function onError(error) {
                // Note: show an error page
                console.log("Error:"  + error);
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": "1224506",    // Replace your Merchant ID
                "return_url": "http://localhost/Citymetro/index.php",     // Important
                "cancel_url": "http://localhost/Citymetro/payment.php",     // Important
                "notify_url": "http://sample.com/notify",
                "order_id": obj["order_id"],
                "items": obj["items"],
                "amount": obj["amount"],
                "currency": obj["currency"],
                "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                "first_name": obj["first_name"],
                "last_name": obj["last_name"],
                "email": "",
                "phone": "",
                "address": "",
                "city": "",
                "country": "",
                "delivery_address": "",
                "delivery_city": "",
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        },
        error : function (){
            console.log("ajax err");
        }
    });
}