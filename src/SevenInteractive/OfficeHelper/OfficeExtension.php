<?php

declare(strict_types=1);

namespace SevenInteractive\OfficeHelper;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

class OfficeExtension extends CompilerExtension
{

    public function getConfigSchema(): Schema
    {
        return Expect::structure([
            'folder' => Expect::string(),
        ]);
    }

    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();
        $builder->addDefinition($this->prefix('officeHelper'))
            ->setFactory(DocumentFactory::class, [$this->config->folder]);
    }

}