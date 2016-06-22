/**
 * Created by lucasnascimento on 21/06/2016.
 */

( function( $ ) {

    $( document ).ready( function() {
        body = $( document.body );

        $( window )
            .on( 'load', function () {

                if ( !body.hasClass('home') ) {
                    $('.fusion-toggle-icon-line').css('background-color', '#000');
                    $('.fusion-icon:before').css('color', '#000 !important');
                    $('.fusion-logo-link img').css('filter', 'brightness(0%)');
                    $('.fusion-logo-link img').css('-webkit-filter', 'brightness(0%)');
                }



                //$loadBtn = $self.find("#sbi_load .sbi_load_btn");
                
                
                

            } );
    } );




} )( jQuery );
