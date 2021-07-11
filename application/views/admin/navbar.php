<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="2-columns">
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="">
              <img class="brand-logo" alt="modern admin logo" src="https://img-premium.flaticon.com/png/512/3097/premium/3097756.png?token=exp=1626013626~hmac=ee03beb74dcc4ac1f5ee29a86c0a4fe7">
              <h3 class="brand-text">Admin</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
            
            <!-- Array
(
    [__ci_last_regenerate] => 1626016106
    [v1-sunday_mobility] => Array
        ( -->
            
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700"><?php echo $_SESSION['v1-sunday_mobility']['username'] ; ?></span>
                </span>
                <span class="avatar avatar-online">
                  <img src="https://img-premium.flaticon.com/png/512/3097/premium/3097756.png?token=exp=1626013626~hmac=ee03beb74dcc4ac1f5ee29a86c0a4fe7" alt="avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                
                <a class="dropdown-item" href="<?php echo base_url() ?>admin/dashboard/logout"><i class="ft-power"></i> Logout</a>
              </div>
            </li>
            
           
            
          </ul>
        </div>
      </div>
    </div>
  </nav>


  <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item">
          <a href="<?php echo base_url('admin/dashboard') ?>">
            <i class="la la-home"></i>
            <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
          
        </li>
       
        <li class=" nav-item">
          <a href="<?php echo base_url('admin/users_lists') ?>">
            <i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Users Lists</span></a>
          
          </li>
 
       
        
      </ul>
    </div>
  </div>