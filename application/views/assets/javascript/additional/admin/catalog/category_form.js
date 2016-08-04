
$(document).ready(function() {
    init_system();
});

function init_system() {
    $.ajax({
       type: 'POST',
       url: base_url + '/admin/catalog/category/getCategory',
       data: {data: 1},
       dataType: 'JSON',
       success: function(response){
          // for
           
           $(".tree").find('a').after(response);
           
           
           console.log(response);
       }
    });
    
}

// save
$("#btn_save,#btn_save_stay").on("click", function(event) {
    event.preventDefault();
    //var status_required = check_required();
    //var count_detail = check_detail("tbl_detail_detail");

    //if(status_required == 1) {
        prototype_save(this);
    //}
});





// <ul>
//                                            <li>	
//                                                <a href="javascript:;">Child</a>
//                                                <ul>
//                                                    <li>	
//                                                        <a href="javascript:;">Grand Child</a>
//                                                    </li>
//                                                </ul>
//                                            </li>
//                                            <li>	
//                                                <a href="javascript:;">Child</a>
//                                                <ul>
//                                                    <li><input type='checkbox'><a href="#">Grand Child</a>
//                                                    </li>
//                                                    <li>	<a href="javascript:;">Grand Child</a>
//
//                                                        <ul>
//                                                            <li>	<a href="javascript:;">Great Grand Child</a>
//
//                                                            </li>
//                                                            <li>	<a href="javascript:;">Great Grand Child</a>
//
//                                                            </li>
//                                                            <li>	<a href="javascript:;">Great Grand Child</a>
//
//                                                            </li>
//                                                        </ul>
//                                                    </li>
//                                                    <li><a href="javascript:;">Grand Child</a>
//                                                    </li>
//                                                </ul>
//                                            </li>
//                                        </ul>-->