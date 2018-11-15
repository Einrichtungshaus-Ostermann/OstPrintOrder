
;(function ($) {

    // use strict mode
    "use strict";






    // detail plugin
    $.plugin( "ostOrderPrint", {




        number: null,




        configuration: {
            checkPrinterUrl: null,
            printOrderUrl: null
        },





        // on initialization
        init: function ()
        {
            // get this
            var me = this;



            me.number = me.$el.data( "order-number" );


            me.configuration.checkPrinterUrl = ostPrintOrderConfiguration.checkPrinterUrl;
            me.configuration.printOrderUrl = ostPrintOrderConfiguration.printOrderUrl;


            // admin delete
            me._on( me.$el, 'click', $.proxy( me.onPrintClick, me ) );
        },






        // ...
        onPrintClick: function ( event )
        {
            // get this
            var me = this;

            // open number input
            $.ostFoundationNumberInput.open(
                "Drucker wählen",
                {
                    castToInteger: false
                },
                function( number ) {


                    // try to login
                    $.ostFoundationJson.get(
                        {
                            url: me.configuration.checkPrinterUrl,
                            method: "post",
                            params: { printer: number }
                        },
                        function( response ) {

                            // ...
                            if ( response.success == false || response.isAvailable == false )
                                // show error
                                return $.ostFoundationAlert.open( "Der Drucker wurde nicht gefunden.", {
                                    callback: function() {
                                    }
                                });





                            // finally print the order
                            $.ostFoundationJson.get(
                                {
                                    url: me.configuration.printOrderUrl,
                                    method: "post",
                                    params: { number: me.number, printer: number }
                                },
                                function( response ) {

                                    // ...
                                    if ( response.success == false  )
                                        return $.ostFoundationAlert.open( "Die Bestellung konnte nicht gedruckt werden. Bitte versuchen Sie es erneut.", {
                                        });

                                }
                            );


                        }
                    );


                }
            );
        },







        // on destroy
        destroy: function()
        {
            // get this
            var me = this;

            // call the parent
            me._destroy();
        }



    });




    // call our plugin
    $( "body .ost-order-print--button" ).ostOrderPrint();








})(jQuery);



