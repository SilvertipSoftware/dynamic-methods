<?php

require('vendor/autoload.php');

class SampleNonBinding {
    use \SilvertipSoftware\DynamicMethods\DynamicMethodBehaviour;

    public $value;

    public function __construct( $value ) {
        $this->value = $value;
    }
    public function regularMethod() {
        echo "regular called ok\n";
    }
}

SampleNonBinding::addDynamicMethod( 'printValue', function($obj,$message) {
    echo "$message: " . $obj->value . "\n";
});

$snb = new SampleNonBinding(5);
$snb->printValue('Here is the value');
$snb->regularMethod();

class SampleBinding {
    use \SilvertipSoftware\DynamicMethods\BindingDynamicMethodBehaviour;

    private $value;

    public function __construct( $value ) {
        $this->value = $value;
    }

    protected function double() {
        return 2 * $this->value;
    }

    public function regularMethod() {
        echo "regular called ok";
    }
}

SampleBinding::addDynamicMethod( 'printValue', function($message) {
    echo "$message: " . $this->double() . "\n";
});

$sb = new SampleBinding(42);
$sb->printValue('Doubled value');
$sb->regularMethod();
