<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Etape
 * @brief Entité représentant une étape de préparation d'une recette.
 * * Cette classe stocke les instructions détaillées, l'ordre de passage et 
 * la durée indicative pour chaque étape d'une fiche recette.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
#[ORM\Table(name: 'etape')]
class Etape
{
    /**
     * @var int|null $intId Identifiant unique de l'étape (Clé primaire).
     * @note Mappé sur 'etape_id'.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'etape_id')]
    private ?int $intId = null;

    /**
     * @var int|null $intNumero Ordre de l'étape dans la recette.
     * @note Type TINYINT conformément au dictionnaire des données.
     */

    #[ORM\Column(name: 'etape_numero', type: Types::SMALLINT, options: ["unsigned" => true])]
    private ?int $intNumero = null;

    /**
     * @var string|null $strLibelle Titre court de l'étape.
     * @note Longueur max : 150 caractères.
     */

    #[ORM\Column(name: 'etape_libelle', length: 150)]
    private ?string $strLibelle = null;

    /**
     * @var string|null $strDescription Description détaillée de l'instruction.
     * @note Type TEXT pour permettre des instructions longues.
     */

    #[ORM\Column(name: 'etape_description', type: Types::TEXT)]
    private ?string $strDescription = null;

    /**
     * @var int|null $intDuree Durée indicative de l'étape en minutes.
     * @note Peut être NULL si la durée n'est pas spécifiée.
     */

    #[ORM\Column(name: 'etape_duree', type: Types::SMALLINT, nullable: true)]
    private ?int $intDuree = null;

    /**
     * @var Recette|null $objRecette Référence à la recette parente.
     * @note Relation ManyToOne : une recette possède plusieurs étapes.
     */

    #[ORM\ManyToOne(targetEntity: Recette::class, inversedBy: 'colEtapes')]
    #[ORM\JoinColumn(name: 'recette_id', referencedColumnName: 'recette_id', nullable: false)]
    private ?Recette $objRecette = null;

    /**
     * @brief Récupère l'identifiant technique de l'étape.
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère le numéro d'ordre de l'étape.
     * @return int|null
     */

    public function getNumero(): ?int
    {
        return $this->intNumero;
    }

    /**
     * @brief Définit le numéro d'ordre de l'étape.
     * @param int $intNumero Numéro de l'étape.
     * @return static
     */

    public function setNumero(int $intNumero): static
    {
        $this->intNumero = $intNumero;
        return $this;
    }

    /**
     * @brief Récupère le libellé de l'étape.
     * @return string|null
     */

    public function getLibelle(): ?string
    {
        return $this->strLibelle;
    }

    /**
     * @brief Définit le libellé de l'étape.
     * @param string $strLibelle Titre de l'étape.
     * @return static
     */

    public function setLibelle(string $strLibelle): static
    {
        $this->strLibelle = $strLibelle;
        return $this;
    }

    /**
     * @brief Récupère la description de l'étape.
     * @return string|null
     */

    public function getDescription(): ?string
    {
        return $this->strDescription;
    }

    /**
     * @brief Définit la description de l'étape.
     * @param string $strDescription Instructions détaillées.
     * @return static
     */

    public function setDescription(string $strDescription): static
    {
        $this->strDescription = $strDescription;
        return $this;
    }

    /**
     * @brief Récupère la durée de l'étape.
     * @return int|null
     */

    public function getDuree(): ?int
    {
        return $this->intDuree;
    }

    /**
     * @brief Définit la durée de l'étape.
     * @param int|null $intDuree Durée en minutes.
     * @return static
     */

    public function setDuree(?int $intDuree): static
    {
        $this->intDuree = $intDuree;
        return $this;
    }

    /**
     * @brief Récupère la recette associée à l'étape.
     * @return Recette|null
     */

    public function getRecette(): ?Recette
    {
        return $this->objRecette;
    }

    /**
     * @brief Définit la recette associée à l'étape.
     * @param Recette|null $objRecette Instance de la recette.
     * @return static
     */

    public function setRecette(?Recette $objRecette): static
    {
        $this->objRecette = $objRecette;
        return $this;
    }
}