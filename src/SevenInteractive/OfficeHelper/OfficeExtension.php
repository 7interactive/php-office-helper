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
        // load the configuration file for the extension
        $this->compiler->loadDefinitionsFromConfig(
            $this->loadFromFile('config/config.neon')['services']
		);
    }

}