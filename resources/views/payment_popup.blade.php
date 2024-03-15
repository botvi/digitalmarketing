<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Popup</title>
</head>

<body>
    <h1>Payment Popup</h1>
    <!-- Konten popup pembayaran -->
    <div id="snap-form"></div>
    <!-- your HTML code -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $snapToken }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Include axios library -->

    <script type="text/javascript">
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Pembayaran berhasil');
                updateTransactionStatus(result.order_id);
            },
            onPending: function(result) {
                alert('Pembayaran dalam proses');
                updateTransactionStatus(result.order_id);
            },
            onError: function(result) {
                alert('Pembayaran gagal');
                updateTransactionStatus(result.order_id);
            },
            onClose: function(result) {
                alert('Pembayaran ditutup');
                // Tidak perlu memperbarui status jika pembayaran ditutup tanpa selesai
            }
        });

        function updateTransactionStatus(orderId) {
            axios.get('/deposit/' + orderId + '/status')
                .then(function(response) {
                    console.log(response.data.message); // Tampilkan pesan dari server
                    // Redirect ke route /deposit_idr setelah pembaruan status
                    window.location.href = '/deposit';
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        }
    </script>


</body>

</html>
