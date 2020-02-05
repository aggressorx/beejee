<?php


namespace core\base;


class Controller
{

    protected $view;
    public $route;   //Массив (Controller, Action)
    public $model;
    public $layout = 'default';

    /**
     * BaseController constructor.
     * В массиве [0] контроллер
     * [1] не обязательно action
     * @param $data
     */
    public function __construct($data)
    {
        $this->route = $data;
        $this->model = $data['controller'];
        $this->view = (mb_strtolower($data['action'])) ? mb_strtolower($data['action']) : 'index';
    }


    //получаем данные из контроллера и передаем их в (вид, и шаблон)
    public function loadView($data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        //Подключаем вид
        $viewFile = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        if (file_exists($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }
        //Подключаем шаблон
        $layout = APP . "/views/layouts/{$this->layout}.php";
        require_once $layout;
    }

    /**
     * получаем из POST/GET нужный параметр
     * по умолчанию get, параметр id
     * @param bool $get
     * @param string $id
     * @return int|string|null
     * @throws \Exception
     */

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }


}