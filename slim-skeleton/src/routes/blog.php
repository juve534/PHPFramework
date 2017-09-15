<?php
// Routes
// ブログ登録内容取得
$app->get('/posts', function ($request, $response, $args) {

    $sql   = 'SELECT * FROM posts';
    $query = $this->db->prepare($sql);
    $query->execute();

    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    return $this->renderer->render($response, 'posts/index.phtml', ['posts' => $posts]);
});

// ブログ登録内容取得
$app->get('/post/get_posts/[{id}]', function ($request, $response, $args) {
    $sql   = 'SELECT * FROM posts';
    if (!empty($args['id'])) {
        if (!is_numeric($args['id'])) {
            throw new Exception("Error Processing Request", 1);
        }
        $sql .= sprintf(' WHERE id=?', $id);
    }
    $query = $this->db->prepare($sql);
    $query->execute();

    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    return $response->withJson($posts, 200, JSON_PRETTY_PRINT);
});

// ブログ登録
$app->post('/post/save_posts/', function ($request, $response, $args) {
    $sql = 'INSERT INTO '
         .     'posts'
         .     '('
         .         'title, '
         .         'body, '
         .         'created'
         .      ') '
         . 'VALUES '
         .      '('
         .         '?, '
         .         '?, '
         .         'NOW()'
         .       ')';

    $query = $this->db->prepare($sql);
    return $query->execute();
});