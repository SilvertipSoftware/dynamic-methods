<?php namespace SilvertipSoftware\DynamicMethods;

trait DynamicMethodBehaviour {

    protected static $_dynamicMethods;

    public static function addDynamicMethod($name, \Closure $func)
    {
        static::$_dynamicMethods[get_called_class()][$name] = $func;
    }

    public static function hasDynamicMethod($name)
    {
        return isset( static::$_dynamicMethods[get_called_class()][$name] );
    }

    public static function getDynamicMethod($name)
    {
        return ( static::hasDynamicMethod($name) ) ? 
            static::$_dynamicMethods[get_called_class()][$name] : null;
    }

    public static function clearDynamicMethods() {
        static::$_dynamicMethods[get_called_class()] = array();
    }

    public static function removeDynamicMethod($name) {
        unset( static::$_dynamicMethods[get_called_class()][$name] );
    }

    public function __call($method, $parameters) {
        if ( static::hasDynamicMethod( $method ) ) {
            array_unshift($parameters, $this );
            return call_user_func_array(static::getDynamicMethod($method), $parameters);
        }
        return parent::__call($method, $parameters);
    }

}