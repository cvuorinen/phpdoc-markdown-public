<?php

namespace Cvuorinen\PhpdocMarkdownPublic\Extension;

use phpDocumentor\Descriptor\ClassDescriptor;
use phpDocumentor\Descriptor\MethodDescriptor;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Twig extension to get only the public methods from a \phpDocumentor\Descriptor\ClassDescriptor instance.
 *
 * Adds the following function to Twig:
 *
 *  publicMethods(ClassDescriptor class): MethodDescriptor[]
 */
class TwigClassPublicMethods extends Twig_Extension
{
    const NAME = 'TwigClassPublicMethods';

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
            new Twig_SimpleFunction('publicMethods', array($this, 'getPublicMethods'))
        );
    }

    /**
     * @param ClassDescriptor $class
     *
     * @return MethodDescriptor[]
     */
    public function getPublicMethods($class)
    {
        if (!$class instanceof ClassDescriptor) {
            return [];
        }

        $methods = $class->getMagicMethods()
            ->merge($class->getInheritedMethods())
            ->merge($class->getMethods());

        return array_filter(
            $methods->getAll(),
            function (MethodDescriptor $method) {
                return $method->getVisibility() === 'public';
            }
        );
    }
}
