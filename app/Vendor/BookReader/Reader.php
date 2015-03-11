<?php

namespace BookReader;

/**
 * Class Reader.
 *
 * @package BookReader
 */
Class Reader
{

    /**
     * Path of book.
     *
     * @var string
     * @access private
     */
    private $bookPath;

    /**
     * Book information.
     *
     * @var array
     * @access private
     */
    private $bookInfo = array();

    /**
     * Supported read of books.
     *
     * @var array
     * @access private
     * @static
     */
    static private $supportedTypes = array('epub', 'pdf');

    /**
     * Initialize.
     *
     * @param string $bookPath Path of book
     * @access public
     */
    public function __construct($bookPath)
    {
        $this->bookPath = $bookPath;
        $this->bookInfo = pathinfo($bookPath);
    }

    /**
     * Autoload classes.
     *
     * @param string $className Autoload class name
     * @access public
     * @static
     * @return void
     */
    static public function __autoload($className)
    {
        \App::uses($className, 'Vendor');
        \App::load($className);
    }

    /**
     * Read book.
     *
     * @param \CakeRequest $cakeRequest Class that helps wrap Request information
     * @access public
     * @return Reader\ReaderInterface
     */
    public function read(\CakeRequest $cakeRequest)
    {
        $extension  = $this->bookInfo['extension'];
        $readerName = '\\BookReader\\Reader\\Reader' . strtoupper($extension);
        if (!$this->hasSupported($extension) || !class_exists($readerName)) {
            throw new \NotFoundException(__('Unsupported format book'));
        }

        return (new $readerName($this->bookPath, $cakeRequest));
    }

    /**
     * Is supported read of book.
     *
     * @param string $extension Name extension book
     * @access public
     * @static
     * @return bool
     */
    static public function hasSupported($extension)
    {
        return (in_array(strtolower($extension), self::$supportedTypes));
    }

}
