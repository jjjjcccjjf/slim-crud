<?php
// Routes

$app->get('/', function ($request, $response, $args) {

    return $response->getBody()->write(var_dump($this->db->table('tarots')->get()));
    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);
});



//
// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");
//
//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });
