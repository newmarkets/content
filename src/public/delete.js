/**
 * Script for delete button.
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 */
$(document).ready( function() {

    $('#delete-modal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget),
            category = button.data('category'),
            article = button.data('article'),
            modal = $(this);

        modal.find('input.category').val(category);
        modal.find('input.article').val(article);

    });

    $('#delete-modal .delete-button').on('click', function (event) {

        var category = $('#delete-modal input.category').val(),
            article = $('#delete-modal input.article').val(),
            token = $('#delete-modal input[name="_token"]').val();

        $('#delete-modal').modal('hide');

        $.ajax({
            type: 'DELETE',
            url: '/' + category + '/article/' + article,
            data: {_token: token}
        })
            .done(function (data, textStatus, jqXHR) {

                window.location = '/' + category + '/article';

            })
            .fail(function (jqXHR, textStatus, errorThrown) {

                $('#error_message').html(errorThrown)
                    .parents('.alert')
                    .css('display', 'inline-block');

            });

    });

});
