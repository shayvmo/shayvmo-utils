<?php

declare (strict_types=1);


namespace Shayvmo\ShayvmoUtil\sign;


/**
 * 签名加密类
 */
class Signature
{
    private $appId;

    private $secretKey;

    public function __construct(string $appId, string $secretKey)
    {
        $this->appId = $appId;
        $this->secretKey = $secretKey;
        if (empty($this->secretKey)) {
            throw new \RuntimeException("secretKey不能为空");
        }
    }

    public function getSignData(array $data, bool $urlEncode = false): array
    {
        !empty($this->appId) && $data['appid'] = $this->appId;
        $data['nonce_str'] = strtoupper(bin2hex(random_bytes(16)));
        $content = $this->getContent($data, $urlEncode);
        $data['sign'] = $this->getSign($content);
        return $data;
    }

    public function checkSign(array $data, string $sign, bool $urlEncode = false): bool
    {
        return $this->getSign($this->getContent($data, $urlEncode)) === $sign;
    }

    private function getContent(array $data, bool $urlEncode = false): string
    {
        ksort($data);

        $temp = [];

        foreach ($data as $key => $item) {
            if ($key === 'sign' || $item === '' || is_null($item)) {
                continue;
            }
            if (is_array($item)) {
                foreach ($item as $k => $v) {
                    if (!is_array($v)) {
                        $temp[] = trim("{$key}[{$k}]=". $urlEncode ? urlencode((string)$v) : $v);
                    }
                }
            } else {
                $temp[] = trim($key .'='. $urlEncode ? urlencode((string)$item) : $item);
            }
        }

        return implode('&', $temp);
    }

    private function getSign(string $content): string
    {
        return strtoupper(md5(md5($content . $this->secretKey) . $this->secretKey));
    }
}
