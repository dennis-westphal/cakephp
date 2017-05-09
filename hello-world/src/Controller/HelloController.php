<?php

namespace App\Controller;

class HelloController extends AppController
{
    public function world($name, $country)
    {
        $this->set('name', $name);
        $this->set('country', $country);
    }
}
