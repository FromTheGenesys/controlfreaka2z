<div class="container-fluid mt-4">

  <div class="animated fadeIn">

    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-body"> 

                    <h3>MANAGE <strong>MESSAGES</strong></h3>

                    <?php if ( !isset( $this->setMessage ) ) : ?>

                        <div class="alert alert-primary border-primary">
                            <b class="font-weight-normal">Display all system wide messages.</b>
                        </div>                    

                    <?php else: ?>

                        <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                            <?php echo $this->setMessage[1]; ?>
                        </div>                    

                    <?php endif; ?>

                    <button class="font-sm btn-dark btn-lg" type="button" onclick="location.href='<?php echo gpConfig['URLPATH'] . _ACCESS_; ?>'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                    <button class="font-sm btn-success btn-lg" type="button" data-target="#NewMessage" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;New Message</button>

                </div>

            </div>

        </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <?php if ( $this->GetAllMessages['count'] > 0 ) : ?>

              <br>
              <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                <thead class="thead-light font-weight-normal">
                  <tr>                  
                    <th>Message</th>
                    <th class="text-left">Location</th>
                    <th>Starts</th>
                    <th>Ends</th>                  
                    <th class="text-center">Focus</th>                                    
                    <th class="text-center">Status</th>                                    
                    <th class="text-center">Task</th>                                    
                  </tr>
                </thead>
                <tbody>

                <?php foreach( $this->GetAllMessages['data'] as $MessageSet ) : ?>

                  <tr>
                    <td>
                      <div><?php echo $MessageSet['MessageBody']; ?></div>                    
                    </td>

                    <td>
                      <div class="text-left">
                        <?php echo  ( $MessageSet['MessageLocation'] == '*' ) ? 'ALL LOCATIONS' : strtoupper( $this->LogicAdmin->GetBranch( $MessageSet['MessageLocation'] )['data'][0]['location_name'] ); ?>
                      </div>                                      
                    </td>
                    <td class="text-left">
                      <div>
                        <?php echo date( 'd-M-Y \a\t h:i a', strtotime( $MessageSet['MessageStart'] ) ); ?>
                      </div>
                      
                    </td>

                    <td class="text-left">
                      <div>
                        <?php echo date( 'd-M-Y \a\t h:i a', strtotime( $MessageSet['MessageStop'] ) ); ?>
                      </div>                     
                    </td>

                    <td class="text-center">                      
                      <div>
                        <?php echo ( $MessageSet['MessageFocus'] == '1' ) ? '<i class="fa fa-check text-success" style="font-size: 18px"' : '<i class="fa fa-times text-danger" style="font-size: 18px"'; ?>
                      </div>
                    </td>
                    
                    <td class="text-center">                      
                        <div class="">
                          <?php echo ( $MessageSet['MessageStatus'] == 'A' ) ? '<i class="fa fa-check text-success" style="font-size: 18px"' : '<i class="fa fa-times text-danger" style="font-size: 18px"'; ?>
                        </div>
                    </td>
                  
                    <td class="text-center">
                      <i style="font-size: 18px;" class="fa fa-pencil text-warning" data-target="#UpdateMessage<?php echo $MessageSet['MessageID']; ?>" data-toggle="modal"></i>                     
                      &nbsp;
                      <i style="font-size: 18px;" class="fa fa-trash text-danger" data-target="#DeleteMessage<?php echo $MessageSet['MessageID']; ?>" data-toggle="modal"></i>                     
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


