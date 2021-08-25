<?php

    /** ***********************************************************
     * @name    Genesys Project Framework
     * @author  Vincent J. Rahming
     * @desc    Genesys Project Framework designed using MVC architecture
     * @created February 8th, 2018
     * @file    gpConfig.php
     **/

    class gpConfig {

        public function __construct() {

            # System Error Reporting Controls
            error_reporting( E_ALL & ~E_NOTICE|E_STRICT );
            ini_set( 'display_errors', 1 );  # set to 1 in dev, set to 0 in production

            # define system and file paths
            # all defined paths are named in UPPERCASE and has an underscore prefix (_)

            # *********************************************** #
            # GENESYS PROJECT GENERAL CONFIGURATION SETTINGS  #
            # *********************************************** #
            define( 'gpConfig',   [ 'ASSETS'      =>      'assets/',
                                    'BASEPATH'    =>      realpath('') .'/',
                                    'DATA'        =>      'data/',
                                    'DOWNLOADS'   =>      'downloads/',
                                    'IMAGES'      =>      'img/',
                                    'LIBS'        =>      'libs/',
                                    'LOGIC'       =>      'logic/',
                                    'LOGS'        =>      'logs/',
                                    'ROUTER'      =>      'router/',
                                    'RENDER'      =>      'render/',
                                    'TIMEOUT'     =>      15,
                                    'UPLOADS'     =>      'uploads/',
                                    'URLPATH'     =>      ''
                                   ] );

            # *********************************************** #
            # GENESYS PROJECT DATABASE CONFIGURATION SETTINGS #
            # *********************************************** #
             define( 'gpDataCfg',  [ 'HOST'        =>      '',
                                     'USER'        =>      '',
                                     'PWSD'        =>      '',
                                     'SOURCE'      =>      '' ] );

            # *********************************************** #
            # GENESYS PROJECT SECURITY CONFIGURATION SETTINGS #
            # *********************************************** #
            define( 'gpSecCfg',   [ 'ENC_METHOD'  =>      '',
                                    'SECRET_KEY'  =>      '',
                                    'SECRET_IV'   =>      ''] );

            # *********************************************** #
            # GENESYS PROJECT PAGE CONFIGURATION SETTINGS     #
            # *********************************************** #
            define( 'gpPageCfg',  [ 'FOOTER'      =>      '',
                                    'NAME'        =>      '',
                                    'KEYWORDS'    =>      '',
                                    'DESCRIPTION' =>      '',
                                    'AUTHOR'      =>      '',
                                    'TITLE'       =>      'MVP - Control Freak v1.0
                                    ' ] );

            # *********************************************** #
            # GENESYS PROJECT VERSION CONTROL                 #
            # *********************************************** #
            define( 'gpVersCfg',  [ 'VERSION'     =>      '2.0',
                                    'DATE'        =>      '',
                                    'TITLE'       =>      'Genesysnow Now' ] );

            # *********************************************** #
            # GENESYS PROJECT MAIL CONFIGURATION SETTINGS     #
            # *********************************************** #
            define( 'gpMailCfg',  [ 'HOST'        =>      '',
                                    'USER'        =>      '',
                                    'PSWD'        =>      '',
                                    'PORT'        =>      '' ] );

            # *********************************************** #
            # GENESYS PROJECT DEFAULTS CONFIGURATION SETTINGS #
            # *********************************************** #
            define( 'gpDefsCfg',  [ 'HEADER'       =>      'Header.php',
                                    'FOOTER'       =>      'Footer.php',
                                    'ERROR'        =>      'Errors.php',
                                    'INDEX'        =>      'Index.php',
                                    'HOME'         =>      'Index.php' ] );

            # define path to other classes within the project scope
            set_include_path( get_include_path() . PATH_SEPARATOR . gpConfig['BASEPATH'] . gpConfig['LIBS'] );
            set_include_path( get_include_path() . PATH_SEPARATOR . gpConfig['BASEPATH'] . gpConfig['ROUTER'] );
            set_include_path( get_include_path() . PATH_SEPARATOR . gpConfig['BASEPATH'] . gpConfig['LOGIC'] );

            date_default_timezone_set('America/Nassau');

        }

     }
