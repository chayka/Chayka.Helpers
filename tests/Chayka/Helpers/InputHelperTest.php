<?php

use Chayka\Helpers\InputHelper;

class InputHelperTest extends PHPUnit_Framework_TestCase {

    public function testInputFiltering(){
        $input = array(
            'a' => 'a',
            'trimmed' => ' trimmed ',
            'slashed' => '\"slashed\"',
            'html-forbidden' => '<a href="http://google.com">forbidden</a> hey',
            'html-allowed' => '<a href="http://google.com">allowed</a> hey',
        );

        InputHelper::setInput($input);

        InputHelper::permitHtml('html-allowed');

        $this->assertEquals('a', InputHelper::getParam('a'));
        $this->assertEquals(' trimmed', InputHelper::getParam('trimmed'));
        $this->assertEquals('"slashed"', InputHelper::getParam('slashed'));
        $this->assertEquals('forbidden hey', InputHelper::getParam('html-forbidden'));
        $this->assertEquals('<a href="http://google.com">allowed</a> hey', InputHelper::getParam('html-allowed'));
    }
}
 