<!-- Main content -->

<div class="container-fluid mt-4">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col">

                <div class="card">

                    <div class="card-body"> 

                        <h3>COLLECTION <strong>COMPANIES</strong></h3>

                        <?php if ( !isset( $this->setMessage ) ) : ?>

                            <div class="alert alert-teal border-teal">
                                <b class="font-weight-normal">View all Collections Companies</b>
                            </div>                    

                        <?php else: ?>

                            <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                                <?php echo $this->setMessage[1]; ?>
                            </div>                    

                        <?php endif; ?>

                        <button class="font-sm btn-dark btn-lg" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                        <button class="font-sm btn-teal btn-lg" type="button" data-target="#AddCollectionCompany" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Add Collection Company Details</button>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body">

            <?php if( $this->GetAllCompanies['count'] == 0 ) : ?>

                <div class="alert alert-warning border-warning">
                    There are no company details available.
                </div>

            <?php else: ?>

                <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                <thead class="thead-light font-weight-normal">
                    <tr>                  
                    <th>Company ID</th>
                    <th>Name</th>
                    <th>Description</th>                              
                    <th class="text-center">Status</th>                                    
                    <th class="text-left">Created</th>                                    
                    <th class="text-center">Task</th>                                    
                    </tr>
                </thead>
                <tbody>

                <?php foreach( $this->GetAllCompanies['data'] as $CollectionSet ) : ?>

                    <tr>
                    <td>
                        <div><?php echo $CollectionSet['CompanyID']; ?></div>                    
                    </td>

                    <td class="text-left">
                        <div>
                        <?php echo  $CollectionSet['CompanyName'] ; ?>
                        </div>                   
                    </td>

                    <td class="text-left">
                        <div>
                            <?php echo  $CollectionSet['CompanyDescription'] ; ?>
                        </div>                    
                    </td>

                    <td class="text-center">
                        <?php if ( $CollectionSet['CompanyStatus'] == 'A' ) : ?>
                            <i class="fa fa-check text-success" style="font-size:24px"></i>
                        <?php else: ?>
                            <i class="fa fa-times text-red" style="font-size:24px"></i>
                        <?php endif; ?>

                        <div class="small text-muted">
                            <?php echo ( $CollectionSet['CompanyStatus'] == 'A' ) ? 'Active' : 'Inactive'; ?>
                        </div>

                    </td>

                    <td class="text-left">
                        <div>
                            <?php echo date( 'd-M-Y \a\t h:i a', strtotime( $CollectionSet['CompanyCreated'] ) ) ; ?>
                        </div>                    
                    </td>
                    
                    <td class="text-center">
                        <i data-target="#UpdateCompany<?php echo $CollectionSet['CompanyGUID']; ?>" data-toggle="modal" style="font-size: 18px;" class="fa fa-pencil text-warning"></i>
                        &nbsp;
                        <i data-target="#UpdatePhoto<?php echo $CollectionSet['CompanyGUID']; ?>" data-toggle="modal" style="font-size: 18px;" class="fa fa-camera text-primary"></i>
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
    



