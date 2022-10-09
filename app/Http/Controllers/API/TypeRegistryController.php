<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ApiBaseController;
use App\Models\TypeRegistry;
use Illuminate\Support\Facades\Auth;

class TypeRegistryController  extends ApiBaseController
{
    public function getAll(Request $request)
    {
        /*
        // Access Validation
        if (!Auth::user()->tokenCan('api:customer-create')) {
            return $this->noAccessAllowed();
        }
        */

        $typeRegistry = TypeRegistry::all();
        if ($typeRegistry) {
            return $this->sendResponseWithPayload($typeRegistry, __('Types Listed'));
        } else {
            return $this->sendError(__("Registry  error"), [], 500);
        }
    }
}
