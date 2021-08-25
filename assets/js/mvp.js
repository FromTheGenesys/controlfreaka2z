function colorThis() {

    $( "#AddToCart" ).show();

}

$( document ).ready( function() {   

    $('#phone').mask('(999) 999-9999');           
    $('.phone').mask('(999) 999-9999');           
    $('.Expire').mask('99/99');           
    $('.CardNumber').mask('9999-9999-9999-9999');   

    
    // validate numbers
    $( '#PaymentOne').blur( function(){

        var PaymentAmount       =       $( '#PaymentOne' ).val();
        
        if ( $.isNumeric( PaymentAmount ) === false ) {

            $( '#error').html( '<div class="alert alert-danger border-danger">Payment Amount values specified must be numeric. </div>' );

        } 

    });

    // validate numbers
    $( '#PaymentTwo').blur( function(){

        var PaymentAmount       =       $( '#PaymentTwo' ).val();
        
        if ( $.isNumeric( PaymentAmount ) === false ) {

            $( '#error').html( '<div class="alert alert-danger border-danger">Payment Confirmation Amount values specified must be numeric. </div>' );

        } 

    });

    // tender amount
    $( '#Tender').blur( function(){

        var PaymentAmountOne    =   $( '#PaymentOne' ).val();
        var PaymentAmountTwo    =   $( '#PaymentTwo' ).val();
        var PaymentGiven        =   $( '#Tender' ).val();

        if ( PaymentAmountOne != PaymentAmountTwo ) {

            $( '#error').html( '<div class="alert alert-danger border-danger">Please ensure that both payment amounts contain matching values</div>' );

        } else {

            if ( PaymentAmountOne > PaymentGiven ) {

                $( '#error').html( '<div class="alert alert-danger border-danger">The cash amount given does not cover the payment amount specified. </div>' );

            } else {

                $( '#error').html( '' );

                if ( $.isNumeric( PaymentAmountOne ) === false ) {

                    $( '#error').html( '<div class="alert alert-danger border-danger">All values specified must be numeric. </div>' );

                } else {
                    
                    $( '#makePayment').show();

                }
                
            }

        }

    });


    // tender amount
    $( '#BillPayAmount').blur( function(){

        var PaymentAmount    =   $( '#BillPayTotal' ).val();        
        var PaymentGiven     =   $( '#BillPayAmount' ).val();

        if ( Number( PaymentAmount ) > Number( PaymentGiven ) ) {

            $( '#error').html( '<div class="alert alert-danger mt-2 border-danger">Please ensure that the Cash given is sufficient to cover the total due.</div>' );
            $( '#makePayment').hide();
        } else {

            if ( $.isNumeric( PaymentGiven ) == false ) {

                $( '#error').html( '<div class="alert mt-2 alert-danger border-danger">All values specified must be numeric. </div>' );
                $( '#makePayment').hide();
                
            } else {

                $( '#error').html( $.isNumeric( '' ) );
                $( '#makePayment').show();

            }

        }

    });

    $( "#confirmDelete" ).click( function(){

        $( '#TrashButton' ).toggle();

    });

    // insurance scripts
    $( ".insselector" ).click( function() {

        var selected    =   $( 'input[type="checkbox"]:checked' ).length;

        if ( selected > 0 ) {

            $( "#AddToCart" ).show();
            $( "#AddViewCart" ).show();
            
        } else {

            $( "#AddToCart" ).hide();
            $( "#AddViewCart" ).hide();

        }

    });

    $( '#PayMethod' ).change( function() {

        var PayMethod   =   $( "#PayMethod" ).val();

        var CashTable   =   '<table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">' +
                             '<thead class="thead-light font-weight-normal">' +
                              '<tr>' +                
                                 '<th class="text-center" colspan="2">CASH OPTIONS</th>' +                                                                                                                                                                                
                                '</tr>' +
                             '</thead>' +
                              '<tbody>' +
                                '<tr>' +
                                  '<input type="hidden" value="1" name="Method" id="Method" />' +
                                  '<td>Amount:</td><td align="right"><input class="form-control text-right" name="PaymentAmount" id="PaymentCash" required="" autocomplete="off" autofocus style="width: 140px;" /></td>' +                                 
                                '</tr>' +
                             '</tbody>' +
                            '</table>' +

                            '<div class="text-right">' +
                                '<button class="btn-lg mt-3 font-sm btn-success" name="btnPaymentCash"><i class="fa fa-check"></i> Make Payment </button>' +
                            '</div>';


        var CheckTable =   '<table class="table table-responsive-sm table-hover table-striped table-outline mb-0 font-sm">' +
                             '<thead class="thead-light font-weight-normal">' +
                              '<tr>' +                
                                 '<th class="text-center" colspan="2">CHEQUE OPTIONS</th>' +                                                                                                                                                                                
                                '</tr>' +
                             '</thead>' +
                              '<tbody>' +
                                '<tr>' +                                  
                                  '<td>Cheque No:</td><td align="right"><input class="form-control text-right" name="ChequeNo" style="width: 140px;" /></td>' +
                                 '</tr>' +
                                '</tr>' +
                                '<tr>' +                                  
                                  '<td>Cheque Date:</td><td align="right"><input type="date" class="form-control text-right" name="ChequeDate" style="width: 140px;" /></td>' +
                                 '</tr>' +
                                '</tr>' +
                                '<tr>' +
                                  '<input type="hidden" value="2" name="Method" id="Method" />' +
                                  '<td>Amount:</td><td align="right"><input class="form-control text-right" name="PaymentAmount" id="PaymentAmount" autofocus style="width: 140px;" /></td>' +
                                 '</tr>' +
                                '</tr>' +
                             '</tbody>' +
                            '</table>';                            

        if ( PayMethod == 'Cash' ) { 

            $( '#PaymentMethod' ).html( CashTable );

        } else {

            $( '#PaymentMethod' ).html( CheckTable );
            
        }

    });


    $( '#PaymentCash').blur( function(){  

        var Method          =   $( '#Method' ).val();
        var TotalAmount     =   $( '#TotalAmount' ).val();
        var PaymentAmount   =   $( '#PaymentAmount' ).val();

        $( '#output').html( Method );

        if ( Method == 1 ) {

          //  if ( PaymentAmount > TotalAmount ) {

               // $( '#error' ).text( 'Hi' );
                //$( '#error').html( '<div class="alert alert-danger border-danger">The cash amount given does not cover the payment amount specified. </div>' );

//            }

        }

    });

}); 