$(document).ready(function() {
    get_list_attribute();
});

function get_list_attribute() {
    
      $('#tbl_master_attribute').dynatable({
                dataset: {
                    ajax: true,
                    ajaxMethod: 'POST',
                    ajaxUrl: base_url + '/admin/catalog/attribute/getListRecord',
                    ajaxOnLoad: true,
                    records: []
                }
            });
}


// delete
$("#btn_delete").on("click", function(event) {
//    event.preventDefault();
//    var selected = $("#tbl_master_attribute").find("[name]:checked").length;
//    delete_selector(this, selected);
});
      