<?php

use Illuminate\Http\Request;

function flashMessage(Request $request, $message, $messageType = 'info', $addons = [])
{
    if (config('app.env') == 'local') {
        if (isset($addons['res'])) {
            $request->session()->flash('message', $message . PHP_EOL . $addons['res']);
        } else {
            $request->session()->flash('message', $message);
        }
    } else {
        $request->session()->flash('message', $message);
    }
    $request->session()->flash('messageType', $messageType);
}