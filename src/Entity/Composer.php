<?php

namespace App\Entity;

use App\Repository\ComposerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Composer
 * @brief Entité de liaison entre Recette et Ingredient.
 *
 * Cette classe implémente la table de jointure 'composer' issue du MLD.
 * Elle permet de définir précisément quel ingrédient compose une recette, 
 * ainsi que sa quantité et son unité de mesure.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: ComposerRepository::class)]
#[ORM\Table(name: 'composer')]
class Composer
{
    /**
     * @var int|null $intId Identifiant unique de la liaison (PK technique).
     * @note Mappé sur la colonne 'composer_id'.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'composer_id')]
    private ?int $intId = null;

    /**
     * @var Recette|null $objRecette La recette concernée par cette ligne de composition.
     * @note Référence à la colonne 'composer_recette_id'.
     */

    #[ORM\ManyToOne(targetEntity: Recette::class, inversedBy: 'colCompositions')]
    #[ORM\JoinColumn(name: 'composer_recette_id', referencedColumnName: 'recette_id', nullable: false)]
    private ?Recette $objRecette = null;

    /**
     * @var Ingredient|null $objIngredient L'ingrédient lié à la recette.
     * @note Référence à la colonne 'composer_ingredient_id'.
     */

    #[ORM\ManyToOne(targetEntity: Ingredient::class)]
    #[ORM\JoinColumn(name: 'composer_ingredient_id', referencedColumnName: 'ingredient_id', nullable: false)]
    private ?Ingredient $objIngredient = null;

    /**
     * @var string|null $decQuantite Quantité nécessaire pour la recette.
     * @note Type DECIMAL(10) pour gérer les mesures précises.
     */

    #[ORM\Column(name: 'composer_quantite', type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $decQuantite = null;

    /**
     * @var string|null $strUnite Unité de mesure (ex: g, cl, pincée).
     * @note Longueur maximale de 20 caractères.
     */

    #[ORM\Column(name: 'composer_unite', length: 20)]
    private ?string $strUnite = null;

    /**
     * @brief Récupère l'identifiant technique de la composition.
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère l'objet Recette associé.
     * @return Recette|null
     */

    public function getRecette(): ?Recette
    {
        return $this->objRecette;
    }

    /**
     * @brief Définit la recette associée.
     * @param Recette|null $objRecette
     * @return static
     */

    public function setRecette(?Recette $objRecette): static
    {
        $this->objRecette = $objRecette;
        return $this;
    }

    /**
     * @brief Récupère l'objet Ingredient associé.
     * @return Ingredient|null
     */

    public function getIngredient(): ?Ingredient
    {
        return $this->objIngredient;
    }

    /**
     * @brief Définit l'ingrédient associé.
     * @param Ingredient|null $objIngredient
     * @return static
     */

    public function setIngredient(?Ingredient $objIngredient): static
    {
        $this->objIngredient = $objIngredient;
        return $this;
    }

    /**
     * @brief Récupère la quantité nécessaire.
     * @return string|null
     */

    public function getQuantite(): ?string
    {
        return $this->decQuantite;
    }
    
    /**
     * @brief Définit la quantité nécessaire.
     * @param string $decQuantite Valeur numérique (string pour la précision décimale).
     * @return static
     */
    
    public function setQuantite(string $decQuantite): static
    {
        $this->decQuantite = $decQuantite;
        return $this;
    }

    /**
     * @brief Récupère l'unité de mesure.
     * @return string|null
     */

    public function getUnite(): ?string
    {
        return $this->strUnite;
    }

    /**
     * @brief Définit l'unité de mesure.
     * @param string $strUnite Libellé de l'unité (ex: 'grammes').
     * @return static
     */

    public function setUnite(string $strUnite): static
    {
        $this->strUnite = $strUnite;
        return $this;
    }
}