<?php

namespace Cvuorinen\PhpdocMarkdownPublic\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Twig extension to create Markdown anchor links (within a single page).
 *
 * Links need to be created in the same order as the anchors appear in the document, so that links with
 * same title will be correctly suffixed with a numeric index.
 *
 * Adds the following function:
 *
 *  anchorLink(string title): string
 */
class TwigMarkdownAnchorLink extends Twig_Extension
{
    const NAME = 'TwigMarkdownAnchorLink';

    /**
     * Keep track of the created links so we can check if a link with the same title already exists.
     *
     * @var array
     */
    private static $links = array();

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('anchorLink', array($this, 'createAnchorLink'))
        );
    }

    /**
     * @param string $title
     *
     * @return string
     */
    public function createAnchorLink($title)
    {
        $anchor = strtolower($title);

        // Check if we already have link to an anchor with the same name, and add count suffix
        $linkCounts = array_count_values(self::$links);
        $anchorSuffix = array_key_exists($anchor, $linkCounts)
            ? '-' . $linkCounts[$anchor] : '';
        array_push(self::$links, $anchor);

        return sprintf("[%s](%s)", $title, '#' . $anchor . $anchorSuffix);
    }
}
