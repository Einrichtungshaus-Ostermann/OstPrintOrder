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
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(): array
    {
        // are we not live?
        if ($this->configuration['live'] === false) {
            // return default printers
            return array_map(
                function ($printer) { return trim($printer); },
                explode( '<br>', nl2br( $this->configuration['availablePrinters'], false ) )
            );
        }

        /* @var $api CogitoApiService */
        $api = Shopware()->Container()->get('ost_cogito_soap_api.cogito_api_service');

        // return list by cogito api
        return $api->getPrinterList();
    }

    /**
     * {@inheritdoc}
     */
    public function printOrder($orderNumber, $printerNumber): bool
    {
        // are we not live?
        if ($this->configuration['live'] === false) {
            // prt18 is valid printer
            if ($printerNumber === str_replace("PRT", "", trim($this->configuration['validPrinter']))) {
                return true;
            }

            // every other is invalid
            return false;
        }

        /* @var $api CogitoApiService */
        $api = Shopware()->Container()->get('ost_cogito_soap_api.cogito_api_service');

        // print by cogito api
        $api->printOrder($orderNumber, 'PRT' . $printerNumber);

        // all good
        return true;
    }
}
