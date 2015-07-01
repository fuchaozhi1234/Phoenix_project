<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php
                if($this->request->get['action'] == "insert") {
                    echo "New product";
                }
                else {
                    echo "Update product";
                }
                ?>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Product details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <?php foreach($this->data['form'] as $value) : ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $value['name']; ?></label>
                                    <div class="col-sm-10">
                                        <?php echo html_form_element($value); ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Save</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-6">
            <?php if(isset($this->request->get['product_id'])) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    New attribute
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="index.php?model=product&action=add_attribute&product_id=<?php echo $this->request->get['product_id']; ?>">
                                <div class="form-group">
                                    <label>Attribute</label>
                                    <input name="attribute" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Value</label>
                                    <input name="value" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="<?php echo $this->request->get['product_id']; ?>">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(isset($this->request->get['product_id'])) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    New stock
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="index.php?model=product&action=add_stock&product_id=<?php echo $this->request->get['product_id']; ?>">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select class="form-control" name="supplier_id">
                                        <?php echo html_dropdown_option($this->data['supplier'], 0); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>MPN</label>
                                    <input name="mpn" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input name="sku" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Cost price</label>
                                    <input name="cost" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Availability</label>
                                    <input name="availability" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>ETA</label>
                                    <input name="eta" type="date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="<?php echo $this->request->get['product_id']; ?>">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    New product image
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="index.php?model=product&action=add_image&product_id=<?php echo $this->request->get['product_id']; ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Select file</label>
                                    <input name="image" type="file" class="form-control"  accept="image/*" />
                                </div>
                                <div class="form-group">
                                    <label>Thumb</label>
                                    <select name="thumb" class="form-control">
                                        <option value="0" selected>False</option>
                                        <option value="1">True</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="<?php echo $this->request->get['product_id']; ?>">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Attributes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Attribute</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($this->data['attribute'] as $value) {
                                    $id = $value['product_attribute_id'];
                                    echo "<tr>";
                                    echo "<td>" . $value['attribute'] . "</td>";
                                    echo "<td>" . $value['value'] . "</td>";
                                    echo "<td><a href=\"index.php?model=product&action=delete_attribute&product_attribute_id=$id\"" . html_confirm_delete() . ">Delete</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Product stock list
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Supplier</th>
                                    <th>MPN</th>
                                    <th>Price</th>
                                    <th>Availability</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($this->data['stock'] as $value) {
                                    $id = $value['product_stock_id'];
                                    echo "<tr>";
                                    echo "<td>" . $value['supplier_name'] . "</td>";
                                    echo "<td>" . $value['mpn'] . "</td>";
                                    echo "<td>" . $value['cost'] . "</td>";
                                    echo "<td>" . $value['availability'] . "</td>";
                                    echo "<td><a href=\"index.php?model=product&action=delete_stock&product_stock_id=$id\"" . html_confirm_delete() . ">Delete</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>