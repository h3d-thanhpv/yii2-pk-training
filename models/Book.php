<?php

namespace app\models;

/**
 * @property string $totalBook
 * @property string $quality
 */
class Book extends base\Book
{
    private $_quality = 1000;

    public function getQuality()
    {
        return $this->_quality;
    }

    public function getTotalBook()
    {
        return self::find()->count();
    }
}