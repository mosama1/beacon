$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('#_token').attr('content') }
    });
});