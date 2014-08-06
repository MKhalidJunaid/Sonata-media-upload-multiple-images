<?php

namespace Traffic\WidgetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * FooterWidgets
 *
 * @ORM\Table(name="traffic_footer_widgets")
 * @ORM\Entity
 */
class FooterWidgets
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = "255",
     *      maxMessage = "Title cannot be longer than {{ limit }} characters length"
     * )
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="abstract", type="text")
     */
    private $abstract;

    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="background_image_id", referencedColumnName="id")
     */
    protected $backgroundImage;
    public function __construct()
    {
        $this->links = new ArrayCollection();
    }
    public function __toString()
    {
        return ($this->getTitle()) ?mb_substr($this->getTitle(),0,50):'Create';
    }

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
     * @return FooterWidgets
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
     * Set abstract
     *
     * @param string $abstract
     * @return FooterWidgets
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return FooterWidgets
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
     * @return FooterWidgets
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
     * Set enable
     *
     * @param boolean $enable
     * @return FooterWidgets
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }


    /**
     * @param \Sonata\MediaBundle\Model\MediaInterface $backgroundImage
     */
    public function setBackgroundImage(\Sonata\MediaBundle\Model\MediaInterface $backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * @return \Sonata\MediaBundle\Model\MediaInterface
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }


    /**
     * @Assert\NotBlank()
     * @ORM\OneToMany(targetEntity="Traffic\WidgetsBundle\Entity\FooterWidgetsHasMedia", mappedBy="footerWidget",cascade={"persist","remove"} )
     */
    protected $links;



    /**
     * Remove widgetImages
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $widgetImages
     */
    public function removeLinks(\Traffic\WidgetsBundle\Entity\FooterWidgetsHasMedia $links)
    {
        $this->links->removeElement($links);
    }

    /**
     * Get widgetImages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * {@inheritdoc}
     */
    public function setLinks($links)
    {
        $this->links = new ArrayCollection();

        foreach ($links as $footerWidget) {
            $this->addLinks($footerWidget);
        }
    }


    /**
     * {@inheritdoc}
     */
    public function addLinks(\Traffic\WidgetsBundle\Entity\FooterWidgetsHasMedia $links)
    {
        $links->setFooterWidget($this);

        $this->links[] = $links;
    }

}
