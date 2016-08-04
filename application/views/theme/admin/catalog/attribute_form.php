<div class="content">
    <!-- Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_panel_title; ?></h3>
        </div>
        <!-- Panel Body -->
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Attribute Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="input_name" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Value List</label>
                <div class="col-sm-10">
                    <div class="table-responsive">
                        <table id="tbl_master_value" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-center" width="10%">#</td>
                                    <td class="text-left" width="80%">VALUE</td>
                                    <td class="text-left" width="10%">OPTION</td>
                                </tr>
                            </thead>
                            <tbody id="tbl_value_list">

                            </tbody>
                        </table>
                        <div id="notify_attribute_value"></div>
                        <div class="well">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Value</label>
                                <div class="col-sm-9">
                                    <input type="text" id="input_attribute_value" class="form-control" />
                                </div>
                                <button type="button" class="btn btn-default" id="btn_attribute">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hidden -->

            <!-- #Hidden -->
        </div>
        <!-- #Panel Body -->
    </div>
    <!-- #Panel -->
</div>