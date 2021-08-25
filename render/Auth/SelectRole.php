<div class="row justify-content-center mt-3">
    
  <div class="col-lg-6">  
        
      <div class="card p-2 mt-2 opacity-3 bg-dark" style="">

        <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>auth/selectrole">  

          <div class="card-body">

            <div class="text-center mb-4">
              <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/brand_logo.png" class="img-fluid w-50">
            </div>

            <?php if ( !isset( $this->setMessage ) ) : ?>

                <div class="alert bg-teal border-teal text-white">
                  Your account is assigned multiple roles. Please select the role in which you wish to operate from your list of options below.
                </div>

            <?php else: ?>

                <div class="alert alert-danger border-danger font-weight-normal">
                    <?php echo $this->setMessage[1]; ?>
                </div>

            <?php endif; ?>
            
            <div class="">

                <select name="RoleID" class="custom-select form-control form-control-lg">

                    <!-- // CSR -->
                    <?php if ( in_array( '4', explode( ',', $_SESSION['sessAcctRoles'] ) ) ) : ?>
                        <option value="4">Customer Service Representative</option>
                    <?php endif; ?>

                     <!-- // Senior CSR -->
                     <?php if ( in_array( '3', explode( ',', $_SESSION['sessAcctRoles'] ) ) ) : ?>
                        <option value="3">Senior CSR</option>
                    <?php endif; ?>

                </select>
            </div>


            <div class="form-actions mt-3">                
              <button type="submit" class="font-sm btn-teal btn-lg" id="selectRole" name="btnSelectRole" ><i class="fa fa-check"></i> Select Role</button>
              <button type="button" class="font-sm btn-danger btn-lg" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>auth/logout'" ><i class="fa fa-sign-out"></i> Cancel</button>
            </div>
                            
          </div>

        </form>

    </div>
    
</div>
    