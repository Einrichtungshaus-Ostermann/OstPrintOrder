<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Print Order
 *
 * @package   OstPrintOrder
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

use OstPrintOrder\Services\PrinterServiceInterface;
use Shopware\Components\CSRFWhitelistAware;

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
        // get printer number
        $number = $this->Request()->getParam('printer');

        /* @var $printerService PrinterServiceInterface */
        $printerService = Shopware()->Container()->get('ost_print_order.printer_service');

        // get every printer
        $printer = $printerService->getList();

        // ...
        $printerNumbers = array_column($printer, 'Prnt');

        // valid printer?
        $isAvailable = (in_array('PRT' . $number, $printerNumbers));

        // create response
        $response = [
            'success'     => true,
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
        // get parameters
        $number = $this->Request()->getParam('number');
        $printer = $this->Request()->getParam('printer');

        /* @var $printerService PrinterServiceInterface */
        $printerService = Shopware()->Container()->get('ost_print_order.printer_service');

        // try to print order
        $printed = $printerService->printOrder($number, $printer);

        // create response
        $response = [
            'success' => $printed
        ];

        // echo as json encoded string and die
        echo json_encode($response);
        die();
    }

    /**
     * ...
     */
    public function getDefaultPrinterAction()
    {
        // ...
        if ( Shopware()->Container()->get('ost_print_order.configuration')['live'] == false )
        {
            // create response
            $response = [
                'success' => true,
                'printer' => str_replace( "PRT", "", Shopware()->Container()->get('ost_print_order.configuration')['defaultPrinter'] )
            ];

            // echo as json encoded string and die
            echo json_encode($response);
            die();
        }

        $url = 'http://intranet-apswit11/verkaufsassistent/getdefaultprinterbyip/' . $this->Request()->getClientIp();

        $data = file_get_contents($url);

        $arr = json_decode($data, true);

        // create response
        $response = [
            'success' => $arr['success'],
            'printer' => str_replace( "PRT", "", $arr['printer'] )
        ];

        // echo as json encoded string and die
        echo json_encode($response);
        die();
    }
}
