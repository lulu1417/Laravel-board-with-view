<?php


namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class PostValidationException extends Exception
{
    public function report()
    {

    }

    public function render(Request $request)
    {


    }
}
