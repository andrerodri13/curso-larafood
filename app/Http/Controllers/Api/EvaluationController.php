<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEvaluationOrderRequest;
use App\Http\Resources\EvaluationResource;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * @var EvaluationService
     */
    private $evaluationService;

    /**
     * EvaluationController constructor.
     */
    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(StoreEvaluationOrderRequest $request)
    {
        $evaluation = $request->only('stars', 'comment');
        $evaluation = $this->evaluationService->createNewEvaluation($request->identifyOrder, $evaluation);
        return new EvaluationResource($evaluation);
    }
}
