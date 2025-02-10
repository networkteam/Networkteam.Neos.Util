<?php
namespace Networkteam\Neos\Util\Tests\Unit;

use Networkteam\Neos\Util\Eel\ArrayHelper;

class ArrayHelperTest extends \Neos\Flow\Tests\UnitTestCase {
    public static function hasElementIntersectionExamples()
    {
        return [
            'All are equal' => [[1, 2, 3, 4, 5], [1, 2, 3, 4, 5], true],
            'Some are equal' => [[1, 2, 3, 4], [4, 5, 6, 7], true],
            'None are equal' => [[1, 2, 3, 4], [5, 6, 7, 8], false],
            'some strings are equal' => [['a', 'b', 'c'], ['c', 'd', 'e'], true],
            'no strings are equal' => [['a', 'b', 'c'], ['d', 'e', 'f'], false],
            'empty arrays' => [[], [], false],
            'no array' => [ '', null, null]
        ];
    }

    /**
     * @test
     * @dataProvider hasElementIntersectionExamples
     */
    public function hasElementIntersectionWorks($array1, $array2, $expected)
    {
        $helper = new ArrayHelper();
        $result = $helper->hasElementIntersection($array1, $array2);
        self::assertEquals($expected, $result);
    }
}
