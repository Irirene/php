<?php
namespace src\Controllers;
use src\View\View;
use Servieces\Db;
use src\Models\Article\Article;

class ArticleController{
    private $view;
    private $db;

    public function __construct(){
        $this->view = new View(__DIR__.'/../../template/');
        $this->db = new Db;
    }

    public function index(){
        $sql = 'SELECT * FROM `articles`';
        $article = $this->db->query($sql, [], Article::class);
        $this->view->renderHtml('main/main.php', ['article'=>$article]);
    }

    public function show($id){
        $sql = 'SELECT * FROM `articles` WHERE `id` =:id;';
        $article = $this->db->query($sql, [':id'=>$id], Article::class);
        if(!$article){
            $this->view->renderHtml('main/error.php', [], 404);
            return;
        }
        $this->view->renderHtml('articles/show.php', ['article'=>$article[0]]);
    }
}