<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Userbug")
 */
class userBug
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $bugId;

  /**
   * @ORM\Column(type="text")
   */
  private $bugDescription;

  /**
   * @ORM\Column(type="string", length=32)
   */
  private $bugGuid;

  /**
   * @ORM\Column(type="datetime", name="bugDate")
   */
  private $bugDate;

    /**
     * Get bugId
     *
     * @return integer
     */
    public function getBugId()
    {
        return $this->bugId;
    }

    /**
     * Set bugDescription
     *
     * @param string $bugDescription
     *
     * @return userBug
     */
    public function setBugDescription($bugDescription)
    {
        $this->bugDescription = $bugDescription;

        return $this;
    }

    /**
     * Get bugDescription
     *
     * @return string
     */
    public function getBugDescription()
    {
        return $this->bugDescription;
    }

    /**
     * Set bugGuid
     *
     * @param string $bugGuid
     *
     * @return userBug
     */
    public function setBugGuid($bugGuid)
    {
        $this->bugGuid = $bugGuid;

        return $this;
    }

    /**
     * Get bugGuid
     *
     * @return string
     */
    public function getBugGuid()
    {
        return $this->bugGuid;
    }

    /**
     * Set bugDate
     *
     * @param \DateTime $bugDate
     *
     * @return userBug
     */
    public function setBugDate($bugDate)
    {
        $this->bugDate = $bugDate;

        return $this;
    }

    /**
     * Get bugDate
     *
     * @return \DateTime
     */
    public function getBugDate()
    {
        return $this->bugDate;
    }
}
