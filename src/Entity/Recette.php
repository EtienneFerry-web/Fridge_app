<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Recette
 * @brief Entité principale représentant une fiche recette dans l'application Fridge.
 * * Cette classe centralise toutes les données relatives à une recette, incluant les métadonnées 
 * (difficulté, temps), le contenu pédagogique (étapes) et les besoins matériels (ingrédients).
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
#[ORM\Table(name: 'recette')]
class Recette
{
    /**
     * @var int|null $intId Identifiant unique de la recette (PK).
     * @note Mappé sur la colonne 'recette_id'.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'recette_id')]
    private ?int $intId = null;

    /**
     * @var string|null $strLibelle Titre de la recette.
     * @note Longueur max : 150 caractères.
     */

    #[ORM\Column(name: 'recette_libelle', length: 150)]
    private ?string $strLibelle = null;

    /**
     * @var string|null $strDescription Description générale de la recette.
     * @note Type TEXT pour permettre des descriptions détaillées.
     */

    #[ORM\Column(name: 'recette_description', type: Types::TEXT, nullable: true)]
    private ?string $strDescription = null;

    /**
     * @var string|null $strDifficulte Niveau de difficulté (facile, moyen, difficile).
     * @note Convention : préfixe 'str' pour string.
     */

    #[ORM\Column(name: 'recette_difficulte', type: Types::STRING, length: 20)]
    private ?string $strDifficulte = null;

    /**
     * @var int|null $intPortion Nombre de portions par défaut pour la recette.
     * @note Type SMALLINT conformément au dictionnaire des données.
     */

    #[ORM\Column(name: 'recette_portion', type: Types::SMALLINT)]
    private ?int $intPortion = null;

    /**
     * @var int|null $intTempsPrepa Temps de préparation nécessaire en minutes.
     */

    #[ORM\Column(name: 'recette_temps_prepa', type: Types::SMALLINT)]
    private ?int $intTempsPrepa = null;

    /**
     * @var int|null $intTempsCuisson Temps de cuisson nécessaire en minutes.
     */

    #[ORM\Column(name: 'recette_temps_cuisson', type: Types::SMALLINT)]
    private ?int $intTempsCuisson = null;

    /**
     * @var Collection<int, Etape> $colEtapes Liste ordonnée des étapes de la recette.
     * @note Relation OneToMany vers l'entité Etape.
     */

    #[ORM\OneToMany(mappedBy: 'objRecette', targetEntity: Etape::class, orphanRemoval: true)]
    private Collection $colEtapes;

    /**
     * @var Collection<int, Composer> $colCompositions Liste des ingrédients et quantités.
     * @note Relation OneToMany vers l'entité de jointure porteuse de données Composer.
     */

    #[ORM\OneToMany(mappedBy: 'objRecette', targetEntity: Composer::class, orphanRemoval: true)]
    private Collection $colCompositions;

    /**
     * @brief Constructeur de la classe Recette.
     * Initialise les collections d'étapes et de compositions.
     */

    public function __construct()
    {
        $this->colEtapes = new ArrayCollection();
        $this->colCompositions = new ArrayCollection();
    }

    /**
     * @brief Récupère l'identifiant technique.
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère le titre de la recette.
     * @return string|null
     */

    public function getLibelle(): ?string
    {
        return $this->strLibelle;
    }

    /**
     * @brief Définit le titre de la recette.
     * @param string $strLibelle Titre préfixé.
     * @return static
     */

    public function setLibelle(string $strLibelle): static
    {
        $this->strLibelle = $strLibelle;
        return $this;
    }

    /**
     * @brief Récupère la description de la recette.
     * @return string|null
     */

    public function getDescription(): ?string
    {
        return $this->strDescription;
    }

    /**
     * @brief Définit la description de la recette.
     * @param string|null $strDescription Description longue préfixée.
     * @return static
     */

    public function setDescription(?string $strDescription): static
    {
        $this->strDescription = $strDescription;
        return $this;
    }

    /**
     * @brief Récupère le niveau de difficulté.
     * @return string|null
     */

    public function getDifficulte(): ?string
    {
        return $this->strDifficulte;
    }

    /**
     * @brief Définit la difficulté.
     * @param string $strDifficulte Niveau (facile|moyen|difficile).
     * @return static
     */

    public function setDifficulte(string $strDifficulte): static
    {
        $this->strDifficulte = $strDifficulte;
        return $this;
    }

    /**
     * @brief Récupère le nombre de portions.
     * @return int|null
     */

    public function getPortion(): ?int
    {
        return $this->intPortion;
    }

    /**
     * @brief Définit le nombre de portions.
     * @param int $intPortion Nombre entier.
     * @return static
     */

    public function setPortion(int $intPortion): static
    {
        $this->intPortion = $intPortion;
        return $this;
    }

    /**
     * @brief Récupère le temps de préparation.
     * @return int|null
     */

    public function getTempsPrepa(): ?int
    {
        return $this->intTempsPrepa;
    }

    /**
     * @brief Définit le temps de préparation.
     * @param int $intTempsPrepa Temps en minutes.
     * @return static
     */

    public function setTempsPrepa(int $intTempsPrepa): static
    {
        $this->intTempsPrepa = $intTempsPrepa;
        return $this;
    }

    /**
     * @brief Récupère le temps de cuisson.
     * @return int|null
     */

    public function getTempsCuisson(): ?int
    {
        return $this->intTempsCuisson;
    }

    /**
     * @brief Définit le temps de cuisson.
     * @param int $intTempsCuisson Temps en minutes.
     * @return static
     */

    public function setTempsCuisson(int $intTempsCuisson): static
    {
        $this->intTempsCuisson = $intTempsCuisson;
        return $this;
    }

    /**
     * @brief Récupère la collection des étapes.
     * @return Collection<int, Etape>
     */

    public function getEtapes(): Collection
    {
        return $this->colEtapes;
    }

    /**
     * @brief Récupère la collection des ingrédients (via Composer).
     * @return Collection<int, Composer>
     */

    public function getCompositions(): Collection
    {
        return $this->colCompositions;
    }
}