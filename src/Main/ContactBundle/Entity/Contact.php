<?php

namespace Main\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contacts")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sender", type="string", length=225, nullable=false)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Assert\NotBlank()
     */
    private $sender;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=225, nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=225, nullable=false)
     * @Assert\NotBlank()
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * @var \Department
     *
     * @ORM\ManyToOne(targetEntity="Main\AbstractBundle\Entity\Department")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $department;

    /**
     * @var string
     *
     * @ORM\Column(name="sent", type="string", length=255, nullable=true)
     */
    private $sent;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sender
     * @param string $sender
     */
    public function setSender($sender) {
        $this->sender = $sender;
    }
    
    /**
     * Get Sender
     * @return string
     */
    public function getSender() {
        return $this->sender;
    }
    
    /**
     * Set name
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    /**
     * Get Name
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set subject
     * @param string $subject
     */
    public function setSubject($subject) {
        $this->subject = $subject;
    }
    
    /**
     * Get Subject
     * @return string
     */
    public function getSubject() {
        return $this->subject;
    }
    
    /**
     * Set message
     * @param string $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }
    
    /**
     * Get Message
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }
    
    /**
     * Set department
     * @param Main\AbstractBundle\Entity\Department $department
     */
    public function setDepartment($department) {
        $this->department = $department;
    }
    
    /**
     * get Department
     * 
     * @return Main\AbstractBundle\Entity\Department
     */
    public function getDepartment() {
        return $this->department;
    }
    
    /**
     * Set sent
     * @param string $sent
     */
    public function setSent($sent) {
        $this->sent = $sent;
    }
    
    /**
     * Get Sent
     * @return string
     */
    public function getSent() {
        return $this->sent;
    }
}
