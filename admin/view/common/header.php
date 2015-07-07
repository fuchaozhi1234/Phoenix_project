<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phoenix <?php echo VERSION; ?></title>

    <link href="<?php echo ADMIN_TEMPLATE_CSS_PATH; ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_TEMPLATE_CSS_PATH; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo ADMIN_TEMPLATE_CSS_PATH; ?>base.css" rel="stylesheet">

    <script src="<?php echo ADMIN_TEMPLATE_JS_PATH; ?>jquery-1.10.2.js"></script>
    <script src="<?php echo ADMIN_TEMPLATE_JS_PATH; ?>bootstrap.min.js"></script>
    <script src="<?php echo ADMIN_TEMPLATE_JS_PATH; ?>jquery.metisMenu.js"></script>
    <script src="<?php echo ADMIN_TEMPLATE_JS_PATH; ?>base.js"></script>
    <script src="<?php echo ADMIN_TEMPLATE_PATH; ?>ckeditor/ckeditor.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Phoenix <?php echo VERSION; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a href="index.php"><i class="fa fa-home fa-fw"></i> 主页</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bar-chart-o fa-fw"></i> 运单 <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?model=waybill">运单管理</a>
                        </li>
                        <li>
                            <a href="index.php?model=uploads">上传管理</a>
                        </li>
                        <li>
                            <a href="index.php?model=import">导入运单</a>
                        </li>
                        <li>
                            <a href="index.php?model=export">导出运单</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li class="dropdown">
                    <a href="index.php?model=waybill&action=insert"><i class="fa fa-plus"></i> 添加运单</a>
                </li>
                <li class="dropdown">
                    <a href="index.php?model=login&action=logout"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
