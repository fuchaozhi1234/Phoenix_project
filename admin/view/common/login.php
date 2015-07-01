<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phoenix <?php echo VERSION; ?></title>

    <link href="<?php echo ADMIN_TEMPLATE_CSS_PATH; ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_TEMPLATE_CSS_PATH; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo ADMIN_TEMPLATE_CSS_PATH; ?>sb-admin.css" rel="stylesheet">

    <script src="<?php echo ADMIN_TEMPLATE_JS_PATH; ?>jquery-1.10.2.js"></script>
    <script src="<?php echo ADMIN_TEMPLATE_JS_PATH; ?>bootstrap.min.js"></script>
    <script src="<?php echo ADMIN_TEMPLATE_JS_PATH; ?>jquery.metisMenu.js"></script>
    <script src="<?php echo ADMIN_TEMPLATE_JS_PATH; ?>sb-admin.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">请登录</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="index.php?model=login&action=login" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">登陆</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
