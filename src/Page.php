<?php

/**
 * Paginator Page class
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

class Page {
    private $page = 1;

    private $url = '/?page=1';

    private $name = '1';

    /**
     * Конструктор объекта страницы
     *
     * @param int|null $pageNum - номер страницы
     * @param string|null $url - целевой URL адрес
     * @param string|null $name - имя страницы
    */
    public function __construct(?int $pageNum = null, ?string $url = null, ?string $name = null) {
        if(!is_null($pageNum)){
            $this->setPage($pageNum);
        }

        if(!is_null($url)){
            $this->setUrl($url);
        }

        if(!is_null($name)){
            $this->setName($name);
        }
    }

    /**
     * Геттер номера страницы
     *
     * @return int
    */
    public function getPage() : int {
        return $this->page;
    }

    /**
     * Сеттер страницы
     *
     * @param int $page - номер страницы
     *
     * @return self
    */
    public function setPage(int $page) : self {
        $this->page = $page;

        return $this;
    }



    /**
     * Геттер целевого URL адреса
     *
     * @return string
     */
    public function getUrl() : string {
        return $this->url;
    }

    /**
     * Сеттер целевого URL адреса
     *
     * @param string $url - URL адрес страницы
     *
     * @return self
     */
    public function setUrl(string $url) : self {
        $this->url = $url;

        return $this;
    }



    /**
     * Геттер имени страницы
     *
     * @return string
     */
    public function getName() : string {
        return $this->name;
    }

    /**
     * Сеттер имени страницы
     * Можно использовать то же значение, что и в getPage
     *
     * @param string $name - имя страницы
     *
     * @return self
     */
    public function setName(string $name) : self {
        $this->name = $name;

        return $this;
    }
}