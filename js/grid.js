$(document).ready(function () {
    $('.grid-delete').click(function(event) {
        event.preventDefault();
        if (confirm('Delete this contact?')) {
            var el = this;
            var delete_row = $.ajax( $(this).attr('href') )
            .done(function(success) {
                if (success == true) {
                    $(el).closest('tr').remove();
                    window.location.reload();
                };
            })
            .fail(function() {
                alert( "Error occured, please try again later." );
            });
        };
    });


    $('.grid-editable').bind('dblclick', updater);
});

var updater = function () {
    var el = $(this);
    el.unbind('dblclick', updater);
    var old_value = $(el).text();
    var editable = $('<input type="text" value="'+old_value+'" />').blur(function () {
    var new_value = $(this).val();
    var input = $(this);

    var data = {};
    var model_name = el.closest('table').attr('data-model');
    data[model_name] = {}
    var field_name = el.attr('data-name');
    data[model_name][field_name] = new_value;
    
        var update_field = $.ajax( {
            url: el.closest('table').attr('data-updateurl')+'/'+el.attr('data-id'),
            data: data,
            type: 'post',
            dataType: 'json',
        })
        .done(function(data) {
            el.find('span').remove();
            el.find('br').remove();
            if (typeof data.errors !== "undefined"){
                el.append('<br /><span style="color:#b94a48;">'+data.errors[field_name].join(', ')+'</span>');
            }else{
                el.html(input.val());
                el.bind('dblclick', updater);
            }
        })
        .fail(function() {
            el.html(old_value);
            el.bind('dblclick', updater);
            alert( "Error accured, try again later." );
        });

    }).keypress(function(event) { 
        if (event.keyCode == 13){
            $(this).blur();
            return false
        }
    });
    el.html(editable);
    editable.focus();
}
