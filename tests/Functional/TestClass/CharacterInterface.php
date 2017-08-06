<?php

namespace ObjectQuery\Test\Functional\TestClass;

/**
 * Interface CharacterInterface
 *
 * @package ObjectQuery\Test\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
interface CharacterInterface
{
    public function id();

    public function name();

    public function friends();

    public function appearsIn();
}