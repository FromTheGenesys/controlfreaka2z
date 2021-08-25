
<div class="container-fluid mt-4">

  <div class="animated fadeIn">

    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-body"> 

                    <h3>VIEW <strong>BRANCH DETAILS</strong></h3>

                    <?php if ( !isset( $this->setMessage ) ) : ?>

                        <div class="alert alert-primary border-primary">
                            <b class="font-weight-normal">View the details of the Branch  below.</b>
                        </div>                    

                    <?php else: ?>

                        <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                            <?php echo $this->setMessage[1]; ?>
                        </div>        

                    <?php endif; ?>

                    <button class="font-sm btn-lg btn-dark" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                    <button class="font-sm btn-lg btn-warning" type="button" data-target="#UpdateLocation" data-toggle="modal"><i class="fa fa-pencil"></i>&nbsp;Update Branch</button>
                    <button class="font-sm btn-lg btn-pink" type="button" data-target="#OperatingHours" data-toggle="modal"><i class="fa fa-hourglass"></i>&nbsp;Add Operation Hours</button>
                    <button class="font-sm btn-lg btn-purple" type="button" data-target="#ManageModules" data-toggle="modal"><i class="fa fa-cubes"></i>&nbsp;Manage Modules</button>
                    <button class="font-sm btn-lg btn-teal" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator/branches'"><i class="fa fa-building"></i>&nbsp;View All Branches</button>
                    
                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-4">

            <div class="card">

                <div class="card-body font-lg">

                    <h4>BRANCH <strong>SUMMARY</strong></h4>

                    <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 mt-2 font-sm">
                        <tr>
                            <td>Name</td>
                            <td><?php echo $this->GetLocation['data'][0]['location_name']; ?></td>
                        </tr>                    
                        <tr>
                            <td>Type</td>
                            <td><?php echo $this->LocationTypes[ $this->GetLocation['data'][0]['location_type'] ]; ?></td>
                        </tr>                    
                        <tr>
                            <td>Region</td>
                            <td><?php echo $this->LocationRegions[ $this->GetLocation['data'][0]['location_region'] ]; ?></td>
                        </tr>                    
                        <tr>
                            <td>Status</td>
                            <td><?php echo ( $this->GetLocation['data'][0]['location_status'] == 'A' ) ? 'Active' : 'Inactive'; ?></td>   
                        </tr>                    
                    </table>
                    
                </div>

            </div>

            <?php if ( !empty( $this->GetLocation['data'][0]['location_modules'] ) ) : ?>

                <div class="card mt-3">

                    <div class="card-body font-lg">

                        <h4>BRANCH <strong>MODULES</strong></h4>

                        <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 mt-2 font-sm">
                            <thead class="thead-light font-weight-normal">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                </tr>              
                            </thead>

                            <?php foreach( explode( ',', $this->GetLocation['data'][0]['location_modules'] ) as $ModuleID ) : ?>       

                                <tr>
                                    <td><?php echo $this->LogicAdmin->GetModule( $ModuleID )['data'][0]['ModuleName']; ?></td>
                                    <td><?php echo $this->LogicAdmin->GetModule( $ModuleID )['data'][0]['ModuleDescription']; ?></td>
                                </tr>                    

                            <?php endforeach; ?>
                            
                        </table>
                        
                    </div>

                </div>

            <?php endif; ?>

            <?php if ( !empty( $this->GetLocation['data'][0]['location_hours'] ) ) : ?>

                <div class="card mt-3">

                    <div class="card-body font-lg">

                        <h4>BRANCH <strong>OPERATING HOURS</strong></h4>

                        <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 mt-2 font-sm">
                            <thead class="thead-light font-weight-normal">
                                <tr>
                                    <th>Day</th>
                                    <th>Opens</th>
                                    <th>Closes</th>
                                </tr>              
                            </thead>

                            <?php foreach( explode( ',', $this->GetLocation['data'][0]['location_hours'] ) as $Hours ) : ?>       

                                <?php list( $D, $O, $C )    =   explode( '-', $Hours ); ?>
                                <?php $days                 =   [ 0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday' ]; ?>

                                <tr>
                                    <td><?php echo $days[ $D ]; ?></td>
                                    <td><?php echo date( 'h:i a', strtotime( $O ) ); ?></td>
                                    <td><?php echo date( 'h:i a', strtotime( $C ) ); ?></td>
                                </tr>                    

                            <?php endforeach; ?>
                            
                        </table>
                        
                    </div>

                </div>

            <?php endif; ?>

        </div>

        <div class="col-md-8">

            <div class="card">

                <div class="card-body">
                    <h4>REGISTERED <strong>BRANCH CSR ACCOUNTS</strong></h4>

                    <?php if ( $this->BranchCSRS['count'] == 0 ) : ?>

                        <div class="alert alert-warning border-warning">There are no CSR accounts associated with this Branch</div>

                    <?php else: ?>

                        <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                            <thead class="thead-light font-weight-normal">
                                <tr>                  
                                    <th>Last</th>
                                    <th>First</th>
                                    <th>Login</th>
                                    <th>Email Address</th>
                                    <th>Created</th>
                                    <th class="text-center">Status</th>                                                                                                
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach( $this->BranchCSRS['data'] as $LocationSet ) : ?>

                                    <tr>
                                   
                                        <td>
                                            <div class="text-left">
                                                <a style="text-decoration: none;" href="<?php echo gpConfig['URLPATH']; ?>administrator/account/<?php echo $LocationSet['id']; ?>">
                                                    <?php echo $LocationSet['AccountLast']; ?>
                                                </a>
                                            </div>                                                     
                                        </td>

                                        <td class="text-left">
                                            <div>
                                                <?php echo  $LocationSet['AccountFirst'] ; ?>
                                            </div>                                    
                                        </td>

                                        <td class="text-left">
                                            <div>
                                                <?php echo  $LocationSet['account_login'] ; ?>
                                            </div>                                   
                                        </td>

                                        <td class="text-left">
                                            <div>
                                                <?php echo strtolower( $LocationSet['account_email'] ); ?>
                                            </div>                                   
                                        </td>

                                        <td class="text-left">
                                            <div>
                                                <?php echo date( 'd-M-Y \a\t h:i a', strtotime( $LocationSet['account_created'] ) ); ?>
                                            </div>
                                        
                                        </td>

                                        <td class="text-center">
                                            <div>
                                                <?php if ( $LocationSet['account_status'] == '1' ) : ?>
                                                    <i class="fa fa-check text-success" style="font-size: 18px"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-times text-red" style="font-size: 18px"></i>
                                                <?php endif; ?>
                                            </div>                                    
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    <?php endif; ?>

                </div>
            </div>
        
        </div>

    </div>
    <!--/.row-->

  </div>

</div>



<div class="modal fadeIn animated" id="UpdateLocation" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/branch/<?php echo $this->BranchID; ?>">

                <div class="modal-header bg-warning">
                    <h4 class="modal-title text-white">UPDATE <strong>BRANCH</strong></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-warning border-warning">
                            Update lcation details using the form below
                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Branch Name
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <input name="LocationName" autocomplete="off" type="text" required value="<?php echo $this->GetLocation['data'][0]['location_name']; ?>" class="form-control form-control-lg font-sm" />
                            <input name="LocationNameOLD" type="hidden" value="<?php echo $this->GetLocation['data'][0]['location_name']; ?>"  />

                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                              Platform
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                              <select name="LocationPID" class="form-control form-control-lg custom-select font-sm">
                                  <option value="CNG">Cash N' Go</option>
                                  <option value="MMX">MoneyMaxx</option>
                              </select>
                          </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Type
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <select name="LocationType" class="form-control form-control-lg custom-select font-sm">
                                <?php foreach( $this->LocationTypes as $TypeID => $TypeName ) : ?>
                                    
                                    <option value="<?php echo $TypeID; ?>" 

                                    <?php if ( $this->GetLocation['data'][0]['location_type'] == $TypeID ) : echo 'SELECTED'; endif; ?>

                                    ><?php echo $TypeName; ?></option>

                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Region
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <select name="LocationRegion" class="form-control form-control-lg custom-select font-sm">
                                <?php foreach( $this->LocationRegions as $RegionID => $RegionName ) : ?>
                                    
                                    <option value="<?php echo $RegionID; ?>" 

                                    <?php if ( $this->GetLocation['data'][0]['location_region'] == $RegionID ) : echo 'SELECTED'; endif; ?>

                                    ><?php echo $RegionName; ?></option>

                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Status
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <select name="LocationStatus" class="form-control form-control-lg custom-select font-sm">
                                <option value="A" <?php echo ( ( $this->GetLocation['data'][0]['location_status'] == 'A' ) ? 'SELECTED' : NULL ); ?>>Active</option>
                                <option value="I" <?php echo ( ( $this->GetLocation['data'][0]['location_status'] == 'I' ) ? 'SELECTED' : NULL ); ?>>Inactive</option>
                            </select>

                        </div>
                        
                    </div>

                </div>

                <div class="modal-footer">                                                                      
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-warning font-weight-light" type="submit" name="btnUpdate"><i class="fa fa-pencil"></i>  Update Branch  </button>                                                                      
                </div>

            </form>
            
        </div>

    </div>

</div>


<div class="modal fadeIn animated" id="OperatingHours" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/branch/<?php echo $this->BranchID; ?>">

                <div class="modal-header bg-pink">
                    <h4 class="modal-title text-white">UPDATE <strong>OPERATING HOURS</strong></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-pink border-pink">
                            Select the operating days and hours from the list below
                        </div>

                        <?php $Days     =   []; 

                              foreach( explode( ',', $this->GetLocation['data'][0]['location_hours'] ) as $Day ) :

                                    list( $d, $start, $stop )    =   explode( '-', $Day );

                                    $Days[ $d ]     =   [ $start, $stop ];

                              endforeach;

                        ?>

                        <table class="table table-responsive-sm table-hover table-striped table-outline mb-0">
                            <thead class="thead-light font-weight-normal">
                                <tr class="font-sm">
                                    <th><i class="fa fa-check text-success text-center"></i></th>
                                    <th>Day</th>
                                    <th>Opens</th>
                                    <th>Closes</th>
                                </tr>
                            </thead>

                            <tr class="font-sm">
                                <td class="text-center"><input type="checkbox" name="Day[]" value="0" <?php echo ( in_array( 0, array_keys( $Days ) ) ? ' CHECKED ' : NULL ); ?> /></td>
                                <td>Sunday</td>
                                <td><input type="time" name="Opens[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[0] ) ? $Days[0][0] : NULL ); ?>"></td>
                                <td><input type="time" name="Closes[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[0] ) ? $Days[0][1] : NULL ); ?>"></td>
                            </tr>
                            
                            <tr class="font-sm">
                                <td class="text-center"><input type="checkbox" name="Day[]" value="1" <?php echo ( in_array( 1, array_keys( $Days ) ) ? ' CHECKED ' : NULL ); ?>  /></td>
                                <td>Monday</td>
                                <td><input type="time" name="Opens[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[1] ) ? $Days[1][0] : NULL ); ?>"></td>
                                <td><input type="time" name="Closes[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[1] ) ? $Days[1][1] : NULL ); ?>"></td>
                            </tr>
                            
                            <tr class="font-sm">
                                <td class="text-center"><input type="checkbox" name="Day[]" value="2" <?php echo ( in_array( 2, array_keys( $Days ) ) ? ' CHECKED ' : NULL ); ?> /></td>
                                <td>Tuesday</td>
                                <td><input type="time" name="Opens[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[2] ) ? $Days[2][0] : NULL ); ?>"></td>
                                <td><input type="time" name="Closes[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[2] ) ? $Days[2][1] : NULL ); ?>"></td>
                            </tr>
                            
                            <tr class="font-sm">
                                <td class="text-center"><input type="checkbox" name="Day[]" value="3" <?php echo ( in_array( 3, array_keys( $Days ) ) ? ' CHECKED ' : NULL ); ?>/></td>
                                <td>Wednesday</td>
                                <td><input type="time" name="Opens[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[3] ) ? $Days[3][0] : NULL ); ?>"></td>
                                <td><input type="time" name="Closes[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[3] ) ? $Days[3][1] : NULL ); ?>"></td>
                            </tr>
                            
                            <tr class="font-sm">
                                <td class="text-center"><input type="checkbox" name="Day[]" value="4" <?php echo ( in_array( 4, array_keys( $Days ) ) ? ' CHECKED ' : NULL ); ?> /></td>
                                <td>Thursday</td>
                                <td><input type="time" name="Opens[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[4] ) ? $Days[4][0] : NULL ); ?>"></td>
                                <td><input type="time" name="Closes[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[4] ) ? $Days[4][1] : NULL ); ?>"></td>
                            </tr>
                            
                            <tr class="font-sm">
                                <td class="text-center"><input type="checkbox" name="Day[]" value="5" <?php echo ( in_array( 5, array_keys( $Days ) ) ? ' CHECKED ' : NULL ); ?>/></td>
                                <td>Friday</td>
                                <td><input type="time" name="Opens[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[5] ) ? $Days[5][0] : NULL ); ?>"></td>
                                <td><input type="time" name="Closes[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[5] ) ? $Days[5][1] : NULL ); ?>"></td>
                            </tr>
                            
                            <tr class="font-sm">
                                <td class="text-center"><input type="checkbox" name="Day[]" value="6" <?php echo ( in_array( 6, array_keys( $Days ) ) ? ' CHECKED ' : NULL ); ?> /></td>
                                <td>Saturday</td>
                                <td><input type="time" name="Opens[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[6] ) ? $Days[6][0] : NULL ); ?>"></td>
                                <td><input type="time" name="Closes[]" class="form-control form-control-lg font-sm" value="<?php echo ( isset( $Days[6] ) ? $Days[6][1] : NULL ); ?>"></td>
                            </tr>
                            
                        </table>

                    </div>

                </div>

                <div class="modal-footer">                                                                            
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-pink font-weight-light" type="submit" name="btnUpdateOpHours"><i class="fa fa-pencil"></i>  Update Operating Hours  </button>                                                                      
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ManageModules" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/branch/<?php echo $this->BranchID; ?>">

                <div class="modal-header bg-purple">
                    <h4 class="modal-title text-white">MANAGE <strong>MODULES</strong></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-purple border-purple">
                            Select the name of the module that you want to add to this location.
                        </div>

                        <table class="table table-responsive-sm table-hover table-striped table-outline mb-0">
                            <thead class="thead-light font-weight-normal">
                                <tr class="font-sm">
                                    <th><i class="fa fa-check text-success text-center"></i></th>
                                    <th>Module</th>
                                    <th>Description</th>                                    
                                </tr>
                            </thead>

                            <?php foreach( $this->GetModules['data'] as $Module ) : ?>

                                <tr class="font-sm">
                                    <td class="text-center"><input type="checkbox" name="Modules[]" value="<?php echo $Module['ModuleID']; ?>" 
                                    
                                    <?php

                                        if ( in_array( $Module['ModuleID'], explode( ',', $this->GetLocation['data'][0]['location_modules'] ) ) ) :
                                            
                                            echo ' CHECKED ';
                                            
                                        endif;

                                    ?>
                                    /></td>
                                    <td><?php echo $Module['ModuleName']; ?></td>
                                    <td><?php echo $Module['ModuleDescription']; ?></td>                                    
                                </tr>

                            <?php endforeach; ?>
                            
                        </table>

                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-purple font-weight-light" type="submit" name="btnUpdateModules"><i class="fa fa-pencil"></i>  Add/Remove Module(s) </button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>


