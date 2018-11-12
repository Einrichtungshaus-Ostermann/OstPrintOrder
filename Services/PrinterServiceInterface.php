<?php declare(strict_types=1);




namespace OstPrintOrder\Services;

interface PrinterServiceInterface
{
    /**
     * ...
     *
     */
    public function getList(): array;


    /**
     * ...
     *
     */
    public function printOrder( $orderNumber, $printerNumber ): bool;


}
