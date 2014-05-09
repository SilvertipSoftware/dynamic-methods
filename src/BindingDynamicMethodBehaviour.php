<?php namespace SilvertipSoftware\DynamicMethods;

trait BindingDynamicMethodBehaviour {
    use DynamicMethodBehaviour;
    
    public function __call($method, $parameters) {
        if ( static::hasDynamicMethod( $method ) ) {
            return call_user_func_array( static::getDynamicMethod($method)->bindTo( $this, get_called_class() ), $parameters);
        }
        return parent::__call($method, $parameters);
    }

}