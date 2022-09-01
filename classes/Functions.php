<?php

namespace classes;

class Functions
{
    public function convertBytes(float $bytes, string $type): float|string {
        if (strtolower($type) == "kb") {
            return $bytes / 1000;
        }

        else if (strtolower($type) == "mb") {
            return $bytes / pow(1000, 2);
        }

        else if (strtolower($type) == "gb") {
            return $bytes / pow(1000, 3);
        }

        else if (strtolower($type) == "tb") {
            return $bytes / pow(1000, 4);
        }

        else if (strtolower($type) == "pb") {
            return $bytes / pow(1000, 5);
        }

        else {
            return "Type is not defined.";
        }
    }
}