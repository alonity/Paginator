<?php

/**
 * Paginator class
 *
 *
 * @author Qexy admin@qexy.org
 *
 * @copyright © 2021 Alonity
 *
 * @package alonity\paginator
 *
 * @license MIT
 *
 * @version 1.0.0
 *
 */

namespace alonity\paginator;

class Pagination {
    const VERSION = '1.0.0';

    private $count = 0;

    private $currentPage;

    private $limit = 0;

    private $offset = 0;

    private $url = '/?page={PAGE}';

    private $pages = 1;

    private $pageList = [];

    private $leftArrow = '‹';

    private $leftDoubleArrow = '«';

    private $rightArrow = '›';

    private $rightDoubleArrow = '»';

    private $leftPages = 3;

    private $rightPages = 3;

    private $writeCurrentPage = true;

    /**
     * Конструктор класса Pagination
     * Может принимать 3 параметра:
     *
     * @param int|null $count - общее кол-во записей
     * @param int|null $pageNum - номер текущей страницы
     * @param int|null $limit - кол-во выводимых записей
     *
    */
    public function __construct(?int $count = null, ?int $pageNum = null, ?int $limit = null){
        if(!is_null($count)){
            $this->setCount($count);
        }

        if(!is_null($pageNum)){
            $this->setCurrentPage(Paginator::Page($pageNum, str_replace('{PAGE}', $pageNum, $this->getUrl()), $pageNum));
        }

        if(!is_null($limit)){
            $this->setLimit($limit);
        }
    }

    /**
     * Сеттер для общего кол-ва записей
     * Принимает 1 обязательный параметр (кол-во записей) и возвращает текущий объект
     * Если входящий параметр меньше 0, то выставляется 0
     *
     * @param int $count
     *
     * @return self
    */
    public function setCount(int $count) : self {
        $this->count = $count < 0 ? 0 : $count;

        return $this;
    }

    /**
     * Геттер общего кол-во записей
     *
     * @return int
    */
    public function getCount() : int {
        return $this->count;
    }


    /**
     * Сеттер для текущей страницы
     * В качестве параметра передается объект @see Paginator::Page и возвращается текущий объект
     *
     * @param Page|null $page
     *
     * @return self
    */
    public function setCurrentPage(?Page $page) : self {
        $this->currentPage = $page;

        return $this;
    }

    /**
     * Геттер текущей страницы
     *
     * @return Page|null
     */
    public function getCurrentPage() : ?Page {
        return $this->currentPage;
    }



    /**
     * Сеттер лимита резульататов на страницу
     *
     * @param int $limit
     *
     * @return self
     */
    public function setLimit(int $limit) : self {
        $this->limit = $limit < 0 ? 0 : $limit;

        return $this;
    }

    /**
     * Геттер лимита результатов на странице
     *
     * @return int
     */
    public function getLimit() : int {
        return $this->limit;
    }



    /**
     * Сеттер отступа резульататов на страницу
     *
     * @param int $offset
     *
     * @return self
     */
    public function setOffset(int $offset) : self {
        $this->offset = $offset < 0 ? 0 : $offset;

        return $this;
    }

    /**
     * Геттер отступа результатов на странице
     *
     * @return int
     */
    public function getOffset() : int {
        return $this->offset;
    }



    /**
     * Сеттер адреса страницы.
     * Можно использовать шаблон {PAGE} для подстановки номера строки
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url) : self {
        $this->url = $url;

        return $this;
    }

    /**
     * Геттер адреса страницы
     *
     * @return string
     */
    public function getUrl() : string {
        return $this->url;
    }



    /**
     * Сеттер общего кол-ва страниц
     *
     * @param int $pages
     *
     * @return self
     */
    public function setPages(int $pages) : self {
        $this->pages = $pages <= 0 ? 1 : $pages;

        return $this;
    }

    /**
     * Геттер общего кол-ва страниц
     *
     * @return int
     */
    public function getPages() : int {
        return $this->pages;
    }



    /**
     * Сеттер списка страниц
     * В качестве аргумента метод принимает массив объектов @see Paginator::Page
     *
     * @param Page[]
     *
     * @return self
     */
    public function setPageList(array $list) : self {
        $this->pageList = $list;

        return $this;
    }

    /**
     * Геттер списка страниц
     * Возвращает массив объектов @see Paginator::Page
     *
     * @return Page[]
     */
    public function getPageList() : array {
        return $this->pageList;
    }



    /**
     * Сеттер для имени второй(на ход назад) стрелки в списке. По умолчанию используется символ ‹
     * В качестве входящего параметра принимается строка или null
     * Если в параметре указано значение null, то стрелка не будет вставлена в список
     *
     * Ввод стрелки в список производится только при условии, что текущая страница больше 1
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setLeftArrow(?string $value) : self {
        $this->leftArrow = $value;

        return $this;
    }

    /**
     * Геттер второй стрелки в списке
     *
     * @return string|null
     */
    public function getLeftArrow() : ?string {
        return $this->leftArrow;
    }



    /**
     * Сеттер для имени первой(на первую страницу) стрелки в списке. По умолчанию используется символ «
     * В качестве входящего параметра принимается строка или null
     * Если в параметре указано значение null, то стрелка не будет вставлена в список
     *
     * Ввод стрелки в список производится только при условии, что текущая страница больше 2
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setLeftDoubleArrow(?string $value) : self {
        $this->leftDoubleArrow = $value;

        return $this;
    }

    /**
     * Геттер первой стрелки в списке
     *
     * @return string|null
     */
    public function getLeftDoubleArrow() : ?string {
        return $this->leftDoubleArrow;
    }



