<div class="container-fluid mt-4">

  <div class="animated fadeIn">

    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-body"> 

                    <h3>VIEW <strong>ACCOUNT DETAILS</strong></h3>

                    <?php if ( !isset( $this->setMessage ) ) : ?>
                        <div class="alert alert-teal border-teal">
                            <b class="font-weight-normal">View the details of the Account  below.</b>
                        </div>                    
                    <?php else: ?>

                        <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                            <?php echo $this->setMessage[1]; ?>
                        </div>        

                    <?php endif; ?>

                    <button class="font-sm btn-lg btn-dark" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                    <button class="font-sm btn-lg btn-warning" type="button" data-target="#UpdateAccount" data-toggle="modal"><i class="fa fa-pencil"></i>&nbsp;Update Account</button>
                    <button class="font-sm btn-lg btn-pink" type="button" data-target="#ResetPassword" data-toggle="modal" ><i class="fa fa-lock"></i>&nbsp;Reset Password</button>
                    <button class="font-sm btn-primary btn-lg" type="button" data-target="#ManageLocation" data-toggle="modal"><i class="fa fa-cubes"></i>&nbsp;Manage Location(s)</button>                    
                    <button class="font-sm btn-purple btn-lg" type="button" data-target="#ManageRoles" data-toggle="modal"><i class="fa fa-bars"></i>&nbsp;Manage Role(s)</button>                    
                    <button class="font-sm btn-lg btn-teal" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator/accounts'"><i class="fa fa-users"></i>&nbsp;View All Accounts</button>
                    
                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-4">

            <div class="card">

                <div class="card-body font-lg">

                    <h4>ACCOUNT <strong>SUMMARY</strong></h4>

                    <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 mt-2 font-sm">
                        <tr>
                            <td>Name</td>
                            <td><?php echo strtoupper( $this->GetAccount['data'][0]['account_last'] ) .', '. strtoupper( $this->GetAccount['data'][0]['account_first'] ); ?></td>
                        </tr>                    
                        <tr>
                            <td>Login</td>
                            <td><?php echo $this->GetAccount['data'][0]['account_login']; ?></td>
                        </tr>                    
                        <tr>
                            <td>Email</td>
                            <td><?php echo $this->GetAccount['data'][0]['account_email']; ?></td>
                        </tr>                    
                        <tr>
                            <td>Created</td>
                            <td><?php echo date( 'd-M-Y \a\t h:i a', strtotime( $this->GetAccount['data'][0]['account_created'] ) ); ?></td>
                        </tr>                    
                        <tr>
                            <td>Status</td>
                            <td><?php echo ( $this->GetAccount['data'][0]['account_status'] == '1' ) ? 'Active' : 'Inactive'; ?></td>   
                        </tr>                    
                    </table>
                    
                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="card">

                <div class="card-body">
                
                    <h4>REGISTERED <strong>BRANCHES </strong></h4>                    
                    <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                        <thead class="thead-light font-weight-normal">
                            <tr>                                          
                                <th>Branch Name</th>                        
                                <th class="text-left">Region</th>                                                                                                
                                <th class="text-left">Type</th>                                                                                                
                                <th class="text-center">Status</th>                                                                                                
                                <th class="text-left">Tasks</th>                                                                                                
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach( $this->GetBranches['data'] as $LocationSet ) : ?>

                                <tr>
                                    <td>
                                        <div class="text-left">
                                        <?php echo strtoupper( $LocationSet['location_name'] ); ?>
                                        </div>                                                     
                                    </td>

                                    <td>
                                        <div class="text-left">

                                            <?php 

                                                if ( empty( $LocationSet['location_region'] ) ) : 

                                                    echo '<strong> -- Region Not Provided -- </strong>'; 

                                                else:

                                                    echo $this->LocationRegions[ $LocationSet['location_region'] ]; 

                                                endif;
                                                    
                                            ?>
                                        </div>                                                     
                                    </td>

                                    <td>
                                        <div class="text-left">
                                            <?php echo $this->LocationTypes[ $LocationSet['location_type'] ]; ?>
                                        </div>                                                     
                                    </td>

                                    <td class="text-center">
                                        <div>
                                            <?php if ( $LocationSet['location_status'] == 'A' ) : ?>
                                                <i class="fa fa-check text-success" style="font-size: 18px"></i>
                                            <?php else: ?>
                                                <i class="fa fa-times text-red" style="font-size: 18px"></i>
                                            <?php endif; ?>
                                        </div>                                    
                                    </td>

                                    <td>
                                        <div><a style="text-decoration: none;" href="<?php echo gpConfig['URLPATH']; ?>administrator/branch/<?php echo $LocationSet['id']; ?>">View Branch</a></div>                    
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>   
    <!--/.row-->

  </div>

</div>
<!-- /.conainer-fluid -->


