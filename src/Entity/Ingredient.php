<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Ingredient
 * @brief Entité représentant un ingrédient de base dans l'application Fridge.
 * * Cette classe stocke les informations essentielles des ingrédients qui seront 
 * utilisés pour composer des recettes ou gérer les stocks des foyers.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[ORM\Table(name: 'ingredient')]
class Ingredient
{
    /**
     * @var int|null $intId Identifiant unique de l'ingrédient (Clé primaire).
     * @note Mappé sur la colonne 'ingredient_id' du dictionnaire de données.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ingredient_id')]
    private ?int $intId = null;

    /**
     * @var string|null $strLibelle Nom de l'ingrédient (ex: Tomate, Farine). 
     * @note Longueur maximale : 100 caractères, NOT NULL. 
     */

    #[ORM\Column(name: 'ingredient_libelle', length: 100)]
    private ?string $strLibelle = null;

    /**
     * @var string|null $strType Type ou catégorie technique de l'ingrédient (ex: légume, épice). 
     * @note Longueur maximale : 50 caractères. 
     */

    #[ORM\Column(name: 'ingredient_type', length: 50, nullable: true)]
    private ?string $strType = null;

    /**
     * @brief Récupère l'identifiant technique de l'ingrédient.
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère le nom (libellé) de l'ingrédient.
     * @return string|null
     */

    public function getLibelle(): ?string
    {
        return $this->strLibelle;
    }

    /**
     * @brief Définit le nom (libellé) de l'ingrédient.
     * @param string $strLibelle Nom de l'ingrédient.
     * @return static
     */

    public function setLibelle(string $strLibelle): static
    {
        $this->strLibelle = $strLibelle;
        return $this;
    }

    /**
     * @brief Récupère le type de l'ingrédient.
     * @return string|null
     */

    public function getType(): ?string
    {
        return $this->strType;
    }

    /**
     * @brief Définit le type de l'ingrédient.
     * @param string|null $strType Type de l'ingrédient (ex: viande, poisson).
     * @return static
     */
    
    public function setType(?string $strType): static
    {
        $this->strType = $strType;
        return $this;
    }
}