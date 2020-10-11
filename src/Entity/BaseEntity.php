<?php
namespace Webdock\Entity;
use Webdock\Exception\EntityException;
use GuzzleHttp\Psr7\Response;

class BaseEntity implements EntityInterface
{
    use Validator;
    protected $attributes = [];

    public function __construct(array $data = null)
    {
        if (is_array($data)) {
            $this->fromArray($data);
        }
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function fromArray(array $data)
    {
        if ($this->validate($data)) {
            $this->attributes = $data;
            return $this;
        }
    }
}
