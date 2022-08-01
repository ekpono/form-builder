<?php

namespace Shopceed\FormBuilder\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Shopceed\FormBuilder\Http\Requests\Form\IndexFormRequest;
use Shopceed\FormBuilder\Http\Requests\Form\StoreFormRequest;
use Shopceed\FormBuilder\Http\Requests\Form\UpdateFormRequest;
use Shopceed\FormBuilder\Http\Resources\FormResource;
use Shopceed\FormBuilder\Models\Form;
use Shopceed\FormBuilder\Services\Search\FormSearchService;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function index(IndexFormRequest $request, FormSearchService $searchService)
    {
        $query = $searchService->search($request->validated());

        return $query->simplePaginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFormRequest  $request
     * @return FormResource
     */
    public function store(StoreFormRequest $request): FormResource
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['store_id'] = $request->current_store_id;

        return new FormResource(Form::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return FormResource
     */
    public function show(Form $form)
    {
        $this->authorize('view', $form);

        return new FormResource($form);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFormRequest  $request
     * @param  \App\Models\Form  $form
     * @return FormResource
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateFormRequest $request, Form $form)
    {
        $this->authorize('update', $form);

        $form->update($request->validated());

        return new FormResource($form);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Form $form)
    {
        $this->authorize('delete', $form);

        $form->delete();

        // todo: delete related resources

        return response()->json('OK');
    }
}
