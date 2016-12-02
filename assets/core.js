/*
* Calculate()
*/
function calculate () {
    var total_price = 0;
    /*Search for each .material*/
    $('.material').each(function () {
        /*Find amount with .amount class input*/
        var amount = $(this).find('.amount').val();
        /*Find price with .price class input*/
        var price = $(this).find('.price').val();

        total_price += amount * price;
    });
    /*Result will be total price*/
    $('#result').val(total_price);
}
/*
* Clear()
*/
function clear () {
    $('input').each(function () {
        /*Clear all input value*/
        $(this).val(0);
    });
}
/*
* Send Email()
*/
function send_email() {
    var data = [];
    /*Search for each .material*/
    $('.material').each(function () {
        /*Find amount with .amount class input*/
        var amount = $(this).find('.amount').val();
        /*Find price with .price class input*/
        var price = $(this).find('.price').val();
        /*Find name with .name class element*/
        var name = $(this).find('.name').text();
        data.push({
            amount: amount,
            price: price,
            name: name
        });
    });
    $.post('mail.php', {data: data}, function (r) {
        r = JSON.parse(r);
        if (r.status) {
            clear();
        } else {
            alert(r.message);
        }
    });
}
$(document).ready(function () {
    calculate();
    /*Search for each .material*/
    $('.material').each(function () {
        /*bind calculate function to every .amount input with change*/
        $(this).find('.amount').change(function () {
            calculate();
        });
        /*bind calculate function to every .price input with change*/
        $(this).find('.price').change(function () {
            calculate();
        });
    });
    /*Bind clear function to #clear button with click*/
    $('#clear').click(function () {
        clear();
    });
    /*Bind send function to #send button with click*/
    $('#send').click(function () {
        send_email();
    });
});