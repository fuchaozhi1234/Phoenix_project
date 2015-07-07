<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                导入运单
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    运单
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>&action=upload">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文件</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="csv" class="form-control" />
                                    </div>
                                </div>
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
            <?php if(isset($this->request->get['id'])) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    添加运单记录
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="index.php?model=waybill&action=log&waybill_id=<?php echo $this->request->get['id']; ?>">
                                <div class="form-group">
                                    <label>内容</label>
                                    <input name="content" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="waybill_id" value="<?php echo $this->request->get['id']; ?>">
                                    <button type="submit" class="btn btn-default">保存</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(isset($this->request->get['id'])) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    运单记录
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>时间</th>
                                    <th>内容</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($this->data['log'] as $value) : ?>
                                    <tr>
										<td><?php echo $value['time'] ?></td>
										<td><?php echo $value['content'] ?></td>
										<td><a href="index.php?model=waybill&action=delete_log&log_id=<?php echo $value['id'] ?>" <?php echo html_confirm_delete() ?>>删除</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <?php endif; ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>