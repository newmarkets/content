/**
 * Script for the edit page.
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 */
$(document).ready( function() {

    var editor = new Pen({
        editor: document.getElementById('content'),
        stayMsg: editorConfig.stayMsg,
        placeholder: editorConfig.placeholder,
        debug: true,
        textarea: '<div class="form-group"><label class="' + editorConfig.col
        + '-2 control-label" for="content">' + editorConfig.label
        + '</label><div class="' + editorConfig.col
        + '-10"><textarea class="form-control" rows="20" id="content">' + editorConfig.label
        + '</textarea></div></div>',
        list: [
            'blockquote',
            'h3',
            'h4',
            'code',
            'insertunorderedlist',
            'bold',
            'italic',
            'createlink',
            'insertimage',
            'undo'
        ],
        titles: {
            blockquote: 'Blockquote',
            h3: 'Heading 3',
            h4: 'Heading 4',
            code: 'Code',
            insertunorderedlist: 'Unordered list',
            bold: 'Bold',
            italic: 'Italic',
            createlink: 'Hyperlink',
            insertimage: 'Image',
            undo: 'Undo'
        },
        cleanTags: ['script', 'style', 'font']
    });

    $('i.pen-icon').tooltip();

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

            // gather content from the editor
            editor.cleanContent();
            article_data.content = editor.toMd();

            // gather the slug content
            article_data.slug = $('#slug').text();

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

            if (jqXHR.responseJSON.content) {
                $('#cms_content_tab').addClass('has-error');
                messages = messages + jqXHR.responseJSON.content;
            } else {
                $('#cms_content_tab').removeClass('has-error');
            }

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

    $('.cms_content_editor .alert button.close').on('click', function () {
        $(this).parents('.alert').hide();
    });

    $('#title').keyup(function (event) {

        var title = $('#title').val();
        $.get(editorConfig.urlBase + '/' + editorConfig.path + '/article/slug',
            {title: title},
            function (data) {
                $('#slug').text(data);
            },
            'text'
        );

    });

});
