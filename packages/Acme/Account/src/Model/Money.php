<?php declare(strict_types=1);

namespace Acme\Account\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValueObject
 */
class Money
{
    /**
     * @var int
     */
    private $value;

    /**
     * Money constructor.
     * @param int $value
     * @throws \InvalidArgumentException
     */
    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('more money!!!');
        }

        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param Money $money
     * @return Money
     */
    public function addition(self $money) : self
    {
        return new self($this->value + $money->getValue());
    }

    public function subtraction(self $money) :self
    {
        return new self($this->value - $money->getValue());
    }

}