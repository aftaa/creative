$(function () {
    $('#phone').on('keypress', function () {
        let phone = this.value;

        phone = phone.replace(/^\\+7/, '');
        phone = phone.replace(/^8/, '');
        phone = phone.replace(/[^0-9]/, '');

        $.get('/format_phone.php', {phone: phone}, function (data) {
            $('#phone').val(data.phone);
        }, 'json');


    });
});
