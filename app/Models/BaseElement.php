<?php
namespace App\Models;
require_once '../../vendor/autoload.php';

class BaseElement
{
    protected $title;
    protected $description;
    protected $visible;
    protected $months;

    public function __construct($title, $description)
    {
        $this->setTitle($title);
        $this->setDescription($description);
    }



    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDurationAsString()
    {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;

        return "$years years $extraMonths months";
    }

    public function printJob($job)
    {
        if ($job->visible == false) {
            return;
        }
    }
    // echo lista

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of months
     */ 
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * Set the value of months
     *
     * @return  self
     */ 
    public function setMonths($months)
    {
        $this->months = $months;

        return $this;
    }

    /**
     * Get the value of visible
     */ 
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set the value of visible
     *
     * @return  self
     */ 
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }
}
