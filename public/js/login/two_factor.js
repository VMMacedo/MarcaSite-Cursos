$(document).on('click', '#codeEmgerAuth', function () {
    $('.codeAuth').hide();
    $('.codeEmgerAuth').show();
    $('#codeAuth').show();
    $('#codeEmgerAuth').hide();
});
$(document).on('click', '#codeAuth', function () {
    $('.codeEmgerAuth').hide();
    $('.codeAuth').show();
    $('#codeEmgerAuth').show();
    $('#codeAuth').hide();
});