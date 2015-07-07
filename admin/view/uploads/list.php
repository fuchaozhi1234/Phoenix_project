<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">上传列表</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
            <div class="input-group custom-search-form">
                <input type="hidden" name="model" value="uploads">
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
    <div class="row"><br></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>运单号</th>
                                    <th>姓名</th>
                                    <th>身份证号</th>
                                    <th>正面</th>
                                    <th>背面</th>
                                    <th>编辑</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($this->data['list'] as $value) {
                                    echo "<tr>";
                                    echo "<td>{$value['tracking_number']}</td>";
                                    echo "<td>{$value['name']}</td>";
                                    echo "<td>{$value['identity']}</td>";
                                    echo "<td><a href=\"../{$value['frontside_photo']}\" target=\"_blank\">{$value['frontside_photo']}</a></td>";
                                    echo "<td><a href=\"../{$value['backside_photo']}\" target=\"_blank\">{$value['backside_photo']}</a></td>";
                                    echo "<td><a href=\"index.php?model=uploads&action=delete&id={$value['id']}\"" . html_confirm_delete() . ">删除</a></td>";
                                    echo "</tr>";
                                }
                                ?>
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