<?php

namespace App\Entity;

use App\Repository\RegimeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Regime
 * @brief Entité représentant un régime alimentaire dans l'application Fridge.
 * * Cette classe permet de définir les différents régimes (ex: omnivore, végétarien) 
 * afin de proposer aux utilisateurs des recettes adaptées à leurs préférences 
 * alimentaires via le système de filtrage du feed.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: RegimeRepository::class)]
#[ORM\Table(name: 'regime')]
class Regime
{
    /**
     * @var int|null $intId Identifiant unique du régime (Clé primaire).
     * @note Mappé sur la colonne 'regime_id' du dictionnaire de données.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'regime_id')]
    private ?int $intId = null;

    /**
     * @var string|null $strLibelle Nom du régime (ex: sans gluten, végétalien).
     * @note Longueur maximale : 100 caractères, contrainte UNIQUE.
     */

    #[ORM\Column(name: 'regime_libelle', length: 100, unique: true)]
    private ?string $strLibelle = null;

    /**
     * @brief Récupère l'identifiant technique du régime.
     * @return int|null L'identifiant du régime.
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère le libellé du régime alimentaire.
     * @return string|null Le nom du régime (ex: omnivore).
     */

    public function getLibelle(): ?string
    {
        return $this->strLibelle;
    }

    /**
     * @brief Définit le libellé du régime alimentaire.
     * @param string $strLibelle Le libellé à enregistrer (format préfixé).
     * @return static L'instance de l'objet pour le chaînage de méthodes.
     */

    public function setLibelle(string $strLibelle): static
    {
        $this->strLibelle = $strLibelle;
        return $this;
    }
}