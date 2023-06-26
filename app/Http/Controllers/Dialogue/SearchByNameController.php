<?php

namespace App\Http\Controllers\Dialogue;

use App\Http\Requests\Dialogue\SearchByNameRequest;

class SearchByNameController extends BaseController
{
    public function __invoke(SearchByNameRequest $request)
    {
        $data = $request->validated();

        $key = $data['name'];

        return redirect()->route('dialogues.showSearchResults', $key);
    }
}
