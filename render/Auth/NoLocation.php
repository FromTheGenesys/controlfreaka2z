<div class="row justify-content-center mt-3">
    
  <div class="col-lg-6">  
        
      <div class="card p-2 mt-2 opacity-3 bg-dark" style="">

        <div class="text-center mb-4">
          <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/genesys_brand.png" class="img-fluid w-50">
        </div>

        <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>auth/logout">  

          <div class="card-body">

            <div class="alert bg-danger border-danger font-weight-normal text-left">
                Your profile does not contain an active location. At least one active location is required. Please contact your System Administrator in order to continue.
            </div>

            <div class="form-actions mt-3">
              <button type="submit" class=" btn btn-dark btn-lg" name="btnLogin" ><i class="fa fa-thumbs-up"></i> Ok</button>
            </div>
                            
          </div>

        </form>

    </div>
    
</div>
    