<div class="modal fadeIn animated" id="AddCollectionCompany" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" enctype="multipart/form-data" action="<?php echo gpConfig['URLPATH']; ?>administrator/collections">

                <div class="modal-header bg-teal">
                    <h5 class="modal-title text-white">COLLECTION <strong>COMPANY DETAILS</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-success border-success">
                            Add Collection Company Details
                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Company Name
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <input name="CompanyName" autocomplete="off" type="text" placeholder="Company Name" required class="form-control form-control-lg font-sm" />

                        </div>


                        <div class="div mt-3 text-dark font-weight-bold">
                            Company Description 
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <textarea name="CompanyDescription" class="form-control form-control-lg font-sm" rows="5" placeholder="Description of the Company"></textarea>

                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Company Logo
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <input name="CompanyLogo" autocomplete="off" type="file" required class="form-control form-control-lg font-sm" />

                        </div>

                        <div class="div mt-3 text-dark font-weight-bold">
                            Status
                        </div>

                        <div class="div mt-2 text-dark font-weight-normal">

                            <select name="CompanyStatus" class="form-control form-control-lg custom-select font-sm">
                                <option value="A">Active</option>
                                <option value="I">Inactive</option>
                            </select>

                        </div>
                        
                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-teal" type="submit" name="btnAdd"><i class="fa fa-plus"></i>  Add Collection Company</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<?php if ( $this->GetAllCompanies['count'] > 0 ) :foreach( $this->GetAllCompanies['data'] as $CompanySet ) : ?>

  <div class="modal fadeIn animated" id="UpdateCompany<?php echo $CompanySet['CompanyGUID']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/collections">

                  <div class="modal-header bg-warning">
                      <h5 class="modal-title text-white">UPDATE <strong>COMPANY DETAILS</strong></h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-warning border-warning">
                              Update Company Details
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Company Name
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                              <input name="CompanyName" type="text" placeholder="Module Name" required value="<?php echo $CompanySet['CompanyName']; ?>" required class="form-control form-control-lg font-sm" />
                              <input name="CompanyNameOld" type="hidden" value="<?php echo $CompanySet['CompanyName']; ?>" />

                          </div>


                          <div class="div mt-3 text-dark font-weight-bold">
                              Company Description 
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                              <textarea name="CompanyDescription" class="form-control form-control-lg font-sm" rows="5" placeholder="Description of Company"><?php echo $CompanySet['CompanyDescription']; ?></textarea>

                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Status
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">
                             
                              <select name="CompanyStatus" class="form-control form-control-lg custom-select font-sm">
                                  <option value="A" <?php echo ( $CompanySet['CompanyStatus'] == 'A' ) ? 'SELECTED' : NULL ?> >Active</option>
                                  <option value="I" <?php echo ( $CompanySet['CompanyStatus'] == 'I' ) ? 'SELECTED' : NULL ?> >Inactive</option>
                              </select>

                          </div>
                          
                      </div>

                  </div>

                  <div class="modal-footer">                           
                      <input type="hidden" value="<?php echo $CompanySet['CompanyGUID']; ?>" name="CompanyGUID" />                                                    
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-warning font-weight-light" type="submit" name="btnUpdate"><i class="fa fa-pencil"></i>  Update Company Details  </button>                                                  
                      
                  </div>

              </form>
              
          </div>

      </div>

  </div>

  <div class="modal fadeIn animated" id="UpdatePhoto<?php echo $CompanySet['CompanyGUID']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" enctype="multipart/form-data" action="<?php echo gpConfig['URLPATH']; ?>administrator/collections">

                  <div class="modal-header bg-primary">
                      <h5 class="modal-title text-white">UPDATE <strong>COMPANY LOGO</strong></h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-primary border-primary">
                              Update the company logo. The file must be at a .png, .jpg or .gif format and must be less than 2MB.
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Browse your computer for the photo
                          </div>

                          <?php if ( !empty( $CompanySet['CompanyLogo'] ) ) : ?>
                            <div class="div mt-2 text-dark font-weight-normal">
                                <img class="img-fluid" src="<?php echo gpConfig['URLPATH'] . gpConfig['DATA'] . gpConfig['UPLOADS'] .'CollectionCompanies/'. $CompanySet['CompanyID'] .'/'. $CompanySet['CompanyLogo']; ?>" />                                
                          </div>
                          <?php endif; ?>

                          <?php if ( !empty( $CompanySet['CompanyLogo'] ) ) : ?>
                                <div class="div mt-2 text-dark font-weight-normal">
                                    <input name="overwrite" type="checkbox" value="1" required />&nbsp;Overwrite this file                           
                                </div>
                          <?php endif; ?>

                          <div class="div mt-2 text-dark font-weight-normal">
                              <input name="CompanyLogo" type="file" required class="form-control form-control-lg font-sm" />                              
                          </div>

                      </div>

                  </div>

                  <div class="modal-footer">                           
                      <input type="hidden" value="<?php echo $CompanySet['CompanyGUID']; ?>" name="CompanyGUID" />                                                    
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-primary font-weight-light" type="submit" name="btnUpdatePhoto"><i class="fa fa-photo"></i>  Add/Update Company Logo  </button>                                                                        
                  </div>

              </form>
              
          </div>

      </div>

  </div>

<?php endforeach; endif; ?>