<div class="content">
    <!-- Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_panel_title; ?></h3>
        </div>
        <!-- Panel Body -->
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_information" data-toggle="tab">Information</a></li>
                <li><a href="#tab_category" data-toggle="tab">Category</a></li>
                <li><a href="#tab_combination" data-toggle="tab">Combination</a></li>
                <li><a href="#tab_dimension" data-toggle="tab">Dimension</a></li>
                <li><a href="#tab_image" data-toggle="tab">Image</a></li>
            </ul>
            <div class="tab-content" id="tab-wrapper">
                <!-- tab information -->
                <div class="tab-pane active" id="tab_information">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reference</label>
                        <div class="col-sm-10">
                            <input type="text" name="reference" id="input_reference" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="input_name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="input_description" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label">EAN13</label>
                        <div class="col-sm-10">
                            <input type="text" name="ean13" id="input_ean13" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label">UPC</label>
                        <div class="col-sm-10">
                            <input type="text" name="upc" id="input_upc" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label">Condition</label>
                        <div class="col-sm-10">
                            <select name="condition" id="condition" class="form-control">
                                <option value="new" selected="selected">New</option>
                                <option value="used">Used</option>
                                <option value="refurbished">Refurbished</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label">Wholesale Price</label>
                        <div class="col-sm-10">
                            <input type="text" name="wholesale_price" id="input_wholesale_price" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Retail Price</label>
                        <div class="col-sm-10">
                            <input type="text" name="price" id="input_price" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-10">
                            <div class="well">
                                s
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #tab information -->
                <!-- tab category -->
                <div class="tab-pane" id="tab_category">
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

                </div>
                <!-- #tab category -->
                <!-- tab combination -->
                <div class="tab-pane" id="tab_combination">
                    <div class="table-responsive">
                        <table id="tbl_master_combination" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-left" width="5%">LEVEL</td>
                                    <td class="text-right" width="15%">Attribute - Value</td>
                                    <td class="text-right" width="15%">Reference</td>
                                    <td class="text-left" width="15%">EAN13</td>
                                    <td class="text-left" width="10%">UPC</td>
                                    <td class="text-left" width="10%">RETAIL PRICE</td>
                                    <td class="text-left" width="10%">OPTION</td>
                                </tr>
                            </thead>
                            <tbody id="tbl_detail_combination">

                            </tbody>
                        </table>
                    </div>
                    <div class="well">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Attribute</label>
                            <div class="col-sm-4">
                                <select name="attribute_group" id="attribute_group" class="form-control" onchange="populate_attrs();">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Attribute</label>
                            <div class="col-sm-4">
                                <select name="attribute" id="attribute" class="form-control">
                                    <option value="0">---</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <div class="well">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reference</label>
                        <div class="col-sm-4">
                            <input type="text" id="input_barcode_level" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">EAN13</label>
                        <div class="col-sm-4">
                            <input type="text" id="input_barcode_level" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">UPC</label>
                        <div class="col-sm-4">
                            <input type="text" id="input_barcode_level" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Default Image</label>
                        <div class="col-sm-4">
                            <input type="text" id="input_barcode_level" class="form-control" />
                        </div>
                    </div>
                </div>
                <!-- #tab combination -->
                <!-- tab dimension -->
                <div class="tab-pane" id="tab_dimension">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Package width</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_width" id="input_product_width" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label">Package height</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_height" id="input_product_height" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Package depth</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_depth" id="input_product_depth" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label">Package weight</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_weight" id="input_product_weight" class="form-control" />
                        </div>
                    </div>
                </div>
                <!-- #tab dimension -->
                <!-- tab image -->
                <div class="tab-pane" id="tab_image">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                            <div id="get_image_small"> </div>
                        </div>
                        <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="userfile">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                </div>
                <!-- #tab image -->
            </div>
            <!-- Hidden -->
            <input type="hidden" name="product_id" id="input_product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>">
            <!-- #Hidden -->
        </div>
        <!-- #Panel Body -->
    </div>
    <!-- #Panel -->
</div>