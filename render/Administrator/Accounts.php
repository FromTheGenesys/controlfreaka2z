<div class="container-fluid mt-4">

  <div class="animated fadeIn">

    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-body"> 

                    <h3>USER <strong>ACCOUNTS</strong></h3>

                    <?php if ( !isset( $this->setMessage ) ) : ?>

                        <div class="alert alert-primary border-primary">
                            <b class="font-weight-normal">View all accounts that are currently established in the management system.</b>
                        </div>                    

                    <?php else: ?>

                        <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                            <?php echo $this->setMessage[1]; ?>
                        </div>                    

                    <?php endif; ?>

                    <button class="font-sm btn-dark btn-lg" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                    <button class="font-sm btn-teal btn-lg" type="button" data-target="#AddAccount" data-toggle="modal"><i class="fa fa-user-plus"></i>&nbsp;New Account</button>
                    <button class="font-sm btn-primary btn-lg" type="button" data-target="#SearchUserAccount" data-toggle="modal"><i class="fa fa-search"></i>&nbsp;Search Users</button>

                </div>

            </div>

        </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <?php if ( $this->GetAllAccounts['count'] == 0 ) : ?>

                <div class="alert alert-warning border-warning">
                    There were no records available.
                </div>

            <?php else: ?>
                <br>

                <?php if ( isset( $_POST['btnSearch'] ) ) : ?>

                    <?php if ( $this->GetAllAccounts['count'] == 0 ) : ?>

                        <div class="alert alert-warning border-warning">
                            There were no records available.
                        </div>

                    <?php else: ?>

                        <div class="alert alert-success border-success">
                            Your search returned the following results
                        </div>

                        <button type="button" onclick="location.href='<?php echo gpConfig['URLPATH'] . _ACCESS_; ?>accounts'" class="btn-lg btn-info font-sm mb-4"><i class="fa fa-users"></i> Show All User Accounts</button>

                        

                    <?php endif; ?>

                <?php endif; ?>

                <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                <thead class="thead-light font-weight-normal">
                    <tr>                  
                    <th>User</th>
                    <!-- <th class="text-left">Created</th>                   -->
                    <th class="text-left">Login</th>                  
                    <th class="text-left">Role</th>                  
                    <th class="text-left">Branches</th>                  
                    <th class="text-left">Email</th>                  
                    <th class="text-center">Status</th>                                    
                    <th class="text-left">Task</th>                                    
                    </tr>
                </thead>
                <tbody>

                <?php foreach( $this->GetAllAccounts['data'] as $AccountSet ) : ?>

                    <tr>
                    <td>
                        <div><a style="text-decoration: none;" href="<?php echo gpConfig['URLPATH']; ?>administrator/account/<?php echo $AccountSet['id']; ?>"><?php echo $AccountSet['AccountLast']  .', '. $AccountSet['AccountFirst']; ?></a></div>                    
                    </td>


                    <!-- <td class="text-left">
                        <div>
                        <?php echo date( 'd-M-Y \a\t h:i a', strtotime( $AccountSet['account_created'] ) ); ?>
                        </div>                  
                    </td> -->

                    <td class="text-left">
                        <div>
                        <?php echo strtolower( $AccountSet['account_login'] ); ?>                      
                        </div>                  
                    </td>

                    <td class="text-left">
                        <div>
                        <?php 

                            if ( sizeof( explode( ',', $AccountSet['account_roles'] ) ) == 1 ) :
                        
                                if ( $AccountSet['account_roles'] == 0 ) : 

                                    echo '<strong class="text-danger">Not Assigned</strong>';
                                    
                                else: 

                                    if ( empty( $AccountSet['account_roles'] ) ) :

                                    echo '<strong> -- Account Roles Not Defined --</strong>';
                                    else:

                                    echo $this->AccountRoles[ $AccountSet['account_roles'] ];

                                    endif;

                                endif;

                            else:

                                echo '<strong>Multiple Roles</strong> | <span class="font-sm"><a href="" data-target="#ShowRoles'. $AccountSet['id'] .'" data-toggle="modal">Show</a></span>';

                            endif;

                        ?>
                        </div>                  
                    </td>

                    <td class="text-left">
                        <div>
                        <?php 

                            if ( sizeof( explode( ',', $AccountSet['account_locations'] ) ) == 1 ) :
                        
                                if ( $AccountSet['account_locations'] == 0 ) :

                                echo '<strong class="text-danger">Not Assigned</strong>';

                                else: 

                                echo $this->AccountLocations[ $AccountSet['account_locations'] ];

                                endif;
                                
                            else:

                                echo '<strong>Multiple Branches</strong> | <span class="font-sm"><a href="" data-target="#ShowLocations'. $AccountSet['id'] .'" data-toggle="modal">Show</a></span>';

                            endif;

                        ?>
                        </div>                  
                    </td>
                    
                    <td class="text-left">
                        <div>
                        <?php echo $AccountSet['account_email']; ?>
                        </div>                  
                    </td>
                    
                    <td class="text-center">
                        <?php if ( $AccountSet['account_status'] == '1' ) : ?>
                            <i class="fa fa-check text-success" style="font-size: 18px"></i>
                        <?php else: ?>
                            <i class="fa fa-times text-red" style="font-size: 18px"></i>
                        <?php endif; ?>

                        <div class="small text-muted">
                        
                        </div>

                    </td>
                    
                    <td class="text-left">     
                        <i class="fa fa-pencil text-warning" title="Update User Details" style="font-size: 18px" data-target="#UpdateAccount<?php echo $AccountSet['id']?>" data-toggle="modal" ></i>
                        &nbsp;
                        <i class="fa fa-cubes text-pink" title="Add Roles" style="font-size: 18px" data-target="#UpdateUserRoles<?php echo $AccountSet['id']?>" data-toggle="modal" ></i>                        
                        &nbsp;
                        <i class="fa fa-lock text-info" title="Reset Password" style="font-size: 18px" data-target="#ResetPassword<?php echo $AccountSet['id']?>" data-toggle="modal"></i>                        
                        &nbsp;
                        <i class="fa fa-home text-dark" title="Update User Branches" style="font-size: 18px" data-target="#UpdateUserBranches<?php echo $AccountSet['id']; ?>" data-toggle="modal" ></i> 
                    </td> 
                    </tr>

                <?php endforeach; ?>

                </tbody>
                </table>

            <?php endif; ?>
            
          </div>
        </div>
      </div>
      <!--/.col-->
    </div>
    <!--/.row-->

  </div>


  <div class="modal animate__animated animate__slideInLeft " id="SearchUserAccount" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/accounts">

                  <div class="modal-header bg-primary">
                      <h5 class="modal-title text-white">SEARCH <strong>USER ACCOUNT</strong></h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-primary border-primary">
                              Enter the search parameters using the form below. Click the Search Accounts button to return results.
                          </div>

                          <div class="row"> 

                              <div class="col-md-6"> 

                                  <div class="div mt-3 text-dark font-weight-bold">
                                      First Name
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                      <input name="FirstName" autocomplete="off" type="text"  placeholder="First Name" value="" class="font-sm form-control" />
                                  </div>

                              </div>

                              <div class="col-md-6">            

                                  <div class="div mt-3 text-dark font-weight-bold">
                                      Last Name
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">

                                      <input name="LastName" autocomplete="off" type="text"  placeholder="Last Name" value="" class="form-control font-sm" />
                                  </div>

                              </div>

                              <div class="col-md-12">    

                                  <div class="mt-3 text-dark font-weight-bold">
                                      Location
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    <select name="Locations" class="form-control form-control-lg custom-select font-sm">
                                        <option value="*" > --- ALL LOCATIONS ---</option>
                                        <?php

                                            foreach( $this->GetAllBranches['data'] as $BranchSet ) : if ( $BranchSet['location_status'] == 'A' ) :

                                            echo '<option value="'. $BranchSet['id'] .'"';

                                            // if ( $BranchSet['id'] == $MessageSet['MessageLocation'] ) :

                                            //     echo ' SELECTED ';

                                            // endif;

                                            echo '>'. strtoupper( $BranchSet['location_name'] ) .'</option>';

                                            endif; endforeach;

                                        ?>
                                    </select>
                                  </div>

                              </div>

                              <div class="col-md-12">    

                                  <div class="mt-3 text-dark font-weight-bold">
                                      Email Address
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    <input name="EmailAddres" autocomplete="off" type="text" placeholder="Email Address" value="" class="form-control font-sm" />
                                  </div>

                              </div>

                              <div class="col-md-6">    

                                  <div class=" mt-3 text-dark font-weight-bold">
                                      Status
                                  </div>

                                  <div class=" mt-2 text-dark font-weight-normal">

                                      <select name="Status" class="form-control custom-select font-sm font-sm">
                                          <option value="*" > --- SELECT ---</option>
                                          <option value="1">Active</option>
                                          <option value="2">Inactive</option>
                                      </select>

                                  </div>

                              </div>

                              <div class="col-md-6">    
                                &nbsp;
                              </div>

                          </div>
                          
                      </div>

                  </div>

                  <div class="modal-footer">                                                                                   
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-primary font-weight-light" type="submit" name="btnSearch"><i class="fa fa-search"></i> Search Accounts</button>                                                  
                      
                  </div>

              </form>
              
          </div>

      </div>

  </div>


  <div class="modal fade animated animate__animated animate__slideInLeft" id="AddAccount" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/accounts">

                  <div class="modal-header bg-success">
                      <h5 class="modal-title text-white">ADD <strong>ACCOUNT</strong></h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-success border-success">
                              Add user account details using the form below.  The password is set to <strong>123456</strong> by default. The user will be required to reset their password on initial login.
                          </div>

                          <div class="row"> 

                              <div class="col-md-6"> 

                                  <div class="div mt-3 text-dark font-weight-bold">
                                      First Name
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                      <input name="FirstName" autocomplete="off" type="text" required placeholder="First Name" value="" class="form-control form-control-lg" />
                                  </div>

                              </div>

                              <div class="col-md-6">            

                                  <div class="div mt-3 text-dark font-weight-bold">
                                      Last Name
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">

                                      <input name="LastName" autocomplete="off" type="text" required placeholder="Last Name" value="" class="form-control form-control-lg" />

                                  </div>

                              </div>

                              <div class="col-md-12">    

                                  <div class="mt-3 text-dark font-weight-bold">
                                      Email Address
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                      <input name="EmailAddress" autocomplete="off" required type="email" placeholder="Email Address" value="" class="form-control form-control-lg" />                                      
                                  </div>

                              </div>

                              <div class="col-md-6">    

                                  <div class=" mt-3 text-dark font-weight-bold">
                                      Status
                                  </div>

                                  <div class=" mt-2 text-dark font-weight-normal">

                                      <select name="Status" class="form-control form-control-lg custom-select">
                                          <option value="1">Active</option>
                                          <option value="2">Inactive</option>
                                      </select>

                                  </div>

                              </div>

                              <div class="col-md-6">    

                                  <div class=" mt-3 text-dark font-weight-bold">
                                      Login ID
                                  </div>

                                  <div class=" mt-2 text-dark font-weight-normal">

                                  <input name="LoginID" type="text" required value="" placeholder="Login" class="form-control form-control-lg" />

                                  </div>

                              </div>

                          </div>
                          
                      </div>

                  </div>

                  <div class="modal-footer">                                                                                   
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-success font-weight-light" type="submit" name="btnAddAccount"><i class="fa fa-plus"></i>  Add Account</button>                                                  
                      
                  </div>

              </form>
              
          </div>

      </div>

  </div>

