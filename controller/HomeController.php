<?php

namespace base\controller; // MVCONE_NAMESPACEBASE\controller

/**
 * It's a example of Controller.  The comments are optional.
 * Class HomeController
 * @package base\controller
 */
class HomeController
{
    /**
     * home\index or index.php?_controller=home&_action=index or home\  or index.php?_controller=home
     * It uses the structure <action>Action().
     * @param string $event
     * @param string $id
     * @param string $idparent
     * @return void
     * @throws \Exception
     */
    public function IndexAction($event="",$id="",$idparent="")
    {
        echo "hola mundo";
    }
}