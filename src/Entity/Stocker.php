<?php

namespace App\Entity;

use App\Repository\StockerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Stocker
 * @brief Entité représentant l'inventaire des ingrédients par foyer (le "Frigo").
 * * Cette classe matérialise la table de jointure 'stocker' issue du MLD.
 * Elle permet de suivre en temps réel les quantités d'ingrédients disponibles 
 * pour un foyer spécifique afin de suggérer des recettes réalisables.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: StockerRepository::class)]
#[ORM\Table(name: 'stocker')]
class Stocker
{
    /**
     * @var int|null $intId Identifiant unique de la ligne de stock (PK technique).
     * @note Mappé sur la colonne 'stocker_id' du dictionnaire de données.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'stocker_id')] 
    private ?int $intId = null;

    /**
     * @var Foyer|null $objFoyer Référence au foyer propriétaire du stock.
     * @note Clé étrangère 'stocker_foyer_id' liée à 'foyer_id'.
     */

    #[ORM\ManyToOne(targetEntity: Foyer::class)]
    #[ORM\JoinColumn(name: 'stocker_foyer_id', referencedColumnName: 'foyer_id', nullable: false)]
    private ?Foyer $objFoyer = null;

    /**
     * @var Ingredient|null $objIngredient Référence à l'ingrédient stocké.
     * @note Clé étrangère 'stocker_ingredient_id' liée à 'ingredient_id'.
     */

    #[ORM\ManyToOne(targetEntity: Ingredient::class)]
    #[ORM\JoinColumn(name: 'stocker_ingredient_id', referencedColumnName: 'ingredient_id', nullable: false)]
    private ?Ingredient $objIngredient = null;

    /**
     * @var string|null $decQuantiteDispo Quantité actuellement disponible dans le foyer.
     * @note Type DECIMAL(10,2) pour gérer les unités fractionnables (ex: 1.5 kg).
     * @note Préfixe 'dec' pour souligner le type Decimal/Float.
     */

    #[ORM\Column(name: 'stocker_quantite_dispo', type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $decQuantiteDispo = null;

    /**
     * @brief Récupère l'identifiant technique de la ligne de stock.
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère l'objet Foyer associé.
     * @return Foyer|null
     */

    public function getFoyer(): ?Foyer
    {
        return $this->objFoyer;
    }

    /**
     * @brief Définit le foyer propriétaire du stock.
     * @param Foyer|null $objFoyer Instance du foyer.
     * @return static L'instance de l'objet pour le chaînage.
     */

    public function setFoyer(?Foyer $objFoyer): static
    {
        $this->objFoyer = $objFoyer;
        return $this;
    }

    /**
     * @brief Récupère l'objet Ingredient en stock.
     * @return Ingredient|null
     */

    public function getIngredient(): ?Ingredient
    {
        return $this->objIngredient;
    }

    /**
     * @brief Définit l'ingrédient à stocker.
     * @param Ingredient|null $objIngredient Instance de l'ingrédient.
     * @return static L'instance de l'objet pour le chaînage.
     */

    public function setIngredient(?Ingredient $objIngredient): static
    {
        $this->objIngredient = $objIngredient;
        return $this;
    }

    /**
     * @brief Récupère la quantité disponible.
     * @return string|null Valeur décimale sous forme de chaîne.
     */

    public function getQuantiteDispo(): ?string
    {
        return $this->decQuantiteDispo;
    }

    /**
     * @brief Définit la quantité disponible dans le stock.
     * @param string $decQuantiteDispo Valeur numérique (ex: "500.00").
     * @return static L'instance de l'objet pour le chaînage.
     */

    public function setQuantiteDispo(string $decQuantiteDispo): static
    {
        $this->decQuantiteDispo = $decQuantiteDispo;
        return $this;
    }
}