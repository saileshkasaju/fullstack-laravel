<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test() {
        return response() -> json([
            'msg' => 'tag created'
        ], 422);
    }
    public function controllerMethod() {
        return view('welcome');
    }

    public function controllerMethodWithMeta($id) {
        // call api to get metadata for view
        // generate metadata array of titles and contents
        return view('welcome')->withMetadata("send metadata array here");
    }
    public function controllerMethodReturnJson() {
        return response() -> json([
            'msg' => 'We should return pnlu json'
        ]);
    }
}
