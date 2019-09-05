<?php

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\SkeletonBundle\Tests;

use Contao\SkeletonBundle\TomkonBundle;
use PHPUnit\Framework\TestCase;

class ContaoSkeletonBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new TomkonBundle();

        $this->assertInstanceOf('Contao\SkeletonBundle\TomkonBundle', $bundle);
    }
}
