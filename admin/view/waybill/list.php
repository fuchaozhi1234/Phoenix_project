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
        <div class="col-lg-6">
			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
            <div class="input-group custom-search-form">
                <input type="hidden" name="model" value="waybill">
                <input type="text" class="form-control" name="keyword" placeholder="Search...">
                <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="fa fa-search"></i>
                </button>
                </span>
            </div>
			</form>
        </div>
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
						<form action="" method="post" id="main-form">
                        <p><?php html_page_nav($this->data['page']); ?></p>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th style="width: 30px;"></th>
                                    <th>运单号</th>
                                    <th>发件人</th>
                                    <th>收件人</th>
                                    <th>已上传身份证</th>
                                    <th>身份证号</th>
                                    <th>状态</th>
                                    <th>编辑</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($this->data['list'] as $value) : ?>
                                    <tr>
										<td><input type="checkbox" class="waybill-checkbox" name="select[]" value="<?php echo $value['id'] ?>"></td>
										<td><a href="index.php?model=waybill&action=update&id=<?php echo $value['id'] ?>"><?php echo $value['tracking_number'] ?></a></td>
										<td><?php echo $value['sender_name'] ?></td>
										<td><?php echo $value['receiver_name'] ?></td>
										<td><?php echo ($value['uploaded'])?'已上传':'未上传' ?></td>
										<td><?php echo $value['identity'] ?></td>
										<td><?php echo $value['status'] ?></td>
										<td><a href="index.php?model=waybill&action=delete&id=<?php echo $value['id'] ?>" <?php echo html_confirm_delete() ?>>删除</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
						<p>
							<button class="btn btn-default" id="select-all" onclick="return false;">全选</button>
							<button class="btn btn-default" id="batch-delete">删除</button>
							<button class="btn btn-default" id="batch-log-a">已入凤凰仓库</button>
							<button class="btn btn-default" id="batch-log-b">航班已起飞</button>
							<button class="btn btn-default" id="batch-log-c">航班已到达</button>
							<button class="btn btn-default" id="batch-log-d">等待海关清关</button>
							<button class="btn btn-default" id="batch-log-e">海关已清关</button>
							<button class="btn btn-default" id="batch-log-f">正在派送</button>
							<button class="btn btn-default" id="batch-log-g">收货人签收</button>
						</p>
						<script>
						$(document).ready(function() {
							$('#select-all').click(function(event) {
								$('.waybill-checkbox').each(function() {
									this.checked = true;
								});
							});
							$('#batch-delete').click(function(event) {
								$('#main-form').attr("action", "index.php?model=waybill&action=batch_delete");
								$('#main-form').submit();
							});
							$('#batch-log-a').click(function(event) {
								$('#main-form').attr("action", "index.php?model=waybill&action=batch_log_a");
								$('#main-form').submit();
							});
							$('#batch-log-b').click(function(event) {
								$('#main-form').attr("action", "index.php?model=waybill&action=batch_log_b");
								$('#main-form').submit();
							});
							$('#batch-log-c').click(function(event) {
								$('#main-form').attr("action", "index.php?model=waybill&action=batch_log_d");
								$('#main-form').submit();
							});
							$('#batch-log-d').click(function(event) {
								$('#main-form').attr("action", "index.php?model=waybill&action=batch_log_d");
								$('#main-form').submit();
							});
							$('#batch-log-e').click(function(event) {
								$('#main-form').attr("action", "index.php?model=waybill&action=batch_log_e");
								$('#main-form').submit();
							});
							$('#batch-log-f').click(function(event) {
								$('#main-form').attr("action", "index.php?model=waybill&action=batch_log_f");
								$('#main-form').submit();
							});
							$('#batch-log-g').click(function(event) {
								$('#main-form').attr("action", "index.php?model=waybill&action=batch_log_g");
								$('#main-form').submit();
							});
						});
						</script>
                        <p><?php html_page_nav($this->data['page']); ?></p>
						</form>
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