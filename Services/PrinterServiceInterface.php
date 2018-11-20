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

interface PrinterServiceInterface
{
    /**
     * ...
     *
     * @return array
     */
    public function getList(): array;

    /**
     * ...
     *
     * @param mixed $orderNumber
     * @param mixed $printerNumber
     *
     * @return bool
     */
    public function printOrder($orderNumber, $printerNumber): bool;
}
