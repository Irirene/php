<?php
namespace src\Models\Comment;
use src\Models\Article\Article;
use src\Models\User\User;
use src\ActiveRecordEntity;

class Comment extends ActiveRecordEntity{
    protected $textCom;
    protected $createdAt;
    protected $articleId;
    protected $authorComId;

    public function getAuthorComId():User
    {
        $user = User::getById($this->authorComId);
        return $user;
    }

    public function getTextCom():string
    {
        return $this->textCom;
    }


    public function getArticleId():Article
    {
        $article = Article::getById($this->articleId);
        return $article;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function setArticleId(string $articleId){
        $this->articleId = $articleId;
    }

    public function setAuthorComId(string $authorComId){
        $this->authorComId = $authorComId;
    }

    public function setTextCom(string $textCom){
        $this->textCom = $textCom;
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
    }


    
    public static function getTableName():string
    {
        return 'comments';
    }
}