<div class="row justify-content-center mt-3">
    
  <div class="col-lg-6">  
      
    <div class="card p-2 mt-2 opacity-3 bg-dark" style="">

        <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>auth/selectlocale">  

          <div class="card-body">

            <div class="text-center mb-4">
                <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/brand_logo.png" class="img-fluid w-50">
            </div>  

            <?php if ( !isset( $this->setMessage ) ) : ?>

                <div class="alert bg-teal border-teal text-white">
                    Your account is assigned multiple locations. Please select your operating location from the list below.
                </div>

            <?php else: ?>

                <div class="alert bg-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?> font-weight-normal">
                    <?php echo $this->setMessage[1]; ?>
                </div>

            <?php endif; ?>

            <?php if( $this->GetLocations['count'] > 0 ) : ?>
            
                <div class="">

                    <select name="LocationID" class="custom-select form-control form-control-lg">

                        <?php foreach( $this->GetLocations['data'] as $LocationSet ): ?>

                            <option value="<?php echo $LocationSet['id']; ?>"><?php echo $LocationSet['location_name']; ?></option>

                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-actions mt-3">                
                    <button type="submit" class="font-sm btn-teal btn-lg" id="selectRole" name="btnSelectLocale" ><i class="fa fa-check"></i> Select Location</button>
                    <button type="button" class="font-sm btn-danger btn-lg" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>auth/logout'" ><i class="fa fa-sign-out"></i> Cancel</button>
                </div>

            <?php else: ?>

                <div class="form-actions mt-3">                                    
                    <button type="button" class="font-sm btn-dark btn-lg" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>auth/logout'" ><i class="fa fa-thumbs-up"></i> Ok</button>
                </div>

            <?php endif; ?>
                            
          </div>

        </form>

    </div>
    
</div>
    