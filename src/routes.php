<?php

$app->get('/', function ($request, $response, $args) {
  $obj = new \App\Crud($this->db);
  $data = $obj->all();
  // Render index view
  return $this->renderer->render($response, 'index.phtml', [
    'tarots' => $data
  ]);
});


$app->group('/tarots', function () {

  $this->get('', function($request, $response, $args){
    $obj = new \App\Crud($this->db);
    $data = $obj->all();

    return $response->withJson($data, 200);
  });

  $this->get('/{id:[0-9]+}', function($request, $response, $args){
    $obj = new \App\Crud($this->db);
    $data = $obj->get($args['id']);

    if(count($data) > 0){
      return $response->withJson($data, 200);
    }else{
      return $response->withJson(array('message' => 'Not found'), 404);
    }

  });

  $this->post('', function ($request, $response, $args) {
    $data = $request->getParsedBody();

    $obj = new \App\Crud($this->db);

    try{
      $last_insert_id = $obj->add($data);

      $data = $obj->get($last_insert_id);

      $response = $response->withAddedHeader(
        'Location', $this['settings']['base_url'] . 'tarots/' . $last_insert_id
      );
      return $response->withJson($data, 201);

    }
    catch(Exception $e){

      return $response->withJson(array('message' => 'Malformed syntax'), 400);

    }

  });

  $this->delete('/{id:[0-9]+}', function($request, $response, $args){
    $obj = new \App\Crud($this->db);
    $result = $obj->delete($args['id']);

    /**
    * if more than 1 row(s) got deleted
    */
    if($result > 0){

      return $response->withStatus(204);

    }else{

      return $response->withJson(array('message' => 'Not found'), 404);

    }

  });

  $this->map(['PATCH', 'POST'], '/{id:[0-9]+}', function($request, $response, $args){
    $data = $request->getParsedBody();

    $obj = new \App\Crud($this->db);

    $result = $obj->update($args['id'], $data);

    if($result >= 0){

      $data = $obj->get($args['id']);
      return $response->withJson($data, 200);

    }else{

      return $response->withJson(array('message' => 'Not found'), 404);

    }
  });

});



// $app->post('/testUpload', function ($request, $response, $args){
//   $files = $request->getUploadedFiles();
//   $data = $request->getParsedBody();
//
//   $obj = new \App\Crud($this->db);
//
//   /**
//    * merge array of uploaded files + request body array
//    * @var array
//    */
//   $data = array_merge($obj->upload($files), $data);
//
//   $result = $obj->add($data);
//
//   return $response->getBody()->write(var_dump($result));
//
//
// });


// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");
//
//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });
