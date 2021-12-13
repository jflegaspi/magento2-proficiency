<?php

namespace ATF\Specific404Page\Controller;

class Custom404RouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{


    public function process(\Magento\Framework\App\RequestInterface $request)
    {

        $pathInfo = $request->getPathInfo();

        $paths = explode('/', trim($pathInfo, '/'));

        $controller = $paths[1] ?? '';

        if($controller === 'product')
        {

            $request->setModuleName('notfound')->setControllerName('product')->setActionName('customproduct404');

        }
        else  if($controller === 'category')
        {

            $request->setModuleName('notfound')->setControllerName('category')->setActionName('customcategory404');

        }
        else {

            $request->setModuleName('notfound')->setControllerName('page')->setActionName('custom404route');
        }

        return true;
    }
}
