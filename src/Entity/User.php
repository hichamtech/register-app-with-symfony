<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AppAssert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const SEXE_HOMME = 'Homme';
    const SEXE_FEMME = 'Femme';
    const ROLE_USER = 'ROLE_USER';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Sequentially({
     *      @Assert\NotBlank(),
     *      @Assert\Type("string"),
     *      @Assert\Length(
     *          min = 5,
     *          max = 253,
     *          minMessage = "Email must be at least {{ limit }} characters long",
     *          maxMessage = "Email cannot be longer than {{ limit }} characters"
     *      ),
     *     @Assert\Email()
     * })
     *
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Sequentially({
     *      @Assert\NotBlank(),
     *      @Assert\Type("string"),
     *      @Assert\Length(
     *          min = 5,
     *          max = 50,
     *          minMessage = "Nom must be at least {{ limit }} characters long",
     *          maxMessage = "Nom cannot be longer than {{ limit }} characters"
     *      ),
     *
     * })
     *
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Sequentially({
     *      @Assert\NotBlank(),
     *      @Assert\Type("string"),
     *      @Assert\Length(
     *          min = 5,
     *          max = 50,
     *          minMessage = "Prenom must be at least {{ limit }} characters long",
     *          maxMessage = "Prenom cannot be longer than {{ limit }} characters"
     *      ),
     *
     * })
     */
    private $prenom;
    
    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Sequentially({
     *      @Assert\NotBlank(),
     *      @Assert\Type("string"),
     *      @Assert\Length(
     *          min = 2,
     *          max = 50,
     *          minMessage = "Pays must be at least {{ limit }} characters long",
     *          maxMessage = "Pays cannot be longer than {{ limit }} characters"
     *      ),
     *
     * })
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     * @AppAssert\Telephone()
     */
    private $tel;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isMarried;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrEnfants;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="text")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername()
    {
        return (string) $this->email;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getIsMarried(): ?bool
    {
        return $this->isMarried;
    }

    public function setIsMarried(bool $isMarried): self
    {
        $this->isMarried = $isMarried;

        return $this;
    }

    public function getNbrEnfants(): ?int
    {
        return $this->nbrEnfants;
    }

    public function setNbrEnfants(?int $nbrEnfants): self
    {
        $this->nbrEnfants = $nbrEnfants;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }
}
