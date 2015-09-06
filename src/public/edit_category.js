/**
 * Script for the edit page.
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 */
$(document).ready( function() {

    $('.cms_content_editor form').on('submit', function () {

        var url, method, id, article_data, self = this, messages = '';

        var gatherInput = function () {

            article_data = {};

            // gather the input fields
            $(self).find('input, select, textarea').each(function (index, control) {

                // _token field only has a name, no id
                id = $(control).attr('name') || $(control).attr('id');

                if ($(control).is(':checkbox')) {
                    article_data[id] = $(control).prop('checked') ? 1 : 0;
                } else {
                    article_data[id] = $(control).val();
                }

            });

        };

        var setUrl = function () {

            if (editorConfig.thisUrl.indexOf('create') > -1) {
                method = 'POST';
                url = editorConfig.thisUrl.replace('/create', '');

            } else {
                method = 'PUT';
                url = editorConfig.thisUrl.replace('/edit', '');
            }

        };

        var setSuccessMessage = function (data) {

            $('#success_message')
                .html(editorConfig.contentSaved.replace('view:', data['next']));

            var decoded = $('#success_message').text(); // @todo: better way to decode

            $('#success_message')
                .html(decoded)
                .parents('div.alert')
                .css('display', 'inline-block');

            $('#error_message').parents('.alert').hide();

        }

        var setErrorMessage = function (message) {

            $('#error_message').html(message)
                .parents('.alert')
                .css('display', 'inline-block');

            $('#success_message').parents('.alert').hide();

        }

        var setFieldMessages = function (jqXHR) {

            $(self).find('input, select, textarea').each( function (index, control) {

                // _token field only has a name, no id
                id = $(control).attr('name') || $(control).attr('id');

                if (jqXHR.responseJSON[id]) {
                    $(control).addClass('invalid')
                        .attr('aria-invalid', true)
                        .parents('div.form-group')
                        .addClass('has-error')
                        .children('span.sr-only')
                        .text('invalid');
                    messages = messages + jqXHR.responseJSON[id] + '<br/>';
                } else {
                    $(control).removeClass('invalid')
                        .attr('aria-invalid', null)
                        .parents('div.form-group')
                        .removeClass('has-error')
                        .children('span.sr-only')
                        .text('');
                }

            });

        }

        gatherInput();
        setUrl();

        $.ajax({
            type: method,
            url: url,
            data: article_data
        })
            .done(function (data, textStatus, jqXHR) {
                setFieldMessages({responseJSON: {}});
                setSuccessMessage(data);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 422) {

                    setFieldMessages(jqXHR);
                    setErrorMessage(messages);

                } else {
                    setErrorMessage(errorThrown);
                }
            });

        return false;

    });

    $('.cms_content_editor button.cancel').on('click', function () {
        window.location = editorConfig.urlBase + '/' + editorConfig.categoryBase;
    });

    $('.cms_content_editor .alert button.close').on('click', function () {
        $(this).parents('.alert').hide();
    });

});
