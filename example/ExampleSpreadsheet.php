<?php

declare(strict_types=1);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use SevenInteractive\OfficeHelper\BaseExcelDocument;

class ExampleSpreadsheet extends BaseExcelDocument
{


    /** @var \DateTime */
    protected $from;
    /** @var \DateTime */
    protected $to;

    public function __construct()
    {
        //request any possible dependencies
    }

    public function setRange(\DateTime $from, \DateTime $to): void
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function getFileName(): string
    {
        return sprintf('example-%s-%s-%s.xlsx', $this->from->format('Y-m-d'), $this->to->format('Y-m-d'), time());
    }

    public function getSpreadsheet(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();

        $worksheet = $spreadsheet->getActiveSheet();
        /**
         * Do some magic setting all the possible columns and rows
         */

        return $spreadsheet;
    }

}