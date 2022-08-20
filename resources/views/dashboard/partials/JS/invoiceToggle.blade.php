<script>
    let old_cost = 1;
    let new_cost = 1;
    let points = 1;
    let available_points = 1;
    let min_cost_invoice = 0;

    function validate() {
        let pointsWallet = document.getElementById('pointsWallet');
        if (pointsWallet.checked) {
            if (old_cost <= min_cost_invoice) {
                new_cost = old_cost;
            } else {
                new_cost = old_cost - available_points;
            }

            if (new_cost < min_cost_invoice) {
                available_points = old_cost - min_cost_invoice;
                new_cost = old_cost - available_points;
                $("#pointsWalletLabel").html(`${available_points} points used from ${points} points`);
            }
            $('#view-invoice-form-cost').html(new_cost)
            $('#points').val(available_points)
        } else {
            $('#points').val(0)
            $('#view-invoice-form-cost').html(old_cost)
            $("#pointsWalletLabel").html(`${available_points} points to use from ${points} points`);
        }
    }
</script>
