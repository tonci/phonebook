$(document).ready(function () {
    $('.grid-delete').click(function(event) {
        event.preventDefault();
        var el = this;
        var delete_row = $.ajax( $(this).attr('href') )
        .done(function(success) {
            if (success == true) {
                $(el).closest('tr').remove();
                window.location.reload();
            };
        })
        .fail(function() {
            alert( "error" );
        });
    });


    $('.grid-editable').bind('dblclick', updater);
});

var updater = function () {
    var el = $(this);
    el.unbind('dblclick', updater);
    var text = $(el).text();
    var editable = $('<input type="text" value="'+text+'" />').blur(function () {
    var new_value = $(this).val();

    var data = {};
    var model_name = el.closest('table').attr('data-model');
    data[model_name] = {}
    var field_name = el.attr('data-name');
    data[model_name][field_name] = new_value;
    
        var update_field = $.ajax( {
            url: el.closest('table').attr('data-updateurl')+'/'+el.attr('data-id'),
            data: data,
            type: 'post',
        })
        .done(function(success) {
            
        })
        .fail(function() {
            alert( "error" );
        });

        el.html($(this).val());
        el.bind('dblclick', updater);
    }).keypress(function(event) { 
        if (event.keyCode == 13){
            $(this).blur();
            return false
        }
    });
    el.html(editable);
    editable.focus();
}
