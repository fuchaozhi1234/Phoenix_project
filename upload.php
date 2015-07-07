<?php
require_once('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['id'])
		&& isset($_POST['tracking_number']) && !empty($_POST['tracking_number'])
		&& isset($_POST['name']) && !empty($_POST['name'])
		&& !empty($_FILES["id_front"]["name"])
		&& !empty($_FILES["id_back"]["name"])
		) {
		$tracking_number = $_POST['tracking_number'];
		$id = $_POST['id'];
		$name = $_POST['name'];

		$file_type_front = pathinfo($_FILES["id_front"]["name"], PATHINFO_EXTENSION);
		$file_type_back = pathinfo($_FILES["id_back"]["name"], PATHINFO_EXTENSION);
		$file_path_front = "uploads/id/" . $id . "_front.$file_type_front";
		$file_path_back = "uploads/id/" . $id . "_back.$file_type_back";

		if (move_uploaded_file($_FILES["id_front"]["tmp_name"], $file_path_front)) {
			$error = "The file ". basename( $_FILES["id_front"]["name"]). " has been uploaded.";
		} else {
			$error = "Sorry, there was an error uploading your file.";
		}

		if (move_uploaded_file($_FILES["id_back"]["tmp_name"], $file_path_back)) {
			$error = "The file ". basename( $_FILES["id_front"]["name"]). " has been uploaded.";
		} else {
			$error = "Sorry, there was an error uploading your file.";
		}

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$conn->set_charset("utf8");

		$sql = "SELECT `id` FROM `uploads` WHERE `identity`=$id";
		
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$sql = "UPDATE uploads SET frontside_photo='$file_path_front',backside_photo='$file_path_back' WHERE `identity`=$id";
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO uploads (`identity`,`tracking_number`,`name`,`frontside_photo`,`backside_photo`) VALUES ('$id','$tracking_number','$name','$file_path_front','$file_path_back')";
			$conn->query($sql);
		}
		
		$message = "上传成功。";

		$conn->close();
	} else {
		$message = "上传失败。";
	}
}
?>
<!--DOCTYPE html -->
<html><head>
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
		padding-top: 20px;
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
	
	<div class="container">
		<div class="row">
        <div class="col-md-8">
            <div class="myborder">
                <!-- Upload Photos -->
                <hr>
                <h1>上传身份证</h1>
                <p>请正确填写运单号与身份证号.</p>
				<p style="color:red"><?php echo $message; ?></p>
                <form id="upload-form" action="upload.php" method="post" enctype="multipart/form-data">
                    <p>
                        <strong>运单号: </strong> 
                        <input type="text" class="form-control" name="tracking_number" placeholder="Enter tracking number">
                        <input type="hidden" name="sender_id">
                    </p>
                    <p>
                        <strong>收件人姓名: </strong> 
                        <input type="text" class="form-control" name="name" placeholder="Enter name">
                        <input type="hidden" name="sender_id">
                    </p>
                    <p>
                        <strong>收件人身份证号: </strong> 
                        <input type="text" class="form-control" name="id" placeholder="Enter identity number">
                    </p>

                    <hr>

                    <!-- PHOTO UPLOADER -->
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <strong id="label-photo-type">身份证正面: </strong>
                        <div class="input-append">
                            <input type="file" class="form-control" name="id_front">
                        </div>
                    </div>

                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <strong id="label-photo-type">身份证背面: </strong>
                        <div class="input-append">
                            <input type="file" class="form-control" name="id_back">
                        </div>
                    </div>
					<hr>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <button type="submit"  class="btn"><span>确定</span></button>
                    </div>
					<!-- END OF PHOTO UPLOADER -->
                    <hr>
                </form>
            </div>

        </div> <!-- END OF CONTENT -->

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