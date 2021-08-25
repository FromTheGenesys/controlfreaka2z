<!-- Main content -->
<main class="main">

<div class="container-fluid mt-4">

  <div class="animated fadeIn">

    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-body"> 

                    <h3>REGISTERED <strong>MODULES</strong></h3>

                    <?php if ( !isset( $this->setMessage ) ) : ?>

                        <div class="alert alert-primary border-primary">
                            <b class="font-weight-normal">View all registered MVP Modules</b>
                        </div>                    

                    <?php else: ?>

                        <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                            <?php echo $this->setMessage[1]; ?>
                        </div>                    

                    <?php endif; ?>

                    <button class="font-sm btn-dark btn-lg" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                    <button class="font-sm btn-teal btn-lg" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator/modules'"><i class="fa fa-cubes"></i>&nbsp;View All Modules</button>
                    <button class="font-sm btn-warning btn-lg" type="button" data-target="#UpdateModule" data-toggle="modal"><i class="fa fa-pencil"></i>&nbsp;Update Module</button>

                </div>

            </div>

        </div>

    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">

            <h4>MODULE <strong>DETAILS</strong></h4>

            <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
              
                <tr>                  
                  <td>Name</td>
                  <td><?php echo $this->GetModule['data'][0]['ModuleName']; ?></td>              
                </tr>
              
                <tr>                  
                  <td>Description</td>
                  <td><?php echo $this->GetModule['data'][0]['ModuleDescription']; ?></td>              
                </tr>
              
                <tr>                  
                  <td>Status</td>
                  <td><?php echo ( $this->GetModule['data'][0]['ModuleStatus'] == 'A' ) ? 'Active' : 'Inactive'; ?></td>              
                </tr>              
            </table>
            
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="card">
          <div class="card-body">

            <h4>ASSIGNED <strong>LOCATIONS</strong></h4>

            <?php if ( $this->GetModuleLocations['count'] == 0 ): ?>

              <div class="alert alert-warning border-warning">
                  There are no branches to which this module is assigned.
              </div>

            <?php else: ?>

                  <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                    <thead class="thead-light font-weight-normal">
                        <tr>                                              
                            <th>Branch</th>
                            <th>Region</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach( $this->GetModuleLocations['data'] as $LocationSet ) : ?>

                          <tr>
                          
                            <td>
                                <div class="text-left">
                                  <a style="text-decoration: none;" href="<?php echo gpConfig['URLPATH']; ?>administrator/location/<?php echo $LocationSet['id']; ?>">
                                    <?php echo $LocationSet['location_name']; ?>
                                  </a>
                                </div>                                                     
                            </td>


                            <td class="text-left">
                                <div>
                                    <?php echo  $this->LocationRegions[ $LocationSet['location_region'] ]; ?>
                                </div>                                    
                            </td>

                            <td class="text-left">
                                <div>
                                    <?php echo  $this->LocationTypes[ $LocationSet['location_type'] ]; ?>
                                </div>                                   
                            </td>

                            <td class="text-left">
                                <div>
                                    <?php if ( $LocationSet['location_status'] == 'A' ) : ?>
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
      <!--/.col-->
    </div>
    <!--/.row-->

  </div>

</div>
<!-- /.conainer-fluid -->
</main>

<div class="modal fadeIn animated" id="UpdateModule" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/module/<?php echo $this->ModuleID; ?>">

                <div class="modal-header bg-warning">
                    <h4 class="modal-title text-white">UPDATE <strong>MODULE</strong></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-warning border-warning">
                            Update Module Details
                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Module Name
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <input name="ModuleName" readonly type="text" placeholder="Module Name" required value="<?php echo $this->GetModule['data'][0]['ModuleName']; ?>" required class="form-control form-control-lg font-sm" />

                        </div>


                        <div class="div mt-3 text-dark font-weight-bold">
                            Module Description 
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <textarea name="ModuleDescription" class="form-control form-control-lg font-sm" rows="5" placeholder="Description of Module"><?php echo $this->GetModule['data'][0]['ModuleDescription']; ?></textarea>

                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Status
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">
                            
                            <select name="ModuleStatus" class="form-control form-control-lg custom-select font-sm">
                                <option value="A" <?php echo ( $this->GetModule['data'][0]['ModuleStatus'] == 'A' ) ? 'SELECTED' : NULL ?> >Active</option>
                                <option value="I" <?php echo ($this->GetModule['data'][0]['ModuleStatus'] == 'I' ) ? 'SELECTED' : NULL ?> >Inactive</option>
                            </select>

                        </div>
                        
                    </div>

                </div>

                <div class="modal-footer">                           
                    <input type="hidden" value="<?php echo $this->GetModule['data'][0]['ModuleID']; ?>" name="ModuleID" />                                                    
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-warning font-weight-light" type="submit" name="btnUpdate"><i class="fa fa-pencil"></i>  Update Module  </button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

