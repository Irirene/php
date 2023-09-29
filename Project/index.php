<?php

spl_autoload_register(function (string $className){
    require_once str_replace('\\', '/', $className). '.php';
});

$controller = new src\Controllers\MainController;
if (!empty($_GET['name'])) $controller->sayHello($_GET['name']);
else $controller->main();



// $author = new src\Models\User\User("Ivan");
// $article = new src\Models\Article\Article('new title', 'text', $author);

// echo $article->getAuthor()->getName();