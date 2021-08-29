# Paginator
Pagination component

## Install

`composer require alonity/paginator`

### Examples
```php
use alonity\paginator\Paginator;

require('vendor/autoload.php');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$count = 100;

$limit = 10;

$paginator = Paginator::Pagination($count, $page, $limit)
    ->setUrl("/?page={PAGE}");

$paginator->execute();

foreach($paginator->getPageList() as $page){
    if($page->getPage() == $paginator->getCurrentPage()->getPage()){
        echo "<a href=\"{$page->getUrl()}\"><b>{$page->getName()}</b></a> ";
    }else{
        echo "<a href=\"{$page->getUrl()}\">{$page->getName()}</a> ";
    }
}

```