<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude(dirs: ['var', 'vendor']);

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;
