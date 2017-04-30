<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function () use ($app) {
    return $app->json([
        'List: GET /items',
        'View: GET /items/{id}',
        'Create: POST /items',
        'Update: PUT /items/{id}',
        'Delete: DELETE /items/{id}',
    ]);
});

// List: GET /items
$app->get('/items', function () use ($app) {
    $items = [
        [
            'id' => 1,
            'title' => 'Item title 1',
        ],
        [
            'id' => 2,
            'title' => 'Item title 2',
        ],
        [
            'id' => 3,
            'title' => 'Item title 3',
        ],
    ];
    return $app->json($items);
});

// View: GET /items/{id}
$app->get('/items/{id}', function ($id) use ($app) {
    $id = (int)$id;
    $item = [
        'id' => $id,
        'title' => 'Item title ' . $id,
    ];
    return $app->json($item);
});

// Create: POST /items
$app->post('/items', function () use ($app) {
    $id = mt_rand(100000, 999999);
    $item = [
        'id' => $id,
        'title' => 'Item title ' . $id,
    ];
    return $app->json($item);
});

// Update: PUT /items/{id}
$app->put('/items/{id}', function ($id) use ($app) {
    $id = (int)$id;
    $item = [
        'id' => $id,
        'title' => 'Item title ' . $id,
    ];
    return $app->json($item);
});

// Delete: DELETE /items/{id}
$app->delete('/items/{id}', function ($id) use ($app) {
    $id = (int)$id;
    return $app->json(new \stdClass());
});

$app->run();
