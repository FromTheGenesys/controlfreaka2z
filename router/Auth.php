<?php

    class Auth extends gpRouter {
        
        public function __construct() {
            parent::__construct();
            
            $this->render->LogicAuth         =   new GPLogicAuth();                 # include LogicAuth Library
            $this->render->LogicIndex        =   new GPLogicIndex();                # include LogicIndex Library

            $this->render->setParams         =   [ 'header'  =>  'Auth/Header',
                                                   'footer'  =>  'Auth/Footer' ];   # include specific header and footer for Auth/ pages
         
        }
       
        public function getindex() { 
            
            if ( !isset( $_SESSION['SessionIsStarted'] ) ) :
            
                # if session is not active and started, force the login prompt
                $this->render->page( 'Auth/Login', $this->render->setParams  );
            
            else: 
                
                # if session is started, route the user to the appropriate page based on their role
                $this->render->LogicIndex->routeToIndex();
                
            endif;
            
        }

        public function route() {

            $this->render->LogicIndex->routeToIndex();

        }

        /**
         * 
         * @name    nolocale
         * 
         * @desc    No active locations available for the customer
         * 
         * @author  Vincent J. Rahming
         * 
         * @return  MIXED $getData
         * 
         */
        public function nolocale() {

            $this->render->page( 'Auth/NoLocation', $this->render->setParams  );

        }

        /**
         * 
         * @name    selectrole
         * 
         * @desc    CSR / Senior CSR Role selection page
         * 
         * @author  Vincent J. Rahming
         * 
         * @return  MIXED $getData
         * 
         */
        public function selectrole() {

            if ( !isset( $_SESSION['SessionIsStarted'] ) ) :

                if ( sizeof( $_SESSION ) > 2 ) :

                    if ( isset( $_POST['btnSelectRole'] ) ) :

                        # if the button has been clicked, process the selection of a role
                        $this->render->LogicAuth->processRoleSelection();

                    endif;

                    $this->render->page( 'Auth/SelectRole', $this->render->setParams  );

                else:

                    # redirect to login page
                    $this->getindex();

                endif;
              
            else:
                
                # route to appropriate page
                $this->render->LogicIndex->routeToIndex();

            endif;

        }

        /**
         * 
         * @name    selectlocale
         * 
         * @desc    CSR / Senior CSR Location selection page
         * 
         * @author  Vincent J. Rahming
         * 
         * @return  MIXED $getData
         * 
         */
        public function selectlocale() {

            if ( !isset( $_SESSION['SessionIsStarted'] ) ) :

                if ( sizeof( $_SESSION ) > 2 ) :

                    if ( isset( $_POST['btnSelectLocale'] ) ) :

                        # if the button has been clicked, process the selection of a role
                        $this->render->LogicAuth->processLocationSelection();

                    endif;

                    if ( ( $_SESSION['sessAcctRole'] >= 3 ) AND ( $_SESSION['sessAcctRole'] <= 4 ) ) :

                        # get locations
                        $this->render->GetLocations             =               $this->render->LogicAuth->processGetAccountLocations();

                        if ( $this->render->GetLocations['count'] == 0 ) :

                            $this->render->setMessage           =               [ 'danger', 'Your profile does not contain an active location. At least one active location is required. Please contact your System Administrator in order to continue.' ];                        
                            
                        endif;

                        # display locale page
                        $this->render->page( 'Auth/SelectLocale', $this->render->setParams  );

                    else:

                        # operations or admin                        
                        $_SESSION['SessionIsStarted']   =   true;
                        $this->getindex();
                        
                    endif;

                else:

                    # redirect to login page
                    $this->getindex();

                endif;
              
            else:
                
                # route to appropriate page
                $this->render->LogicIndex->routeToIndex();

            endif;

        }

       
        ###############################
        #  LOGIN / LOGOUT  
        ###############################
        public function login() {
        
            # send LoginID and Password for authentication against the database
            $this->process                                  =                   $this->render->LogicAuth->processAccountLogin();


            if ( $this->process == 1 ) :
               
                $this->getindex();
               
            elseif( $this->process == 2 ):

                $this->render->setMessage                   =                   $this->render->GPLogicMessages->setMessage( 
                                                                                   ['message'  =>  'One or more required fields to not contain the appropriate value. Please try again.',
                                                                                    'color'    =>  'danger',
                                                                                    'border'   =>  'danger',
                                                                                    'title'    =>  'Required Fields Missing',
                                                                                    'icon'     =>  'fa fa-exclamation'] );  
                                                                                //[ 'danger', 'Welcome' ];               
                $this->getindex();

            elseif( $this->process == 2 ):

                $this->render->setMessage                   =                   $this->render->GPLogicMessages->setMessage( 
                                                                                    ['message'  =>  'One or more required fields to not contain the appropriate value. Please try again.',
                                                                                    'color'    =>  'danger',
                                                                                    'border'   =>  'danger',
                                                                                    'title'    =>  'Required Fields Missing',
                                                                                    'icon'     =>  'fa fa-bell'] ); 
                $this->getindex();

            elseif( $this->process == 3 ):

                $this->render->setMessage                   =                   $this->render->GPLogicMessages->setMessage( 
                                                                                    ['message'  =>  'One or more required fields to not contain the appropriate value. Please try again.',
                                                                                    'color'    =>  'danger',
                                                                                    'border'   =>  'danger',
                                                                                    'title'    =>  'Required Fields Missing',
                                                                                    'icon'     =>  'fa fa-bell'] ); 
                $this->getindex();

            endif;
            
        }
        
        public function noaccess() {
            
            $this->render->page( 'Auth/NoAccess', $this->render->setParams  );
            
        }
        
        public function logout() {
            
            $this->render->LogicAuth->setAuthLogout();
            
        }
        
    }