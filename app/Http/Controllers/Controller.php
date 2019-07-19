<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function json($content = null)
    {
        return response()->json($content);
    }

    public function swal($type, $title, $message)
    {
        return $this->json([
            'type' => $type,
            'title' => $title,
            'text' => $message
        ]);
    }
}
