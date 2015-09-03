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
            'blockquote|Blockquote',
            'h3|Heading 3',
            'h4|Heading 4',
            'code|Code',
            'insertunorderedlist|Unordered list',
            'bold|Bold',
            'italic|Italic',
            'createlink|Hyperlink',
            'insertimage|Image',
            'undo|Undo'
        ],
        cleanTags: ['script', 'style', 'font']
    });

    $('.cms_content form').on('submit', function () {

        var url, method, index, data = {};
        $(this).find('input, select, textarea').each( function (index, control) {

            // _token field only has a name, no id
            index = $(control).attr('name') || $(control).attr('id');

            if ($(control).is(':checkbox')) {
                data[index] = $(control).prop('checked');
            } else {
                data[index] = $(control).val();
            }

        });

        // get the editor content as Markdown
        editor.cleanContent();
        data.content = editor.toMd();

        if (editorConfig.thisUrl.indexOf('create') > -1) {
            method = 'POST';
            url = editorConfig.thisUrl.replace('/create', '');
        } else {
            method = 'PUT';
            url = editorConfig.thisUrl.replace('/edit', '');
        }

        $.ajax({
            type: method,
            url: url,
            data: data
        })
            .done(function (data, textStatus, jqXHR) {
                $('#success_message').text(editorConfig.contentSaved);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                $('#error_message').text(errorThrown);
            });

        return false;

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
