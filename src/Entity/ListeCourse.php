<?php

namespace App\Entity;

use App\Repository\ListeCourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class ListeCourse
 *
 * @brief Entité représentant une liste de courses associée à un foyer.
 * * Cette classe permet de gérer les besoins en approvisionnement d'un foyer.
 * Elle suit un cycle de vie via son statut (ex: 'en cours', 'terminee').
 *
 * * @author Étienne (Projet Symfony 2025-2026)
 */
#[ORM\Entity(repositoryClass: ListeCourseRepository::class)]
#[ORM\Table(name: 'liste_course')]
class ListeCourse
{
    /**
     * @var int|null $intId identifiant unique de la liste (PK)
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'liste_id')]
    private ?int $intId = null;

    /**
     * @var \DateTimeInterface|null $dtDate date de création ou d'échéance de la liste
     */
    #[ORM\Column(name: 'liste_date', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dtDate = null;

    /**
     * @var string|null $strStatut état de la liste (ex: 'en cours', 'archivee')
     *
     * @note Longueur 50, par défaut 'en cours'.
     */
    #[ORM\Column(name: 'liste_statut', length: 50)]
    private ?string $strStatut = 'en cours';

    /**
     * @var Foyer|null $objFoyer le foyer propriétaire de cette liste
     */
    #[ORM\ManyToOne(targetEntity: Foyer::class)]
    #[ORM\JoinColumn(name: 'liste_foyer_id', referencedColumnName: 'foyer_id', nullable: false)]
    private ?Foyer $objFoyer = null;

    /**
     * @var Collection<int, Contenir> $colContenus relation vers les ingrédients de la liste
     */
    #[ORM\OneToMany(mappedBy: 'objListeCourse', targetEntity: Contenir::class, orphanRemoval: true)]
    private Collection $colContenus;

    public function __construct()
    {
        $this->colContenus = new ArrayCollection();
        $this->dtDate = new \DateTime(); // Initialisation par défaut à "maintenant"
    }

    /**
     * @brief Récupère l'identifiant technique.
     */
    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère la date de la liste.
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->dtDate;
    }

    /**
     * @brief Définit la date de la liste.
     */
    public function setDate(\DateTimeInterface $dtDate): static
    {
        $this->dtDate = $dtDate;

        return $this;
    }

    /**
     * @brief Récupère le statut actuel.
     */
    public function getStatut(): ?string
    {
        return $this->strStatut;
    }

    /**
     * @brief Définit le statut (en cours, terminee, archivee).
     */
    public function setStatut(string $strStatut): static
    {
        $this->strStatut = $strStatut;

        return $this;
    }

    /**
     * @brief Récupère le foyer associé.
     */
    public function getFoyer(): ?Foyer
    {
        return $this->objFoyer;
    }

    /**
     * @brief Définit le foyer associé.
     */
    public function setFoyer(?Foyer $objFoyer): static
    {
        $this->objFoyer = $objFoyer;

        return $this;
    }

    /**
     * @return Collection<int, Contenir>
     */
    public function getContenus(): Collection
    {
        return $this->colContenus;
    }
}
