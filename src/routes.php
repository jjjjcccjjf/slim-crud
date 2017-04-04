<?php

$app->get('/', function ($request, $response, $args) {
  $obj = new \App\Crud($this->db);
  $data = $obj->all();
  // Render index view
  return $this->renderer->render($response, 'index.phtml', [
    'tarots' => $data
  ]);
});

$app->get('/tarots', function ($request, $response, $args) {
  $obj = new \App\Crud($this->db);
  $data = $obj->all();
  $response->getBody()->write(var_dump($data));
  return $response;
});

$app->get('/tarot/{id}', function ($request, $response, $args) {
  $obj = new \App\Crud($this->db);
  $data = $obj->get($args['id']);
  $response->getBody()->write(var_dump($data));
  return $response;
});

$app->patch('/tarot/{id}', function ($request, $response, $args) {
  $data = $request->getParsedBody();
  $id = filter_var($args['id'], FILTER_SANITIZE_STRING);
  $obj = new \App\Crud($this->db);
  $result = $obj->update($id, $data);
  return $response->getBody()->write(var_dump($result));
});

$app->delete('/tarot/{id}', function ($request, $response, $args) {
  $id = filter_var($args['id'], FILTER_SANITIZE_STRING);
  $obj = new \App\Crud($this->db);
  $result = $obj->delete($args['id']);
  return $response->getBody()->write(var_dump($result));
});

$app->post('/tarot/new', function ($request, $response, $args) {
  $data = $request->getParsedBody();

  $obj = new \App\Crud($this->db);
  $result = $obj->add($data);

  $response->getBody()->write(var_dump($result));
  return $response;
});

$app->post('/testUpload', function ($request, $response, $args){
  $files = $request->getUploadedFiles();
  $obj = new \App\Crud($this->db);
  $result = $obj->testUpload($files);

  return $response->getBody()->write(var_dump($request->getParsedBody()));


});


// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");
//
//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });
