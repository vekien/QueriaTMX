<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('highlight', [$this, 'highlight']),
        ];
    }

    public function highlight(string $string, string $query): string
    {
        return preg_replace("/\p{L}*?".preg_quote($query)."\p{L}*/ui", "<mark>$0</mark>", $string);
    }
}
