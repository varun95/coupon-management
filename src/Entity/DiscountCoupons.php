<?php

namespace App\Entity;

use App\Repository\DiscountCouponsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiscountCouponsRepository::class)
 * @ORM\Table(name="discount_coupons")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class DiscountCoupons
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $adddate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $moddate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiry_date;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default": 1})
     */
    private $flag;

    /**
     * @ORM\Column(type="integer")
     */
    private $discount_amount;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_redeem;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_redeem_per_user;

    public function __construct()
    {
        $this->adddate = new \DateTime();
        $this->moddate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdddate(): ?\DateTimeInterface
    {
        return $this->adddate;
    }

    public function setAdddate(?\DateTimeInterface $adddate): self
    {
        $this->adddate = $adddate;

        return $this;
    }

    public function getModdate(): ?\DateTimeInterface
    {
        return $this->moddate;
    }

    public function setModdate(?\DateTimeInterface $moddate): self
    {
        $this->moddate = $moddate;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getExpiryDate(): ?\DateTimeInterface
    {
        return $this->expiry_date;
    }

    public function setExpiryDate(\DateTimeInterface $expiry_date): self
    {
        $this->expiry_date = $expiry_date;

        return $this;
    }

    public function getFlag(): ?int
    {
        return $this->flag;
    }

    public function setFlag(?int $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getDiscountAmount(): ?int
    {
        return $this->discount_amount;
    }

    public function setDiscountAmount(int $discount_amount): self
    {
        $this->discount_amount = $discount_amount;

        return $this;
    }

    public function getMaxRedeem(): ?int
    {
        return $this->max_redeem;
    }

    public function setMaxRedeem(int $max_redeem): self
    {
        $this->max_redeem = $max_redeem;

        return $this;
    }

    public function getMaxRedeemPerUser(): ?int
    {
        return $this->max_redeem_per_user;
    }

    public function setMaxRedeemPerUser(int $max_redeem_per_user): self
    {
        $this->max_redeem_per_user = $max_redeem_per_user;

        return $this;
    }
}
