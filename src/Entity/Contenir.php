<?php

namespace App\Entity;

use App\Repository\ContenirRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Contenir
 * @brief Entité de liaison entre ListeCourse et Ingredient.
 * * Cette classe matérialise la table de jointure 'contenir' issue du MLD.
 * Elle permet de définir la quantité d'un ingrédient spécifique présent dans 
 * une liste de courses donnée.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: ContenirRepository::class)]
#[ORM\Table(name: 'contenir')]
class Contenir
{

    /**
     * @var int|null $intId Identifiant unique de la liaison (PK technique).
     * @note Mappé sur la colonne 'contenir_id' du dictionnaire de données.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'contenir_id')] 
    private ?int $intId = null;

    /**
     * @var ListeCourse|null $objListeCourse La liste de courses associée.
     * @note Référence à la colonne 'contenir_liste_id'.
     */

    #[ORM\ManyToOne(targetEntity: ListeCourse::class)]
    #[ORM\JoinColumn(name: 'contenir_liste_id', referencedColumnName: 'liste_id', nullable: false)]
    private ?ListeCourse $objListeCourse = null;

    /**
     * @var Ingredient|null $objIngredient L'ingrédient contenu dans la liste.
     * @note Référence à la colonne 'contenir_ingredient_id'.
     */

    #[ORM\ManyToOne(targetEntity: Ingredient::class)]
    #[ORM\JoinColumn(name: 'contenir_ingredient_id', referencedColumnName: 'ingredient_id', nullable: false)]
    private ?Ingredient $objIngredient = null;

    /**
     * @var int|null $intQuantite Quantité de l'ingrédient dans la liste.
     * @note Convention de nommage : préfixe 'int' pour le type Integer[cite: 70].
     */

    #[ORM\Column(name: 'contenir_quantite')]
    private ?int $intQuantite = null;

    /**
     * @brief Récupère l'identifiant technique de la liaison.
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère l'objet ListeCourse associé.
     * @return ListeCourse|null
     */

    public function getListeCourse(): ?ListeCourse
    {
        return $this->objListeCourse;
    }

    /**
     * @brief Définit la liste de courses associée.
     * @param ListeCourse|null $objListeCourse Instance de la liste de courses.
     * @return static
     */

    public function setListeCourse(?ListeCourse $objListeCourse): static
    {
        $this->objListeCourse = $objListeCourse;
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
     * @param Ingredient|null $objIngredient Instance de l'ingrédient.
     * @return static
     */

    public function setIngredient(?Ingredient $objIngredient): static
    {
        $this->objIngredient = $objIngredient;
        return $this;
    }

    /**
     * @brief Récupère la quantité définie dans la liste.
     * @return int|null
     */

    public function getQuantite(): ?int
    {
        return $this->intQuantite;
    }

    /**
     * @brief Définit la quantité de l'ingrédient.
     * @param int $intQuantite Valeur entière de la quantité.
     * @return static
     */

    public function setQuantite(int $intQuantite): static
    {
        $this->intQuantite = $intQuantite;
        return $this;
    }
}