<?php

use App\Model\Stream as ModelStream;

class EloquentStream implements Stream {

   private $model;

   public function __construct(ModelStream $model)
   {
      $this->model = $model;
   }

   // public function getFullStream($count = 20) { }

   // public function getFilteredStream($type, $count = 20) { }
}
