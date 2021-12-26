// check all rows in datatable table
function check_all() {
    $('input[class = "item_checkbox"]:checkbox').each(function() {
        if ($('input[class="check_all"]:checkbox:checked').length == 0) {
            $(this).prop('checked', false);
        } else {
            $(this).prop('checked', true);
        }

    })
}

// get ids of all selected rows
function delete_all() {
    $(document).on('click', '.del_all', function() {
        $('#form_data').submit();
    });

    $(document).on('click', '.del_btn', function() {
        var item_checked = $('input[class = "item_checkbox"]:checkbox').filter(":checked").length;

        if (item_checked > 0) {
            $('.record_count').text(item_checked);
            $('.not_empty_record').removeAttr('hidden');
            $('.empty_record').attr('hidden', true);
        } else {
            $('.record_count').text('');
            $('.not_empty_record').attr('hidden', true);
            $('.empty_record').removeAttr('hidden');
        }

        $('#multipleDelete').modal('show');
    });
}

$(`#posts-datatable-table`).on('init.dt', function() {
    $(this).wrap("<div class='col-12' style='overflow-x:auto'></div>");
    $(this).width("100%");
});
