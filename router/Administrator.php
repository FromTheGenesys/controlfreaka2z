<?php

    class Administrator extends gpRouter {
        
        public function __construct() {
            parent::__construct();

            // ensures that session is started
            gpSecurity::enforceSession();

            define( '_ACCESS_', 'administrator/' );
            define( '_FOLDER_', ucwords( _ACCESS_ ) );

            $this->render->LogicAdmin         =   new GPLogicAdministrator();                 # include LogicAdministratorLibrary
            $this->render->LogicGlobal        =   new GPLogicGlobal();                        # include LogicGlobal Library
            $this->render->LogicGlobal->setAccessLevel(); 
                                                    

            // set data arrays that will be used in various methods
            $this->render->LocationRegions      =       $this->render->LogicAdmin->locationRegions();                                                   
            $this->render->LocationTypes        =       $this->render->LogicAdmin->locationTypes();                                                   
            $this->render->AccountRoles         =       $this->render->LogicAdmin->accountRoles();                                                   
            $this->render->AccountLocations     =       $this->render->LogicAdmin->accountLocations();                                                   
        }
    
        /**
         * @name    getindex
         * @desc    loads the main index page
         * @author  Vincent J. Rahming <vincent@genesysnow.com?
         */
        public function getindex() {
            
            # if session is not active and started, force the login prompt
            $this->render->page( _FOLDER_ . 'Dashboard', _HFPARAMS_ );
            
        }

        /** **************************************************
         * ACCOUNT METHODS 
         ** ***************************************************/

        /**
         * @name    accounts
         * @desc    this function is responsible for loading the all accounts page
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         */
         public function accounts() {

            // if user clicks the Add User Account [ button ]  
            if ( isset( $_POST['btnAddAccount'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessAddAccount();

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Account was successfully created.' ];               

                elseif ( $this->process == 2 ) :

                    $this->render->setMessage               =                   [ 'danger', 'One or more required fields did not contain the appropriate values.' ];               

                elseif ( $this->process == 3 ) :

                    $this->render->setMessage               =                   [ 'danger', 'The Email Address specified is already assigned to another user.' ];               

                elseif ( $this->process == 4 ) :

                    $this->render->setMessage               =                   [ 'danger', 'The Login ID specified is already assigned to another user.' ];               

                endif;

            endif;

            // if user clicks the Update Branches [ button ]
            if ( isset( $_POST['btnUpdateBranches'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->UpdateUserBranches( $_POST['AccountID'] );

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Account Branches was successfully updated.' ];   

                elseif ( $this->process == 2 ) :

                    $this->render->setMessage               =                   [ 'danger', 'At least one (1) Branch must be selected.' ];   

                endif;

            endif;

            // if user clicks the Reset Password [ button ]
            if ( isset( $_POST['btnResetPassword'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->UpdateAccountPassword( $_POST['AccountID'] );

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Account Password was successfully upset.' ];   

                endif;

            endif;

            // if user clicks the Update Roles [ button ]
            if ( isset( $_POST['btnUpdateRoles'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateRoles( $_POST['AccountID'] );

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Account Password was successfully upset.' ];   

                endif; 

            endif;

            // if user clicks the Update Account [ button ]             
            if ( isset( $_POST['btnUpdateAccount'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateAccount( $_POST['AccountID'] );
             
                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Account Details were successfully updated. ' ];               
    
                elseif( $this->process == 2 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'All fields are required.' ];               
    
                elseif( $this->process == 3 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'Email Address provided is invalid.' ];               
    
                elseif( $this->process == 4 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'Email Address Mismatch. The Email Addresses provided do not match.' ];               
    
                endif;

            endif;

            # get all location ( required as a part of the search parameters )
            $this->render->GetAllBranches                   =                   $this->render->LogicAdmin->GetAllLocations();   

            if ( isset( $_POST['btnSearch'] ) ) :

                $this->render->GetAllAccounts               =                   $this->render->LogicAdmin->SearchAccounts();            

            else:

                $this->render->GetAllAccounts               =                   $this->render->LogicAdmin->GetAllAccounts();            

            endif;

            
            
            $this->render->page( 'Administrator/Accounts', _HFPARAMS_ );

        }

        /**
         * @name    accounts
         * @desc    this function is responsible for loading a specific account and
         *          other related account details
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         */
        public function account() {
            
            // account id as passed in URL
            $this->render->AccountID                        =                   func_get_arg( 0 );

            // if user clicks the Reset Password [ button ]        
            if ( isset( $_POST['btnReset'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessResetPassword( $this->render->AccountID );

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Password was successfully updated.' ];               
    
                elseif( $this->process == 2 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'All fields are required.' ];               
    
                elseif( $this->process == 3 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'Password provided does not meet the required standard.  All passwords must contain at least eight (8) characters, one (1) uppercase letter, one (1) lowercase letter, one (1) numeric character and one (1) special character.' ];               
    
                elseif( $this->process == 4 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'Password Mismatch. The Passwords provided do not match.' ];               
    
                endif;

            endif;

            // if user clicks the Update Account [ button ]        
            if ( isset( $_POST['btnUpdateAccount'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateAccount( $this->render->AccountID );
             
                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Account Details were successfully updated. ' ];               
    
                elseif( $this->process == 2 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'All fields are required.' ];               
    
                elseif( $this->process == 3 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'Email Address provided is invalid.' ];               
    
                elseif( $this->process == 4 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'Email Address Mismatch. The Email Addresses provided do not match.' ];               
    
                endif;

            endif; 

            // if user clicks the Update Account [ button ]        
            if ( isset( $_POST['btnUpdateRoles'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateRoles( $this->render->AccountID );
             
                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Account Roles were successfully updated. ' ];               
    
                elseif( $this->process == 2 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'At least one Account Role must be assigned.' ];               
    
                endif;

            endif;

            // reference all account and branch details associated with this account
            $this->render->GetAccount                       =                   $this->render->LogicAdmin->GetAccount( $this->render->AccountID );
            $this->render->GetBranches                      =                   $this->render->LogicAdmin->GetRegisteredBranches( $this->render->GetAccount['data'][0]['account_locations'] );
            $this->render->GetModules                       =                   $this->render->LogicAdmin->GetAllModules();
            $this->render->GetAllBranches                   =                   $this->render->LogicAdmin->GetAllLocations();
            
            // if the account account cannot be referenced, then display the error page
            if ( $this->render->GetAccount['count'] == 0 ) : 

                $this->render->page( 'Administrator/Error', _HFPARAMS_ );

            // else, if the account can be referenced, the display the account details page                
            else:

                $this->render->GetUserStatus                =                   $this->render->LogicAdmin->SetUserStatus();                
                $this->render->page( 'Administrator/Account', _HFPARAMS_ );

            endif;

        }

        /** **************************************************
         * BRANCH METHODS 
         ** ***************************************************/

        /**
         * @name    branches
         * @desc    views all branches added to the system
         * @author  Vincent Rahming <vincent@genesysnow.com>
         */
        public function branches() {

            // if user clicks the Update Branch Details [ button ]     
            if ( isset( $_POST['btnUpdate'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->UpdateLocationDetails( $_POST['BranchID'] );

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Branch Details were successfully updated. ' ];               

                endif;

            endif;

            // if user clicks the Add Branch Details [ button ]     
            if ( isset( $_POST['btnAdd'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessAddBranch();

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Branch Details were successfully updated. ' ];           

                elseif ( $this->process == 2 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Branch Name was not specified. ' ];           

                elseif ( $this->process == 3 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Branch Name specified is already in use.  Please select a new Branch Name.' ];           

                endif;

            endif;

            // if the Add/Remove Modules [ button ] is clicked
            if ( isset( $_POST['btnUpdateModules'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateModules( $_POST['BranchID'] );
                $this->render->setMessage                   =                   [ 'success', 'Branch Modules were successfully updated.' ];               

            endif;

            // if user clicks the Update Branch Operating Hours [ button ]     
            if ( isset( $_POST['btnUpdateOpHours'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateHours( $_POST['BranchID'] );
                $this->render->setMessage                   =                   [ 'success', 'Branch Modules were successfully updated.' ];               

            endif;


            // gets all branches
            $this->render->GetAllBranches                   =                   $this->render->LogicAdmin->GetAllLocations();            
            $this->render->GetModules                       =                   $this->render->LogicAdmin->GetAllModules();
            $this->render->page( _FOLDER_ . 'Branches', _HFPARAMS_ );

        }

        /**
         * @name    branch
         * @desc    allows the viewing of a specific account
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         */
        public function branch() {
            
            // account id as passed in URL
            $this->render->BranchID                         =                   func_get_arg( 0 );

            // gets all CSRS that are registered to the branch
            $this->render->BranchCSRS                       =                   $this->render->LogicAdmin->GetAllBranchCSRs( $this->render->BranchID );

            // if user clicks the Update Branch Details [ button ]     
            if ( isset( $_POST['btnUpdate'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateLocation( $this->render->BranchID );
             
                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Location Details were successfully updated. ' ];               
    
                elseif( $this->process == 2 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'All fields are required.' ];               
    
                elseif( $this->process == 3 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'Email Address provided is invalid.' ];               
    
                elseif( $this->process == 4 ) :
    
                    $this->render->setMessage               =                   [ 'danger', 'Email Address Mismatch. The Email Addresses provided do not match.' ];               
    
                endif;


            endif;

            // if user clicks the Update Branch Operating Hours [ button ]     
            if ( isset( $_POST['btnUpdateOpHours'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateHours( $this->render->BranchID );
                $this->render->setMessage                   =                   [ 'success', 'Branch Modules were successfully updated.' ];               

            endif;

            // if user clicks the Update Branch Modules Details [ button ]     
            if ( isset( $_POST['btnUpdateModules'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateModules( $this->render->BranchID );
                $this->render->setMessage                   =                   [ 'success', 'Branch Modules were successfully updated.' ];               

            endif;

            // get branch and module details
            $this->render->GetLocation                       =                   $this->render->LogicAdmin->GetBranch( $this->render->BranchID );
            $this->render->GetModules                        =                   $this->render->LogicAdmin->GetAllModules();
            
            // if the branch cannot be referenced, then display the error page
            if ( $this->render->GetLocation['count'] == 0 ) : 

                $this->render->page( 'Administrator/Error', _HFPARAMS_ );

            // else, if the account can be referenced, the display the account details page   
            else:

                $this->render->GetUserStatus                =                   $this->render->LogicAdmin->SetUserStatus();                
                $this->render->page( 'Administrator/Branch', _HFPARAMS_ );

            endif;

        }

        /** **************************************************
         * MODULE METHODS 
         ** ***************************************************/

         /**
         * @name    modules
         * @desc    allows the viewing of all defined modules in the system         
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         */
        public function modules() {

            // if user clicks the Register Module  [ button ]     
            if ( isset( $_POST['btnRegister'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->RegisterModule();

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Module was successfully registered. ' ];               

                elseif ( $this->process == 2 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Module Name is requires. ' ];               

                elseif ( $this->process == 3 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Module Name already registered. Please try another name. ' ];               

                endif;

            endif;

            // if user clicks the Update Module  [ button ]    
            if ( isset( $_POST['btnUpdate'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->UpdateRegisteredModule( $_POST['ModuleID'] );

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Module was successfully updated. ' ];               

                endif;

            endif;

            // show the registered modules
            $this->render->GetModules                       =                   $this->render->LogicAdmin->GetRegisteredModules();            
            $this->render->page( _FOLDER_ . 'Modules', _HFPARAMS_ );

        }

        /**
         * @name    module
         * @desc    allows the viewing of a specific module.
         *          this also shows all branches to whom a specified module
         *          is currently assigned
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         */
        public function module() {

            // module id as passed in URL
            $this->render->ModuleID                         =                   func_get_arg( 0 );

            // if user clicks the Update Module  [ button ]   
            if ( isset( $_POST['btnUpdate'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->UpdateRegisteredModule( $_POST['ModuleID'] );

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Module was successfully updated. ' ];               

                endif;

            endif;

            // gets module details for the selected module
            $this->render->GetModule                        =                   $this->render->LogicAdmin->GetModule( $this->render->ModuleID );            
            $this->render->GetModuleLocations               =                   $this->render->LogicAdmin->GetModuleLocations( $this->render->ModuleID );            
            $this->render->page( _FOLDER_ . 'Module', _HFPARAMS_ );

        }

        /**
         * @name    messages
         * @desc    allows the viewing of a specific module.
         *          this also shows all branches to whom a specified module
         *          is currently assigned
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         */
        public function messages() {

            if ( isset( $_POST['btnAdd'] ) ) :

                $this->render->StartDate                    =                   $_POST['StartDate'];
                $this->render->StopDate                     =                   $_POST['StopDate'];
                $this->process                              =                   $this->render->LogicAdmin->ProcessAddMessage();    
                
                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Message was successfully added. ' ];      

                elseif ( $this->process == 2 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Message content is required. ' ];      

                elseif ( $this->process == 3 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Message Stop Date must be greater than or equal to the Message Start Date.' ];      

                endif;

            else:

                $this->render->StartDate                    =                   date('Y-m-d');
                $this->render->StopDate                     =                   date('Y-m-d');

            endif;

            if ( isset( $_POST['btnUpdate'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateMessage();   

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Message was successfully updated. ' ];      

                elseif ( $this->process == 2 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Message content is required. ' ];      

                elseif ( $this->process == 3 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Message Stop Date must be greater than or equal to the Message Start Date.' ];      

                endif;

            endif;

            if ( isset( $_POST['btnDelete'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessDeleteMessage();   
                $this->render->setMessage                   =                   [ 'success', 'Message was successfully deleted. ' ];              

            endif;

            $this->render->GetAllMessages                   =                   $this->render->LogicAdmin->GetAllSystemMessages();            
            $this->render->GetAllBranches                   =                   $this->render->LogicAdmin->GetAllLocations();            
            $this->render->page( _FOLDER_ . 'Messages', _HFPARAMS_ );

        }



        /**
         * 
         * @name    collections
         * 
         * @desc    allows the viewing of a the collections module                  
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function collections() {

            if ( isset( $_POST['btnAdd'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessAddCollectionCompany();    
                
                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Collection Company was successfully added.' ];      

                elseif ( $this->process == 2 ) :

                    $this->render->setMessage               =                   [ 'danger', 'The Company Name must be provided.' ];      

                elseif ( $this->process == 3 ) :

                    $this->render->setMessage               =                   [ 'danger', 'The Company Name specified is already on file.' ];      

                elseif ( $this->process == 4 ) :

                    $this->render->setMessage               =                   [ 'danger', 'The Company Logo is provided in a format that is not permitted.' ];      

                elseif ( $this->process == 5 ) :

                    $this->render->setMessage               =                   [ 'danger', 'The Company Logo size exceeds the 2MB max size limit per file. Please reduce the file size then attempt the file upload again.' ];      

                endif;
 
            endif;

            if ( isset( $_POST['btnUpdate'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateCollectionCompany( $_POST['CompanyGUID'] );   

                if ( $this->process == 1 ) :

                    $this->render->setMessage               =                   [ 'success', 'Company details successfully updated. ' ];      

                elseif ( $this->process == 2 ) :

                    $this->render->setMessage               =                   [ 'danger', 'Company Name is required. ' ];      

                elseif ( $this->process == 3 ) :

                    $this->render->setMessage               =                   [ 'danger', 'The name of the Company is already exists. Please review the name and try another.' ];      

                endif;

            endif;

            if ( isset( $_POST['btnUpdatePhoto'] ) ) :

                $this->process                              =                   $this->render->LogicAdmin->ProcessUpdateCompanyLogo( $_POST['CompanyGUID'] );   

            endif;

            $this->render->GetAllCompanies                  =                   $this->render->LogicAdmin->GetAllCollectionCompanies();                             
            $this->render->page( _FOLDER_ . 'Collections', _HFPARAMS_ );

        }

        /**
         * 
         * @name    imports  
         * 
         * @desc    allows the viewing of a the collections module                  
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function imports() {

            // if someone clicks the reload BPL button
            if ( isset( $_POST['btnReloadBPL'] ) ) :

                $this->render->LogicAdmin->ProcessBPLDataReload(); 

            endif;

            $this->render->page( _FOLDER_ . 'Imports', _HFPARAMS_ );

        }

    }

    