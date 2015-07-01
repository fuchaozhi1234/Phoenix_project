<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">运单</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <a href="index.php?model=waybill&action=insert">
                <button type="submit" class="btn btn-default">新运单</button>
            </a>
        </div>
		<!--
        <div class="col-lg-6">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </div>
		-->
    </div>
    <!-- /.row -->
    <div class="row"><br></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>运单号</th>
                                    <th>发件人</th>
                                    <th>收件人</th>
                                    <th>编辑</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($this->data['list'] as $value) : ?>
                                    <tr>
										<td><a href="index.php?model=waybill&action=update&id=<?php echo $value['id'] ?>"><?php echo $value['tracking_number'] ?></a></td>
										<td><?php echo $value['sender_name'] ?></td>
										<td><?php echo $value['receiver_name'] ?></td>
										<td><a href="index.php?model=waybill&action=delete&id=<?php echo $value['id'] ?>" <?php echo html_confirm_delete() ?>>删除</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <p><?php html_page_nav($this->data['page']); ?></p>
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