<?php
// Get blog data
$app->get('/blog', function ($request, $response, $args) {

    $sql   = 'SELECT * FROM posts';
    $query = $this->db->prepare($sql);
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    var_dump($data);
});

// Routes
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});