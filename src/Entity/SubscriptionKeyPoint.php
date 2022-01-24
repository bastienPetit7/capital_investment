<?php

namespace App\Entity;

use App\Repository\SubscriptionKeyPointRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubscriptionKeyPointRepository::class)
 */
class SubscriptionKeyPoint
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keyPoint;

    /**
     * @ORM\ManyToMany(targetEntity=Subscription::class, mappedBy="keyPoint_id")
     * @ORM\JoinTable(name="subscription_subscription_key_point")
     */
    private $subscriptions;

    public function __construct()
    {
        $this->subscriptions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->keyPoint; 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyPoint(): ?string
    {
        return $this->keyPoint;
    }

    public function setKeyPoint(string $keyPoint): self
    {
        $this->keyPoint = $keyPoint;

        return $this;
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->addKeyPointId($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->removeElement($subscription)) {
            $subscription->removeKeyPointId($this);
        }

        return $this;
    }
}
