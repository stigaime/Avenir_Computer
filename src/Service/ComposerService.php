<?php

namespace App\Service;

class ComposerService

{

    private $composers = [];

    public function __construct()
    {
        $this->composers = [
            ['id' => 1,'name' => 'asus'],
            ['id' => 2,'name' => 'acer'],
            ['id' => 3,'name' => 'msi'],

        ];

    }
    public function all()
    
    {
    
        return $this->composers;
        
    }

    public function find($id)
    {
        foreach ($this->composers as $composer) {
            if ($composer['id'] == $id) {
                return $composer;
            }
        }

        return null;

    }
}