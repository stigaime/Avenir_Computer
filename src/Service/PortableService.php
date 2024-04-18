<?php

namespace App\Service;

class PortableService

{

    private $portables = [];

    public function __construct()
    {
        $this->portables = [
            ['id' => 1,'name' => 'asus'],
            ['id' => 2,'name' => 'acer'],
            ['id' => 3,'name' => 'msi'],

        ];

    }
    public function all()
    
    {
    
        return $this->portables;
        
    }

    public function find($id)
    {
        foreach ($this->portables as $portable) {
            if ($portable['id'] == $id) {
                return $portable;
            }
        }

        return null;

    }
}