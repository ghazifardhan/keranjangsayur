<?php 
    session_start(); 
    error_reporting(0);	
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        
        <title>Keranjang Sayur</title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<!-- custom CSS -->
        <link href="/keranjangsayur/libs/css/keranjangsayur.css" rel="stylesheet" />        
        <link rel="shortcut icon" href="/keranjangsayur/images/favicon.ico" type="image/x-icon">
        <link href="/keranjangsayur/libs/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" media="screen" />
        <link href="/keranjangsayur/libs/js/bootstrap/dist/css/bootstrap-chosen.css" rel="stylesheet" />
        <style>
            .navbar-inverse {
                background-color: #88AC25;
                border-color: #88AC25;
            }
        </style>
        
    </head>

<body>
    
    <?php
    if($_SESSION['user'] == NULL)
    {
    ?>
    <div class="container">
        <br/>
        <br/>
    <div class='jumbotron'>
		<h1>You must Login first!!</h1>
    </div>
    </div>
    
   <?php
    } else {
   ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div id="page-title" class="display-none"></div>
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/keranjangsayur/views/app.php"><img src="../images/logoks4.png" width="75%" heigh="75%" style="margin-top: -8px;"/></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!-- dropdown navbar create -->
                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Create <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href='javascript://' id="create_category">Create Category</a></li>
                            <li><a href='javascript://' id="create_item">Create Item</a></li>
                            <li><a href='javascript://' id="create_unit">Create Unit</a></li>
                            <li><a href='javascript://' id="create_highlight">Create Highlight</a></li>
                        </ul>
                    </li>
                    
                    <!-- dropdown navbar show -->
                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Show <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript://" id="show_category">Show Category</a></li>
                            <li><a href="javascript://" id="show_item">Show Item</a></li>
                            <li><a href="javascript://" id="show_unit">Show Unit</a></li>
                            <li><a href="javascript://" id="show_highlight">Show Highlight</a></li>
                        </ul>
                    </li>
                    
                    <!-- dropdown navbar transaction -->
                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Transaction <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript://" id="create_invoice">New Invoice</a></li>
							<li><a href="javascript://" id="show_invoice">Show Invoice</a></li>
							<li><a href="javascript://" id="detail_packing">Shipping Invoice</a></li>
							<li><a href="javascript://" id="detail_packing_pisah">Detail Packing Pisah</a></li>
							<li><a href="javascript://" id="export_invoice">Export Invoice</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- dropdown navbar login -->
                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Logged as <?php echo $_SESSION['user']; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="<?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){echo 'disabled';}?>"><a href="javascript://" id="show-user" class="<?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){echo 'not-active';}?>">User Control</a></li>
							<li role="separator" class="divider"></li>
                            <li><a href="/keranjangsayur/views/logout.php" id="logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <br/><br/><br/>
        <div id='page-content'></div>
        <div id='loader-image'><img src='../images/ajax-loader.gif' /></div>
    </div>
    <br/>
    <br/>
    <!--<div id="footer">Keranjang Sayur &copy; 2016</div>-->
    <?php
    }
    ?>

<!-- jQuery library -->
<script src="/keranjangsayur/libs/js/jquery.js"></script>
<script src="/keranjangsayur/libs/js/chosen/chosen.jquery.js"></script>
<script src="/keranjangsayur/libs/js/chosen/chosen.jquery.min.js"></script>
 
<!-- bootstrap JavaScript -->
<script src="/keranjangsayur/libs/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/keranjangsayur/libs/js/script.js"></script>
</body>
</html>