<?php

namespace Evently\LimeRemote\Query;

class LimeRemoteQueryBuilder
{
    protected $method;
    protected $params = [];
    protected $sessionKey;

    public function __construct(string $method)
    {
        $this->method = $method;
    }

    public static function method(string $method): self
    {
        return new self($method);
    }

    public function withSessionKey(string $sessionKey): self
    {
        $this->sessionKey = $sessionKey;

        return $this;
    }

    public function withParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function build(): array
    {
        $params = $this->params;
        if ($this->sessionKey !== null) {
            array_unshift($params, $this->sessionKey);
        }

        return [$this->method, $params];
    }
}
