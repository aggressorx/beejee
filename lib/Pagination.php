<?php


namespace lib;


use core\Engine;

class Pagination
{
    private $countRecord;  //Количество записей в выборке
    private $currentPage;   //текущая страница
    private $perPage;       //количество записей на страницу
    private $countPages;    //максимальное количество страниц
    private $uri;           //url (с удаленным параметром page)

    public function __construct($perPage, $countRecord)
    {
        $this->perPage = $perPage;
        $this->countRecord = $countRecord;
        $this->countPages = $this->countPages();
        $this->currentPage = $this->getCurrentPage();
        //удаляем из url параметр page
        $this->uri = removeGetParam('page');
    }

    /**
     * Возвращает число страниц
     * @return int
     */
    public function countPages()
    {
        return ceil($this->countRecord / $this->perPage) ?: 1;
    }

    /**
     * Проверка на указание параметра page
     * @return int
     */
    public function getCurrentPage()
    {
        $page = (int)$_GET['page'] ?? null;
        if (!$page || $page < 1) {
            $page = 1;
        }
        if ($page > $this->countPages) {
            $page = $this->countPages;
        }
        return $page;
    }

    /**
     * С какой позиции делать выборку из базы
     * @return float|int
     */
    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perPage;
    }


    public function getHtmlPagination()
    {
        //Кнопки навигации
        $firstPage = null;  //В начало
        $lastPage = null;   //В конец
        $prev = null;      //На одну меньше
        $next = null;      //На одну больше
        $activePage = null;  //Активная страница


        if ($this->currentPage > 1) {
            $firstPage = "<li class='page-item'>
                            <a class='page-link' href='{$this->uri}'>В начало</a>
                           </li>";
        }


        if ($this->currentPage < $this->countPages) {
            $lastPage = "<li class='page-item'>
                              <a class='page-link' href='{$this->uri}&page=" . ($this->countPages) . "'>В конец</a>
                        </li>";
        }

        if ($this->currentPage > 1) {
            $prev = "<li class='page-item'>
                     <a class='page-link' href='{$this->uri}&page=" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a></li>";
        }

        if ($this->currentPage < $this->countPages) {
            $next = "<li class='page-item'>
                    <a class='page-link' href='{$this->uri}&page=" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a>        </li>";
        }


        $activePage = "<li class='page-item active'><span class='page-link'>{$this->currentPage}
                        <span class='sr-only'>(current)</span>
                        </span></li>";

        return '<ul class="pagination pagination-sm">' .
            $firstPage . $prev . $activePage . $next . $lastPage
            . '</ul>';

    }


}