<?php

namespace EventsBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="EventsBundle\Repository\EventsRepository")
 */
class Events
{

    /**
     * @Assert\File(maxSize="500000000k")
     */
    public $file;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $nomfile;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=200, nullable=false)
     * @Assert\Length(
     *      min = 2,
     *      max = 15,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=200, nullable=false)
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=200, nullable=false)
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="organisateur", type="string", length=200, nullable=false)
     */
    private $organisateur;
    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     * )
     * @ORM\Column(name="num", type="string", length=200, nullable=false)
     */
    private $num;
    /**
     * @var DateTime
     * @Assert\GreaterThan("today")
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */

    private $date_debut;
    /**
     * @var DateTime
     * @Assert\GreaterThan("today")
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */

    private $date_fin;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    /**
     * @var int
     *
     * @ORM\Column(name="nbr_participant", type="integer", nullable=true)
     */
    private $nbr_participant;
    /**
     * @var int
     *
     * @ORM\Column(name="nbr_participant_max", type="integer", nullable=false)
     */
    private $nbr_participant_max;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param string $organisateur
     */
    public function setOrganisateur($organisateur)
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param string $num
     */
    public function setNum($num)
    {
        $this->num = $num;
    }

    public function getWebpath()
    {


        return null === $this->nomfile ? null : '/' . $this->nomfile;
    }

    public function getUploadFile()
    {
        if (null === $this->getFile()) {
            $this->nomfile = "3.jpg";
            return;
        }


        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()

        );

        // set the path property to the filename where you've saved the file
        $this->nomfile = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    protected function getUploadRootDir()
    {

        return __DIR__ . '/../../../web/Upload' ;
    }



    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $marque
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getNomfile()
    {
        return $this->nomfile;
    }

    /**
     * @param string $nomfile
     */
    public function setNomfile($nomfile)
    {
        $this->nomfile = $nomfile;
    }

    /**
     * @return DateTime
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param DateTime $date_debut
     */
    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return DateTime
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * @param DateTime $date_fin
     */
    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getNbrParticipant()
    {
        return $this->nbr_participant;
    }

    /**
     * @param int $nbr_participant
     */
    public function setNbrParticipant($nbr_participant)
    {
        $this->nbr_participant = $nbr_participant;
    }

    /**
     * @return int
     */
    public function getNbrParticipantMax()
    {
        return $this->nbr_participant_max;
    }

    /**
     * @param int $nbr_participant_max
     */
    public function setNbrParticipantMax($nbr_participant_max)
    {
        $this->nbr_participant_max = $nbr_participant_max;
    }


}

