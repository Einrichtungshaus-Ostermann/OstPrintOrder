<?php declare(strict_types=1);



namespace OstPrintOrder\Listeners\Controllers\Frontend;

use Enlight_Controller_Action as Controller;
use Enlight_Event_EventArgs as EventArgs;
use Enlight_Hook_HookArgs as HookArgs;
use Shopware\Models\Order\Order;
use Shopware\Components\Model\ModelManager;

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
    public function onPostDispatch(EventArgs $arguments)
    {
        /* @var $controller Controller */
        $controller = $arguments->get('subject');
        $request = $controller->Request();
        $view = $controller->View();
        $controllerName = $request->getControllerName();


        // add template dir
        $view->addTemplateDir($this->viewDir);
    }




}
