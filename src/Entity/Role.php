<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Role
 * @brief Entité représentant les rôles et niveaux d'accès des utilisateurs.
 * * Cette classe permet de gérer la hiérarchie des droits au sein de l'application Fridge.
 * Elle définit les accès pour les profils Visiteur, Abonné, Modérateur et Administrateur.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ORM\Table(name: 'role')]
class Role
{
    /** * @name Constantes de Rôles
     * @brief Identifiants de rôles utilisés pour la logique de sécurité Symfony.
     */

    public const ROLE_USER = 'ROLE_USER';           // Rôle par défaut (Abonné)
    public const ROLE_MODERATOR = 'ROLE_MODERATOR'; // Accès à la modération du contenu
    public const ROLE_ADMIN = 'ROLE_ADMIN';         // Gestion globale de la plateforme

    /**
     * @var int|null $intId Identifiant unique du rôle (Clé primaire).
     * @note Mappé sur la colonne 'role_id'.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'role_id')]
    private ?int $intId = null;

    /**
     * @var string|null $strLibelle Nom du rôle (ex: admin, membre, abonné).
     * @note Contraintes : longueur 50, NOT NULL, UNIQUE.
     */

    #[ORM\Column(name: 'role_libelle', length: 50, unique: true)]
    private ?string $strLibelle = null;

    /**
     * @brief Récupère l'identifiant technique du rôle.
     * @return int|null L'identifiant du rôle.
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère le libellé du rôle.
     * @return string|null Le libellé (ex: 'admin').
     */

    public function getLibelle(): ?string
    {
        return $this->strLibelle;
    }

    /**
     * @brief Définit le libellé du rôle.
     * @param string $strLibelle Le libellé à enregistrer (format préfixé).
     * @return static L'instance de l'objet pour le chaînage de méthodes.
     */

    public function setLibelle(string $strLibelle): static
    {
        $this->strLibelle = $strLibelle;
        return $this;
    }
}