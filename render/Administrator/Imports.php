<!-- Main content -->

<div class="container-fluid mt-4">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col">

                <div class="card">

                    <div class="card-body"> 

                        <h3>DAILY <strong>IMPORTS</strong></h3>

                        <?php if ( !isset( $this->setMessage ) ) : ?>

                            <div class="alert alert-teal border-teal">
                                <b class="font-weight-normal">View all Daily MVP Imports</b>
                            </div>                    

                        <?php else: ?>

                            <div class="alert alert-<?php echo $this->setMessage[0]; ?> border-<?php echo $this->setMessage[0]; ?>">
                                <?php echo $this->setMessage[1]; ?>
                            </div>                    

                        <?php endif; ?>

                        <button class="font-sm btn-dark btn-lg" type="button" onclick="location.href='<?php echo gpConfig['URLPATH']; ?>administrator'"><i class="fa fa-desktop"></i>&nbsp;Dashboard</button>
                        
                    </div>

                </div>

            </div>

        </div>

        <div class="row">
                            
            <div class="col-md-4"> 

                <div class="row">

                    <div class="col-md-6"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">

                                <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/logos/BPL.png" style="width: 100px"/>                        
                                <button type="button" data-target="#ReloadBPLData" data-toggle="modal" class="mt-2 btn-lg btn-success font-sm btn-block"><i class="fa fa-plus"></i> Reload Data</button>
                                
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-md-6"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">

                                <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/logos/BTC.png" style="width: 100px"/>                        
                                <button type="button" data-target="#ReloadBTCData" data-toggle="modal" class="mt-2 btn-lg btn-success font-sm btn-block"><i class="fa fa-plus"></i> Reload Data</button>
                                
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-md-6"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">

                                <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/logos/WSC.png" style="width: 100px"/>                        
                                <button type="button" data-target="#ReloadWSCData" data-toggle="modal" class="mt-2 btn-lg btn-success font-sm btn-block"><i class="fa fa-plus"></i> Reload Data</button>
                                
                            </div>

                        </div>
                        
                    </div>

                    <div class="col-md-6"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">
                            
                                <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/logos/GBP.png" style="width: 100px"/>                        
                                <button type="button" data-target="#ReloadGBPData" data-toggle="modal" class="mt-2 btn-lg btn-success font-sm btn-block"><i class="fa fa-plus"></i> Reload Data</button>
                                
                            </div>

                        </div>
                        
                    </div>

                    <div class="col-md-6"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">
                                
                                <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/logos/GBU.png" style="width: 100px"/>                        
                                <button type="button" data-target="#ReloadGBUData" data-toggle="modal" class="mt-2 btn-lg btn-success font-sm btn-block"><i class="fa fa-plus"></i> Reload Data</button>
                                
                            </div>

                        </div>
                        
                    </div>

                    <div class="col-md-6"> 
                    
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">

                                <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/baf.png" style="width: 80px"/>                        
                                <button type="button" data-target="#ReloadIGASData" data-toggle="modal" class="mt-2 btn-lg btn-success font-sm btn-block"><i class="fa fa-plus"></i> Reload Data</button>
                                
                            </div>
                            
                        </div>
                        
                    </div>

                </div>

            </div>

            <div class="col-md-8">

                <div class="card text-center font-weight-normal">

                    <div class="card-body">

                        <h4>DAILY <strong>IMPORT LOG</strong></h4>

                        <table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">
                            <thead class="thead-light font-weight-normal">
                                <tr>                  
                                    <th>Vendor</th>
                                    <th class="text-center">Date</th>
                                    <th>Start Time</th>
                                    <th>Completed Time</th>
                                    <th>FileName</th>
                                    <th class="text-left">Records</th>                                                  
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>

        <!--/.row-->

    </div>

</div>
    

