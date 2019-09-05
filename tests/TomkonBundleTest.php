<?php

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace bytesystems\TomkonBundle\Tests;

use bytesystems\TomkonBundle\TomkonBundle;
use PHPUnit\Framework\TestCase;

class TomkonBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new TomkonBundle();

        $this->assertInstanceOf('bytesystems\TomkonBundle\TomkonBundle', $bundle);
    }
}
