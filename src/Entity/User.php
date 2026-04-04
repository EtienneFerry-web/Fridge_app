<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @class User
 * @brief Entité représentant un utilisateur de l'application Fridge.
 * * Cette classe gère l'authentification (UserInterface) et la persistance des données
 * personnelles. Elle fait le lien entre les foyers, les rôles de sécurité et les
 * préférences alimentaires (régimes).
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var int|null $intId Identifiant unique de l'utilisateur (PK).
     * @note Mappé sur la colonne 'user_id'.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'user_id')]
    private ?int $intId = null;

    /**
     * @var string|null $strNom Nom de famille de l'utilisateur.
     */

    #[ORM\Column(name: 'user_nom', length: 80)]
    private ?string $strNom = null;

    /**
     * @var string|null $strPrenom Prénom de l'utilisateur.
     */

    #[ORM\Column(name: 'user_prenom', length: 80)]
    private ?string $strPrenom = null;

    /**
     * @var string|null $strMail Adresse email (identifiant de connexion unique).
     * @note Contrainte : UNIQUE.
     */

    #[ORM\Column(name: 'user_mail', length: 150, unique: true)]
    private ?string $strMail = null;

    /**
     * @var string|null $strMdp Mot de passe haché de l'utilisateur.
     */

    #[ORM\Column(name: 'user_mdp', length: 255)]
    private ?string $strMdp = null;

    /**
     * @var \DateTimeInterface|null $dtDateInscription Date de création du compte.
     */

    #[ORM\Column(name: 'user_date_inscription', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dtDateInscription = null;

    /**
     * @var \DateTimeInterface|null $dtDateSuppression Date de désactivation du compte.
     * @note Si non nul, le compte est considéré comme supprimé (Soft Delete).
     */

    #[ORM\Column(name: 'user_date_suppression', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dtDateSuppression = null;

    /**
     * @var Foyer|null $objFoyer Foyer auquel appartient l'utilisateur.
     * @note Relation ManyToOne vers 'Foyer'.
     */

    #[ORM\ManyToOne(inversedBy: 'colUsers')]
    #[ORM\JoinColumn(name: 'user_foyer_id', referencedColumnName: 'foyer_id', nullable: false)]
    private ?Foyer $objFoyer = null;

    /**
     * @var Role|null $objRole Rôle de sécurité assigné (Admin, Modérateur, User).
     */

    #[ORM\ManyToOne(targetEntity: Role::class)]
    #[ORM\JoinColumn(name: 'user_role_id', referencedColumnName: 'role_id', nullable: false)]
    private ?Role $objRole = null;

    /**
     * @var Collection<int, Regime> $colRegimes Liste des régimes alimentaires suivis.
     * @note Table de jointure 'suivre'.
     */

    #[ORM\ManyToMany(targetEntity: Regime::class)]
    #[ORM\JoinTable(name: 'suivre')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    #[ORM\InverseJoinColumn(name: 'regime_id', referencedColumnName: 'regime_id')]
    private Collection $colRegimes;

    /**
     * @var Collection<int, Like> $colLikes Liste des recettes marquées en favoris.
     * @note Table de jointure 'like' gérée via l'entité de liaison Like.
     */

    #[ORM\OneToMany(mappedBy: 'objUser', targetEntity: Like::class, orphanRemoval: true)]
    private Collection $colLikes;

    /**
     * @brief Constructeur de la classe User.
     * Initialise les collections pour les régimes et les favoris.
     */

    public function __construct()
    {
        $this->colRegimes = new ArrayCollection();
        $this->colLikes = new ArrayCollection();
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
     * @brief Retourne l'identifiant utilisé pour l'authentification (l'email).
     * @return string
     */

    public function getUserIdentifier(): string
    {
        return (string) $this->strMail;
    }

    /**
     * @brief Retourne les rôles de l'utilisateur pour le composant Security de Symfony.
     * @return array Tableau de chaînes (ex: ['ROLE_ADMIN']).
     */

    public function getRoles(): array
    {
        return $this->objRole ? ['ROLE_' . strtoupper($this->objRole->getLibelle())] : ['ROLE_USER'];
    }

    /**
     * @brief Récupère le mot de passe haché.
     * @return string
     */

    public function getPassword(): string
    {
        return (string) $this->strMdp;
    }

    /**
     * @brief Efface les données sensibles temporaires (obligatoire par UserInterface).
     */

    public function eraseCredentials(): void
    {
  
    }

    /* --- Getters et Setters --- */

    public function getNom(): ?string { return $this->strNom; }
    public function setNom(string $strNom): static { $this->strNom = $strNom; return $this; }

    public function getPrenom(): ?string { return $this->strPrenom; }
    public function setPrenom(string $strPrenom): static { $this->strPrenom = $strPrenom; return $this; }

    public function getMail(): ?string { return $this->strMail; }
    public function setMail(string $strMail): static { $this->strMail = $strMail; return $this; }

    public function setPassword(string $strMdp): static { $this->strMdp = $strMdp; return $this; }

    public function getDateInscription(): ?\DateTimeInterface { return $this->dtDateInscription; }
    public function setDateInscription(\DateTimeInterface $dtDateInscription): static { $this->dtDateInscription = $dtDateInscription; return $this; }

    public function getFoyer(): ?Foyer { return $this->objFoyer; }
    public function setFoyer(?Foyer $objFoyer): static { $this->objFoyer = $objFoyer; return $this; }

    public function getRole(): ?Role { return $this->objRole; }
    public function setRole(?Role $objRole): static { $this->objRole = $objRole; return $this; }
}