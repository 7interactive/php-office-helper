<?php

namespace SevenInteractive\OfficeHelper;

use Nette\DI\Container;
use Nette\InvalidStateException;
use Nette\Utils\FileSystem;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DocumentFactory
{

    public function __construct(
        protected string $folder,
        protected Container $container)
    {
        $this->createDirIfNotExists($folder);
    }

    public function createDirIfNotExists(string $folder): void
    {
        if(!file_exists($folder)){
            mkdir($folder, 755);
        }
    }

    public function createByClassName(string $className): BaseDocument
    {
        /** @var BaseDocument $document */
        $document = $this->container->getByType($className);
        return $document;
    }

    public function save(BaseDocument $baseDocument): string
    {
        return match(get_class($baseDocument)){
            BaseExcelDocument::class => $this->saveXlsx($baseDocument),
            default => throw new InvalidStateException(__METHOD__.'() - unimplemented type '.get_class($baseDocument)),
        };
    }

    protected function saveXlsx(BaseExcelDocument $baseExcelDocument): string
    {
        $spreadsheet = $baseExcelDocument->getSpreadsheet();
        $writer = new Xlsx($spreadsheet);
        $filePath = FileSystem::joinPaths($this->folder, $baseExcelDocument->getFileName());
        $writer->save($filePath);
        return $filePath;
    }

}