--TEST--
The right events are emitted in the right order for a test that uses a data provider that returns an invalid array
--SKIPIF--
<?php declare(strict_types=1);
if (DIRECTORY_SEPARATOR === '\\') {
    print "skip: this test does not work on Windows / GitHub Actions\n";
}
--FILE--
<?php declare(strict_types=1);
$traceFile = tempnam(sys_get_temp_dir(), __FILE__);

$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--no-output';
$_SERVER['argv'][] = '--log-events-text';
$_SERVER['argv'][] = $traceFile;
$_SERVER['argv'][] = __DIR__ . '/_files/InvalidDataProviderTest.php';

require __DIR__ . '/../../bootstrap.php';

PHPUnit\TextUI\Application::main(false);

print file_get_contents($traceFile);

unlink($traceFile);
--EXPECTF--
Test Runner Started (PHPUnit %s using %s)
Test Runner Configured
Test Triggered PHPUnit Error (PHPUnit\TestFixture\Event\InvalidDataProviderTest::testOne)
The data provider specified for PHPUnit\TestFixture\Event\InvalidDataProviderTest::testOne is invalid
Data set #0 is invalid

Test Runner Triggered Warning (No tests found in class "PHPUnit\TestFixture\Event\InvalidDataProviderTest".)
Test Suite Loaded (0 tests)
Test Suite Sorted
Event Facade Sealed
Test Runner Execution Started (0 tests)
Test Runner Execution Finished
Test Runner Finished
