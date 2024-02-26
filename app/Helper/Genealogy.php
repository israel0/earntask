<?php

namespace App\Helper;

class Genealogy {

    //put your code here
    public $id;
    public $name;
    public $data;
    public $children;

    function __construct($id, $name, $data, $children) {
        $this->id = $id;
        $this->name = $name;
        $this->data = $data;
        $this->children = $children;
    }

}
