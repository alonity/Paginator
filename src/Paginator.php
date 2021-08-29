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

class Paginator {
    /**
     * Создание экземпляра класса Pagination
     *
     * @param int|null $count - общее кол-во страниц
     * @param int|null $pageNum - номер текущей страницы
     * @param int|null $limit - кол-во записей на одну страницу
     *
     * @return Pagination
    */
    public static function Pagination(?int $count = null, ?int $pageNum = null, ?int $limit = null) : Pagination {
        return new Pagination($count, $pageNum, $limit);
    }



    /**
     * Создание экземпляра класса Page
     *
     * @param int|null $pageNum - номер страницы
     * @param string|null $url - URL адрес страницы
     * @param string|null $name - имя страницы
     *
     * @return Page
     */
    public static function Page(?int $pageNum = null, ?string $url = null, ?string $name = null) : Page {
        return new Page($pageNum, $url, $name);
    }
}