<?php declare(strict_types=1);

namespace Acme\Account\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table("account")
 */
class Account
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Balance
     *
     * @ORM\Embedded(class="Balance")
     */
    private $balance;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Account constructor.
     *
     * @param Balance $balance
     * @param string $name
     */
    public function __construct(Balance $balance, string $name)
    {
        $this->balance = $balance;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Balance
     */
    public function getBalance(): Balance
    {
        return $this->balance;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function deposit(Money $money) : void
    {
        $this->balance = $this->balance->deposit($money);
    }

    public function withdraw(Money $money): void
    {
        $this->balance = $this->balance->withdraw($money);
    }
}