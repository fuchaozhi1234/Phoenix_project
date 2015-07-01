<?php
if(isset($_POST['tracking_number'])) {
	$tracking_number = $_POST['tracking_number'];
	$servername = "localhost";
	$username = "phoenix_main";
	$password = "123456!";
	$dbname = "phoenix_main";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$conn->set_charset("utf8");

	$sql = "SELECT * FROM `log` WHERE `tracking_number`='$tracking_number' ORDER BY time ASC";

	$result = $conn->query($sql);

	$logs = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $logs[] = $row;
    }

	$sql = "SELECT `waybill`.*,`courier`.code FROM `waybill` JOIN `courier` ON `courier`.id=`waybill`.courier_id WHERE `tracking_number`='$tracking_number'";

	$result = $conn->query($sql);

    if($row = mysqli_fetch_assoc($result)) {
        $waybill = $row['tracking_number'];
        $code = $row['code'];
    }

	$conn->close();
	
	if(!empty($waybill) && !empty($code)) {
		$content = file_get_contents("http://api.kuaidi100.com/api?id=63a8b4c04d8a9101&com=$code&nu=$waybill&show=2&muti=0&order=desc");
	}
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--pageMeta-->

    <!-- Loading Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-contact.css" rel="stylesheet">
    <link href="css/style-content.css" rel="stylesheet">
    <link href="css/style-footers.css" rel="stylesheet">
    <link href="css/style-headers.css" rel="stylesheet">
    <link href="css/style-cta.css" rel="stylesheet">
    <link href="css/style-main-section.css" rel="stylesheet">
    <link href="css/style-extras.css" rel="stylesheet">
    <link href="css/style-features.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
	<style>
	.jumbotron__control {
		border-radius: 2px;
		position: absolute;
		background-color: rgba(250,250,250,.35);
		color: rgba(0,0,0,.35);
		text-align: center;
		top: 35px;
		width: 40px;
		height: 40px;
		line-height: 40px;
		transition: all 100ms ease-out;
		width: 60px;
		height: 60px;
		top: 60px;
		line-height: 60px;
		font-size: 24px;
	}
	.jumbotron__control.right {
		margin-left: 68px;
	}
	</style>
</head>
<body>
    <!--headerIncludes-->
    
    <div id="page" class="page">
        
    <!-- Navigation --><!-- Navigation --><header id="layout1-header">
        <nav class="navbar main-navigation-header top-nav navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navigation">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
                    <a href="" class="navbar-brand logo"><img src="images/logo.png" alt="eventix event landing page"></a>
                </div><!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="header-navigation">

                    <ul class="nav navbar-nav main-navigation navbar-right">
	                    <li class="hidden"><a href="#page-top"></a></li>
	
	                    <li><a href="index.html">主页</a></li>
	                    <li><a href="index.html#layout4-showcase">关于我们</a></li>
	                    <li><a href="index.html#layout1-extras">货运服务</a></li>
	                    <li><a href="tracking.php">运单查询</a></li>
	                    <li><a href="upload.php">上传证件</a></li>
	                    <li><a href="index.html#layout4-prefooter">联系我们</a></li>
	                    
	                </ul>
	                
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header><!-- Navigation -->
	<div class="carousel  slide  js-jumbotron-slider" id="headerCarousel" data-ride="carousel" data-interval="5000">
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item">
				<img src="images/xslider_1.jpg" width="1920" height="600">
			</div>
			<div class="item">
				<img src="images/xslider_2.jpg" width="1920" height="600">
			</div>
			<div class="item active">
				<img src="images/xslider_3.jpg" width="1920" height="600">
			</div>
		</div>
		<div class="container">
			<!-- Controls -->
			<a class="left  jumbotron__control" href="#headerCarousel" role="button" data-slide="prev">
				<i class="fa  fa-caret-left"></i>
			</a>
			<a class="right  jumbotron__control" href="#headerCarousel" role="button" data-slide="next">
				<i class="fa  fa-caret-right"></i>
			</a>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="myborder">
					<!-- Track your items -->
					<h1>订单信息查询</h1>
					<p>请输入订单号.</p>
					<!-- tracking id submission form -->
					<form id="tracking_form" method="post" action="tracking.php">
						<div class="form-inline">
							<p><strong>订单号: </strong></p>
							<input type="text" class="form-control" name="tracking_number" placeholder="Enter tracking id" id="tracking_number">
							<button type="submit" class="btn btn-danger">追踪</button>
						</div>
					</form>
					<!-- display tracking result -->
					<div id="tracking_summary">
						<h4>结果: </h4>
						<table class="table table-condensed">
							<tbody>
								<tr>
									<th>时间:</th>
									<th>状态:</th>
								</tr>
								<?php foreach($logs as $log) : ?>
								<tr>
									<td id="get_id"><?php echo $log['time'] ?></td>
									<td id="get_status"><?php echo $log['content'] ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?php if(!empty($content)) : ?>
						<div id="waybill-tracking-details">
							<?php echo $content; ?>
						</div>
						<?php endif; ?>
					</div> <!-- end of tracking result  -->
				</div> <!-- end of my border -->
			</div>
		</div>
    </div>
	
	<footer id="layout4-footer">
		<div class="container">
			<div class="row bottom-footer">
			    			
    			<div class="col-sm-6 col-xs-12" style="color: #666666">
	    			<p>Copyright © 2015 Phoenix International Cargo Pty Ltd. All rights are reserved</p>
    			</div>
    			
    		</div>
    		
		</div>
	</footer></div><!-- /#page -->

	<script src="js/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.nav.js"></script>
    <script src="js/jquery.scrollto.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
    <script src="js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script><script src="https://maps.gstatic.com/maps-api-v3/api/js/21/5a/main.js"></script>
    <script src="js/google-maps.js" type="text/javascript"></script>
    
    <script src="js/style-options.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>

</body></html>