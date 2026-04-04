<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Categorie
 * @brief Entité représentant les catégories d'ingrédients.
 * * Cette classe permet de classifier les ingrédients (ex: Fruits, Laitiers, Viandes) 
 * pour faciliter la navigation et le filtrage sur l'application Fridge.
 * * @author Étienne (Projet Symfony 2025-2026) 
 */

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ORM\Table(name: 'categorie')]
class Categorie
{
    /**
     * @var int|null $intId Identifiant unique de la catégorie (PK).
     * @note Mappé sur la colonne 'categorie_id'.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'categorie_id')]
    private ?int $intId = null;

    /**
     * @var string|null $strLibelle Nom de la catégorie (ex: Fruits, Laitiers).
     * @note Contrainte : NOT NULL, UNIQUE.
     */

    #[ORM\Column(name: 'categorie_libelle', length: 80, unique: true)]
    private ?string $strLibelle = null;

    /**
     * @brief Récupère l'identifiant de la catégorie.
     * @return int|null L'identifiant technique.
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère le libellé de la catégorie.
     * @return string|null Le nom de la catégorie (ex: Fruits).
     */

    public function getLibelle(): ?string
    {
        return $this->strLibelle;
    }

    /**
     * @brief Définit le libellé de la catégorie.
     * @param string $strLibelle Le libellé à enregistrer.
     * @return static L'instance de l'objet pour le chaînage.
     */

    public function setLibelle(string $strLibelle): static
    {
        $this->strLibelle = $strLibelle;
        return $this;
    }
}