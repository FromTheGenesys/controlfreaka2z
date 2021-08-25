<?php

    class GPLogicAdministrator extends gpLogic {
        
        public function __construct() {

            parent::__construct();      
            // $this->LogicGeneral     =   new GPLogicGeneral();

        }

        public function ProcessUpdateAccount( $AccountID ) {

            $setData                    =                   $this->GPLogicData->update( 'sysAccounts',
                                                                                        'account_first    =   "'. strtoupper( $_POST['FirstName'] ) .'",
                                                                                         account_last     =   "'. strtoupper( $_POST['LastName'] ) .'",
                                                                                         account_email    =   "'. strtolower( $_POST['EmailAddress'] ) .'",
                                                                                         account_status   =   "'. $_POST['Status'] .'"',
                                                                                        'WHERE sysAccounts.id  =  "'. $AccountID. '" AND sysAccounts.account_pid = "CNG"' );

        }

        public function UpdateLocationDetails( $LocationID ) {

            $setData                    =                   $this->GPLogicData->update( 'sysLocations',
                                                                                        'location_region  =   "'. $_POST['LocationRegion'] .'",
                                                                                         location_type    =   "'. $_POST['LocationType'] .'",
                                                                                         location_status  =   "'. $_POST['LocationStatus'] .'"',
                                                                                        'WHERE sysLocations.id           =  "'. $LocationID. '"' );

            return 1;                                                                                           

        }

        public function ProcessUpdateLocation( $LocationID ) {

            $setData                    =                   $this->GPLogicData->update( 'sysLocations',
                                                                                        'location_name    =   "'. strtoupper( $_POST['LocationName'] ) .'",
                                                                                         location_region  =   "'. $_POST['LocationRegion'] .'",
                                                                                         location_type    =   "'. $_POST['LocationType'] .'",
                                                                                         location_pid     =   "'. $_POST['LocationPID'] .'",
                                                                                         location_status  =   "'. $_POST['LocationStatus'] .'"',
                                                                                        'WHERE sysLocations.id           =  "'. $LocationID. '" ' );

            return 1;                                                                                           

        }

        public function ProcessAddBranch() {

            // check to determine if the Location/Branch name is specified
            if ( empty( $_POST['LocationName'] ) ) :

                return 2;

            endif;

            // check to determine if the Location/Branch name is already assigned
            if ( $this->_checkExistingBranch( $_POST['LocationName'] ) ) :

                return 3;

            endif;

            $InsertData                 =                   [ 'fields'      =>      'location_name,
                                                                                     location_type,
                                                                                     location_region,
                                                                                     location_status,
                                                                                     location_pid,
                                                                                     location_created',
            
                                                              'values'      =>      [ strtoupper( $_POST['LocationName'] ),
                                                                                      $_POST['LocationType'],
                                                                                      $_POST['LocationRegion'],
                                                                                      $_POST['LocationStatus'],
                                                                                      $_POST['LocationPID'],
                                                                                      date( 'Y-m-d H:i:s') ] ];

            $setData                    =                   $this->GPLogicData->insert( 'sysLocations', $InsertData );

            // operation was successful
            return 1;

        }

        private function _checkExistingBranch( $BranchName ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.*
                                                                                                    
                                                                                      FROM          sysLocations
                                                                                      WHERE         UPPER( sysLocations.location_name ) = "'. strtoupper( $BranchName ) .'"' );

            if ( $getData['count'] == 0 ) :

                return false;

            else:

                return true;

            endif;

        }

        public function ProcessResetPassword( $AccountID ) {

            $setData                    =                   $this->GPLogicData->update( 'sysAccounts',
                                                                                        'account_secure_password =   "'. password_hash( '12345678', PASSWORD_BCRYPT ) .'",
                                                                                         account_secure_updated  =   "Y",
                                                                                         account_reset           =   "1"',
                                                                                        'WHERE  sysAccounts.id  =  "'. $AccountID. '" 
                                                                                         AND    sysAccounts.account_pid = "CNG"' );

            return 1;

        }

        public function GetUserAccounts() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysAccounts.*
                                                                                                    
                                                                                      FROM          sysAccounts
                                                                                      WHERE         sysAccounts.account_pid = "CNG"
                                                                                      ORDER BY      sysAccounts.account_last ASC' );

            return $getData;              

        }

        public function GetRegisteredBranches( $LocationSet ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.*
                                                                                                    
                                                                                      FROM          sysLocations
                                                                                      WHERE         sysLocations.location_pid = "CNG"
                                                                                      AND           FIND_IN_SET( sysLocations.id, "'. $LocationSet .'" )
                                                                                      ORDER BY      sysLocations.location_name ASC' );

            return $getData;              

        }

        /**
         * 
         * @name    GetAllBranches
         * 
         * @desc    Gets all branches of Cash N' Go locations
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetAllBranches() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.*,
                                                                                                    UPPER( sysLocations.location_name ) as location_name
                                                                                                    
                                                                                      FROM          sysLocations
                                                                                      
                                                                                      ORDER BY      sysLocations.location_name ASC'
                                                                                    );

            return $getData;            

        }

        /**
         * 
         * @name    GetAllLocations
         * 
         * @desc    Get all branche sof Cash N' Go locations ( with number of Cashiers )
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */

        public function GetAllLocations() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.*,
                                                                                                    UPPER( sysLocations.location_name ) as LocationName,
                                                                                                    ( SELECT    COUNT( sysAccounts.id )

                                                                                                      FROM      sysAccounts
                                                                                                      WHERE     FIND_IN_SET( sysLocations.id, sysAccounts.account_locations ) ) as CSRsAtLocation
                                                                                                    
                                                                                      FROM          sysLocations
                                                                                      WHERE         sysLocations.location_pid = "CNG"
                                                                                      ORDER BY      sysLocations.location_name ASC'
                                                                                    );

            return $getData;            

        }

        /**
         * 
         * @name    GetLocations
         * 
         * @desc    Get All Locations ( Legacy )
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */

        public function GetLocations() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.*
                                                                                                    
                                                                                      FROM          sysLocations
                                                                                      WHERE         sysLocations.location_pid = "CNG"
                                                                                      ORDER BY      sysLocations.location_name ASC'
                                                                                    );

            return $getData;            

        }

        /**
         * 
         * @name    GetAllAccounts
         * 
         * @desc    Gets all accounts that belong to Cash N' Go
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */

        public function GetAllAccounts() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysAccounts.*,
                                                                                                    UPPER( sysAccounts.account_first ) as AccountFirst,
                                                                                                    UPPER( sysAccounts.account_last ) as AccountLast
                                                                                                    
                                                                                      FROM          sysAccounts
                                                                                      WHERE         sysAccounts.account_pid = "CNG"
                                                                                      ORDER BY      sysAccounts.account_last ASC'
                                                                                    );

            return $getData;            

        }

        /**
         * 
         * @name    GetAccount
         * 
         * @desc    Gets the specific details of an account
         * 
         * @param   INT $AccountID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetAccount( $AccountID ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysAccounts.*,
                                                                                                    UPPER( sysAccounts.account_first ) as AccountFirst,
                                                                                                    UPPER( sysAccounts.account_last ) as AccountLast
                                                                                                    
                                                                                      FROM          sysAccounts
                                                                                      WHERE         sysAccounts.id  =  "'. $AccountID .'"'
                                                                                    );

            return $getData;            

        }

        /**
         * 
         * @name    ProcessAddAccount
         * 
         * @desc    Adds an account to the portal for Cash N Go users
         * 
         * @param   INT $AccountID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function ProcessAddAccount() {

            if ( empty( $_POST['LastName'] ) OR
                 empty( $_POST['FirstName'] ) OR
                 empty( $_POST['EmailAddress'] ) OR
                 empty( $_POST['LoginID'] ) )  :
                 
                 return 2;

            endif;

            // check to see if the Email Address already exists
            if ( $this->_checkExistingEmail( $_POST['EmailAddress'] ) == true ) :

                return 3; 

            endif;

            // check to see if the LoginID already exists
            if ( $this->_checkExistingLoginID( $_POST['LoginID'] ) == true ) :

                return 4; 

            endif;

            $InsertData                 =                   [ 'fields'      =>      'account_first,
                                                                                     account_last,
                                                                                     account_email,
                                                                                     account_password,
                                                                                     account_login,
                                                                                     account_status,
                                                                                     account_created',
            
                                                              'values'      =>      [ strtoupper( $_POST['FirstName'] ),
                                                                                      strtoupper( $_POST['LastName'] ),
                                                                                      strtolower( $_POST['EmailAddress'] ),                                                                                      
                                                                                      md5( '123456' ),                                                                                      
                                                                                      strtolower( $_POST['LoginID'] ),                                                                                      
                                                                                      $_POST['Status'],                                                                                      
                                                                                      date( 'Y-m-d H:i:s') ] ];

            $setData                    =                   $this->GPLogicData->insert( 'sysAccounts', $InsertData );


            return 1;

        }

        /**
         * 
         * @name    _checkExistingLoginID
         * 
         * @desc    Checks to see if a login id currently exists
         * 
         * @param   INT $AccountID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        private function _checkExistingLoginID( $LoginID ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysAccounts.*
                                                                                                    
                                                                                      FROM          sysAccounts
                                                                                      WHERE         LOWER( sysAccounts.account_login ) = "'. strtolower( $LoginID ) .'"' );

            if ( $getData['count'] == 0 ) :

                return false;

            else:

                return true;

            endif;
            
        }

        /**
         * 
         * @name    _checkExistingEmail
         * 
         * @desc    Checks to see if a email address being used to add or update an account already exists
         * 
         * @param   INT $AccountID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        private function _checkExistingEmail( $EmailAddress ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysAccounts.*
                                                                                                    
                                                                                      FROM          sysAccounts
                                                                                      WHERE         LOWER( sysAccounts.account_email ) = "'. strtolower( $EmailAddress ) .'"' );

            if ( $getData['count'] == 0 ) :

                return false;

            else:

                return true;

            endif;
        }

        /**
         * 
         * @name    GetBranch
         * 
         * @desc    Gets details of a specified Cash N Go Branch
         * 
         * @param   INT $BranchID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetBranch( $BranchID ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.*
                                                                                                    
                                                                                      FROM          sysLocations
                                                                                      WHERE         sysLocations.id = "'. $BranchID .'"'
                                                                                    );

            return $getData;            

        }

        /**
         * 
         * @name    GetAllBranchCSRs
         * 
         * @desc    
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetAllBranchCSRs( $LocationID ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysAccounts.*,
                                                                                                    UPPER( sysAccounts.account_first ) as AccountFirst,
                                                                                                    UPPER( sysAccounts.account_last ) as AccountLast
                                                                                                    
                                                                                      FROM          sysAccounts
                                                                                      WHERE         FIND_IN_SET( "'. $LocationID .'", sysAccounts.account_locations )
                                                                                      ORDER BY      sysAccounts.account_last ASC'
                                                                                    );

            return $getData;            

        }

        /**
         * 
         * @name    Generate GUID
         * 
         * @desc    Geneerates a GUID
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetGUID() {

            return $this->gpGenerateGUID();

        }

        /**
         * 
         * @name    SetUserStatus
         * 
         * @desc    Provides a list of user statuses or a specific status if an argument is provided
         * 
         * @param   INT $StatusID | Optional
         * 
         * @author  Vincent Rahming <vincent@genesysnow.com>
         * 
         * @return  MIXED | STRING $setStatus 
         * 
         */
        public function SetUserStatus( $StatusID = false ) {

            $setStatus                  =                   [ 1     =>      'Active',
                                                              2     =>      'Inactive' ];

            if ( empty( $StatusID ) ) :
                
                return $setStatus;
            
            else:

                return $setStatus[ $StatusID ];

            endif;

        }
        
        /**
         * @name    GetAllModules
         * @desc    
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         */
        public function GetAllModules() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        ModuleRegister.*
                                                                                                    
                                                                                      FROM          ModuleRegister
                                                                                      WHERE         ModuleRegister.ModuleStatus     =   "A"
                                                                                      ORDER BY      ModuleRegister.ModuleName ASC'
                                                                                    );

            return $getData;            

        }
        /**
         * 
         * @name    GetAllModules
         * 
         * @desc    
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetRegisteredModules() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        ModuleRegister.*
                                                                                                    
                                                                                      FROM          ModuleRegister                                                                                      
                                                                                      ORDER BY      ModuleRegister.ModuleName ASC'
                                                                                    );

            return $getData;            

        }

        public function GetModuleLocations( $ModuleID ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.*
                                                                                                    
                                                                                      FROM          sysLocations              
                                                                                      WHERE         FIND_IN_SET( "'. $ModuleID .'", sysLocations.location_modules )                                                                        
                                                                                      ORDER BY      sysLocations.location_name ASC'
                                                                                    );

            return $getData;     


        }

        /**
         * 
         * @name    RegissterModule
         * 
         * @desc    
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function RegisterModule() {

            // check to determine if the Location/Branch name is specified
            if ( empty( $_POST['ModuleName'] ) ) :

                return 2;

            endif;

            // check to determine if the Module name is already assigned
            if ( $this->_checkExistingModule( $_POST['ModuleName'] ) ) :

                return 3;

            endif;

            $InsertData                 =                   [ 'fields'      =>      'ModuleName,
                                                                                     ModuleDescription,
                                                                                     ModuleStatus,
                                                                                     ModuleCreated',
            
                                                              'values'      =>      [ strtoupper( $_POST['ModuleName'] ),
                                                                                      $_POST['ModuleDescription'],
                                                                                      $_POST['ModuleStatus'],                                                                                      
                                                                                      date( 'Y-m-d H:i:s') ] ];

            $setData                    =                   $this->GPLogicData->insert( 'ModuleRegister', $InsertData );

            // operation was successful
            return 1;


        }

        /**
         * 
         * @name    _checkExistingModule
         * 
         * @desc    Determines if a module with the same name already exists
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        private function _checkExistingModule( $ModuleName ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        ModuleRegister.*
                                                                                                    
                                                                                      FROM          ModuleRegister
                                                                                      WHERE         UPPER( ModuleRegister.ModuleName ) = "'. strtoupper( $ModuleName ) .'"' );

            if ( $getData['count'] == 0 ) :

                return false;

            else:

                return true;

            endif;

        }

        /**
         * 
         * @name    UpdateRegisteredModule
         * 
         * @desc    Updates Registered Modules
         * 
         * @param   INT $ModuleID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function UpdateRegisteredModule( $ModuleID ) {

            $getData                    =                   $this->GPLogicData->update( 'ModuleRegister',
                                                                                        'ModuleDescription   =   "'. $_POST['ModuleDescription'] .'",
                                                                                         ModuleStatus        =   "'. $_POST['ModuleStatus'] .'"',        
                                                                                        'WHERE ModuleID      =   "'. $ModuleID .'"' );

            return 1;                                                                                        
            
        }

        /**
         * 
         * @name    UpdateAccountPassword
         * 
         * @desc    Updates Password and Changes it to default
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         * @param   INT $AccountID | Mandatory
         * 
         */
        public function UpdateAccountPassword( $AccountID ) {

            $getData                    =                   $this->GPLogicData->update( 'sysAccounts',
                                                                                        'account_password    =   "'. md5( '123456' ) .'"',        
                                                                                        'WHERE id            =   "'. $AccountID .'"' );

            return 1;                                                                                        
            
        }

        /**
         * 
         * @name    GetModule
         * 
         * @desc    Gets the details of a specific Registered Modules
         * 
         * @param   INT $ModuleID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetModule( $ModuleID ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        ModuleRegister.*
                                                                                                    
                                                                                      FROM          ModuleRegister
                                                                                      WHERE         ModuleRegister.ModuleID     =   "'. $ModuleID .'"
                                                                                      '
                                                                                    );

            return $getData;            

        }

        public function ProcessUpdateHours( $LocationID ) {

            if ( isset( $_POST['Day'] ) ) :

                $Hours                  =                   NULL;

                foreach( $_POST['Day'] as $DaySet ) :

                    $Hours              .=                  $DaySet .'-'. $_POST['Opens'][ $DaySet ] .'-'. $_POST['Closes'][ $DaySet ] .',';                             

                endforeach;

                $getData                    =                   $this->GPLogicData->update( 'sysLocations',
                                                                                            'location_hours   =   "'. rtrim( $Hours, ',' ) .'"',        
                                                                                            'WHERE id = "'. $LocationID .'"'
                                                                                    );

            endif;

        }

        public function ProcessUpdateModules( $LocationID ) {

            if ( isset( $_POST['Modules'] ) ) :

                $getData                    =                   $this->GPLogicData->update( 'sysLocations',
                                                                                            'location_modules   =   "'. implode( ',', $_POST['Modules'] ) .'"',        
                                                                                            'WHERE id = "'. $LocationID .'"'
                                                                                    );

            endif;

        }

       
        public function locationRegions( $RegionID = false ) {

            $setRegions                  =                   [ 1     =>      'New Providence',
                                                               2     =>      'Northern Bahamas',
                                                               3     =>      'Central and Southern Bahamas'
                                                             ];

            if ( empty( $RegionID ) ) :
                
                return $setRegions;
            
            else:

                return $setRegions[ $RegionID ];

            endif;
            
        }
        
        public function locationTypes( $TypeID = false ) {

            $setTypes                    =                   [ 1     =>      'Core',
                                                               2     =>      'BFG',
                                                               3     =>      'Sub Agent'
                                                             ];

            if ( empty( $TypeID ) ) :
                
                return $setTypes;
            
            else:

                return $setTypes[ $TypeID ];

            endif;

        }

        public function accountRoles( $RoleID = false ) {

            $setRoles                    =                   [ 2     =>      'Administrator',
                                                               3     =>      'Senior CSR',
                                                               4     =>      'Customer Service Rep.',
                                                               5     =>      'Operations',
                                                               6     =>      'Operations II'
                                                             ];

            if ( empty( $RoleID ) ) :
                
                return $setRoles;
            
            else:

                return $setRoles[ $RoleID ];

            endif;

        }

        public function accountLocations( $LocationID = false ) {

            $setLocations               =                   [];

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.id, sysLocations.location_name
                                                                                                    
                                                                                      FROM          sysLocations
                                                                                      WHERE         sysLocations.location_pid = "CNG"
                                                                                      ' );

            foreach( $getData['data'] as $DataSet ) :
                
                $setLocations[ $DataSet['id'] ]  =   $DataSet['location_name'];
                 
            endforeach;

            if ( empty( $LocationID ) ) :
                
                return $setLocations;
            
            else:

                return $setLocations[ $LocationID ];

            endif;

        }

        /**
         * 
         * @name    UpdateUserBranches
         * 
         * @desc    Updates selected branches for a single user
         * 
         * @param   INT $AccountID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function UpdateUserBranches( $AccountID ) {

            if ( !isset( $_POST['BranchID'] ) ) :

                return 2;   # no branch selected

            else:

                $getData                    =                   $this->GPLogicData->update( 'sysAccounts',
                                                                                            'account_locations  =  "'. implode( ',', $_POST['BranchID'] ) .'"',
                                                                                            'WHERE   id = "'. $AccountID .'"');

                return 1;

            endif;

        }

        /**
         * 
         * @name    ProcessUpdateRoles
         * 
         * @desc    Updates User Roles for a single user
         * 
         * @param   INT $AccountID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function ProcessUpdateRoles( $AccountID ) {

            if ( !isset( $_POST['RoleID'] ) ) :

                return 2;   # no role selected

            else:

                $getData                    =                   $this->GPLogicData->update( 'sysAccounts',
                                                                                            'account_roles  =  "'. implode( ',', $_POST['RoleID'] ) .'"',
                                                                                            'WHERE   id = "'. $AccountID .'"');

                return 1;

            endif;

        }

        /**
         * 
         * @name    ProcessAddMessage
         * 
         * @desc    Adds messsage to the System Messsages Table
         * 
         * @author  Vincent Rahming <vincent@genesysnow.com>         
         * 
         */
        public function ProcessAddMessage() {

            // ensure that all required fields contain values
            if ( empty( $_POST['MessageContent'] ) ) :

                return 2;

            endif;

            // ensure that the dates provided are valid
            if ( $_POST['StopDate'] <  $_POST['StartDate'] ) :

                return 3;

            endif;

            if ( $_POST['Focus'] == '1' ) :
                
                // clear the focus value from every other record
                $this->_clearMessageFocus();

            endif;

            $InsertData                 =                   [ 'fields'      =>      'MessageGUID,
                                                                                     MessageBody,
                                                                                     MessageLocation,
                                                                                     MessageStart,
                                                                                     MessageStop,
                                                                                     MessageStatus,
                                                                                     MessageFocus,
                                                                                     MessageCreated',
            
                                                              'values'      =>      [ $this->gpGenerateGUID(),
                                                                                      str_replace( ',', '', $_POST['MessageContent'] ),
                                                                                      $_POST['Locations'],                                                                                      
                                                                                      $_POST['StartDate'] .' '. date( 'h:i:s' ),                                                                                      
                                                                                      $_POST['StopDate'] .' 23:59:59',                                                                                      
                                                                                      $_POST['Status'],                                                                                      
                                                                                      $_POST['Focus'],                                                                                      
                                                                                      date( 'Y-m-d H:i:s') ] ];

            $setData                    =                   $this->GPLogicData->insert( 'SystemMessages', $InsertData );

            return 1;

        }

        /**
         * 
         * @name    _clearMessageFocuss
         * 
         * @desc    Only one message can have a focus at any time, this method clears
         *          the focus of all message in the event that the new message or current
         *          updated message has a focus set to 1 ( or yes )
         * 
         * @author  Vincent Rahming <vincent@genesysnow.com>         
         * 
         */
        private function _clearMessageFocus() {

            $getData                    =                   $this->GPLogicData->update( 'SystemMessages',
                                                                                        'MessageFocus   =   "0"',        
                                                                                        'WHERE SystemMessages.MessageID > 0'
                                                                                    );

        }

        /**
         * 
         * @name    GetAllSystemMessages
         * 
         * @desc    Gets all system messages currently available in the system
         * 
         * @author  Vincent Rahming <vincent@genesysnow.com>         
         * 
         */
        public function GetAllSystemMessages() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        SystemMessages.*
                                                                                                    
                                                                                      FROM          SystemMessages
                                                                                      WHERE         SystemMessages.MessageID > 0
                                                                                      ORDER BY      SystemMessages.MessageFocus ASC,
                                                                                                    SystemMessages.MessageCreated DESC
                                                                                      ' );

            return $getData;

        }

        /**
         * 
         * @name    ProcessUpdateMessages
         * 
         * @desc    Updates system messages in the database
         * 
         * @author  Vincent Rahming <vincent@genesysnow.com>         
         * 
         */
        public function ProcessUpdateMessage() {

            // ensure that all required fields contain values
            if ( empty( $_POST['MessageContent'] ) ) :

                return 2;

            endif;

            // ensure that the dates provided are valid
            if ( $_POST['StopDate'] <  $_POST['StartDate'] ) :

                return 3;

            endif;

            if ( $_POST['Focus'] == '1' ) :
                
                // clear the focus value from every other record
                $this->_clearMessageFocus();

            endif;
            
            $getData                    =                   $this->GPLogicData->update( 'SystemMessages',
                                                                                        'MessageFocus   =   "'. $_POST['Focus'] .'",
                                                                                         MessageStart   =   "'. $_POST['StartDate'] .' 00:00:00",
                                                                                         MessageStop    =   "'. $_POST['StopDate'] .' 23:59:59",
                                                                                         MessageBody    =   "'. $_POST['MessageContent'] .'",
                                                                                         MessageLocation =  "'. $_POST['Locations'] .'",
                                                                                         MessageStatus  =   "'. $_POST['Status'] .'"',        
                                                                                        'WHERE SystemMessages.MessageID = "'. $_POST['MessageID'] .'"'
                                                                                        );
                                                                                        
            return 1;

        }

        /**
         * 
         * @name    ProcessDeleteMessage
         * 
         * @desc    Removes system messages from the database
         * 
         * @author  Vincent Rahming <vincent@genesysnow.com>         
         * 
         */
        public function ProcessDeleteMessage() {

            $getData                    =                   $this->GPLogicData->delete( 'SystemMessages',
                                                                                        'WHERE SystemMessages.MessageID = "'. $_POST['MessageID'] .'"');

        }

        /**
         * 
         * @name    SearchAccounts
         * 
         * @desc    Returns search results based on user providied parameters         
         * 
         * @author  Vincent Rahming <vincent@genesysnow.com>
         * 
         * @return  MIXED | STRING $getData 
         * 
         */
        public function SearchAccounts() {

            
            if ( empty( $_POST['FirstName'] ) AND 
                 empty( $_POST['LastName'] ) AND 
                 empty( $_POST['EmailAddress'] ) AND 
                 $_POST['Status'] == '*' AND 
                 $_POST['Locations'] == '*' ) :

                 return 2;

            endif;

            # establish empty query string
            $GPQuery                    =                   '';

            // if the first namme is provided as a parameter
            if ( !empty( $_POST['FirstName'] ) ) :

                $GPQuery                .=                  ' AND UPPER( sysAccounts.account_first ) LIKE "'. strtoupper( $_POST['FirstName'] ) .'%" ';

            endif;

            // if the last name is provided as a parameter
            if ( !empty( $_POST['LastName'] ) ) :

                $GPQuery                .=                  ' AND UPPER( sysAccounts.account_last ) LIKE "'. strtoupper( $_POST['LastName'] ) .'%" ';

            endif;

            // if the email address is provided as a parameter
            if ( !empty( $_POST['EmailAddress'] ) ) :

                $GPQuery                .=                  ' AND UPPER( sysAccounts.account_email ) LIKE "'. strtoupper( $_POST['EmailAddress'] ) .'%" ';

            endif;

            // if account status is specified
            if ( $_POST['Status'] != '*' ) :

                $GPQuery                .=                  ' AND sysAccounts.account_status = "'. $_POST['Status'] .'" ';

            endif;

            // if account location is specified
            if ( $_POST['Locations'] != '*' ) :

                $GPQuery                .=                  ' AND FIND_IN_SET( "'. $_POST['Locations'] .'", sysAccounts.account_locations ) ';

            endif;

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysAccounts.*,
                                                                                                    UPPER( sysAccounts.account_first ) AS AccountFirst,
                                                                                                    UPPER( sysAccounts.account_last ) AS AccountLast
                                                                                                    
                                                                                      FROM          sysAccounts
                                                                                      WHERE         sysAccounts.account_pid     =   "CNG"
                                                                                      '. $GPQuery .'
                                                                                      ORDER BY      sysAccounts.account_last ASC
                                                                                      
                                                                                      ' );

            return $getData;

        }

        /**
         * 
         * @name    GetAllBranchCSRs
         * 
         * @desc    
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetAllCollectionCompanies() {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        MVPCollectionCompanies.*
                                                                                                    
                                                                                      FROM          MVPCollectionCompanies
                                                                                      ORDER BY      MVPCollectionCompanies.CompanyName ASC'
                                                                                    );

            return $getData;            

        }

        /**
         * 
         * @name    GetCollectionCompany
         * 
         * @desc    Gets the details of a collection company
         * 
         * @param   STRING $CompanyGUID | Mandatory
         * 
         * @author  Vincent J. Rahming <vincent@genesysnow.com>
         * 
         */
        public function GetCollectionCompany( $CompanyGUID ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        MVPCollectionCompanies.*
                                                                                                    
                                                                                      FROM          MVPCollectionCompanies
                                                                                      WHERE         MVPCollectionCompanies.CompanyGUID  = "'. $CompanyGUID .'"'
                                                                                    );

            return $getData;            

        }

        public function ProcessAddCollectionCompany() {

            if ( empty( $_POST['CompanyName'] ) ) :        

                return 2;       // company name must be specified

            endif;

            if ( $this->_checkExistingCompanyName( $_POST['CompanyName'] ) ) :

                return 3;       // company name already exists

            endif;

            # insert backage
            $InsertData                 =                   [ 'fields'      =>      'CompanyGUID,
                                                                                     CompanyName,
                                                                                     CompanyDescription,
                                                                                     CompanyStatus,
                                                                                     CompanyCreated',
            
                                                              'values'      =>      [ $this->gpGenerateGUID(),
                                                                                      str_replace( ',', '', strtoupper( $_POST['CompanyName'] ) ),
                                                                                      $_POST['CompanyDescription'],                                                                                      
                                                                                      $_POST['CompanyStatus'],
                                                                                      date( 'Y-m-d H:i:s') ] ];

            $setData                    =                   $this->GPLogicData->insert( 'MVPCollectionCompanies', $InsertData );

            $setFileTypes               =                   [ 'image/png', 'image/jpeg', 'image/jpg', 'image/gif' ];

            if ( !in_array( $_FILES['CompanyLogo']['type'], $setFileTypes ) ) :

                return 4;

            endif;

            if ( $_FILES['CompanyLogo']['size'] > 2000000 ) :

                return 5;

            endif;

            # insert folder into 
            if ( !file_exists( gpConfig['BASEPATH'] . gpConfig['DATA'] . gpConfig['UPLOADS'] . 'CollectionCompanies/'. $setData['insertID'] .'/') ) :

                mkdir( gpConfig['BASEPATH'] . gpConfig['DATA'] . gpConfig['UPLOADS'] . 'CollectionCompanies/'. $setData['insertID'] .'/', 0777 );

            endif;

            # move file to folder
            move_uploaded_file( $_FILES['CompanyLogo']['tmp_name'], gpConfig['BASEPATH'] . gpConfig['DATA'] . gpConfig['UPLOADS'] . 'CollectionCompanies/'. $setData['insertID'] .'/'. str_replace( ' ', '_', $_FILES['CompanyLogo']['name'] ) );
            
            # update the logo file
            $getData                    =                   $this->GPLogicData->update( 'MVPCollectionCompanies',
                                                                                        'CompanyLogo    =   "'. str_replace( ' ', '_', $_FILES['CompanyLogo']['name'] ) .'"',
                                                                                        'WHERE MVPCollectionCompanies.CompanyID = "'. $setData['insertID'] .'"' );
            
            return 1;

        }
        
        private function _checkExistingCompanyName( $CompanyName ) {

            $getData                    =                   $this->GPLogicData->sql( 'SELECT        MVPCollectionCompanies.*
                                                                                                    
                                                                                      FROM          MVPCollectionCompanies
                                                                                      WHERE         UPPER( MVPCollectionCompanies.CompanyName ) = "'. strtoupper( $CompanyName ) .'"'
                                                                                    );

            if ( $getData['count'] == 0 ) :
                
                return false;

            else:

                return true;

            endif;

        }

        public function ProcessUpdateCollectionCompany( $CompanyGUID ) {

            if ( empty( $_POST['CompanyName'] ) ) :        

                return 2;       // company name must be specified

            endif;

            if ( $_POST['CompanyName'] != $_POST['CompanyNameOld'] ) : 

                if ( $this->_checkExistingCompanyName( $_POST['CompanyName'] ) ) :

                    return 3;       // company name already exists

                endif;

            endif;

            $getData                    =                   $this->GPLogicData->update( 'MVPCollectionCompanies',
                                                                                        'CompanyName        =   "'. strtoupper( $_POST['CompanyName'] ) .'",
                                                                                         CompanyDescription =   "'. $_POST['CompanyDescription'] .'",
                                                                                         CompanyStatus      =   "'. $_POST['CompanyStatus'] .'"',        
                                                                                        'WHERE MVPCollectionCompanies.CompanyGUID = "'. $CompanyGUID .'"'
                                                                                        );

            return 1;

        }

        public function ProcessUpdateCompanyLogo( $CompanyGUID ) {

            $GetCollection                  =                   $this->GetCollectionCompany( $CompanyGUID );

            if ( isset( $_FILES['CompanyLogo'] ) ) :

                $setFileTypes                   =                   [ 'image/png', 'image/jpeg', 'image/jpg', 'image/gif' ];

                if ( !in_array( $_FILES['CompanyLogo']['type'], $setFileTypes ) ) :

                    return 2;

                endif;

                if ( $_FILES['CompanyLogo']['size'] > 2000000 ) :

                    return 3;

                endif;

                if ( !empty( $GetCollection['data'][0]['CompanyLogo'] ) ) :

                    # remove the current file
                    unlink( gpConfig['BASEPATH'] . gpConfig['DATA'] . gpConfig['UPLOADS'] .'CollectionCompanies/'. $GetCollection['data'][0]['CompanyID'] .'/'. $GetCollection['data'][0]['CompanyLogo'] );
            
                endif;

                $getData                    =                   $this->GPLogicData->update( 'MVPCollectionCompanies',
                                                                                            'CompanyLogo        =   "'. str_replace( ' ', '_', $_FILES['CompanyLogo']['name'] ) .'"',        
                                                                                            'WHERE MVPCollectionCompanies.CompanyGUID = "'. $CompanyGUID .'"');

                # insert folder into 
                if ( !file_exists( gpConfig['BASEPATH'] . gpConfig['DATA'] . gpConfig['UPLOADS'] . 'CollectionCompanies/'. $GetCollection['data'][0]['CompanyID'] .'/') ) :

                    mkdir( gpConfig['BASEPATH'] . gpConfig['DATA'] . gpConfig['UPLOADS'] . 'CollectionCompanies/'. $GetCollection['data'][0]['CompanyID'] .'/', 0777 );

                endif;

                # move file to folder
                move_uploaded_file( $_FILES['CompanyLogo']['tmp_name'], gpConfig['BASEPATH'] . gpConfig['DATA'] . gpConfig['UPLOADS'] . 'CollectionCompanies/'. $GetCollection['data'][0]['CompanyID'] .'/'. str_replace( ' ', '_', $_FILES['CompanyLogo']['name'] ) );
                
                # update the logo file
                $getData                    =                   $this->GPLogicData->update( 'MVPCollectionCompanies',
                                                                                            'CompanyLogo    =   "'. str_replace( ' ', '_', $_FILES['CompanyLogo']['name'] ) .'"',
                                                                                            'WHERE MVPCollectionCompanies.CompanyID = "'. $GetCollection['data'][0]['CompanyID'] .'"' );
                

                return 1;

            endif;

            return 4;

        }

    }