<div class="modal fadeIn animated" id="ReloadBPLData" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/imports">

                <div class="modal-header bg-teal">
                    <h5 class="modal-title text-white">RELOAD <strong>BPL Data</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-success border-success">
                            This process may take up to 5 minutes. During this period, you will not be able to process any BPL Payments in store.  A system alert will be automatically generated while this process is on-going and until such time as this process is completed. <strong>DO YOU WISH TO CONTINUE?</strong>
                        </div>
   
                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-teal" type="submit" name="btnReloadBPL"><i class="fa fa-thumbs-up"></i>  Reload BPL Customer Data</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ReloadBTCData" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/imports">

                <div class="modal-header bg-teal">
                    <h5 class="modal-title text-white">RELOAD <strong>BTC Data</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-success border-success">
                            This process may take up to 5 minutes. During this period, you will not be able to process any BTC Payments in store.  A system alert will be automatically generated while this process is on-going and until such time as this process is completed. <strong>DO YOU WISH TO CONTINUE?</strong>
                        </div>
   
                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-teal" type="submit" name="btnReloadBPL"><i class="fa fa-thumbs-up"></i>  Reload BTC Customer Data</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ReloadWSCData" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/imports">

                <div class="modal-header bg-teal">
                    <h5 class="modal-title text-white">RELOAD <strong>WSC Data</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-success border-success">
                            This process may take up to 5 minutes. During this period, you will not be able to process any WSC Payments in store.  A system alert will be automatically generated while this process is on-going and until such time as this process is completed. <strong>DO YOU WISH TO CONTINUE?</strong>
                        </div>
   
                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-teal" type="submit" name="btnReloadBPL"><i class="fa fa-thumbs-up"></i>  Reload WSC Customer Data</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ReloadGBPData" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/imports">

                <div class="modal-header bg-teal">
                    <h5 class="modal-title text-white">RELOAD <strong>GBP Data</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-success border-success">
                            This process may take up to 5 minutes. During this period, you will not be able to process any GBP Payments in store.  A system alert will be automatically generated while this process is on-going and until such time as this process is completed. <strong>DO YOU WISH TO CONTINUE?</strong>
                        </div>
   
                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-teal" type="submit" name="btnReloadBPL"><i class="fa fa-thumbs-up"></i>  Reload GBP Customer Data</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ReloadGBUData" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/imports">

                <div class="modal-header bg-teal">
                    <h5 class="modal-title text-white">RELOAD <strong>GBU Data</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-success border-success">
                            This process may take up to 5 minutes. During this period, you will not be able to process any GBU Payments in store.  A system alert will be automatically generated while this process is on-going and until such time as this process is completed. <strong>DO YOU WISH TO CONTINUE?</strong>
                        </div>
   
                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-teal" type="submit" name="btnReloadGBU"><i class="fa fa-thumbs-up"></i>  Reload GBU Customer Data</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>

<div class="modal fadeIn animated" id="ReloadIGASData" tabindex="-2" role="dialog" aria-labelledby="myCreateFolder" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="<?php echo gpConfig['URLPATH']; ?>administrator/imports">

                <div class="modal-header bg-teal">
                    <h5 class="modal-title text-white">RELOAD <strong>IGAS Data</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div class="form-body text-dark"> 
                    
                        <div class="alert alert-success border-success">
                            This process may take up to 5 minutes. During this period, you will not be able to process any IGAS Payments in store.  A system alert will be automatically generated while this process is on-going and until such time as this process is completed. <strong>DO YOU WISH TO CONTINUE?</strong>
                        </div>
   
                    </div>

                </div>

                <div class="modal-footer">                                                                               
                    <button class="font-sm btn-lg btn-dark" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>                                                  
                    <button class="font-sm btn-lg btn-teal" type="submit" name="btnReloadIGAS"><i class="fa fa-thumbs-up"></i>  Reload IGAS Customer Data</button>                                                  
                    
                </div>

            </form>
            
        </div>

    </div>

</div>