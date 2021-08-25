<!-- Main content -->

<div class="container-fluid mt-4">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col">

                <div class="card">

                    <div class="card-body"> 

                        <h3>REGISTERED <strong>MODULES</strong></h3>

                        <?php if ( !isset( $this->setMessage ) ) : ?>

                            <div class="alert alert-teal border-teal">
                                <b class="font-weight-normal">View all registered MVP Modules</b>
                            </div>                    

                        <?php else: ?>

                            <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                                <?php echo $this->setMessage[1]; ?>
                            </div>                    

                        <?php endif; ?>

                        <button class="font-sm btn-dark btn-lg" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                        <button class="font-sm btn-teal btn-lg" type="button" data-target="#RegisterModule" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Register Module</button>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body">

                <table class="table table-responsive-sm table-hover table-striped table-outline mb-0">
                <thead class="thead-light font-weight-normal">
                    <tr>                  
                    <th>Module ID</th>
                    <th>Name</th>
                    <th>Description</th>                              
                    <th class="text-center">Status</th>                                    
                    <th class="text-center">Task</th>                                    
                    </tr>
                </thead>
                <tbody>

                <?php foreach( $this->GetModules['data'] as $ModSet ) : ?>

                    <tr>
                    <td>
                        <div><a style="text-decoration: none;" href="<?php echo gpConfig['URLPATH']; ?>administrator/module/<?php echo $ModSet['ModuleID']; ?>"><?php echo $ModSet['ModuleID']; ?></a></div>                    
                    </td>

                    <td class="text-left">
                        <div>
                        <?php echo  $ModSet['ModuleName'] ; ?>
                        </div>                   
                    </td>

                    <td class="text-left">
                        <div>
                            <?php echo  $ModSet['ModuleDescription'] ; ?>
                        </div>                    
                    </td>

                    
                    
                    <td class="text-center">
                        <?php if ( $ModSet['ModuleStatus'] == 'A' ) : ?>
                            <i class="fa fa-check text-success" style="font-size:24px"></i>
                        <?php else: ?>
                            <i class="fa fa-times text-red" style="font-size:24px"></i>
                        <?php endif; ?>

                        <div class="small text-muted">
                            <?php echo ( $ModSet['ModuleStatus'] == 'A' ) ? 'Active' : 'Inactive'; ?>
                        </div>

                    </td>
                    
                    <td class="text-center">
                        <button type="button" class="btn btn-link text-muted" data-target="#UpdateModule<?php echo $ModSet['ModuleID']; ?>" data-toggle="modal"><i style="font-size: 18px;" class="fa fa-pencil"></i></button> 
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
    



<div class="modal fadeIn animated" id="RegisterModule" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/modules">

                <div class="modal-header bg-teal">
                    <h4 class="modal-title text-white">REGISTER <strong>MODULE</strong></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-teal border-teal">
                            Add Module Details
                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Module Name
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <input name="ModuleName" autocomplete="off" type="text" placeholder="Module Name" required class="form-control form-control-lg font-sm" />

                        </div>


                        <div class="div mt-3 text-dark font-weight-bold">
                            Module Description 
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <textarea name="ModuleDescription" class="form-control form-control-lg font-sm" rows="5" placeholder="Description of Module"></textarea>

                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Status
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <select name="ModuleStatus" class="form-control form-control-lg custom-select font-sm">
                                <option value="A">Active</option>
                                <option value="I">Inactive</option>
                            </select>

                        </div>
                        
                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-teal font-weight-light" type="submit" name="btnRegister"><i class="fa fa-plus"></i>  Register Module  </button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<?php if ( $this->GetModules['count'] > 0 ) :foreach( $this->GetModules['data'] as $ModSet ) : ?>

  <div class="modal fadeIn animated" id="UpdateModule<?php echo $ModSet['ModuleID']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/modules">

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

                              <input name="ModuleName" readonly type="text" placeholder="Module Name" required value="<?php echo $ModSet['ModuleName']; ?>" required class="form-control form-control-lg font-sm" />

                          </div>


                          <div class="div mt-3 text-dark font-weight-bold">
                              Module Description 
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                              <textarea name="ModuleDescription" class="form-control form-control-lg font-sm" rows="5" placeholder="Description of Module"><?php echo $ModSet['ModuleDescription']; ?></textarea>

                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Status
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">
                             
                              <select name="ModuleStatus" class="form-control form-control-lg custom-select font-sm">
                                  <option value="A" <?php echo ( $ModSet['ModuleStatus'] == 'A' ) ? 'SELECTED' : NULL ?> >Active</option>
                                  <option value="I" <?php echo ( $ModSet['ModuleStatus'] == 'I' ) ? 'SELECTED' : NULL ?> >Inactive</option>
                              </select>

                          </div>
                          
                      </div>

                  </div>

                  <div class="modal-footer">                           
                      <input type="hidden" value="<?php echo $ModSet['ModuleID']; ?>" name="ModuleID" />                                                    
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-warning font-weight-light" type="submit" name="btnUpdate"><i class="fa fa-pencil"></i>  Update Module  </button>                                                  
                      
                  </div>

              </form>
              
          </div>

      </div>

  </div>

<?php endforeach; endif; ?>