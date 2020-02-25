<?php declare(strict_types = 1);

return [
    ['GET', '/framework/', ['Framework\Controller\HeroCtrl','heroIndex'] ],
    ['GET', '/framework/{id:[0-9]+}', ['Framework\Controller\HeroCtrl','heroById'] ],
    ['GET', '/framework/name/{name}', ['Framework\Controller\HeroCtrl','heroByName'] ],
];

