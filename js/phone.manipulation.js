$(function () {
    $('#phone').on('keyup', function () {
        let phone = this.value;
        // phone = phone.replace(/^\\+7/, '');
        // phone = phone.replace(/^8/, '');
        phone = phone.replace(/[^0-9]+git push
        /, '');
        $('#phone').val(phone);
    });
});
