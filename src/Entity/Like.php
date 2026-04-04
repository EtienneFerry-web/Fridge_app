<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @class Like
 * @brief Entité représentant l'action de "liker" une recette par un utilisateur.
 * * Cette classe matérialise la table de jointure 'LIKE' issue du MLD.
 * Elle permet de lier un utilisateur à une recette tout en conservant la date 
 * à laquelle l'action a été effectuée. 
 * * @author Étienne (Projet Symfony 2025-2026) 
 */

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
class Like
{
    /**
     * @var int|null $intId Identifiant unique du like (PK technique).
     * @note Mappé sur la colonne 'like_id'. 
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'like_id')] 
    private ?int $intId = null;

    /**
     * @var \DateTimeInterface|null $dtLikeDate Date et heure de l'ajout au favori.
     * @note Correspond au champ 'like_date' du dictionnaire des données. 
     */

    #[ORM\Column(name: 'like_date', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dtLikeDate = null;

    /**
     * @var User|null $objUser L'utilisateur ayant effectué le like.
     * @note Référence à la colonne 'like_user_id'. 
     */

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'colLikes')]
    #[ORM\JoinColumn(name: 'like_user_id', referencedColumnName: 'user_id', nullable: false)]
    private ?User $objUser = null;

    /**
     * @var Recette|null $objRecette La recette concernée par le like.
     * @note Référence à la colonne 'like_recette_id'. 
     */

    #[ORM\ManyToOne(targetEntity: Recette::class)]
    #[ORM\JoinColumn(name: 'like_recette_id', referencedColumnName: 'recette_id', nullable: false)]
    private ?Recette $objRecette = null;

    /**
     * @brief Récupère l'identifiant technique du like.
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->intId;
    }

    /**
     * @brief Récupère la date à laquelle la recette a été likée.
     * @return \DateTimeInterface|null
     */

    public function getLikeDate(): ?\DateTimeInterface
    {
        return $this->dtLikeDate;
    }

    /**
     * @brief Définit la date du like.
     * @param \DateTimeInterface $dtLikeDate Instance de la date.
     * @return static
     */

    public function setLikeDate(\DateTimeInterface $dtLikeDate): static
    {
        $this->dtLikeDate = $dtLikeDate;
        return $this;
    }

    /**
     * @brief Récupère l'utilisateur associé au like.
     * @return User|null
     */

    public function getUser(): ?User
    {
        return $this->objUser;
    }

    /**
     * @brief Définit l'utilisateur associé au like.
     * @param User|null $objUser Instance de l'utilisateur.
     * @return static
     */

    public function setUser(?User $objUser): static
    {
        $this->objUser = $objUser;
        return $this;
    }

    /**
     * @brief Récupère la recette associée au like.
     * @return Recette|null
     */

    public function getRecette(): ?Recette
    {
        return $this->objRecette;
    }

    /**
     * @brief Définit la recette associée au like.
     * @param Recette|null $objRecette Instance de la recette.
     * @return static
     */
    
    public function setRecette(?Recette $objRecette): static
    {
        $this->objRecette = $objRecette;
        return $this;
    }
}