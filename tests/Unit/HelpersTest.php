<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    /**
     * Test correct return from get_names_from_string with standard name containing no middle
     *
     * @return void
     */
    public function test_getnamesfromstring_standard_name_returns_no_middle()
    {
        $result = get_names_from_string("John Smith");
        $this->assertIsArray($result, "Result is Array.");

        $this->assertEquals([
            "John", [""], "Smith"
        ], $result, "Result middle names array should contain an empty string if no middle names.");
    }

    /**
     * Test incorrect return from get_names_from_string with standard name containing no middle
     *
     * @return void
     */
    public function test_getnamesfromstring_standard_name_returns_no_middle_incorrect()
    {
        $result = get_names_from_string("John Smith");
        $this->assertIsArray($result, "Result is not an array.");

        $this->assertNotEquals([
            "John", [], "Smith"
        ], $result, "Result middle names array should contain an empty string if no middle names.");
    }
}
