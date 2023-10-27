<?php
namespace src\Controllers;
use src\View\View;
use src\Models\Article\Article;
use src\Models\User\User;
use src\Models\Comment\Comment;

class CommentController{

    private $view;

    public function __construct(){
        $this->view = new View(__DIR__.'/../../template/');
    }

    public function index(){
        $article = Article::findAll();
        $this->view->renderHtml('main/main.php', ['article'=>$article]);
    }


    public function store(){
        $comment = new Comment;
        $comment->setTextCom($_POST['textCom']);
        $comment->setArticleId($_POST['articleId']);
        $comment->save();
        $this->index();
    }

    public function edit($id){
        $comment = Comment::getById($id);
        $this->view->renderHtml('comment/edit.php', ['comment'=>$comment]);
    }


    public function update(int $id){
        $comment = Comment::getById($id);
        $comment->setTextCom($_POST['textCom']);
        $comment->setArticleId($_POST['articleId']);
        $comment->setCreatedAt($_POST['createdAt']);
        $comment->save();
        $this->show($id);
    }

    public function delete(int $id){
        $comment = Comment::getById($id);
        $comment->delete();
        $this->index();
    }
}