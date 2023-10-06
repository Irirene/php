<?php
namespace src\Controllers;
use src\View\View;
use Servieces\Db;

class MainController
{
    private $view;
    private $db;

    public function __construct(){
        $this->view = new View(__DIR__.'/../../template/');
        $this->db = new Db;
    }
    
    public function main(){
        $sql = 'SELECT * FROM `articles`';
        $article = $this->db->query($sql);
        $this->view->renderHtml('main/main.php', ['article'=>$article]);
    }

    public function sayHello(string $name)
    {
        echo "hello, $name";
    }
}