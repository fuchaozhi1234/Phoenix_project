<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php
                if($this->request->get['action'] == "insert") {
                    echo "New user";
                }
                else {
                    echo "Update user";
                }
                ?>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User details
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
    </div>
    <!-- /.row -->
</div>