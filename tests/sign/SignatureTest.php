<?php

declare(strict_types=1);


namespace sign;


use PHPUnit\Framework\TestCase;
use Shayvmo\ShayvmoUtil\sign\Signature;

class SignatureTest extends TestCase
{
    private $appid = "123456";

    private $secretKey = "654321";

    public function testGetSign()
    {
        $data = [
            'a' => 3,
            'b' => 4
        ];
        $signature = new Signature($this->appid, $this->secretKey);
        $signData = $signature->getSignData($data);
        $this->assertIsArray($signData);
        $this->assertNotEmpty($signData['sign']);
    }

    public function testCheckSign()
    {
        $data = [
            'a' => 3,
            'b' => 4,
            'appid' => $this->appid,
            'nonce_str' => "D636F6252C4364FA7EEB716633147C9F",
            'sign' => "462C2C986FCA6BDD7EE878FA28ABEE48",
        ];
        $signature = new Signature($this->appid, $this->secretKey);
        $result = $signature->checkSign($data, $data['sign']);
        $this->assertTrue($result);
    }

    public function testGetAndCheckSign()
    {
        $data = [
            "a" => 3,
            "b" => 4,
            "A" => [
                "a" => 34,
                "b" => 45
            ],
        ];
        $signature = new Signature($this->appid, $this->secretKey);
        $signData = $signature->getSignData($data);
        $this->assertIsArray($signData);
        $this->assertNotEmpty($signData['sign']);
        $result = $signature->checkSign($signData, $signData['sign']);
        $this->assertTrue($result);
    }
}
