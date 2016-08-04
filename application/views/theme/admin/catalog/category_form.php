<div class="content">
    <!-- Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_panel_title; ?></h3>
        </div>
        <!-- Panel Body -->
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">category Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="input_name" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Hierarchy</label>
                <div class="col-sm-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">Category</div>
                        <div class="panel-body">
                            <!-- We will create a family tree using just CSS(3) The markup will be simple nested lists -->
                            <div class="tree">
                                <ul>
                                    <li>	
                                        <a href="javascript:;">Home</a>
                                    </li>
                                </ul>
                            </div><!-- #tree -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Active</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="active" id="input_active" checked />
                </div>
            </div>
            <!-- Hidden -->
            <!-- #Hidden -->
        </div>
        <!-- #Panel Body -->
    </div>
    <!-- #Panel -->
</div>