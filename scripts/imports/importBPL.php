<?php

    ini_set( 'display_errors', 1 );

    /**
     * @name        importBPL
     * 
     * @author      Vincent J. Rahming
     * 
     * @desc        Collects BPL data file and processes it for import into the MVP Database
     * 
     */

     $RemoteSFTP                    =                   '24.244.157.228';
     $RemoteUser                    =                   'vendorbec';
     $RemotePswd                    =                   'CNgFt4BEC!@';
     $RemotePath                    =                   '/';
     $LocalPath                     =                   '/var/www/html/controlfreak/scripts/imports/data/bpl/';

     # connect to remote server
     $RemoteConnect                 =                   ftp_connect( $RemoteSFTP );

     try { 

        if ( ftp_login( $RemoteConnect, $RemoteUser, $RemotePswd ) == true ) :

             $RemoteLastFile             =                    ftp_mdtm( $RemoteConnect, $RemotePath . 'customer.txt' );            

        endif;

     } catch( Exception $ex ) {

        print_r( $ex );

     }

     # attempt to login
    //  if ( ftp_login( $RemoteConnect, $RemoteUser, $RemotePswd ) ) :

        # the last time the remote file was modified, it must be 24 hours
        // $RemoteLastFile             =                    ftp_mdtm( $RemoteConnect, $RemotePath . 'customer.txt' );
        // $SetAgeDate                 =                    new DateTime( date( 'Y-m-d H:i:s', $RemoteLastFile ) );
        // $SetCurrDate                =                    new DateTime();
        // $SetDifference              =                    $SetAgeDate->diff( $SetCurrDate );

        // # if the file is greater than 24 hours, send a alert.
        // if ( $SetDifference->h > 24 ) :

        //     # send a text message
        //     # send an email message

        // endif;

        # create a customer file in which to write data
        // $CreateRemoteFile           =                    fopen( $LocalPath . 'customer_data.txt', 'w' );

        // print_r( ftp_nlist( $RemoteConnect, $RemotePath ) );

        // # pull the file into a data folder
        // if ( ftp_nb_get( $RemoteConnect, $LocalPath . 'customer_data.txt', 'customer.txt', FTP_ASCII, 0 ) == false ) :

        //     # transfer was not successfully executed
        //     echo 'Transfer was not successfully executed ... ';

        // else:

        
            
        // endif;

        // fclose( $CreateRemoteFile );

    //  else:

    //  endif;

     # close connection
     ftp_close( $RemoteConnect );