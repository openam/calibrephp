<?php

namespace BookReader\Reader;

/**
 * Class ReaderPDF.
 *
 * @package BookReader\Reader
 */
class ReaderPDF implements ReaderInterface
{

    /**
     * Path of book.
     *
     * @var string
     * @access private
     */
    private $bookPath;

    /**
     * Class that helps wrap Request information.
     *
     * @var \CakeRequest
     * @access private
     */
    private $cakeRequest;

    /**
     * @inheritdoc
     */
    public function __construct($bookPath, \CakeRequest $cakeRequest)
    {
        $this->bookPath    = $bookPath;
        $this->cakeRequest = $cakeRequest;
    }

    /**
     * @inheritdoc
     */
    public function getSupportedExtension()
    {
        return ('pdf');
    }
}