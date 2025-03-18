<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class NotFoundException extends Exception
{
    public function render(Request $request): RedirectResponse
    {
        return redirect()->back()->with('error', $this->getMessage());
    }
}
