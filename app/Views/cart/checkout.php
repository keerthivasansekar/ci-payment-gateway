<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "<?= $key_id ?>",
    "amount": "<?= $grand_total ?>",
    "currency": "INR",
    "name": "Acme Corp",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    "order_id": "<?= $order_id ?>",
    "callback_url": "<?= base_url('cart/success') ?>",
    "prefill": {
        "name": "<?= $customer['name'] ?>",
        "email": "<?= $customer['email'] ?>",
        "contact": "<?= $customer['mobile'] ?>" 
    },
    "notes": {
        "address": "Acme Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>