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

    public function getSignData(array $data): array
    {
        !empty($this->appId) && $data['appid'] = $this->appId;
        empty($data['nonce_str']) && $data['nonce_str'] = strtoupper(bin2hex(random_bytes(16)));
        $content = $this->getContent($data);
        $data['sign'] = $this->getSign($content);
        return $data;
    }

    public function checkSign(array $data, string $sign, bool $urlEncode = true): bool
    {
        return $this->getSign($this->getContent($data, $urlEncode)) === $sign;
    }

    private function getContent(array $data): string
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
                        $temp[] = trim("{$key}[{$k}]=". urlencode((string)$v));
                    }
                }
            } else {
                $temp[] = trim($key .'='. urlencode((string)$item));
            }
        }

        return implode('&', $temp);
    }

    private function getSign(string $content): string
    {
        return strtoupper(md5(md5($content . $this->secretKey) . $this->secretKey));
    }
}
