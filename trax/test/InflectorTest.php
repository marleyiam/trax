<?php
/**
 *  Regression test for the {@link Inflector} class
 *
 * (PHP 5)
 *
 * @package PHPonTraxTest
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright (c) Walter O. Haas 2006
 * @version $Id$
 * @author Walt Haas <haas@xmission.com>
 */

echo "testing Inflector\n";
require_once 'testenv.php';

// Call InflectorTest::main() if this source file is executed directly.
if (!defined("PHPUnit2_MAIN_METHOD")) {
    define("PHPUnit2_MAIN_METHOD", "InflectorTest::main");
}

require_once "PHPUnit2/Framework/TestCase.php";
require_once "PHPUnit2/Framework/TestSuite.php";

/**
 *  Require class to be tested
 */
require_once "inflector.php";

/**
 * Test class for Inflector.
 * Generated by PHPUnit2_Util_Skeleton on 2006-02-11 at 13:41:16.
 */
class InflectorTest extends PHPUnit2_Framework_TestCase {

    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit2/TextUI/TestRunner.php";

        $suite  = new PHPUnit2_Framework_TestSuite("InflectorTest");
        $result = PHPUnit2_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     */
    protected function tearDown() {
    }

    /**
     *  Test {@link Inflector::pluralize()}
     */
    public function testPluralize() {
        $this->assertEquals(Inflector::pluralize('order'), 'orders');
        $this->assertEquals(Inflector::pluralize('person'), 'people');
        $this->assertEquals(Inflector::pluralize('query'), 'queries');
    }

    /**
     *  Test {@link Inflector::singularize()}
     */
    public function testSingularize() {
        $this->assertEquals(Inflector::singularize('orders'), 'order');
        $this->assertEquals(Inflector::singularize('people'), 'person');
        $this->assertEquals(Inflector::singularize('processes'), 'process');
        $this->assertEquals(Inflector::singularize('queries'), 'query');
    }

    /**
     *  Test {@link Inflector::camelize()}
     */
    public function testCamelize() {
        $this->assertEquals(Inflector::camelize('order'), 'Order');
        $this->assertEquals(Inflector::camelize('order_details'),
                            'OrderDetails');
    }

    /**
     *  Test {@link Inflector::underscore()}
     */
    public function testUnderscore() {
        $this->assertEquals(Inflector::underscore('OrderDetails'),
                            'order_details');
        $this->assertEquals(Inflector::underscore('Person'),'person');
    }

    /**
     *  Test {@link Inflector::humanize()}
     */
    public function testHumanize() {
        $this->assertEquals(Inflector::humanize('order_details'),
                            'Order Details');
        $this->assertEquals(Inflector::humanize('people'), 'People');
    }

    /**
     *  Test {@link Inflector::tableize()}
     */
    public function testTableize() {
        $this->assertEquals(Inflector::tableize('Person'), 'people');
        $this->assertEquals(Inflector::tableize('Query'), 'queries');
        $this->assertEquals(Inflector::tableize('OrderDetail'),
                            'order_details');
    }

    /**
     *  Test {@link Inflector::classify()}
     */
    public function testClassify() {
        $this->assertEquals(Inflector::classify('people'), 'Person');
        $this->assertEquals(Inflector::classify('queries'), 'Query');
        $this->assertEquals(Inflector::classify('accesses'), 'Access');
        echo Inflector::classify('Access')."\n";
    }

    /**
     *  Test {@link Inflector::foreign_key()}
     */
    public function testForeign_key() {
        $this->assertEquals(Inflector::foreign_key('people'), 'people_id');
        $this->assertEquals(Inflector::foreign_key('queries'), 'queries_id');
    }
}

// Call InflectorTest::main() if this source file is executed directly.
if (PHPUnit2_MAIN_METHOD == "InflectorTest::main") {
    InflectorTest::main();
}

// -- set Emacs parameters --
// Local variables:
// tab-width: 4
// c-basic-offset: 4
// c-hanging-comment-ender-p: nil
// indent-tabs-mode: nil
// End:
?>
