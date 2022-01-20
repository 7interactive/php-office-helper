<?php

namespace SevenInteractive\OfficeHelper;

class DocumentHelper
{

    /** @var DocumentFactory */
    protected $documentFactory;

    /**
     * DocumentHelper constructor.
     * @param DocumentFactory $documentFactory
     */
    public function __construct(DocumentFactory $documentFactory)
    {
        $this->documentFactory = $documentFactory;
    }

}