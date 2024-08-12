<?php

namespace App\Http\Controllers\tests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function greet(string $name): string
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        return "Hello, $name!";
    }
}
