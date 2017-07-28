<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Stream as ModelStream;

class EloquentStream implements Stream {

   private $model;

   public function __construct(ModelStream $model)
   {
      $this->model = $model;
   }

   public function saveNewStreamItems($items)
   {
      $items->each(function($item) {
         if (! $this->itemInDB($item)) {
            $this->model->insert($item);
         }
      });
   }

   private function itemInDB($item)
   {
      $exists = $this->model->where('item_created_at','=', Carbon::parse($item['item_created_at'])->toDateTimeString())->get();

      return $exists->count() >= 1 ? true : false;
   }
   // public function getFullStream($count = 20) { }

   // public function getFilteredStream($type, $count = 20) { }
}