    /**
     * Сеттер для имени предпоследней(на следующую страницу) стрелки в списке. По умолчанию используется символ ›
     * В качестве входящего параметра принимается строка или null
     * Если в параметре указано значение null, то стрелка не будет вставлена в список
     *
     * Ввод стрелки в список производится только при условии, что текущая страница меньше номера последней страницы
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setRightArrow(?string $value) : self {
        $this->rightArrow = $value;

        return $this;
    }

    /**
     * Геттер предпоследней стрелки в списке
     *
     * @return string|null
     */
    public function getRightArrow() : ?string {
        return $this->rightArrow;
    }



    /**
     * Сеттер для имени последней(на последнюю страницу) стрелки в списке. По умолчанию используется символ »
     * В качестве входящего параметра принимается строка или null
     * Если в параметре указано значение null, то стрелка не будет вставлена в список
     *
     * Ввод стрелки в список производится только при условии, что текущая страница меньше номера предпоследней страницы
     *
     * @param string|null $value
     *
     * @return self
     */
    public function setRightDoubleArrow(?string $value) : self {
        $this->rightDoubleArrow = $value;

        return $this;
    }

    /**
     * Геттер последней стрелки в списке
     *
     * @return string|null
     */
    public function getRightDoubleArrow() : ?string {
        return $this->rightDoubleArrow;
    }



    /**
     * Сеттер кол-ва страниц выводимых перед текущей страницей
     * Если установлено значение 0, то такие страницы выводиться не будут.
     * Если кол-во страниц меньше, чем указано в данном значении, то будут выводиться только доступные страницы
     *
     * @param int $amount
     *
     * @return self
     */
    public function setLeftPages(int $amount) : self {
        $this->leftPages = $amount;

        return $this;
    }

    /**
     * Геттер кол-ва страниц выводимых перед текущей страницей
     *
     * @return int
     */
    public function getLeftPages() : int {
        return $this->leftPages;
    }



    /**
     * Сеттер кол-ва страниц выводимых после текущей страницей
     * Если установлено значение 0, то такие страницы выводиться не будут.
     * Если кол-во страниц меньше, чем указано в данном значении, то будут выводиться только доступные страницы
     *
     * @param int $amount
     *
     * @return self
     */
    public function setRightPages(int $amount) : self {
        $this->rightPages = $amount;

        return $this;
    }

    /**
     * Геттер кол-ва страниц выводимых после текущей страницей
     *
     * @return int
     */
    public function getRightPages() : int {
        return $this->rightPages;
    }



    /**
     * Сеттер вывода текущей страницы
     *
     * @param bool $value
     *
     * @return self
     */
    public function setWriteCurrentPage(bool $value) : self {
        $this->writeCurrentPage = $value;

        return $this;
    }

    /**
     * Геттер вывода текущей страницы
     *
     * @return bool
     */
    public function getWriteCurrentPage() : bool {
        return $this->writeCurrentPage;
    }



    /**
     * Произвести сборку и подсчет всех параметров объекта
     *
     * @return bool
    */
    public function execute() : bool {
        $current = $this->getCurrentPage();

        $offset = ($current->getPage() - 1) * $this->getLimit();

        $this->setOffset($offset);

        $pages = ceil($this->getCount() / $this->getLimit());

        $this->setPages($pages);

        $list = [];

        if(!is_null($this->getLeftDoubleArrow()) && $current->getPage() > 2){
            $list[] = Paginator::Page()
                ->setPage(1)
                ->setUrl(str_replace('{PAGE}', 1, $this->getUrl()))
                ->setName($this->getLeftDoubleArrow());
        }

        if(!is_null($this->getLeftArrow()) && $current->getPage() > 1){
            $list[] = Paginator::Page()
                ->setPage($current->getPage() - 1)
                ->setUrl(str_replace('{PAGE}', $current->getPage() - 1, $this->getUrl()))
                ->setName($this->getLeftArrow());
        }

        if($this->getLeftPages() > 0){
            for($i = $current->getPage() - $this->getLeftPages(); $i < $current->getPage(); $i++){
                if($i < 1){ continue; }

                $url = str_replace('{PAGE}', $i, $this->getUrl());

                $page = Paginator::Page($i, $url, $i);

                $list[] = $page;
            }
        }

        if($this->getWriteCurrentPage()){
            $list[] = $current->setUrl(str_replace('{PAGE}', $current->getPage(), $this->getUrl()));
        }


        if($this->getRightPages() > 0){
            for($i = $current->getPage()+1; $i <= $current->getPage()+$this->getRightPages(); $i++){
                if($i > $this->getPages()){ break; }

                $url = str_replace('{PAGE}', $i, $this->getUrl());

                $page = Paginator::Page($i, $url, $i);

                $list[] = $page;
            }
        }

        if(!is_null($this->getRightArrow()) && $current->getPage() < $this->getPages()){
            $list[] = Paginator::Page()
                ->setPage($current->getPage() + 1)
                ->setUrl(str_replace('{PAGE}', $current->getPage() + 1, $this->getUrl()))
                ->setName($this->getRightArrow());
        }

        if(!is_null($this->getRightDoubleArrow()) && $current->getPage() < $this->getPages() - 1){
            $list[] = Paginator::Page()
                ->setPage($this->getPages())
                ->setUrl(str_replace('{PAGE}', $this->getPages(), $this->getUrl()))
                ->setName($this->getRightDoubleArrow());
        }

        $this->setPageList($list);

        return true;
    }
}