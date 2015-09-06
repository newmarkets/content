/**
 * Script for delete category button.
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 */
$(document).ready( function() {

    $('#delete-modal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget),
            category = button.data('category'),
            modal = $(this);

        modal.find('input.category').val(category);

    });

    $('#delete-modal .delete-button').on('click', function (event) {

        var category = $('#delete-modal input.category').val(),
            token = $('#delete-modal input[name="_token"]').val();

        $('#delete-modal').modal('hide');

        $.ajax({
            type: 'DELETE',
            url: editorConfig.urlBase + '/' + editorConfig.categoryBase + '/' + category ,
            data: {_token: token}
        })
            .done(function (data, textStatus, jqXHR) {

                window.location = editorConfig.urlBase + '/' + editorConfig.categoryBase;

            })
            .fail(function (jqXHR, textStatus, errorThrown) {

                $('#error_message').html(errorThrown)
                    .parents('.alert')
                    .css('display', 'inline-block');

            });

    });

});
