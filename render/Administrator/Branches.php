<div class="container-fluid mt-4">

  <div class="animated fadeIn">

    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-body"> 

                    <h3>MANAGE <strong>BRANCHES</strong></h3>

                    <?php if ( !isset( $this->setMessage ) ) : ?>

                        <div class="alert alert-primary border-primary">
                            <b class="font-weight-normal">All Cash N Go Core, BFG and Sub Agents.</b>
                        </div>                    

                    <?php else: ?>

                        <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                            <?php echo $this->setMessage[1]; ?>
                        </div>                    

                    <?php endif; ?>

                    <button class="font-sm btn-dark btn-lg" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                    <button class="font-sm btn-success btn-lg" type="button" data-target="#NewBranch" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;New Branch</button>

                </div>

            </div>

        </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <br>
            <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
              <thead class="thead-light font-weight-normal">
                <tr>                  
                  <th>Branch</th>
                  <th class="text-center">CSRs</th>
                  <th>Platform</th>
                  <th>Type</th>
                  <th class="text-left">Region</th>                  
                  <th class="text-center">Status</th>                                    
                  <th class="text-center">Task</th>                                    
                </tr>
              </thead>
              <tbody>

              <?php foreach( $this->GetAllBranches['data'] as $LocationSet ) : ?>

                <tr>
                  <td>
                    <div><a style="text-decoration: none;" href="<?php echo gpConfig['URLPATH']; ?>administrator/branch/<?php echo $LocationSet['id']; ?>"><?php echo $LocationSet['LocationName']; ?></a></div>                    
                  </td>

                  <td>
                    <div class="text-center">
                      <?php echo $LocationSet['CSRsAtLocation']; ?>
                    </div>   
                    <div class="small text-muted">
                        &nbsp;        
                    </div>                 
                  </td>


                  <td class="text-left">
                    <div>
                      <?php echo  $LocationSet['location_pid'] ; ?>
                    </div>
                    <div class="small text-muted">
                        &nbsp;        
                    </div>
                  </td>

                  <td class="text-left">
                    <div>
                    <?php echo  $this->LocationTypes[ $LocationSet['location_type'] ]; ?>

                    </div>
                    <div class="small text-muted">
                        &nbsp;        
                    </div>
                  </td>

                  <td class="text-left">
                    <div>
                    <?php 
                    
                        if ( empty( $LocationSet['location_region'] ) ) :

                          echo '<strong>-- Region Not Specified --</strong>';

                        else: 

                          echo $this->LocationRegions[ $LocationSet['location_region'] ]; 

                        endif; 
                      ?>
                    </div>
                    <div class="small text-muted">
                        &nbsp;        
                    </div>
                  </td>
                  
                  <td class="text-center">
                      <?php if ( $LocationSet['location_status'] == 'A' ) : ?>
                        <i class="fa fa-check text-success" style="font-size: 18px"></i>
                      <?php else: ?>
                        <i class="fa fa-times text-red" style="font-size: 18px"></i>
                      <?php endif; ?>

                      <div class="small text-muted">
                        <!-- <?php echo $AccountSet['AccountDisplayStatus']; ?> -->
                      </div>
                  </td>
                 
                  <td class="text-center">
                    <i style="font-size: 18px;" class="fa fa-pencil text-warning" data-target="#UpdateLocation<?php echo $LocationSet['id']; ?>" data-toggle="modal"></i>
                    &nbsp;
                    <i style="font-size: 18px;" class="fa fa-calendar text-info" data-target="#UpdateOperatingHours<?php echo $LocationSet['id']; ?>" data-toggle="modal"></i>
                    &nbsp;
                    <i style="font-size: 18px;" class="fa fa-cubes text-pink" data-target="#UpdateModules<?php echo $LocationSet['id']; ?>" data-toggle="modal"></i>
                  </td> 
                </tr>

              <?php endforeach; ?>

              </tbody>
            </table>
            
          </div>
        </div>
      </div>
      <!--/.col-->
    </div>
    <!--/.row-->

  </div>

</div>


<div class="modal fadeIn animated" id="NewBranch" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/branches">

                  <div class="modal-header bg-success">
                      <h4 class="modal-title text-white">ADD <strong>BRANCH</strong></h4>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-success border-success">
                              Add Branch Details using the form below.
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Branch Name
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">
                              <input name="LocationName" type="text" placeholder="Branch Name" required value="" required class="form-control form-control-lg font-sm" />                              
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
                                      <option value="<?php echo $TypeID; ?>"><?php echo $TypeName; ?></option>
                                  <?php endforeach; ?>
                                  
                              </select>

                          </div>
                          <div class="div mt-3 text-dark font-weight-bold">
                              Region
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                            <select name="LocationRegion" class="form-control form-control-lg custom-select font-sm">
                              <?php foreach( $this->LocationRegions as $RegionID => $RegionName ) : ?>
                                <option value="<?php echo $RegionID; ?>"><?php echo $RegionName; ?></option>
                              <?php endforeach; ?>
                              </select>

                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Status
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">
                            
                              <select name="LocationStatus" class="form-control form-control-lg custom-select font-sm">
                                  <option value="A">Active</option>
                                  <option value="I">Inactive</option>
                              </select>

                          </div>
                          
                      </div>

                  </div>

                  <div class="modal-footer">                                                                                                
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-success font-weight-light" type="submit" name="btnAdd"><i class="fa fa-plus"></i>  Add Branch Details  </button>                                                                        
                  </div>

              </form>
              
          </div>

      </div>

  </div>

