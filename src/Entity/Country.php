<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ApiResource]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Locale::class, orphanRemoval: true)]
    private $locales;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Vat::class, orphanRemoval: true)]
    private $vats;

    public function __construct()
    {
        $this->locales = new ArrayCollection();
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

    /**
     * @return Collection<int, Locale>
     */
    public function getLocales(): Collection
    {
        return $this->locales;
    }

    public function addLocale(Locale $locale): self
    {
        if (!$this->locales->contains($locale)) {
            $this->locales[] = $locale;
            $locale->setCountry($this);
        }

        return $this;
    }

    public function removeLocale(Locale $locale): self
    {
        if ($this->locales->removeElement($locale)) {
            // set the owning side to null (unless already changed)
            if ($locale->getCountry() === $this) {
                $locale->setCountry(null);
            }
        }

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
            $vat->setCountry($this);
        }

        return $this;
    }

    public function removeVat(Vat $vat): self
    {
        if ($this->vats->removeElement($vat)) {
            // set the owning side to null (unless already changed)
            if ($vat->getCountry() === $this) {
                $vat->setCountry(null);
            }
        }

        return $this;
    }
}
