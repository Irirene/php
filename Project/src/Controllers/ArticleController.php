<?php
namespace src\Controllers;
use src\View\View;
use src\Models\Article\Article;
use src\Models\User\User;

class ArticleController{

    private $view;

    public function __construct(){
        $this->view = new View(__DIR__.'/../../template/');
    }

    public function index(){
        $article = Article::findAll();
        $this->view->renderHtml('main/main.php', ['article'=>$article]);
    }

    public function show($id){
        $article = Article::getById($id);
        $user = $article->getAuthorId();
        

        if(!$article){
            $this->view->renderHtml('main/error.php', [], 404);
            return;
        }
        $this->view->renderHtml('articles/show.php', ['article'=>$article, 'user'=>$user]);
    }

    public function create(){
        $user = User::findAll();
        $this->view->renderHtml('articles/create.php', ['users'=>$user]);
    }


    public function store(){
        $article = new Article;
        $article->setTitle($_POST['title']);
        $article->setText($_POST['text']);
        $article->setAuthorId($_POST['author']);
        $article->save();
        $this->index();
    }

    public function edit($id){
        $article = Article::getById($id);
        $users = User::findAll();
        $this->view->renderHtml('articles/edit.php', ['article'=>$article, 'users'=>$users]);
    }


    public function update(int $id){
        $article = Article::getById($id);
        $article->setTitle($_POST['title']);
        $article->setText($_POST['text']);
        $article->setAuthorId($_POST['author']);
        $article->save();
        $this->show($id);
    }

    public function delete(int $id){
        $article = Article::getById($id);
        $article->delete();
        $this->index();
    }
}