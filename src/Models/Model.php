<?php

namespace App\Models;

use App\DB;

abstract class Model {
    public $id;
    public static $table;

    public static function all(){
        $db = new DB();
        return $db->all(static::$table, static::class);
    }
     public static function find($id){
        $db = new DB();
        return $db->find(static::$table, static::class, $id);
    }
    public static function findBy($field, $value){
        $db = new DB();
        return $db->findBy(static::$table, static::class, $field, $value);
    }

    public function save() {
        $fields = get_object_vars($this);
        unset($fields['id']);
        $db = new DB();
                if($this->id) {
           $db->update(static::$table, $fields, $this->id);
        } else {
              $this->id = $db->insert(static::$table, $fields);
        }   
    }
    public function delete() {
        $db = new DB();
        $db->delete(static::$table, $this->id);
    }
}