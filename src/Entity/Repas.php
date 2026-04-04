<?php

namespace App\Entity;

use App\Repository\RepasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Repas
 * @brief Entité représentant la planification d'un repas pour un foyer.
 * * Cette classe permet de définir quel type de repas est prévu à une date précise.
 * Elle est rattachée à un foyer pour permettre la gestion du planning familial.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: RepasRepository::class)]
#[ORM\Table(name: 'repas')]
class Repas
{
    /**
     * @var int|null $intId Identifiant unique du repas (PK).
     * @note Mappé sur la colonne 'repas_id' du dictionnaire.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'repas_id')]
    private ?int $intId = null;

    /**
     * @var \DateTimeInterface|null $dtDate Date prévue pour le repas.
     * @note Convention de nommage : préfixe 'dt' pour DateTime.
     */

    #[ORM\Column(name: 'repas_date', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dtDate = null;

    /**
     * @var string|null $strType Moment de la journée du repas.
     * @note Valeurs attendues selon MLD : 'petit_dejeuner', 'dejeuner', 'diner'.
     */

    #[ORM\Column(name: 'repas_type', length: 50)]
    private ?string $strType = null;

    /**
     * @var Foyer|null $objFoyer Référence au foyer ayant prévu ce repas.
     * @note Relation ManyToOne : un foyer possède plusieurs repas planifiés.
     */

    #[ORM\ManyToOne(targetEntity: Foyer::class)]
    #[ORM\JoinColumn(name: 'repas_foyer_id', referencedColumnName: 'foyer_id', nullable: false)]
    private ?Foyer $objFoyer = null;

    /**
     * @brief Récupère l'identifiant technique du repas.
     * @return int|null L'identifiant du repas.
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère la date du repas.
     * @return \DateTimeInterface|null La date au format DateTime.
     */

    public function getDate(): ?\DateTimeInterface
    {
        return $this->dtDate;
    }

    /**
     * @brief Définit la date du repas.
     * @param \DateTimeInterface $dtDate Instance de la date du repas.
     * @return static L'instance pour le chaînage de méthodes.
     */

    public function setDate(\DateTimeInterface $dtDate): static
    {
        $this->dtDate = $dtDate;
        return $this;
    }

    /**
     * @brief Récupère le type de repas (moment de la journée).
     * @return string|null Le type de repas.
     */

    public function getType(): ?string
    {
        return $this->strType;
    }

    /**
     * @brief Définit le type de repas.
     * @param string $strType Le moment de la journée (ex: 'diner').
     * @return static L'instance pour le chaînage de méthodes.
     */

    public function setType(string $strType): static
    {
        $this->strType = $strType;
        return $this;
    }

    /**
     * @brief Récupère l'objet Foyer associé au repas.
     * @return Foyer|null L'instance du foyer.
     */

    public function getFoyer(): ?Foyer
    {
        return $this->objFoyer;
    }

    /**
     * @brief Définit le foyer associé au repas.
     * @param Foyer|null $objFoyer Instance du foyer.
     * @return static L'instance pour le chaînage de méthodes.
     */

    public function setFoyer(?Foyer $objFoyer): static
    {
        $this->objFoyer = $objFoyer;
        return $this;
    }
}