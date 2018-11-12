<?php declare(strict_types=1);



namespace OstPrintOrder\Services;



use OstCogitoSoapApi\Bundles\OstCogitoSoapApiBundle\CogitoApiService;



class PrinterService implements PrinterServiceInterface
{



    /**
     * ...
     *
     * @var array
     */
    private $configuration;



    /**
     * ...
     *
     * @return string
     */
    public function __construct( array $configuration )
    {
        $this->configuration = $configuration;
    }




    /**
     * ...
     *
     */
    public function getList(): array
    {
        if ( $this->configuration['live'] == false )
            return array(
                "PRT18",
                "PRT100"
            );


        /* @var $api CogitoApiService */
        $api = Shopware()->Container()->get( "ost_cogito_soap_api.cogito_api_service" );

        return $api->getPrinterList();


    }




    

    /**
     * ...
     *
     */
    public function printOrder( $orderNumber, $printerNumber ): bool
    {
        if ( $this->configuration['live'] == false )
        {
            if ( $printerNumber == "18" )
                return true;

            return false;
        }



        /* @var $api CogitoApiService */
        $api = Shopware()->Container()->get( "ost_cogito_soap_api.cogito_api_service" );

        $api->printOrder( $orderNumber, "PRT" . $printerNumber );

        return true;


    }


}
