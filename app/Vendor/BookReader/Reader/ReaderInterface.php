<?php

namespace BookReader\Reader;

/**
 * Interface ReaderInterface.
 *
 * @package BookReader\Reader
 */
interface ReaderInterface
{

    /**
     * Initialize.
     *
     * @param string $bookPath Path of book
     * @param \CakeRequest $cakeRequest Class that helps wrap Request information
     * @access public
     */
    public function __construct($bookPath, \CakeRequest $cakeRequest);

    /**
     * Get supported extension of book.
     *
     * @access public
     * @return string
     */
    public function getSupportedExtension();
}