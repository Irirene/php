<?php
namespace src\Controllers;
use src\View\View;

class MainController
{
    private $view;

    public function __construct(){
        $this->view = new View(__DIR__.'/../../template/');  
    }
    
    public function main()
    {
        $article = [
            ['title' =>'Заголовок 1', 'text'=>'Наша статья'],
            ['title' =>'Заголовок 2', 'text'=>'Our Article']
        ];
        $this->view->renderHtml('main/main.php', ['article'=>$article]);
    }

    public function sayHello(string $name)
    {
        echo "hello, $name";
    }
}