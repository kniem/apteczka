<!DOCTYPE html>
<html lang=<?php echo "$lang";?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $aplikacja;?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap-social.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
	<link href="css/mystyles.css" rel="stylesheet">
  </head>

  <body role="document">
	<div id="wrapper">
    <div id="header">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--<a class="navbar-brand" href="index.php?wybrano=0"><i class="fa fa-medkit"></i></a>-->
        </div>
        <?php require_once "inc/menu.php";?>
      </div>
    </nav>
	
  <div class="jumbotron">
    <h1><?php echo $tytul;?></h1>
    <h5><?php echo $podtytul;?></h5>
  </div>
  </div>