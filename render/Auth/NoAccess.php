<div class="row justify-content-center mt-3">
    
  <div class="col-lg-6">  
        
      <div class="text-center">
        <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/brand.png">
      </div>

      <div class="card bg-white p-2 mt-3">

        <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>auth">  

          <div class="card-body">

            <div class="alert bg-danger border-danger font-weight-normal text-left">
                You are attempting to access a page that is restricted. 
            </div>

            <div class="form-actions mt-3">
              <button type="submit" class=" btn btn-dark btn-lg" name="btnLogin" ><i class="fa fa-thumbs-up"></i> Go back</button>
            </div>
                            
          </div>

        </form>

    </div>
    
</div>
    