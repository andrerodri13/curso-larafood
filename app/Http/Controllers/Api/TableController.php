<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\TableResource;
use App\Services\TableService;

class TableController extends Controller
{
    /**
     * @var TableService
     */
    private $tableService;

    /**
     * TableController constructor.
     */
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function tablesByTenant(TenantFormRequest $request)
    {
        $tables = $this->tableService->getTableByUuid($request->token_company);
        return TableResource::collection($tables);
    }

    public function show(TenantFormRequest $request, $identify)
    {

        if (!$table = $this->tableService->getTableByIdentify($identify)) {
            return response()->json(['message' => 'Table Not Found'], 404);
        }

        return new TableResource($table);
    }
}
