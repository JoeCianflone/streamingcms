<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Stream;

class StreamController extends Controller
{
    private $stream;

    public function __construct(Stream $stream)
    {
       $this->stream = $stream;
    }

    public function index()
    {
      $content = $this->stream->getFullStream();

      return view('stream')->with(compact('content'));
    }
}
