<?php

namespace SevenInteractive\OfficeHelper;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

abstract class BaseDocument
{

    abstract public function getFileName(): string;

    abstract public function getSpreadsheet(): Spreadsheet;

}