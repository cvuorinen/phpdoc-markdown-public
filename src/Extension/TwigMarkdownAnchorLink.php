<?php

namespace Cvuorinen\PhpdocMarkdownPublic\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Twig extension to create Markdown anchor links.
 *
 * Adds the following function:
 *
 *  anchorLink(string title)
 */
class TwigMarkdownAnchorLink extends Twig_Extension
{
    const NAME = 'TwigMarkdownAnchorLink';

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
