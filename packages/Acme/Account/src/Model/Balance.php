<?php

namespace Acme\Account\Model;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Balance
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="balance")
     */
    private $value;

    /**
     * Balance constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function deposit(Money $money) :self
    {
        return new Balance($this->value + $money->getValue());
    }

    public function withdraw(Money $money) :self
    {
        return new Balance($this->value - $money->getValue());
    }
}