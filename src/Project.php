<?php

namespace RodCar\Portfolio;

class Project
{
    private int $id;
    private string $title;
    private array $technology;
    private string $image;
    private string $description;
    private array $advantages;
    private string $demo;
    private string $fullDescription;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->technology = $data['technology'];
        $this->image = $data['image'];
        $this->description = $data['description'];
        $this->fullDescription = $data['full-description'];
        $this->advantages = $data['advantages'];
        $this->demo = $data['demo'];
    }

    /**
     * Get the value of advantages
     */ 
    public function getAdvantages()
    {
        return $this->advantages;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get the value of demo
     */ 
    public function getDemo()
    {
        return $this->demo;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of technology
     */ 
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * Get the value of fullDescription
     */ 
    public function getFullDescription()
    {
        return $this->fullDescription;
    }
}