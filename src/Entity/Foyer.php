<?php

namespace App\Entity;

use App\Repository\FoyerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Foyer
 * @brief Entité représentant un foyer au sein de l'application Fridge.
 * * Cette classe permet de regrouper plusieurs utilisateurs au sein d'une même entité familiale 
 * pour le partage de listes de courses et la planification de repas.
 * * @author Étienne (Projet Symfony 2025-2026)
 */

#[ORM\Entity(repositoryClass: FoyerRepository::class)]
#[ORM\Table(name: 'foyer')]
class Foyer
{
    /**
     * @var int|null $intId Identifiant unique du foyer (Clé primaire).
     * @note Mappé sur la colonne 'foyer_id' du MLD.
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'foyer_id')]
    private ?int $intId = null;

    /**
     * @var string|null $strNom Nom désignant le foyer (ex: Famille Foo).
     * @note Longueur maximale : 100 caractères.
     */

    #[ORM\Column(name: 'foyer_nom', length: 100)]
    private ?string $strNom = null;

    /**
     * @var int|null $intNombrePers Nombre de personnes composant le foyer.
     * @note Type SMALLINT pour l'optimisation de la base de données.
     */

    #[ORM\Column(name: 'foyer_nombre_pers', type: Types::SMALLINT)]
    private ?int $intNombrePers = null;

    /**
     * @var \DateTimeInterface|null $dtDateCreation Date de création du foyer.
     * @note Convention de nommage : préfixe 'dt' pour DateTime.
     */

    #[ORM\Column(name: 'foyer_date_creation', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dtDateCreation = null;

    /**
     * @var Collection<int, User> $colUsers Collection des utilisateurs rattachés à ce foyer.
     * @note Relation OneToMany inversée par 'objFoyer' dans l'entité User.
     */

    #[ORM\OneToMany(mappedBy: 'objFoyer', targetEntity: User::class)]
    private Collection $colUsers;

    /**
     * @brief Constructeur de la classe Foyer.
     * Initialise la collection d'utilisateurs.
     */

    public function __construct()
    {
        $this->colUsers = new ArrayCollection();
    }

    /**
     * @brief Récupère l'identifiant technique du foyer.
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère le nom du foyer.
     * @return string|null
     */

    public function getNom(): ?string
    {
        return $this->strNom;
    }

    /**
     * @brief Définit le nom du foyer.
     * @param string $strNom Nom du foyer.
     * @return static
     */

    public function setNom(string $strNom): static
    {
        $this->strNom = $strNom;
        return $this;
    }

    /**
     * @brief Récupère le nombre de personnes du foyer.
     * @return int|null
     */

    public function getNombrePers(): ?int
    {
        return $this->intNombrePers;
    }

    /**
     * @brief Définit le nombre de personnes du foyer.
     * @param int $intNombrePers Nombre d'individus.
     * @return static
     */

    public function setNombrePers(int $intNombrePers): static
    {
        $this->intNombrePers = $intNombrePers;
        return $this;
    }

    /**
     * @brief Récupère la date de création du foyer.
     * @return \DateTimeInterface|null
     */

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dtDateCreation;
    }

    /**
     * @brief Définit la date de création du foyer.
     * @param \DateTimeInterface $dtDateCreation Instance de la date.
     * @return static
     */

    public function setDateCreation(\DateTimeInterface $dtDateCreation): static
    {
        $this->dtDateCreation = $dtDateCreation;
        return $this;
    }

    /**
     * @brief Récupère la collection des utilisateurs membres du foyer.
     * @return Collection<int, User>
     */

    public function getUsers(): Collection
    {
        return $this->colUsers;
    }

    /**
     * @brief Ajoute un utilisateur au foyer.
     * @param User $objUser Instance de l'utilisateur à ajouter.
     * @return static
     */

    public function addUser(User $objUser): static
    {
        if (!$this->colUsers->contains($objUser)) {
            $this->colUsers->add($objUser);
            $objUser->setFoyer($this);
        }
        return $this;
    }

    /**
     * @brief Retire un utilisateur du foyer.
     * @param User $objUser Instance de l'utilisateur à retirer.
     * @return static
     */

    public function removeUser(User $objUser): static
    {
        if ($this->colUsers->removeElement($objUser)) {
            if ($objUser->getFoyer() === $this) {
                $objUser->setFoyer(null);
            }
        }
        return $this;
    }
}