<?php
declare(strict_types=1);

namespace corbomite\tests\utilities;

use PHPUnit\Framework\TestCase;
use corbomite\migrations\utilities\CaseConversionUtility;

class CaseConversionUtilityTest extends TestCase
{
    public function testConvertStringToPascale()
    {
        $obj = new CaseConversionUtility();

        self::assertEquals(
            'TestString',
            $obj->convertStringToPascale('Test String')
        );

        self::assertEquals(
            'AnotherStringThing',
            $obj->convertStringToPascale('another string thing')
        );

        self::assertEquals(
            'MyString',
            $obj->convertStringToPascale('my_string')
        );

        self::assertEquals(
            'SomeString',
            $obj->convertStringToPascale('someString')
        );

        self::assertEquals(
            'Something',
            $obj->convertStringToPascale('something')
        );
    }

    public function testConvertStringToCamel()
    {
        $obj = new CaseConversionUtility();

        self::assertEquals(
            'testString',
            $obj->convertStringToCamel('Test String')
        );

        self::assertEquals(
            'anotherStringThing',
            $obj->convertStringToCamel('another string thing')
        );

        self::assertEquals(
            'myString',
            $obj->convertStringToCamel('my_string')
        );

        self::assertEquals(
            'someString',
            $obj->convertStringToCamel('someString')
        );

        self::assertEquals(
            'something',
            $obj->convertStringToCamel('something')
        );
    }
}
