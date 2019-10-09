<?php


namespace ComAI\ArduComponents\WorkingCheck\Infrastructure\Parser;

use ComAI\ArduComponents\WorkingCheck\Domain\CheckButtonEmptyException;
use ComAI\ArduComponents\WorkingCheck\Domain\SesameParserInterface;
use ComAI\ArduComponents\WorkingCheck\Domain\WorkedTimeEmptyException;

/**
 * Class SesameHtmlParser
 *
 * @package ComAI\ArduComponents\Sesame\Infrastructure\Sesame
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class SesameHtmlParser
    implements SesameParserInterface
{
    /**
     * @var \DOMXPath
     */
    protected $domXPath;

    /**
     * @var \DOMDocument
     */
    protected $domDocument;

    /**
     * @var string
     */
    protected $document;

    /**
     * SesameHtmlParser constructor.
     *
     * @param string $document
     */
    public function __construct(
        string $document
    ) {
        $this->domDocument = new \DOMDocument();
        @$this->domDocument->loadHTML($document);

        $this->domXPath = new \DOMXPath($this->domDocument);
    }

    /**
     * @return string
     * @throws CheckButtonEmptyException
     */
    public function getCheckStatus() : string
    {
        $button = $this->domXPath->query('//a[@id="check_button"]');

        if (0 === $button->length) {
            throw new CheckButtonEmptyException(
                'We could not find the selected button',
                0
            );
        }

        if (empty($button->item(0))) {
            throw new CheckButtonEmptyException(
                'There is not any item at first position',
                1
            );
        }

        return (string) $button->item(0)->nodeValue;
    }

    /**
     * @return string
     * @throws WorkedTimeEmptyException
     */
    public function getWorkedTime() : string
    {
        $workedTime = $this->domXPath->query('//span[@id="currenttime3"]');

        if (0 === $workedTime->length){
            throw new WorkedTimeEmptyException(
                'We could not find worked time',
                0
            );
        }

        if (empty($workedTime->item(0))) {
            throw new WorkedTimeEmptyException(
                'There is not any item at first position',
                1
            );
        }

        return (string) $workedTime->item(0)->nodeValue;
    }
}
