<?php

namespace Tests\Unit;

use Tests\TestCase;

class NameValidationTest extends TestCase
{
    /**
     * Test that the name validation regex accepts names with spaces and only letters.
     */
    public function test_name_validation_accepts_spaces_and_valid_characters()
    {
        $name = 'John Doe';
        // Regex allows letters with optional spaces between words and requires at least 3 characters.
        $regex = '/^(?=.{3,}$)[A-Za-z]+(?:\s[A-Za-z]+)*$/';
        $this->assertMatchesRegularExpression($regex, $name);
    }
}
