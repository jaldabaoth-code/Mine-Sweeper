<?php
    namespace App;

    use Exception;
    use OutOfBoundsException;

    class MineSweeper
    {
        public const BOMB = 'x';
        private array $tiles;

        public function __construct(array $tiles)
        {
            $this->tiles = $tiles;
        }

        public function play(int $x, int $y): int
        {
            $bomb = 0;
            if (!isset($this->getTiles()[$y][$x])) {
                throw new OutOfBoundsException('out');
            }

            if ($this->getTiles()[$y][$x] === self::BOMB) {
                throw new Exception('Boom');
            }

            for ($i = $y-1; $i <= $y+1; $i++) {
                for ($j = $x-1; $j <= $x+1; $j++) {
                    if (isset($this->getTiles()[$i][$j]) && $this->getTiles()[$i][$j] === self::BOMB) {
                        $bomb++;
                    } 
                }
            }
            $this->tiles[$y][$x] = $bomb;
            return $bomb;
        }

        /**
         * Get the value of tiles
         */ 
        public function getTiles()
        {
            return $this->tiles;
        }

        /**
         * Set the value of tiles
         * @return  self
         */ 
        public function setTiles($tiles)
        {
            $this->tiles = $tiles;
            return $this;
        }
    }
