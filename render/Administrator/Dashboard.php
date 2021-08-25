<div class="container-fluid mt-4">

    <div class="animated fadeIn">

        <div class="row">
        
            <div class="col-12">

                <div class="card border-white">

                    <div class="card-body">
                        
                        <h3 class="text-dark">ADMINISTRATOR <strong>DASHBOARD</strong></h3>

                        <div class="alert alert-primary border-primary">
                            Hello <span class="font-weight-bold"><?php echo $_SESSION['sessFirstName']; ?></span>. Select one of the available options below to begin.
                        </div>

                    </div>
                    
                </div>

                <div class="row">
                            
                    <div class="col-md"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">
                                <a href="<?php echo gpConfig['URLPATH']; ?>administrator/accounts">
                                    <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/user-icon.png" style="width: 80px"/>
                                </a>
                                <h5 class="mt-3">MANAGE <strong>ACCOUNTS</strong></h5>
                                
                            </div>
                            
                        </div>
                        
                    </div>

                    
                    <div class="col-md"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">
                                <a href="<?php echo gpConfig['URLPATH']; ?>administrator/branches">
                                    <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/branches.png" style="width: 80px"/>
                                </a>
                                <h5 class="mt-3">MANAGE <strong>BRANCHES</strong></h5>
                                
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-md"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">
                                <a href="<?php echo gpConfig['URLPATH']; ?>administrator/modules">
                                    <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/modules.png" style="width: 80px"/>
                                </a>
                                <h5 class="mt-3">MANAGE <strong>MODULES</strong></h5>
                                
                            </div>

                        </div>
                        
                    </div>

                    <div class="col-md"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">
                                <a href="<?php echo gpConfig['URLPATH']; ?>administrator/messages">
                                    <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/messages.png" style="width: 80px"/>
                                </a>
                                <h5 class="mt-3">MANAGE <strong>MESSAGES</strong></h5>
                                
                            </div>

                        </div>
                        
                    </div>

                    <div class="col-md"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">
                                <a href="<?php echo gpConfig['URLPATH']; ?>administrator/imports">
                                    <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/calendar.png" style="width: 80px"/>
                                </a>
                                <h5 class="mt-3">MANAGE <strong>IMPORTS</strong></h5>
                                
                            </div>

                        </div>
                        
                    </div>

                </div>

                <!-- <div class="card border-secondary">

                    <div class="card-body">
                        
                        <h5 class="text-dark">CASH N' GO <strong>COLLECTIONS</strong></h5>
                        <div>Manage aspects of the Cash N' Go Collections Module</div>

                    </div>
                    
                </div> -->

                <div class="row">
                            
                    <div class="col-md"> 
                        
                        <div class="card text-center font-weight-normal">

                            <div class="card-body">
                                <a href="<?php echo gpConfig['URLPATH']; ?>administrator/collections">
                                    <img src="<?php echo gpConfig['URLPATH'] . gpConfig['ASSETS']; ?>img/shop.png" style="width: 80px"/>
                                </a>
                                <h5 class="mt-3">MANAGE <strong>COMPANIES</strong></h5>
                                
                            </div>
                            
                        </div>
                        
                    </div>

                    
                    <div class="col-md"> 
                        &nbsp;
                    </div>

                    <div class="col-md"> 
                        &nbsp;
                    </div>

                    <div class="col-md"> 
                        &nbsp;
                    </div>

                    <div class="col-md">                         
                        &nbsp;                        
                    </div>

                </div>

            </div>

        </div>
        
    </div>
    
</div>