<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <a href="index.php?model=user&action=insert">
                <button type="submit" class="btn btn-default">New User</button>
            </a>
        </div>
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
    </div>
    <!-- /.row -->
    <div class="row"><br></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User list
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Create date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($this->data['list'] as $value) {
                                    $id = $value['user_id'];

                                    echo "<tr>";
                                    echo "<td><a href=\"index.php?model=user&action=update&user_id=$id\">" . $id . "</a></td>";
                                    echo "<td>" . $value['email'] . "</td>";
                                    echo "<td>" . $value['first_name'] . " " . $value['last_name'] . "</td>";
                                    echo "<td>" . $value['create_date'] . "</td>";
                                    echo "<td><a href=\"index.php?model=user&action=delete&user_id=$id\"" . html_confirm_delete() . ">Delete</a></td>";
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