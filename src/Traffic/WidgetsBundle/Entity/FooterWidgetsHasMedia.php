<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Traffic\WidgetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * FooterWidgetsHasMedia
 * @ORM\Table(name="traffic_footer_widget_medias")
 * @ORM\Entity
 */
class FooterWidgetsHasMedia
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
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     */
    protected $media;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="media_hover_id", referencedColumnName="id")
     */
    protected $mediaHover;

    /**
     * @var \Traffic\WidgetsBundle\Entity\FooterWidgets
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Traffic\WidgetsBundle\Entity\FooterWidgets", cascade={"persist","remove"} ,inversedBy="medias", fetch="LAZY" )
     * @ORM\JoinColumn(name="footer_widget_id", referencedColumnName="id",nullable=true)
     */
    protected $footerWidget;

    /**
     * @var integer
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated", type="datetime")
     */
    protected $updated;
    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @var boolean
     * @ORM\Column(name="enable", type="boolean")
     */
    protected $enabled;


    /**
     * @var string
     * @ORM\Column(name="link", type="text")
     */
    private $link;
    /**
     * @var boolean
     * @ORM\Column(name="delete_footer", type="boolean")
     */
    protected $deleteFooter;

    public function __construct()
    {
        $this->position = 0;
        $this->enabled  = false;
        $this->deleteFooter  = false;
        $this->updated = new \DateTime('now');
        $this->created = new \DateTime('now');
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
     * {@inheritdoc}
     */
    public function setCreated(\DateTime $created = null)
    {
        $this->created = $created;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    /**
     * {@inheritdoc}
     */
    public function setDeleteFooter($deleteFooter)
    {
        $this->deleteFooter = $deleteFooter;
    }

    /**
     * {@inheritdoc}
     */
    public function getDeleteFooter()
    {
        return $this->deleteFooter;
    }

    /**
     * {@inheritdoc}
     */
    public function setFooterWidget(\Traffic\WidgetsBundle\Entity\FooterWidgets $footerWidget = null)
    {
        $this->footerWidget = $footerWidget;
    }

    /**
     * {@inheritdoc}
     */
    public function getFooterWidget()
    {
        return $this->footerWidget;
    }

    /**
     * {@inheritdoc}
     */
    public function setMedia(\Sonata\MediaBundle\Model\MediaInterface $media = null)
    {
        $this->media = $media;
    }

    /**
     * {@inheritdoc}
     */
    public function getMedia()
    {
        return $this->media;
    }


    /**
     * {@inheritdoc}
     */
    public function setMediaHover(\Sonata\MediaBundle\Model\MediaInterface $mediaHover = null)
    {
        $this->mediaHover = $mediaHover;
    }

    /**
     * {@inheritdoc}
     */
    public function getMediaHover()
    {
        return $this->mediaHover;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdated(\DateTime $updated = null)
    {
        $this->updated = $updated;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return FooterWidgetsHasMedia
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getFooterWidget().' | '.$this->getMedia();
    }

}