<?php if ( $this->GetAllBranches['count'] > 0 ) :foreach( $this->GetAllBranches['data'] as $LocationSet ) : ?>

  <div class="modal fadeIn animated" id="UpdateLocation<?php echo $LocationSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/branches">

                  <div class="modal-header bg-warning">
                      <h4 class="modal-title text-white">UPDATE <strong>BRANCH</strong></h4>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-warning border-warning">
                              Update Branch Details using the form below.
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Branch Name
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                              <input name="LocationName" readonly type="text" placeholder="Location Name" required value="<?php echo $LocationSet['LocationName']; ?>" required class="form-control form-control-lg font-sm" />
                              
                          </div>


                          <div class="div mt-3 text-dark font-weight-bold">
                              Platform
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                            <select name="LocationPID" class="form-control form-control-lg custom-select font-sm">
                                  <option value="CNG" <?php echo ( $LocationSet['location_pid'] == 'CNG' ) ? 'SELECTED' : NULL ?> >Cash N' Go</option>
                                  <option value="MMX" <?php echo ( $LocationSet['location_pid'] == 'MMX' ) ? 'SELECTED' : NULL ?> >MoneyMaxx</option>
                              </select>
                          </div>
                          <div class="div mt-3 text-dark font-weight-bold">
                              Type
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                              <select name="LocationType" class="form-control form-control-lg custom-select font-sm">
                                  <?php foreach( $this->LocationTypes as $TypeID => $TypeName ) : ?>

                                      <option value="<?php echo $TypeID; ?>"
                                      
                                      <?php if ( $TypeID == $LocationSet['location_type'] ) : echo ' SELECTED ';  endif; ?>

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
                                
                                <?php if ( $RegionID == $LocationSet['location_region'] ) : echo ' SELECTED ';  endif; ?>

                                ><?php echo $RegionName; ?></option>

                                <?php endforeach; ?>
                              </select>

                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Status
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">
                            
                              <select name="LocationStatus" class="form-control form-control-lg custom-select font-sm">
                                  <option value="A" <?php echo ( $LocationSet['location_status'] == 'A' ) ? 'SELECTED' : NULL ?> >Active</option>
                                  <option value="I" <?php echo ( $LocationSet['location_status'] == 'I' ) ? 'SELECTED' : NULL ?> >Inactive</option>
                              </select>

                          </div>
                          
                      </div>

                  </div>

                  <div class="modal-footer">                           
                      <input type="hidden" value="<?php echo $LocationSet['id']; ?>" name="BranchID" />                                                    
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-warning font-weight-light" type="submit" name="btnUpdate"><i class="fa fa-plus"></i>  Update Branch Details  </button>                                                  
                      
                  </div>

              </form>
              
          </div>

      </div>

  </div>

  <div class="modal fadeIn animated" id="UpdateOperatingHours<?php echo $LocationSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/branches">

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

                              if ( !empty( $LocationSet['location_hours'] ) ) : 

                                foreach( explode( ',', $LocationSet['location_hours'] ) as $Day ) :

                                      list( $d, $start, $stop )    =   explode( '-', $Day );

                                      $Days[ $d ]     =   [ $start, $stop ];

                                endforeach;

                              endif;

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
                    <input type="hidden" value="<?php echo $LocationSet['id']; ?>" name="BranchID" />                                     
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-pink font-weight-light" type="submit" name="btnUpdateOpHours"><i class="fa fa-pencil"></i>  Update Operating Hours  </button>                                                                      
                </div>

            </form>
            
        </div>

    </div>

  </div>

  <div class="modal fadeIn animated" id="UpdateModules<?php echo $LocationSet['id']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/branches">

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

                                          if ( in_array( $Module['ModuleID'], explode( ',', $LocationSet['location_modules'] ) ) ) :
                                              
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
                      <input type="hidden" value="<?php echo $LocationSet['id']; ?>" name="BranchID" />                                                                                                                
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-purple font-weight-light" type="submit" name="btnUpdateModules"><i class="fa fa-pencil"></i>  Add/Remove Module(s) </button>                                                  
                      
                  </div>

              </form>
              
          </div>

      </div>

  </div>

<?php endforeach; endif; ?>