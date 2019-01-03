<?php
/**
 * Created by PhpStorm.
 * User: pradeepkkandekar
 * Date: 7/19/18
 * Time: 11:44 AM
 */

?>

<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "rzp_live_b7vQ8lyFs69syy",
        "amount": "20", // 2000 paise = INR 20
        "name": "RupeeBoss.com",
        "description": "Purchase Description",
        "image": "http://www.rupeeboss.com/images/logo-rupee-boss.png",
        "handler": function (response){
            alert(response.razorpay_payment_id);
        },
        "prefill": {
            "name": "Pradeep Khandekar",
            "email": "pradeepkhandekar@gmail.com"
        },
        "notes": {
            "address": "Mumbai,IN"
        },
        "theme": {
            "color": "#F37254"
        }
    };
    var rzp1 = new Razorpay(options);

    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
</script>
