<?php
// Routes
$app->get('/wunderlist/tasks/[{id}]', function ($request, $response, $args) {
    $header = array(
        'X-Access-Token:7843c35d4daabd7531372d233edf4c21f847e64b84b0b44008db9a50ca8c',
        'X-Client-ID:4e03ff4f3a9373e7c4ed',
         "Content-Type: application/json; charset=utf-8",
    );

    $list_url = 'https://a.wunderlist.com/api/v1/tasks?list_id=' . $args['id'];
    $context = array(
         "http" => array(
              "method"  => "GET",
              "header"  => implode("\r\n", $header)
         )
    );
    $response = file_get_contents($list_url, false, stream_context_create($context));
    $json     = json_decode($response);

    // Render index view
    return $this->renderer->render($response, 'calendar.phtml', $json);
});

$app->get('/hellow/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});