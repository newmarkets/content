/**
 * Script for the edit page.
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 */
$(document).ready( function() {

    var editor = new Pen({
        editor: document.getElementById('content'),
        stayMsg: editor_stay_msg,
        placeholder: editor_placeholder,
        debug: true,
        textarea: '<div class="form-group"><label class="' + col
        + '-2 control-label" for="content">' + contentLabel
        + '</label><div class="' + col
        + '-10"><textarea class="form-control" rows="20" id="content">' + contentLabel
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

        var data = {};
        $(this).find('input, select, textarea').each( function (index, control) {
            if ($(control).is(':checkbox')) {
                debugger;
                data[$(control).attr('id')] = $(control).prop('checked');
            } else {
                data[$(control).attr('id')] = $(control).val();
            }
        });
        $(this).find('input[type="checkbox"]').each( function (index, control) {
            data[$(control).attr('id')] = $(control).attr('checked');
        });
        editor.cleanContent();
        data.content = editor.toMd();
        console.log(data);

        var test = $.param(data, false);
        return false;

    });

});
