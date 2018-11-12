<?php declare(strict_types=1);




use Shopware\Components\CSRFWhitelistAware;
use OstPrintOrder\Services\PrinterServiceInterface;



class Shopware_Controllers_Frontend_OstPrintOrder extends Enlight_Controller_Action implements CSRFWhitelistAware
{
    /**
     * ...
     *
     * @throws Exception
     */
    public function preDispatch()
    {
        // ...
        $viewDir = $this->container->getParameter('ost_print_order.view_dir');
        $this->get('template')->addTemplateDir($viewDir);
        parent::preDispatch();
    }



    /**
     * ...
     *
     * @return array
     */
    public function getWhitelistedCSRFActions()
    {
        // return all actions
        return array_values(array_filter(
            array_map(
                function ($method) { return (substr($method, -6) === 'Action') ? substr($method, 0, -6) : null; },
                get_class_methods($this)
            ),
            function ($method) { return  !in_array((string) $method, ['', 'index', 'load', 'extends'], true); }
        ));
    }



    /**
     * ...
     */
    public function indexAction()
    {
    }





    /**
     * ...
     */
    public function checkPrinterAction()
    {
        $number = $this->Request()->getParam( "printer" );

        /* @var $printerService PrinterServiceInterface */
        $printerService = Shopware()->Container()->get( "ost_print_order.printer_service" );


        $printer = $printerService->getList();



        $isAvailable = ( in_array( "PRT" . $number, $printer ) );


        // create response
        $response = [
            'success' => true,
            'isAvailable' => $isAvailable
        ];

        // echo as json encoded string and die
        echo json_encode($response);
        die();
    }




    /**
     * ...
     */
    public function printOrderAction()
    {
        $number = $this->Request()->getParam( "number" );
        $printer = $this->Request()->getParam( "printer" );

        /* @var $printerService PrinterServiceInterface */
        $printerService = Shopware()->Container()->get( "ost_print_order.printer_service" );


        $printed = $printerService->printOrder( $number, $printer );



        // create response
        $response = [
            'success' => $printed
        ];

        // echo as json encoded string and die
        echo json_encode($response);
        die();
    }




}