</div>

<?php if ( $this->GetAllAccounts['count'] > 0 ) : foreach( $this->GetAllAccounts['data'] as $AccountSet ) : ?>

   <!-- Define Modal Popup for Accounts with Multiple Roles -->
   <?php if ( sizeof( explode(',', $AccountSet['account_roles'] ) ) > 1 ) : ?>

      <div class="modal fadeIn animated" id="ShowRoles<?php echo $AccountSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">USER <strong>ROLES</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-dark border-dark">
                            View user roles below
                        </div>

                        <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                            <thead class="thead-light font-weight-normal">
                                <tr>                                          
                                    <th>Roles</th>                                                              
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach( $this->AccountRoles as $RoleID => $RoleName ) : ?>

                                    <?php if ( in_array( $RoleID, explode( ',', $AccountSet['account_roles'] ) ) ) : ?>

                                        <tr>
                                        <td>
                                            <div class="text-left">
                                                <?php echo $RoleName; ?>
                                            </div>                                                     
                                        </td>
                                        </tr>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="modal-footer">                                                     
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>                                                                                                                                                
                </div>

            </div>
        </div>
      </div>

   <?php endif; ?>

   <!-- Define Modal Popup for Accounts with Multiple Locations -->
   <?php if ( sizeof( explode(',', $AccountSet['account_locations'] ) ) > 1 ) : ?>

      <div class="modal fadeIn animated" id="ShowLocations<?php echo $AccountSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/accounts">

                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white">USER <strong>BRANCH ASSIGNMENTS</strong></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">

                        <div class="form-body text-dark"> 
                        
                            <div class="alert alert-dark border-dark">
                                View all branches to which users are assigned
                            </div>

                            <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                              <thead class="thead-light font-weight-normal">
                                  <tr>                                          
                                      <th>Branches</th>                                                              
                                  </tr>
                              </thead>
                              <tbody>

                                  <?php foreach( $this->AccountLocations as $LocationID => $LocationName ) : ?>

                                      <?php if ( in_array( $LocationID, explode( ',', $AccountSet['account_locations'] ) ) ) : ?>

                                          <tr>
                                            <td>
                                                <div class="text-left">                                                  
                                                  <?php echo $LocationName; ?>
                                                </div>                                                     
                                            </td>
                                          </tr>

                                      <?php endif; ?>

                                  <?php endforeach; ?>

                              </tbody>
                            </table>

                        </div>

                    </div>

                    <div class="modal-footer">                                                     
                        <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>                                                                                                                                                
                    </div>

                </form>
                
            </div>

        </div>
      </div>

   <?php endif; ?>

    <div class="modal fade animated" id="ResetPassword<?php echo $AccountSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/accounts">

                    <div class="modal-header bg-pink">
                        <h5 class="modal-title text-white">RESET <strong>ACCOUNT PASSWORD</strong></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">

                        <div class="form-body text-dark"> 
                        
                            <div class="alert alert-pink border-pink">
                                Reset the account password using the form below. The default password is <strong>123456</strong>
                            </div>

                            <div class="div mt-3 text-dark font-weight-bold">
                                New Password 
                            </div>

                            <div class="div mt-2 text-dark font-weight-normal">
                                <input name="Password[]" readonly type="password" value="12345678" required placeholder="New Password" class="form-control form-control-lg" />
                            </div>

                            <div class="div mt-3 text-dark font-weight-bold">
                                Confirm Password
                            </div>

                            <div class="div mt-2 text-dark font-weight-normal">
                                <input name="Password[]" readonly type="password" value="12345678" required placeholder="Confirm Password" class="form-control form-control-lg" />
                            </div>
    
                        </div>

                    </div>

                    <div class="modal-footer">                                 
                        <input type="hidden" name="AccountID" value="<?php echo $AccountSet['id']; ?>" />                
                        <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                        <button class="font-sm btn-lg btn-pink font-weight-light" type="submit" name="btnResetPassword"><i class="fa fa-refresh"></i>  Reset Password</button>                                                                          
                    </div>

                </form>
                
            </div>

        </div>

    </div>

    <div class="modal fade animated" id="UpdateUserBranches<?php echo $AccountSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="POST" action="<?php echo gpConfig['URLPATH'] ._ACCESS_; ?>accounts">

                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white">UPDATE <strong>BRANCH ASSIGNMENTS</strong></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">

                        <div class="form-body text-dark"> 
                        
                            <div class="alert alert-dark border-dark">
                                Add/Remove branches using the form below
                            </div>

                            <!-- <button class="btn-sm btn-dark mb-3" type="button" id="selectAll">&nbsp;Select All</button> -->

                            <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                              <thead class="thead-light font-weight-normal">
                                  <tr>                                          
                                      <th class="text-center">
                                        <input type="checkbox" class="selectAllToggle" />
                                      </th>                                                              
                                      <th>Branches</th>                                                              
                                  </tr>
                              </thead>
                              <tbody>

                                  <?php foreach( $this->AccountLocations as $LocationID => $LocationName ) : ?>

                                    <tr>
                                      <td class="text-center">
                                        <input type="checkbox" class="selectAll" value="<?php echo $LocationID; ?>" <?php echo ( in_array( $LocationID, explode( ',', $AccountSet['account_locations'] ) ) ? ' CHECKED ' : NULL ); ?> name="BranchID[]" />
                                      </td>
                                      <td >
                                          <div class="text-left">                                                  
                                            <?php echo strtoupper( $LocationName ); ?>
                                          </div>                                                     
                                      </td>
                                    </tr>

                                  <?php endforeach; ?>

                              </tbody>
                            </table>

                        </div>

                    </div>

                    <div class="modal-footer">            
                        <input type="hidden" name="AccountID" value="<?php echo $AccountSet['id']; ?>" />                                         
                        <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>                                                                                                                                                
                        <button class="font-sm btn-lg btn-secondary" name="btnUpdateBranches" type="submit"><i class="fa fa-save"></i> Update Branch Assignments</button>                                                                                                                                                
                    </div>

                </form>
                
            </div>

        </div>
    </div>

    <div class="modal fade animated" id="UpdateAccount<?php echo $AccountSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/accounts">

                    <div class="modal-header bg-warning">
                        <h4 class="modal-title text-white">UPDATE <strong>ACCOUNT</strong></h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">

                        <div class="form-body text-dark"> 
                        
                            <div class="alert alert-warning border-warning">
                                Update account details using the form below
                            </div>

                            <div class="row"> 

                                <div class="col-md-6"> 

                                    <div class="div mt-3 text-dark font-weight-bold">
                                        First Name
                                    </div>

                                    <div class="div mt-2 text-dark font-weight-normal">
                                        <input name="FirstName" autocomplete="off" type="text" required value="<?php echo $AccountSet['AccountFirst']; ?>" class="form-control form-control-lg" />
                                    </div>

                                </div>

                                <div class="col-md-6">            

                                    <div class="div mt-3 text-dark font-weight-bold">
                                        Last Name
                                    </div>

                                    <div class="div mt-2 text-dark font-weight-normal">

                                        <input name="LastName" autocomplete="off" type="text" required value="<?php echo $AccountSet['AccountLast']; ?>" class="form-control form-control-lg" />

                                    </div>

                                </div>

                                <div class="col-md-12">    

                                    <div class="mt-3 text-dark font-weight-bold">
                                        Email Address
                                    </div>

                                    <div class="div mt-2 text-dark font-weight-normal">

                                        <input name="EmailAddress" autocomplete="off"  type="email" required value="<?php echo $AccountSet['account_email']; ?>" class="form-control form-control-lg" />
                                        <input name="EmailAddressOld" type="hidden" value="<?php echo $AccountSet['account_email']; ?>" />

                                    </div>

                                </div>

                                <div class="col-md-6">    

                                    <div class=" mt-3 text-dark font-weight-bold">
                                        Status
                                    </div>

                                    <div class=" mt-2 text-dark font-weight-normal">

                                        <select name="Status" class="form-control form-control-lg custom-select">
                                            <option value="1" <?php echo ( ( $AccountSet['account_status'] == '1' ) ? 'SELECTED' : NULL ); ?>>Active</option>
                                            <option value="2" <?php echo ( ( $AccountSet['account_status'] == '2' ) ? 'SELECTED' : NULL ); ?>>Inactive</option>
                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6">    

                                    <div class=" mt-3 text-dark font-weight-bold">
                                        Login ID
                                    </div>

                                    <div class=" mt-2 text-dark font-weight-normal">

                                    <input name="LoginID" type="text" readonly value="<?php echo $AccountSet['account_login']; ?>" class="form-control form-control-lg" />

                                    </div>

                                </div>

                            </div>
                            
                        </div>

                    </div>

                    <div class="modal-footer">    
                        <input type="hidden" value="<?php echo $AccountSet['id']; ?>" name="AccountID" />                                                                               
                        <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                        <button class="font-sm btn-lg btn-warning font-weight-light" type="submit" name="btnUpdateAccount"><i class="fa fa-pencil"></i>  Update Account</button>                                                  
                        
                    </div>

                </form>
                
            </div>

        </div>

    </div>

    <div class="modal fade animated" id="UpdateUserRoles<?php echo $AccountSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/accounts">

                  <div class="modal-header bg-pink">
                      <h5 class="modal-title text-white">UPDATE <strong>USER ROLES ASSIGNMENTS</strong></h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-pink border-pink">
                              Add/Remove user Roles
                          </div>

                          <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                            <thead class="thead-light font-weight-normal">
                                <tr>                                          
                                    <th class="text-center">                                        
                                        <input type="checkbox" class="selectAllToggle" />
                                    </th>                                                              
                                    <th>Roles</th>                                                              
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach( $this->AccountRoles as $RoleID => $RoleName ) : ?>

                                  <tr>
                                    <td class="text-center">
                                      <input type="checkbox" class="selectAll" value="<?php echo $RoleID; ?>" <?php echo ( in_array( $RoleID, explode( ',', $AccountSet['account_roles'] ) ) ? ' CHECKED ' : NULL ); ?> name="RoleID[]" />
                                    </td>
                                    <td >
                                        <div class="text-left">                                                  
                                          <?php echo strtoupper( $RoleName ); ?>
                                        </div>                                                     
                                    </td>
                                  </tr>

                                <?php endforeach; ?>

                            </tbody>
                          </table>

                      </div>

                  </div>

                  <div class="modal-footer">                                                     
                      <input type="hidden" value="<?php echo $AccountSet['id']; ?>" name="AccountID" />
                      <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>                                                                                                                                                
                      <button class="font-sm btn-lg btn-pink" type="submit" name="btnUpdateRoles" ><i class="fa fa-save"></i> Update User Roles</button>                                                                                                                                                
                  </div>

              </form>
              
          </div>

      </div>
      
    </div>

<?php endforeach; endif; ?>

 