<?php

namespace App;

/**
* CRUD Class template for Slim 3 framework using Eloquent ORM
* @author: @jjjjcccjjf
* @source: https://github.com/jjjjcccjjf/slim-crud
*/

class Crud
{
  /**
  * Eloquent capsule instance
  * @var Illuminate\Database\Capsule\Manager;
  */
  public $db;
  /**
  * table associated with the model
  * change this to your table name
  * @var string
  */
  protected $table = 'tarots';
  /**
  * @param Illuminate\Database\Capsule\Manager $db
  */
  function __construct(\Illuminate\Database\Capsule\Manager $db)
  {
    $this->db = $db;
  }
  /**
  * retrieves all data from $table
  * @return Illuminate\Support\Collection Object
  */
  public function all()
  {
    return $this->db->table($this->table)->get();
  }
  /**
  * retrieves a row from $table equal to the $id
  * @param  int $id
  * @return Illuminate\Support\Collection Object
  */
  public function get($id)
  {
    return $this->db->table($this->table)->where('id', $id)->get();
  }
  /**
  * inserts new record to the db
  * @param array $arr associative array of columns and values
  * @return bool
  */
  public function add($arr)
  {
    return $this->db->table($this->table)->insert($arr);
  }
  /**
   * updates row based on $id
   * @param  int $id  [description]
   * @param  array $arr associative array of columns and values
   * @return int number of rows updated
   */
  public function update($id, $arr)
  {
    return $this->db->table($this->table)->where('id', $id)->update($arr);
  }
  /**
   * deletes row on db based on $id
   * @param  int $id [description]
   * @return int     [description]
   */
  public function delete($id)
  {
    return $this->db->table($this->table)->where('id', $id)->delete();
  }
}
