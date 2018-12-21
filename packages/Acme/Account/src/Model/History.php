<?php declare(strict_types=1);

namespace Acme\Account\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * Entity
 *
 * @ORM\Entity()
 * @ORM\Table("history")
 */
class History
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
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="number")
     */
    private $source;

    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="number")
     */
    private $destination;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * History constructor.
     * @param Account $source
     * @param Account $destination
     * @param Money $money
     * @param \DateTimeImmutable $createdAt
     */
    public function __construct(Account $source, Account $destination, Money $money, \DateTimeImmutable $createdAt)
    {
        $this->source = $source;
        $this->destination = $destination;
        $this->amount = $money;
        $this->createdAt = $createdAt;
    }

    /**
     * @return Account
     */
    public function getSource(): Account
    {
        return $this->source;
    }

    /**
     * @return Account
     */
    public function getDestination(): Account
    {
        return $this->destination;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

}