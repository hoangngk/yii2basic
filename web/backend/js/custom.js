// choose all checkboxes
$(function () {
    $('input.checkbox-choose-all').click(function () {
        var checked = $(this).is(':checked'),
            allCheckbox = $('.checbox-list-item .checkbox-item')
        if (checked) {
            allCheckbox.prop('checked', true)
        }
        else {
            allCheckbox.prop('checked', false)
        }
    })
})