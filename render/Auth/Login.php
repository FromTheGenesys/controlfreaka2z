<div class="row justify-content-center mt-3">
    
  <div class="col-lg-6">  
      
      <div class="card p-2 mt-2 opacity-3 bg-dark">

        <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>auth/login">  

          <div class="card-body">

            <div class="text-center">
              <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/brand_logo.png" class="img-fluid w-50">
            </div>

            <?php if ( !isset( $this->setMessage ) ) : ?>

                <div class="alert bg-teal border-teal text-white font-weight-normal mt-3">
                  Welcome to <strong>MVP - CONTROL FREAK</strong>. Please enter your <span class="font-weight-bold">LoginID</span> and <span class="font-weight-bold">Password</span> in the spaces provided below.
                </div>

            <?php else: ?>

                <?php echo $this->setMessage; ?>
                
            <?php endif; ?>

            <div class="mb-3 input-group">
              <input type="text" required autocomplete="off" class="form-control form-control-lg" placeholder="LoginID" autofocus name="LoginID" value="<?php echo $_POST['LoginID'] ?? NULL; ?>" />
            </div>

            <div class="mb-2 input-group">
              <input type="password" required class="form-control form-control-lg" placeholder="Password"  autocomplete="off" name="Password" />
            </div>

            <div class="form-actions mt-3 mb-3">
              <button type="submit" class="font-lg btn-teal btn-block btn-lg" name="btnLogin" ><i class="fa fa-lock"></i> Login</button>
            </div>

            <div class=" small mt-3 mb-1 text-white text-center">
              Powered by Genesys Now. A Technology Company.
              <br />
              Release: <?php echo gpVersCfg['VERSION']; ?>
            </div>
                            
          </div>

        </form>

    </div>
    
</div>
    