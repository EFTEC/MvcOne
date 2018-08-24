<?php

class AppStatic {
    /** @var App */
    public static $_instance;

    public static function __callStatic($function, $parameters)
    {
        $instance = static::$_instance;
        if (! $instance) {
            $instance=new App();
        }
        return $instance->$function(...$parameters);
    }

}

class App {
    //todo: the global stuffs.
    public function example() {
        echo "ok";
    }
}
