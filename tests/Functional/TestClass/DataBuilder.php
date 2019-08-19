<?php

namespace ObjectQuery\Test\Functional\TestClass;

/**
 * Class DataBuilder
 *
 * @package ObjectQuery\Test\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
class DataBuilder
{
    public function getDroid(int $id): ?Droid
    {
        $data = [
            2000 => [
                'name'     => 'C-3PO',
                'friends'  => [1000, 1002, 1003, 2001],
                'function' => 'Protocol',
                'appears'  => [1, 2, 3],
            ],
            2001 => [
                'name'     => 'R2-D2',
                'friends'  => [1000, 1002, 1003],
                'function' => 'Astromech',
                'appears'  => [1, 2, 3],
            ],
        ];

        if (!array_key_exists($id, $data)) {
            return null;
        }

        $droidData = $data[$id];
        $episodes = array_map(function ($episodeNumber) {
            return $this->getEpisode($episodeNumber);
        }, $droidData['appears']);

        return new Droid($id, $droidData['friends'], $droidData['name'], $episodes, $droidData['function']);
    }

    public function getCharacter(int $id): ?CharacterInterface
    {
        return $this->getDroid($id) ?? $this->getHuman($id);
    }

    public function getHuman(int $id): ?Human
    {
        $data = [
            1000 => [
                'name'      => 'Luke Skywalker',
                'friends'   => [1002, 1003, 2000, 2001],
                'height'    => 1.72,
                'mass'      => 77,
                'appears'   => [1, 2, 3],
                'starShips' => [3001, 3003],
            ],
            1001 => [
                'name'      => 'Darth Vader',
                'friends'   => [1004],
                'height'    => 2.02,
                'mass'      => 136,
                'appears'   => [1, 2, 3],
                'starShips' => [3002],
            ],
            1002 => [
                'name'      => 'Han Solo',
                'friends'   => [1000, 1003, 2001],
                'height'    => 1.8,
                'mass'      => 80,
                'appears'   => [1, 2, 3],
                'starShips' => [3000, 3003],
            ],
            1003 => [
                'name'      => 'Leia Organa',
                'friends'   => [1000, 1002, 2000, 2001],
                'height'    => 1.5,
                'mass'      => 49,
                'appears'   => [1, 2, 3],
                'starShips' => [],
            ],
            1004 => [
                'name'      => 'Wilhuff Tarkin',
                'friends'   => [1001],
                'height'    => 1.8,
                'mass'      => null,
                'appears'   => [1],
                'starShips' => [],
            ],
        ];

        if (!array_key_exists($id, $data)) {
            return null;
        }

        $humanData = $data[$id];
        $episodes = array_map(function ($episodeNumber) {
            return $this->getEpisode($episodeNumber);
        }, $humanData['appears']);
        $starShips = array_map(function ($id) {
            return $this->getStarShip($id);
        }, $humanData['starShips']);

        return new Human(
            $id,
            $humanData['name'],
            $humanData['height'],
            (int)$humanData['mass'],
            $humanData['friends'],
            $episodes,
            $starShips
        );
    }

    public function getEpisode(int $number): Episode
    {
        return new Episode($number);
    }

    public function getStarShip(int $id): StarShip
    {
        $data = [
            3000 => [
                'name'   => 'Millenium Falcon',
                'length' => 34.37,
            ],
            3001 => [
                'name'   => 'X-Wing',
                'length' => 12.5,
            ],
            3002 => [
                'name'   => 'TIE Advanced x1',
                'length' => 9.2,
            ],
            3003 => [
                'name'   => 'Imperial shuttle',
                'length' => 20,
            ],
        ];

        $shipData = $data[$id];

        return new StarShip($id, $shipData['name'], $shipData['length']);
    }
}
