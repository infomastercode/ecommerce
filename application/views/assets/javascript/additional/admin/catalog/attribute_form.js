var $object_tr = '';

$("#btn_attribute").on("click", function(e){

   var data = {};
   data.value = $("#input_attribute_value").val();
   
   generate_attribute_value(data);
});


function generate_attribute_value(data) {
    var level;
    level = get_level_table($("#tbl_master_value"), $object_tr);

    //console.log(level); //return;

    $("#tbl_master_value").expandtable({
        columns: [
            {text: (level + 1), align: 'center', class: '', datarow: true},
            {text: data.value, align: 'left', class: ''},
            {
                button: [
                    {event: 'remove_detail($(this))', align: 'right', class: 'btn-danger btn-sm', icon: 'fa-minus-circle', toggle: true, title: 'add'},
                    {event: 'view_detail($(this))', align: 'right', class: 'btn-primary btn-sm', icon: 'fa-file-text-o', toggle: true, title: 'remove'}
                ]
            },
            {type: 'hidden', name: 'detail[' + level + '][name]', value: data.value},
        ],
        $object_tr: $object_tr,
    });
    $object_tr = '';
}




//
////
//
//$(document).ready(function() {
//    generate_product_unit('', 1000, 1200, 1200, 1200, 50);
//    get_product_unit();
//    init_system();
//});
//
//function init_system() {
//    get_warehouse("#input_warehouse", true);
//
//    $("#input_warehouse").change(function() {
//        $("#input_location > option:not(option:eq(0))").remove();
//        get_zone_by_warehouse("#input_zone", $("#input_warehouse").val());
//    });
//
//    $("#input_zone").change(function() {
//        get_location_by_warehouse_zone("#input_location", $("#input_warehouse").val(), $("#input_zone").val());
//    });
//}
//
// save
$("#btn_save,#btn_save_stay").on("click", function(event) {
    event.preventDefault();
    //var status_required = check_required();
    //var count_detail = check_detail("tbl_detail_detail");

  //  if(status_required == 1) {
        prototype_save(this);
  //  }
});
//
//
//
///* begin product unit */
//function get_product_unit() {
//    $.ajax({
//        type: 'get',
//        url: $('#base_url').val() + '/catalog/part/product/getUnits',
//        dataType: 'json',
//        success: function(data) {
//            for(var index in data['units']) {
//                var option = $('<option value=' + data['units'][index] + ' >' + data['units'][index] + '</option>');
//                $("#unit_sm_0").append(option);
//                //$("#select_unit_1").append(option);
//            }
//        }
//    });
//}
//
//function add_product_unit() {
//    generate_product_unit('', '', '', '', '', '');
//}
//
//function add_product_barcode() {
//    var value = {};
//    value.product_barcode_id = '';
//    value.level = $("#input_barcode_level").val();
//    value.barcode_no = $("#input_barcode_no").val();
//    value.comment = $("#input_barcode_comment").val();
//    
//    remove_notify($("#notify_barcode"));
//    if(value.barcode_no == '') {
//        display_notify($("#notify_barcode"), "This field is required.");
//        return;
//    }
//    
//    generate_product_barcode(value);
//    clear_product_barcode();
//}
//
//function add_product_prefer() {
//    var value = {};
//    value.product_prefer_id = '';
//
//    value.warehouse = $("#input_warehouse option:selected").text();
//    value.zone = $("#input_zone option:selected").text();
//    value.location = $("#input_location option:selected").text();
//
//    value.warehouse_id = $("#input_warehouse option:selected").val();
//    value.zone_id = $("#input_zone option:selected").val();
//    value.location_id = $("#input_location option:selected").val();
//
//    remove_notify($("#notify_prefer"));
//    if(value.warehouse_id == 0 || value.zone_id == 0 || value.location_id == 0) {
//        display_notify($("#notify_prefer"), "This field is required.");
//        return;
//    }
//
//    generate_product_prefer(value);
//    clear_product_prefer();
//}
//
//
//
//function generate_product_unit(product_unit_id, qty, width, length, height, weight) {
//    var package = '';
//    var unit = '';
//    var level = $("#tbl_detail_unit tr").length;
//
//    if(level == 0) {
//        package = 'PALLET'; // default max
//        unit = 'PCS'; // default min
//    } else {
//        package = $("#unit_sm_" + (level - 1)).val(); // get unit level 0 into package.
//        unit = package;
//    }
//
//    var tr = $('<tr id="unit_level_' + level + '" ></tr>');
//
//    var td1 = $('<td class="text-center"><input type="hidden" name="unit[' + level + '][product_unit_id]" value="' + product_unit_id + '" >' + (level + 1) + '</td>');
//    var td2 = $('<td><select class="form-control" name="unit[' + level + '][package]"><option value="' + package + '">' + package + '</option></select></td>');
//    var td3 = $('<td><input type="text" name="unit[' + level + '][qty]" value="' + qty + '" class="form-control"></td>');
//    var td4 = $('<td><select class="form-control" name="unit[' + level + '][unit]" id="unit_sm_' + level + '"><option value="' + unit + '">' + unit + '</option></select></td>');
//    var td5 = $('<td><input type="text" name="unit[' + level + '][width]" value="' + width + '" class="form-control"></td>');
//    var td6 = $('<td><input type="text" name="unit[' + level + '][length]" value="' + length + '" class="form-control"></td>');
//    var td7 = $('<td><input type="text" name="unit[' + level + '][height]" value="' + height + '" class="form-control"></td>');
//    var td8 = $('<td><input type="text" name="unit[' + level + '][weight]" value="' + weight + '" class="form-control"></td>');
//    var td9 = $('<td></td>');
//
//    tr.append(td1);
//    tr.append(td2);
//    tr.append(td3);
//    tr.append(td4);
//    tr.append(td5);
//    tr.append(td6);
//    tr.append(td7);
//    tr.append(td8);
//    tr.append(td9);
//
//    $("#tbl_detail_unit").append(tr);
//
//    if(level != 0) {
//        $('#unit_sm_0').find('option').clone().appendTo('#unit_sm_' + (level));
//    }
//
//}
//
//function generate_product_prefer(data) {
//    var level = $("#tbl_detail_prefer tr").length;
//    var html = '';
////	
//    html += '<tr>';
//    html += '<td>' + (level + 1) + '</td>';
//    html += '<td>' + data.warehouse + '</td>';
//    html += '<td>' + data.zone + '</td>';
//    html += '<td>' + data.location + '</td>';
//    html += '<td><button class="form-control"><i class="fa fa-plus-circle"></i></button></td>';
//
//    html += '<td style="display:none;"><input type="hidden" name="prefer[' + level + '][product_prefer_id]" value="' + data.product_prefer_id + '"></td>';
//    html += '<td style="display:none;"><input type="hidden" name="prefer[' + level + '][warehouse_id]" value="' + data.warehouse_id + '"></td>';
//    html += '<td style="display:none;"><input type="hidden" name="prefer[' + level + '][zone_id]" value="' + data.zone_id + '"></td>';
//    html += '<td style="display:none;"><input type="hidden" name="prefer[' + level + '][location_id]" value="' + data.location_id + '"></td>';
//    html += '</tr>';
////
//    $('#tbl_detail_prefer').append(html);
//}
//
//function remove_product_unit() {
//    var level = $("#tbl_detail_unit tr").length;
//    if(level > 1) {
//        $("#unit_level_" + (level - 1)).remove();
//    }
//}
//
///* end product unit */
//
///* begin product barcode */
//
//
//
//function generate_product_barcode(data) {
//    var level = $("#tbl_detail_barcode tr").length;
//    var html = '';
//    // product_barcode_id, barcode_no, comment
//    html += '<tr>';
//    html += '<td>' + (level + 1) + '</td>';
//    html += '<td>' + data.barcode_no + '</td>';
//    html += '<td>' + data.comment + '</td>';
//    html += '<td><button onclick="view_barcode(' + level + ')" type="button" class="btn btn-primary btn-sm"><i class="fa fa-file-text-o"></i></button></td>';
//    
//    html += '<td style="display:none;"><input type="hidden" name="barcode[' + level + '][product_barcode_id]" value="' + data.product_barcode_id + '"></td>';
//    html += '<td style="display:none;"><input type="hidden" name="barcode[' + level + '][level]" value="' + (level + 1) + '"></td>';
//    html += '<td style="display:none;"><input type="hidden" name="barcode[' + level + '][barcode_no]" value="' + data.barcode_no + '"></td>';
//    html += '<td style="display:none;"><input type="hidden" name="barcode[' + level + '][comment]" value="' + data.comment + '"></td>';
//    html += '</tr>';
//
//    $("#tbl_detail_barcode").append(html);
//    
////    var tr = $('<tr id="barcode_level_' + level + '"></tr>');
////    var td1 = $('<td class="text-center"><input type="hidden" name="barcode[' + level + '][product_barcode_id]" value="' + product_barcode_id + '">' + (level + 1) + '</td>');
////    var td2 = $('<td><input type="text" name="barcode[' + level + '][barcode_no]" value="' + barcode_no + '" class="form-control"></td>');
////    var td3 = $('<td><input type="text" name="barcode[' + level + '][comment]" value="' + comment + '" class="form-control"></td>');
////    var td4 = $('<td class="text-center"><button onclick="remove_product_barcode(' + level + ')" data-toggle="tooltip" title="remove" class="btn btn-danger" type="button" ><i class="fa fa-minus-circle"></i></button></td>');
////
////    tr.append(td1);
////    tr.append(td2);
////    tr.append(td3);
////    tr.append(td4);
////
////    
//}
//
//function remove_product_barcode(level_barcode) {
//    $("#barcode_level_" + level_barcode).remove();
//    $("#tbl_detail_barcode > tr").each(function(index) {
//        $(this).find('td').eq(0).text(index + 1);
//    });
//}
//
///* end product barcode */
//
//
//
//function clear_product_prefer() {
//    //$("#input_warehouse > option:not(option:eq(0))").remove();
//    $("#input_zone > option:not(option:eq(0))").remove();
//    $("#input_location > option:not(option:eq(0))").remove();
//}
//
//function clear_product_barcode(){
//    $("#input_barcode_level").val('');
//    $("#input_barcode_no").val('');
//    $("#input_barcode_comment").val('');
//}
//
//
//$(window).load(function() {
//    get_product();
//});
//
//function get_product() {
//    var product_id = $('#input_product_id').val();
//
//    if(product_id == '') {
//        return;
//    }
//
//    $.ajax({
//        type: 'get',
//        url: $('#base_url').val() + '/catalog/part/product/getFormProduct/' + product_id,
//        dataType: 'json',
//        success: function(data) {
//            //console.log(data);
//            $('#input_model').val(data.model);
//            $('#input_name').val(data.name);
//            $('#input_description').val(data.description);
//            $('#input_unit_cost').val(data.unit_cost);
//            $('#input_unit_price').val(data.unit_price);
//            $('#input_sku').val(data.sku);
//            $('#input_upc').val(data.upc);
//            //ASSEMBLY
//            $('input[value=\'' + data.class + '\']').prop('checked', true);
//            //ALERT STOCK
//            $('#input_minimum').val(data.minimum_stock);
//            $('#input_maximum').val(data.maximum_stock);
//            // IMAGE
//            var img = $('<img src=' + data.image_small + '>');
//            $('#get_image_small').append(img);
//            // STOCK CONTROL WEIGHT
//            if(data.control_weight == 'Y'){
//                $("#control_weight").prop('checked', true);
//            }else{
//                $("#control_weight").prop('checked', false);
//            }
//            // STOCK CONTROL DIMENSION
//            if(data.control_dimension == 'Y'){
//                $("#control_dimension").prop('checked', true);
//            }else{
//                $("#control_dimension").prop('checked', false);
//            }
//
//            var product_unit_id = 0;
//            var qty = 0;
//            var unit = '';
//            var width = 0;
//            var length = 0;
//            var height = 0;
//            var weight = 0;
//
//            for(var index in data.unit) {
//                if(index == 0) {
//                    //package = 'PALLET';
//                    product_unit_id = data.unit[index].product_unit_id;
//                    qty = data.unit[index].qty;
//                    unit = data.unit[index].unit;
//                    width = data.unit[index].width;
//                    length = data.unit[index].length;
//                    height = data.unit[index].height;
//                    weight = data.unit[index].weight;
//
//                    //package
//                    $("#tbl_detail_unit tr:eq(0) td:eq(0) input").val(product_unit_id);
//                    $("#tbl_detail_unit tr:eq(0) td:eq(2) input").val(qty); // unit level is 1 access input at value
//                    $("#select_unit_1").val(unit);
//                    $("#tbl_detail_unit tr:eq(0) td:eq(4) input").val(width);
//                    $("#tbl_detail_unit tr:eq(0) td:eq(5) input").val(length);
//                    $("#tbl_detail_unit tr:eq(0) td:eq(6) input").val(height);
//                    $("#tbl_detail_unit tr:eq(0) td:eq(7) input").val(weight);
//
//                } else {
//                    product_unit_id = data.unit[index].product_unit_id;
//                    qty = data.unit[index].qty;
//                    width = data.unit[index].width;
//                    length = data.unit[index].length;
//                    height = data.unit[index].height;
//                    weight = data.unit[index].weight;
//                    generate_product_unit(product_unit_id, qty, width, length, height, weight);
//                }
//
//            }
//
////            var product_barcode_id = 0;
////            var barcode_no = '';
////            var comment = '';
//            var value_barcode = {};
//            for(var index in data.barcode) {
//                value_barcode.product_barcode_id = data.barcode[index].product_barcode_id;
//                value_barcode.barcode_no = data.barcode[index].barcode_no;
//                value_barcode.comment = data.barcode[index].comment;
//                generate_product_barcode(value_barcode);
//            }
//
//            var value_prefer = {};
//            for(var index in data.prefer) {
//                value_prefer.product_prefer_id = data.prefer[index].product_prefer_id;
//                value_prefer.warehouse_id = data.prefer[index].warehouse_id;
//                value_prefer.zone_id = data.prefer[index].zone_id;
//                value_prefer.location_id = data.prefer[index].location_id;
//                value_prefer.warehouse = data.prefer[index].warehouse;
//                value_prefer.zone = data.prefer[index].zone;
//                value_prefer.location = data.prefer[index].location;
//                value_prefer.sequence = data.prefer[index].sequence;
//
//                generate_product_prefer(value_prefer);
//            }
//        }
//    });
//}
