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
  * a static directory for the class if needed
  * @var string
  */
  protected $upload_dir = '../public/uploads';

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
    $id = $this->sanitize($id);

    return $this->db->table($this->table)->where('id', $id)->get();
  }
  /**
  * inserts new record to the db
  * @param array $arr associative array of columns and values
  * @return bool
  */
  public function add($data)
  {
    $data = $this->sanitize($data);

    return $this->db->table($this->table)->insertGetId($data);

  }

  public function sanitize($data)
  {

    if(is_array($data) or ($data instanceof Traversable)){
      return $this->sanitize_array($data);
    }else{
      return $this->sanitize_var($data);
    }

  }

  public function sanitize_array($array)
  {
    $sanitized_array = [];

    foreach($array as $key => $val){
      $sanitized_array[$key] = filter_var($val, FILTER_SANITIZE_STRING);
    }

    return $sanitized_array;
  }

  public function sanitize_var($var)
  {
    return filter_var($var, FILTER_SANITIZE_STRING);
  }

  /**
  * updates row based on $id
  * @param  int $id  [description]
  * @param  array $arr associative array of columns and values
  * @return int number of rows updated
  */
  public function update($id, $data)
  {
    $id = $this->sanitize($id);
    $data = $this->sanitize($data);

    if($this->exists($id)){
      return $this->db->table($this->table)->where('id', $id)->update($data);
    }else{
      return -1; # To handle nonexistent records
    }
  }
  /**
  * deletes row on db based on $id
  * @param  int $id [description]
  * @return int     [description]
  */
  public function delete($id)
  {
    $id = $this->sanitize($id);

    return $this->db->table($this->table)->where('id', $id)->delete();
  }

  /**
  * check if id exists in the table
  * @param  int $id [description]
  * @return bool     [description]
  */
  public function exists($id)
  {
    return $this->db->table($this->table)->where('id', $id)->count();
  }

  /**
  * uploads files on the default directory
  * @param  array   $files    array of \Psr\Http\Message\UploadedFileInterface objects | $request->getUploadedFiles()
  * @return array    array of $key=>$value names of successfully uploaded files
  */
  public function upload($files)
  {
    $storage = new \Upload\Storage\FileSystem($this->upload_dir);

    $uploaded_files = [];

    foreach($files as $key => $value){
      $file = new \Upload\File($key, $storage);

      $new_filename = uniqid();
      $file->setName($new_filename);

      // Validate file upload
      // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
      $file->addValidations(array(

        //You can also add multi mimetype validation
        # We support commonly used MIME type extensions
        new \Upload\Validation\Mimetype(array(
          'image/png',
          'image/jpeg',
          'image/gif',
          'application/pdf',
          'text/csv',
          'text/plain', # .txt
          'application/msword', # .doc
          'application/vnd.ms-excel', # .xls
          'application/vnd.ms-powerpoint', # .ppt
          'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', # .xlsx
          'application/vnd.openxmlformats-officedocument.wordprocessingml.document', # .docx
          'application/vnd.openxmlformats-officedocument.presentationml.presentation', # .pptx
        )),
        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
        // new \Upload\Validation\Size('20M')
      ));


      try{
        $file->upload();

        $uploaded_files[$key] = $file->getNameWithExtension();
      }
      catch(\Exception $e){
        return $e->getMessage();
      }
    }

    return $uploaded_files;

  }


}
