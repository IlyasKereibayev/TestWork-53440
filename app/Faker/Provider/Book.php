<?php
namespace App\Faker\Provider;

class Book extends \Faker\Provider\Base
{
    public function bookTitle($nbWords = 5)
    {
        $sentence = $this->generator->sentence($nbWords);
        return substr($sentence, 0, strlen($sentence) - 1);
    }

    public function ISBN()
    {
        return $this->generator->ean13();
    }
}
