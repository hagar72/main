<?php

namespace Main\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Main\AbstractBundle\Model\UploadFileMover;
use Main\AbstractBundle\Entity\Language;


/**
 * Article
 *
 * @ORM\Table(name="articles", indexes={@ORM\Index(name="article_language", columns={"language_id"})})
 * @ORM\Entity
 */
class Article
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
     * @ORM\Column(name="title", type="string", length=225, nullable=false)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=225, nullable=true)
     * @Assert\File(
     *     maxSize = "600000000",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \Main\AbstractBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="Main\AbstractBundle\Entity\Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=225, nullable=true)
     */
    private $path;

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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Article
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Article
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set language
     *
     * @param \Main\AbstractBundle\Entity\Language $language
     * @return Article
     */
    public function setLanguage(Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Main\AbstractBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
    
    public function getAbsolutePath()
    {
        return (null === $this->path)? null: $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return (null === $this->path)? null: $this->getUploadDir(). $this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded articles should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/articles';
    }
    
    public function processFile()
    {
        if (! ($this->image instanceof UploadedFile) ) {
            return false;
        }
        $oldPath = $this->getWebPath();
        
        $uploadFileMover = new UploadFileMover();
        $this->path = $uploadFileMover->moveUploadedFile($this->image, self::getUploadDir());
        
        if($oldPath && null != $oldPath && $oldPath != $this->path) {
            if(file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
    }
    
    public function getSmallContent() {
        return substr($this->content, 0, 100) . ' ...';
    }

}
