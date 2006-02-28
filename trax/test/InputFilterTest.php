<?php
/**
 *  File for the InputFilterTest class
 *
 * (PHP 5)
 *
 * @package PHPonTraxTest
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright (c) Walter O. Haas 2006
 * @version $Id$
 * @author Walt Haas <haas@xmission.com>
 */

echo "testing InputFilter\n";

// Call InputFilterTest::main() if this source file is executed directly.
if (!defined("PHPUnit2_MAIN_METHOD")) {
    define("PHPUnit2_MAIN_METHOD", "InputFilterTest::main");
}

require_once "PHPUnit2/Framework/TestCase.php";
require_once "PHPUnit2/Framework/TestSuite.php";

// You may remove the following line when all tests have been implemented.
require_once "PHPUnit2/Framework/IncompleteTestError.php";

require_once "../vendor/trax/input_filter.php";

/**
 * Test class for InputFilter.
 * Generated by PHPUnit2_Util_Skeleton on 2006-02-28 at 11:52:31.
 */
class InputFilterTest extends PHPUnit2_Framework_TestCase {
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit2/TextUI/TestRunner.php";

        $suite  = new PHPUnit2_Framework_TestSuite("InputFilterTest");
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
     * @todo Implement testProcess_all().
     */
    public function testProcess_all() {
        // Remove the following line when you implement this test.
        throw new PHPUnit2_Framework_IncompleteTestError;
    }

    /**
     * @todo Implement testProcess().
     */
    public function testProcess() {
        // Remove the following line when you implement this test.
        throw new PHPUnit2_Framework_IncompleteTestError;
    }

    /**
     * @todo Implement testSafeSQL().
     */
    public function testSafeSQL() {
        // Remove the following line when you implement this test.
        throw new PHPUnit2_Framework_IncompleteTestError;
    }
}

// Call InputFilterTest::main() if this source file is executed directly.
if (PHPUnit2_MAIN_METHOD == "InputFilterTest::main") {
    InputFilterTest::main();
}
?>
