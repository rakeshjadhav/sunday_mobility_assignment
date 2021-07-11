
  
  <body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu" data-col="1-column">
  
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">
                      <img src="https://img-premium.flaticon.com/png/512/3097/premium/3097756.png?token=exp=1626013626~hmac=ee03beb74dcc4ac1f5ee29a86c0a4fe7" alt="branding logo" style="width:80px">
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Admin Login </span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                
			<?php if( !empty($error_msg) || !empty(validation_errors()) ) : ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?php echo validation_errors(); ?>
				<?php echo (!empty($error_msg)) ? '<p>' . $error_msg . '</p>' : '' ?>
			</div>
			<?php endif; ?>
		
                    <?php echo form_open('admin/login/submit',array('class'=>'form-login')); ?>
                    <!-- <form class="" action="" > -->
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        
                      <input type="text" name="username" class="form-control" placeholder="Username" autofocus value="<?php echo set_value('username') ?>" autocomplete="off"/>
                        
                      </fieldset>
                      <br>
                      <fieldset class="form-group position-relative has-icon-left">
                      <input name="password" type="password" class="form-control" placeholder="Password" autocomplete="off"/>
                        
                      </fieldset>
                      <input class="btn btn-info btn-lg btn-block" type="submit" name="loginSubmit" value="Login" style="font-style: normal;">
                     
                    </form>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  