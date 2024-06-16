<?php

namespace App\Storage\Domain\Factory;

use App\Storage\Domain\Entity\Data\Event;

class DataFactory
{
   public function create(
       string $name, string $password, string $data
   ): Event
   {
       return  new Event(
         name:  $name,
         password: $password,
         userdata: $data
       );
   }
}