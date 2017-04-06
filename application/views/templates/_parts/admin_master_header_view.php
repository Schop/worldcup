<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $page_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo site_url('assets/admin/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.13/r-2.1.1/datatables.min.css"/>
    <link href="<?php echo site_url('assets/admin/css/styles.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/admin/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/admin/css/bootstrap-datepicker3.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/admin/css/jquery.timepicker.css'); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu|Roboto" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="header">
       <div class="container">
          <div class="row">
             <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                   <h1><a href="index.html"><?php echo $this->config->item('pool_title');?> - Admin</a></h1>
                </div>
             </div>
             <div class="col-md-7">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                      <ul class="nav navbar-nav">
                        <?php $url = urlencode(current_url());?>
                        <li><a href="<?php echo base_url('langswitch/switchLanguage/english').'?url='.$url;?>"><img src="<?php echo base_url();?>assets/flags/24/GB.png"/></a></li>
                        <li><a href="<?php echo base_url('langswitch/switchLanguage/dutch').'?url='.$url;?>"><img src="
                        <?php echo base_url();?>assets/flags/24/NL.png"/></a></li>                      
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp;<b class="caret"></b></a>
                          <ul class="dropdown-menu animated fadeIn">


                            <?php $url = urlencode(current_url());?>
                            <li><a href="<?php echo base_url('langswitch/switchLanguage/english').'?url='.$url;?>">English</a></li>
                            <li><a href="<?php echo base_url('langswitch/switchLanguage/dutch').'?url='.$url;?>">Nederlands</a></li>


                            <li><a href="profile.html"><?php echo lang('profile');?></a></li>
                            <li><a href="<?php echo site_url('admin/user/logout'); ?>"><?php echo lang('logout');?></a></li>
                          </ul>
                        </li>
                      </ul>
                    </nav>
                </div>
             </div>
          </div>
       </div>
    </div>