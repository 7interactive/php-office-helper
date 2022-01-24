<?php

namespace SevenInteractive\OfficeHelper;

use Nette\DI\Container;
use Nette\InvalidStateException;
use Nette\Utils\FileSystem;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DocumentFactory
{

    /** @var string */
    protected $folder;
    /** @var Container */
    protected $container;

    /**
     * DocumentFactory constructor.
     * @param Container $container
     */
    public function __construct(string $folder, Container $container)
    {
        $this->folder = $folder;
        $this->createDirIfNotExists($folder);
        $this->container = $container;
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
        switch (true){
            case $baseDocument instanceof BaseExcelDocument:
                return $this->saveXlsx($baseDocument);
            default:
                throw new InvalidStateException(__METHOD__.'() - unimplemented type '.get_class($baseDocument));
        }
    }

    public function saveAsString(BaseDocument $baseDocument): string
    {
        $filePath = $this->save($baseDocument);
        $fileContent = file_get_contents($filePath);
        unlink($filePath);

        return $fileContent;
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