<div class="modal fadeIn animated" id="NewMessage" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/messages">

                  <div class="modal-header bg-success">
                      <h4 class="modal-title text-white">ADD <strong>MESSAGE</strong></h4>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-success border-success">
                              Enter the details of your system wide message using the form below.
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Message Content
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">
                              <textarea name="MessageContent" placeholder="Message Content" class="form-control" rows="3"></textarea>
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Locations
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                              <select name="Locations" class="form-control form-control-lg custom-select font-sm">
                                  <option value="*" > --- ALL LOCATIONS ---</option>
                                  <?php

                                    foreach( $this->GetAllBranches['data'] as $BranchSet ) : if ( $BranchSet['location_status'] == 'A' ) :

                                      echo '<option value=""';

                                      echo '>'. strtoupper( $BranchSet['location_name'] ) .'</option>';

                                    endif; endforeach;

                                  ?>
                              </select>
                          </div>
                          

                          <div class="row">

                                <div class="col-md-6">

                                  <div class="div mt-3 text-dark font-weight-bold">
                                      Start Date
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    
                                    <input name="StartDate" type="date" placeholder="Start Date" required value="<?php echo $this->StartDate; ?>" required class="form-control form-control-lg font-sm" />                              

                                  </div>
                                </div>
                                <div class="col-md-6">

                                <div class="div mt-3 text-dark font-weight-bold">
                                      Stop Date
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    
                                     <input name="StopDate" type="date" placeholder="Stop Date" required value="<?php echo $this->StopDate; ?>" required class="form-control form-control-lg font-sm" />                              

                                  </div>


                                </div>

                          </div>
                          
                          <div class="row">

                                <div class="col-md-6">

                                  <div class="div mt-3 text-dark font-weight-bold">
                                      Status
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    
                                      <select name="Status" class="form-control form-control-lg custom-select font-sm">
                                          <option value="A">Active</option>
                                          <option value="I">Inactive</option>
                                      </select>

                                  </div>
                                </div>
                                <div class="col-md-6">

                                <div class="div mt-3 text-dark font-weight-bold">
                                      Focus
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    
                                  <select name="Focus" class="form-control form-control-lg custom-select font-sm">
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                  </select>

                                  </div>


                                </div>

                          </div>

                         
                          
                      </div>

                  </div>

                  <div class="modal-footer">                                                                                                
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-success font-weight-light" type="submit" name="btnAdd"><i class="fa fa-plus"></i>  Add Message Details  </button>                                                                        
                  </div>

              </form>
              
          </div>

      </div>

  </div>

  <?php if ( $this->GetAllMessages['count'] > 0 ) : foreach( $this->GetAllMessages['data'] as $MessageSet ) : ?>

    <div class="modal fadeIn animated" id="UpdateMessage<?php echo $MessageSet['MessageID']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/messages">

                  <div class="modal-header bg-warning">
                      <h4 class="modal-title text-white">UPDATE <strong>MESSAGE</strong></h4>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-warning border-warning">
                              Update the details of your system wide message using the form below.
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Message Content
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">
                              <textarea name="MessageContent" placeholder="Message Content" class="form-control" rows="3"><?php echo $MessageSet['MessageBody']; ?></textarea>
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Locations
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">

                              <select name="Locations" class="form-control form-control-lg custom-select font-sm">
                                  <option value="*" > --- ALL LOCATIONS ---</option>
                                  <?php

                                    foreach( $this->GetAllBranches['data'] as $BranchSet ) : if ( $BranchSet['location_status'] == 'A' ) :

                                      echo '<option value="'. $BranchSet['id'] .'"';

                                      if ( $BranchSet['id'] == $MessageSet['MessageLocation'] ) :

                                        echo ' SELECTED ';

                                      endif;

                                      echo '>'. strtoupper( $BranchSet['location_name'] ) .'</option>';

                                    endif; endforeach;

                                  ?>
                              </select>
                          </div>
                          

                          <div class="row">

                                <div class="col-md-6">

                                  <div class="div mt-3 text-dark font-weight-bold">
                                      Start Date
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    
                                    <input name="StartDate" type="date" placeholder="Start Date" required value="<?php echo explode( ' ', $MessageSet['MessageStart'] )[0]; ?>" required class="form-control form-control-lg font-sm" />                              

                                  </div>
                                </div>
                                <div class="col-md-6">

                                <div class="div mt-3 text-dark font-weight-bold">
                                      Stop Date
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    
                                     <input name="StopDate" type="date" placeholder="Stop Date" required value="<?php echo explode( ' ', $MessageSet['MessageStop'] )[0]; ?>" required class="form-control form-control-lg font-sm" />                              

                                  </div>


                                </div>

                          </div>
                          
                          <div class="row">

                                <div class="col-md-6">

                                  <div class="div mt-3 text-dark font-weight-bold">
                                      Status
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    
                                      <select name="Status" class="form-control form-control-lg custom-select font-sm">
                                          <option value="A" <?php echo ( $MessageSet['MessageStatus'] == 'A' ) ? 'SELECTED' : NULL; ?>>Active</option>
                                          <option value="I" <?php echo ( $MessageSet['MessageStatus'] == 'I' ) ? 'SELECTED' : NULL; ?>>Inactive</option>
                                      </select>

                                  </div>
                                </div>
                                <div class="col-md-6">

                                <div class="div mt-3 text-dark font-weight-bold">
                                      Focus
                                  </div>

                                  <div class="div mt-2 text-dark font-weight-normal">
                                    
                                  <select name="Focus" class="form-control form-control-lg custom-select font-sm">
                                      <option value="0" <?php echo ( $MessageSet['MessageFocus'] == '0' ) ? 'SELECTED' : NULL; ?>>No</option>
                                      <option value="1" <?php echo ( $MessageSet['MessageFocus'] == '1' ) ? 'SELECTED' : NULL; ?>>Yes</option>
                                  </select>

                                  </div>


                                </div>

                          </div>

                         
                          
                      </div>

                  </div>

                  <div class="modal-footer">  
                      <input type="hidden" value="<?php echo $MessageSet['MessageID']; ?>" name="MessageID" />                                                                                                                                                                               
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-warning font-weight-light" type="submit" name="btnUpdate"><i class="fa fa-plus"></i>  Update Message Details  </button>                                                                        
                  </div>

              </form>
              
          </div>

      </div>

    </div>

    <div class="modal fadeIn animated" id="DeleteMessage<?php echo $MessageSet['MessageID']; ?>" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">

              <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/messages">

                  <div class="modal-header bg-danger">
                      <h4 class="modal-title text-white">DELETE <strong>MESSAGE</strong></h4>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  
                  <div class="modal-body">

                      <div class="form-body text-dark"> 
                      
                          <div class="alert alert-danger border-danger">
                              Delete the details of this message from the system.
                          </div>

                          <div class="div mt-3 text-dark font-weight-bold">
                              Message Content
                          </div>

                          <div class="div mt-2 text-dark font-weight-normal">
                              <?php echo $MessageSet['MessageBody']; ?>
                          </div>

                      </div>

                  </div>

                  <div class="modal-footer">               
                      <input type="hidden" value="<?php echo $MessageSet['MessageID']; ?>" name="MessageID" />                                                                                 
                      <button class="font-sm btn-lg btn-dark font-weight-light" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                      <button class="font-sm btn-lg btn-danger font-weight-light" type="submit" name="btnDelete"><i class="fa fa-plus"></i>  Delete Message  </button>                                                                        
                  </div>

              </form>
              
          </div>

      </div>

    </div>


  <?php endforeach; endif; ?>