<div class="modal fadeIn animated" id="UpdateAccount" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/account/<?php echo $this->AccountID; ?>">

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
                                    <input name="FirstName" autocomplete="off" type="text" required value="<?php echo $this->GetAccount['data'][0]['AccountFirst']; ?>" class="form-control form-control-lg" />
                                </div>

                            </div>

                            <div class="col-md-6">            

                                <div class="div mt-3 text-dark font-weight-bold">
                                    Last Name
                                </div>

                                <div class="div mt-2 text-dark font-weight-normal">

                                    <input name="LastName" autocomplete="off" type="text" required value="<?php echo $this->GetAccount['data'][0]['AccountLast']; ?>" class="form-control form-control-lg" />

                                </div>

                            </div>

                            <div class="col-md-12">    

                                <div class="mt-3 text-dark font-weight-bold">
                                    Email Address
                                </div>

                                <div class="div mt-2 text-dark font-weight-normal">

                                    <input name="EmailAddress" autocomplete="off"  type="email" required value="<?php echo $this->GetAccount['data'][0]['account_email']; ?>" class="form-control form-control-lg" />
                                    <input name="EmailAddressOld" type="hidden" value="<?php echo $this->GetAccount['data'][0]['account_email']; ?>" />

                                </div>

                            </div>

                            <div class="col-md-6">    

                                <div class=" mt-3 text-dark font-weight-bold">
                                    Status
                                </div>

                                <div class=" mt-2 text-dark font-weight-normal">

                                    <select name="Status" class="form-control form-control-lg custom-select">
                                        <option value="1" <?php echo ( ( $this->GetAccount['data'][0]['account_status'] == '1' ) ? 'SELECTED' : NULL ); ?>>Active</option>
                                        <option value="2" <?php echo ( ( $this->GetAccount['data'][0]['account_status'] == '2' ) ? 'SELECTED' : NULL ); ?>>Inactive</option>
                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6">    

                                <div class=" mt-3 text-dark font-weight-bold">
                                    Login ID
                                </div>

                                <div class=" mt-2 text-dark font-weight-normal">

                                <input name="LoginID" type="text" readonly value="<?php echo $this->GetAccount['data'][0]['account_login']; ?>" class="form-control form-control-lg" />

                                </div>

                            </div>

                        </div>
                        
                    </div>

                </div>

                <div class="modal-footer">                                                                                   
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-warning font-weight-light" type="submit" name="btnUpdateAccount"><i class="fa fa-pencil"></i>  Update Account</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ResetPassword" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/account/<?php echo $this->AccountID; ?>">

                <div class="modal-header bg-pink">
                    <h4 class="modal-title text-white">RESET <strong>ACCOUNT PASSWORD</strong></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-pink border-pink">
                            Reset the account password using the form below. The default password is <strong>12345678</strong>
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
                 
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-pink font-weight-light" type="submit" name="btnReset"><i class="fa fa-refresh"></i>  Reset Password</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ManageLocation" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/account/<?php echo $this->AccountID; ?>">

                <div class="modal-header bg-teal">
                    <h4 class="modal-title text-white">MANAGE <strong>LOCATION</strong></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-teal border-teal">
                            Select the name of the branch that you want to add to this account.
                        </div>

                        <div class="modal-body">

                        <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                            <thead class="thead-light font-weight-normal">
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" class="selectAllToggle" />
                                    </th>
                                    <th>
                                        Branch Name
                                    </th>
                                </tr>
                            </thead>

                            <?php foreach( $this->GetAllBranches['data'] as $BranchSet ) : if ( $BranchSet['location_status'] == 'A' ) : ?>

                                <tr>
                                    <td class="text-center">
                                    
                                        <input type="checkbox" class="selectAll form-control form-control-lg" name="BranchID[]" <?php echo ( in_array( $BranchSet['id'], explode( ',', $this->GetAccount['data'][0]['account_locations'] ) ) ? 'CHECKED' : NULL ); ?> value="<?php echo $BranchSet['id']; ?>" />
                                    </td>
                                    <td>
                                        <?php echo strtoupper( $BranchSet['location_name'] ); ?>
                                    </td>
                                </tr>


                            <?php endif;  endforeach; ?>

                            </table>
                                        
                        </div>

                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>     
                    <button class="font-sm btn-lg btn-teal font-weight-light" type="submit" name="btnUpdate"><i class="fa fa-pencil"></i>  Add/Remove Location(s) </button>                                                                                               
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ManageRoles" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/account/<?php echo $this->AccountID; ?>">

                <div class="modal-header bg-purple">
                    <h5 class="modal-title text-white">MANAGE <strong>USER ROLE ASSIGNMENTS</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-purple border-purple">
                            Add/Remove user Roles
                        </div>

                        <div class="modal-body">

                            <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                                <thead class="thead-light font-weight-normal">
                                    <tr>
                                        <th class="text-center">
                                            <input type="checkbox" class="selectAllToggle" />
                                        </th>
                                        <th>
                                            Role Name
                                        </th>
                                    </tr>
                                </thead>

                                <?php foreach( $this->AccountRoles as $RoleID => $RoleName ) : ?>

                                    <tr>
                                        <td class="text-center">
                                        <input type="checkbox" class="selectAll" value="<?php echo $RoleID; ?>" <?php echo ( in_array( $RoleID, explode( ',', $this->GetAccount['data'][0]['account_roles'] ) ) ? ' CHECKED ' : NULL ); ?> name="RoleID[]" />
                                        </td>
                                        <td >
                                            <div class="text-left">                                                  
                                            <?php echo strtoupper( $RoleName ); ?>
                                            </div>                                                     
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </table>
                            
                        </div>

                    </div>

                </div> 

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>     
                    <button class="font-sm btn-lg btn-purple font-weight-light" type="submit" name="btnUpdateRoles"><i class="fa fa-pencil"></i>  Add/Remove User Role(s) </button>                                                                                                                   
                </div>

            </form>
            
        </div>

    </div>

</div>