<?php declare(strict_types = 1);

namespace Framework\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model {

   protected $table = "hero";
   protected $primaryKey = 'id';


   public function getAll(){
	  return $this->all();
   }

   public function findId($id){
   	return $this->find($id);
   }

}
