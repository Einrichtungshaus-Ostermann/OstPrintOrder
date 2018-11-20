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
namespace OstPrintOrder\Listeners\Controllers\Frontend;

use Enlight_Controller_Action as Controller;
use Enlight_Event_EventArgs as EventArgs;

class Checkout
{
    /**
     * ...
     *
     * @var string
     */
    protected $viewDir;

    /**
     * ...
     *
     * @var array
     */
    protected $configuration;

    /**
     * ...
     *
     * @param string $viewDir
     * @param array  $configuration
     */
    public function __construct($viewDir, array $configuration)
    {
        // set params
        $this->viewDir = $viewDir;
        $this->configuration = $configuration;
    }

    /**
     * ...
     *
     * @param EventArgs $arguments
     */
    public function onPreDispatch(EventArgs $arguments)
    {
        /* @var $controller Controller */
        $controller = $arguments->get('subject');
        $request = $controller->Request();
        $view = $controller->View();

        // add template dir
        $view->addTemplateDir($this->viewDir);
    }
}
