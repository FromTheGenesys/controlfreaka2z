<?php

    class GPLogicAuth extends gpLogic {
        
        public function __construct() {
            parent::__construct();       
        }

        /**
         * 
         * @name    processGetAccountLocations
         * 
         * @desc    Get all account locations that are registered at Cash N Go
         * 
         * @author  Vincent J. Rahming
         * 
         * @return  MIXED $getData
         * 
         */
        public function processGetAccountLocations() {

            # query the database to determine if the account is available
            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysLocations.id,
                                                                                                    sysLocations.location_name
                                                                                                    
                                                                                      FROM          sysLocations
                                                                                      WHERE         sysLocations.location_pid       =   "CNG"
                                                                                      AND           sysLocations.location_status    =   "A"
                                                                                      AND           FIND_IN_SET( sysLocations.id, "'. $_SESSION['sessAcctLocations'] .'")' );


            # if only one result is returned, assign role
            if ( ( $getData['count'] == 1 ) ):
                
                $this->GPLogicSession->setIndex( 'sessAcctLocation', $getData['data'][0]['id'] );
                $this->GPLogicSession->setIndex( 'SessionIsStarted', true );
                header( gpConfig['URLPATH'] .'auth' );                  # redirect to auth
                                                                        # will automatically route to appropriate index page

            endif;

            # if there are multiple locations, return to browser to allow CSR selection
            return $getData;

        }

        /**
         * 
         * @name    processGetAccountLogin
         * 
         * @desc    Validates A UserID and Password against the database
         * 
         * @author  Vincent J. Rahming
         * 
         * @return  MIXED $getData
         * 
         */
        public function processAccountLogin() {

            # account login parameters
            if ( empty( $_POST['LoginID'] ) OR 
                 empty( $_POST['Password'] ) ) :
                 
                 return 2;      # on of the required parameters is empty
                 
            endif;

            # query the database to determine if the account is available
            $getData                    =                   $this->GPLogicData->sql( 'SELECT        sysAccounts.* 

                                                                                      FROM          sysAccounts
                                                                                      WHERE         sysAccounts.account_login       =   ":LoginID"
                                                                                      AND           sysAccounts.account_password    =   ":Password"
                                                                                      AND           sysAccounts.account_pid         =   "CNG"
                                                                                      AND           sysAccounts.account_status      =   "1"', 
                                                                                      [ 'LoginID'    =>  $_POST['LoginID'],
                                                                                        'Password'   =>  md5( $_POST['Password'] ) ]  
                                                                                    );

            # if the account is not found
            if ( $getData['count'] == 0 ) :
                
                return 3;
                
            endif;
            
            # setup session variables            
            $this->GPLogicSession->setIndex( 'sessAcctID', $getData['data'][0]['id'] );
            $this->GPLogicSession->setIndex( 'sessAcctGUID', $getData['data'][0]['account_guid'] );
            $this->GPLogicSession->setIndex( 'sessFirstName', $getData['data'][0]['account_first'] );
            $this->GPLogicSession->setIndex( 'sessLastName', $getData['data'][0]['account_last'] );
            $this->GPLogicSession->setIndex( 'sessAcctEmail', $getData['data'][0]['account_email'] );
            $this->GPLogicSession->setIndex( 'SessionIsStarted', true );
            
            header( 'Location: '. gpConfig['URLPATH'] .'administrator' );
           
        }

        /**
         * 
         * @name    processRoleSelectioin
         * 
         * @desc    Allows a user with multiple roles to specify current singular 
         *          operational role
         * 
         * @author  Vincent J. Rahming              
         * 
         */
        public function processRoleSelection() {

            # set the account role as a session variable
            $this->GPLogicSession->setIndex( 'sessAcctRole', $_POST['RoleID'] );
                
            # determine if the location has multiple options, assign location automatically
            if ( sizeof( explode( ',', $_SESSION['sessAcctLocations'] ) ) == 1 ) :

                $this->GPLogicSession->setIndex( 'sessAcctLocation', $_SESSION['sessAcctLocations'] );
                $this->GPLogicSession->setIndex( 'SessionIsStarted', true );
                header( 'Location: '. gpConfig['URLPATH'] .'auth' );    # redirect to auth page.
                                                                        # auth page will forward to appropriate page using route function

            else:

                # redirect user to select role
                header( 'Location: '. gpConfig['URLPATH'] .'auth/selectlocale' );

            endif;

        }

        

        /**
         * 
         * @name    setAuthLogout
         * 
         * @desc    Validates A UserID and Password against the database
         * 
         * @author  Vincent J. Rahming
         *          
         */
        public function setAuthLogout() {
            
            # kill all indexes
            $this->GPLogicSession->destroyIndexes();
            
        }
         
    }