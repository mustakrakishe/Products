<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer', options:[
        'unsigned' => true,
    ])]
    private $price;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Vat::class, orphanRemoval: true)]
    private $vats;

    public function __construct()
    {
        $this->vats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Vat>
     */
    public function getVats(): Collection
    {
        return $this->vats;
    }

    public function addVat(Vat $vat): self
    {
        if (!$this->vats->contains($vat)) {
            $this->vats[] = $vat;
            $vat->setProduct($this);
        }

        return $this;
    }

    public function removeVat(Vat $vat): self
    {
        if ($this->vats->removeElement($vat)) {
            // set the owning side to null (unless already changed)
            if ($vat->getProduct() === $this) {
                $vat->setProduct(null);
            }
        }

        return $this;
    }
}
