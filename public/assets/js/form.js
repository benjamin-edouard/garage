$(document).ready(function() {
    let formSubject = $('h3:first').text()
    $('input:text.field-subject').val(formSubject)
    $('input:text.field-subject').attr('disabled', true)
});
