<?php

namespace BookReader\Reader;

/**
 * Class ReaderEPUB.
 *
 * @package BookReader\Reader
 */
class ReaderEPUB implements ReaderInterface
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
     * Library read metadata of book.
     *
     * @var \EPub
     * @access private
     */
    private $epub;

    /**
     * @inheritdoc
     */
    public function __construct($bookPath, \CakeRequest $cakeRequest)
    {
        $this->bookPath    = $bookPath;
        $this->cakeRequest = $cakeRequest;

        \App::import('Vendor', 'EPub', array('file' => 'php-epub-meta' . DS . 'epub.php'));

        $this->epub = new \EPub($this->bookPath);
        $this->epub->initSpineComponent();

        isset($this->cakeRequest->query['comp']) && $this->setVisibleContent();
    }

    /**
     * @inheritdoc
     */
    public function getSupportedExtension()
    {
        return ('epub');
    }

    /**
     * Get book metadata of components.
     *
     * @access public
     * @return string
     */
    public function getComponents()
    {
        $components = array_map(
            function ($component) {
                return ('\'' . $component . '\'');
            },
            $this->epub->components()
        );
        return ('[' . implode(', ', $components) . ']');
    }

    /**
     * Get book metadata of contents.
     *
     * @access public
     * @return string
     */
    public function getContents()
    {
        $contents = array_map(
            function ($content) {
                return ('{title: \'' . addslashes($content['title']) . '\', src: \'' . $content['src'] . '\'}');
            },
            $this->epub->contents()
        );
        return ('[' . implode(', ', $contents) . ']');
    }

    /**
     * Set output of book content.
     *
     * @access private
     * @return void
     */
    private function setVisibleContent()
    {
        $book      = $this->epub;
        $component = $this->cakeRequest->query('comp');

        $callback = function ($m) use ($book, $component) {
            $method = $m[1];
            $path   = $m[2];
            $end    = '';

            if (preg_match('/^src\s*:/', $method)) {
                $end = ')';
            }

            if (preg_match('/^#/', $path)) {
                return ($method . '\'' . $path . '\'' . $end);
            }

            $hash = '';
            if (preg_match('/^(.+)#(.+)$/', $path, $matches)) {
                $path = $matches[1];
                $hash = '#' . $matches[2];
            }

            $comp = $book->getComponentName($component, $path);
            if (!$comp) {
                return ($method . '\'#\'' . $end);
            }

            $out = $method . '\'?comp=' . $comp . $hash . '\'' . $end;
            return ($end ? $out : str_replace('&', '&amp;', $out));
        };

        $content = preg_replace_callback(
            array(
                '/(src\s*:\s*url\()(.*?)\)/',
                '/(\@import\s+)["\'](.*?)["\'];/',
                '/(href=)["\']([^:]*?)["\']/',
                '/(src=)["\']([^:]*?)["\']/'
            ),
            $callback,
            $book->component($component)
        );

        header('Pragma: public');
        header('Cache-Control: maxage=' . 1209600);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 1209600) . ' GMT');
        header('Content-Type: ' . $book->componentContentType($component));

        print ($content);
        exit;
    }
}