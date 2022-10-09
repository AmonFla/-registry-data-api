<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ApiBaseController;
use App\Models\Registry;
use App\Models\TypeRegistry;
use Illuminate\Support\Facades\Auth;


class RegistryController  extends ApiBaseController
{
    public function create(Request $request, $type)
    {
        /*
        // Access Validation
        if (!Auth::user()->tokenCan('api:customer-create')) {
            return $this->noAccessAllowed();
        }
        */


        $input = $request->all();
        // valído los requeridos

        $typeRegistry = TypeRegistry::find($type);
        if (!$typeRegistry) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Invalid type')], 204);
        }
        if (!isset($input['name'])) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Required name missing')], 422);
        }
        if (!isset($input['description'])) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Required description missing')], 422);
        }
        if (!isset($input['date_registry'])) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Required date_registry missing')], 422);
        }

        $registry = Registry::create([
            'type_id' => $typeRegistry->id,
            'date_registry' => $input['date_registry'],
            'name' => $input['name'],
            'description' => $input['description'],
            'user_id' => Auth::user()->id

        ]);

        if ($registry) {
            return $this->sendResponseWithPayload($registry, __('Registry Created'), 201);
        } else {
            return $this->sendError(__("Registry  error"), [], 500);
        }
    }

    public function getAll(Request $request, $type)
    {
        /*
        // Access Validation
        if (!Auth::user()->tokenCan('api:customer-create')) {
            return $this->noAccessAllowed();
        }
        */

        $typeRegistry = TypeRegistry::find($type);
        if (!$typeRegistry) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Invalid type')], 204);
        }

        $registries = Registry::where(['user_id' => Auth::user()->id, 'type_id' => $type])->get();

        if ($registries) {
            return $this->sendResponseWithPayload($registries, __('Registries Listed'));
        } else {
            return $this->sendError(__("Registry  error"), [], 500);
        }
    }

    public function getOne(Request $request, $type, $id)
    {
        /*
        // Access Validation
        if (!Auth::user()->tokenCan('api:customer-create')) {
            return $this->noAccessAllowed();
        }
        */

        $registry = Registry::where(['user_id' => Auth::user()->id, 'id' => $id, 'type_id' => $type])->first();

        if ($registry) {
            return $this->sendResponseWithPayload($registry, __('Registr4 Listed'));
        } else {
            return $this->sendError(__("Invalid  registry"), [], 404);
        }
    }

    public function delete(Request $request, $type, $id)
    {
        /*
        // Access Validation
        if (!Auth::user()->tokenCan('api:customer-create')) {
            return $this->noAccessAllowed();
        }
        */

        $registry = Registry::where(['user_id' => Auth::user()->id, 'id' => $id, 'type_id' => $type])->first();

        if ($registry) {
            $registry->delete();
            return $this->sendResponse(__('Registry Erased'), 202);
        } else {
            return $this->sendError(__("Invalid  registry"), [], 404);
        }
    }

    public function update(Request $request, $type, $id)
    {
        /*
        // Access Validation
        if (!Auth::user()->tokenCan('api:customer-create')) {
            return $this->noAccessAllowed();
        }
        */


        $input = $request->all();
        // valído los requeridos

        $typeRegistry = TypeRegistry::find($type);
        if (!$typeRegistry) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Invalid type')], 204);
        }
        if (!isset($input['name'])) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Required name missing')], 422);
        }
        if (!isset($input['description'])) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Required description missing')], 422);
        }
        if (!isset($input['date_registry'])) {
            return $this->sendError(__("Invalid Input"), ['error' => __('Required date_registry missing')], 422);
        }

        $registry = Registry::where(['user_id' => Auth::user()->id, 'id' => $id, 'type_id' => $type])->first();

        if ($registry) {
            $registry->date_registry = $input['date_registry'];
            $registry->name = $input['name'];
            $registry->description = $input['description'];
            $registry->save();
            return $this->sendResponseWithPayload($registry, __('Registry updated'), 202);
        } else {
            return $this->sendError(__("Invalid  registry"), [], 404);
        }
    }
}
