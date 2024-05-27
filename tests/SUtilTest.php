<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Shayvmo\ShayvmoUtil\SUtil;

class SUtilTest extends TestCase
{
    public function testPwdEncrypt()
    {
        $this->assertIsString(SUtil::pwdEncrypt("123456"));
    }

    public function testArrayGroupByKey()
    {
        $data = [
            [
                "a" => "a3",
                "b" => 4,
            ],
            [
                "a" => "a3",
                "b" => 1,
            ],
            [
                "a" => "a3",
                "b" => 2,
            ],
            [
                "a" => "a2",
                "b" => 2,
            ],
            [
                "a" => "a2",
                "b" => 22,
            ],
        ];
        $this->assertEquals(SUtil::arrayGroupByKey($data, "a"), [
            "a3" => [
                [
                    "a" => "a3",
                    "b" => 4,
                ],
                [
                    "a" => "a3",
                    "b" => 1,
                ],
                [
                    "a" => "a3",
                    "b" => 2,
                ],
            ],
            "a2" => [
                [
                    "a" => "a2",
                    "b" => 2,
                ],
                [
                    "a" => "a2",
                    "b" => 22,
                ],
            ],
        ]);

        $this->assertEquals(SUtil::arrayGroupByKey($data, "a", "b"), [
            "a3" => [4, 1, 2],
            "a2" => [2, 22],
        ]);
    }

    public function testGetTreeData()
    {
        $data = [
            [
                'id' => 1,
                'parent_id' => 0,
                'label' => '1',
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'label' => '1-2',
            ],
            [
                'id' => 3,
                'parent_id' => 0,
                'label' => '3',
            ],
        ];
        $this->assertEquals([
            [
                'id' => 1,
                'parent_id' => 0,
                'label' => '1',
                'children' => [
                    [
                        'id' => 2,
                        'parent_id' => 1,
                        'label' => '1-2',
                    ],
                ],
            ],
            [
                'id' => 3,
                'parent_id' => 0,
                'label' => '3',
            ],
        ], SUtil::getTreeData($data));
    }

    public function testLongLatDistance()
    {
        $this->assertIsFloat(SUtil::longLatDistance(23.096252,113.320632, 23.091055,113.327348));
    }
}
