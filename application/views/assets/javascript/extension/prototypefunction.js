

function prototype_save(self) {
    var form_id = self.getAttribute('form');
    var value = self.getAttribute('value');

    var button_value = $("<input type='hidden'/>");
    button_value.attr("name", "save");
    button_value.attr("value", value); // get value save or save_stay
    button_value.appendTo("#" + form_id);

    $("#" + form_id).submit();
    button_value.remove();
}

var get_level_table = function ($obj_table, $obj_tr){

    var level = parseInt($obj_table.find(" > tbody > tr").length);

    if($obj_tr != '') {
        level = parseInt($obj_tr.find('td').attr('datarow')) - 1;
    } else if(level == 0) {
        level = 0;
    } else {
        level = parseInt($obj_table.find(" > tbody > tr:last").find('td').attr('datarow'));
    }
    
    return level;
}

$.fn.expandtable = function(options) {
    var defaults = {
        type: 'text',
        align: 'left',
        visible: true,
    }

    function writeRow(record, $object_tr) {
        var tr = '';
        for(var i = 0, len = record.length;i < len;i ++) {
            tr += writeColumn(record[i]);
        }
        
        if($object_tr != ''){
            return tr;
        }
        return '<tr>' + tr + '</tr>';
    }

    function writeColumn(record) {
        var td = '<td ';
        var html = '';
        var input = '';
        var button = '';
        var image = '';

        var align = (typeof (record.align) === 'undefined') ? defaults.align : record.align;
        var visible = (typeof (record.visible) === 'undefined') ? defaults.visible : record.visible;
        var classes = (typeof (record.class) === 'undefined') ? '' : record.class;
        var type = (typeof (record.type) === 'undefined') ? '' : record.type;
        var icon = (typeof (record.icon) === 'undefined') ? '' : record.icon;
        var name = (typeof (record.name) === 'undefined') ? '' : record.name;
        var value = (typeof (record.value) === 'undefined') ? '' : record.value;

        if(typeof (record.button) !== 'undefined') {
            td += 'class="text-' + record.button[0].align + '" ';
        } else {
            td += 'class="text-' + align + '" ';
        }
        
        if(typeof (record.datarow) !== 'undefined' && record.datarow == true && typeof (record.text) !== 'undefined') {
            td += 'datarow='+record.text;
        }

        if(! visible || type === 'hidden') {
            td += 'style="display:none;"';
        }

        if(type == 'text' || type == 'hidden') {
            input += '<input type="' + type + '" ';

            if(name != '') {
                input += 'name = "' + name + '" ';
            }
            if(value != '') {
                input += 'value = "' + value + '" ';
            }
            if(classes != ''){
                input += 'class = "'+classes+'" ';
            }

            input = $.trim(input) + '>';
        }

        if(typeof (record.button) !== 'undefined') {
            if($.isArray(record.button)) {
                button = writeButton(record.button);
            }
        }

        if(typeof (record.text) !== 'undefined') {
            html += record.text;
        }

        if(typeof (record.image) !== 'undefined' && record.image == true) {
            image += '<img src = "' + record.text + '"  width="32" class="img-thumbnail" >';
            html = '';
        }

        td = $.trim(td) + '>'
        td += button + image + input + html + '</td>';

        return td;
    }

    function writeButton(record) {
        var button = '';
        for(var i = 0, len = record.length;i < len;i ++) {

            var btn = record[i];
            button += '<button type="button" ';

            if(typeof (btn.event) !== 'undefined') {
                button += 'onclick = "' + btn.event + '" ';
            }

            if(typeof (btn.toggle) !== 'undefined' && btn.toggle === true) {
                button += 'data-toggle="tooltip" ';
            }

            if(typeof (btn.title) !== 'undefined') {
                button += 'title = "' + btn.title + '" ';
            }

            if(typeof (btn.class) !== 'undefined') {
                button += 'class = "btn ' + btn.class + '" ';
            }

            button = $.trim(button) + '>';

            if(typeof (btn.icon) !== 'undefined') {
                button += '<i class="fa ' + btn.icon + '"></i>';
            }

            if(typeof (btn.text) !== 'undefined') {
                button += ' ' + btn.text;
            }

            button += '</button> ';
        }

        return button;
    }

    var dataset = options.columns;
    var $object_tr = options.$object_tr || ''; // $object_tr is flag add or update
    var row = writeRow(dataset, $object_tr);
    var $this = $(this);
    
    if($object_tr != ''){
        $object_tr.html(row);
    }else{
        $($this).append(row);
    }
};
