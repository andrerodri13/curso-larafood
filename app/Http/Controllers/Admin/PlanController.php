<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    /**
     * @var Plan
     */
    private $repository;

    /**
     * PlanController constructor.
     */
    public function __construct(Plan $repository)
    {
        $this->repository = $repository;
        $this->middleware('can:plans');
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlanRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('plans.index');
    }

    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        if (!$plan) {
            return redirect()->back();
        }
        return view('admin.pages.plans.show', compact('plan'));
    }

    public function destroy($url)
    {
        $plan = $this->repository
            ->with('details')
            ->where('url', $url)->first();
        if (!$plan) {
            return redirect()->back();
        }

        if ($plan->details->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Existem  detalhes vinculados a este plano, portanto não é possivel remover');
        }

        $plan->delete();
        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $plans = $this->repository->search($request->filter);
        return view('admin.pages.plans.index', compact('plans', 'filters'));
    }

    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        if (!$plan) {
            return redirect()->back();
        }
        return view('admin.pages.plans.edit', compact('plan'));

    }

    public function update(StoreUpdatePlanRequest $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();
        if (!$plan) {
            return redirect()->back();
        }
        $plan->update($request->all());

        return redirect()->route('plans.index');
    }
}
