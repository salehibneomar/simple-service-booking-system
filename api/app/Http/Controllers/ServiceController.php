<?php

namespace App\Http\Controllers;

use App\Enums\CrudStatus;
use Illuminate\Http\Request;
use App\Services\ServiceOperationsService;
use App\Http\Requests\ServiceOperationRequest;
use App\Traits\ApiResponser;
use \Exception;
use App\Enums\HttpStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServiceController extends Controller
{

    use ApiResponser;

    private $serviceOperationsService;

    public function __construct(ServiceOperationsService $serviceOperationsService)
    {
        $this->serviceOperationsService = $serviceOperationsService;
    }

    public function index(Request $request)
    {
        try {
            $services = $this->serviceOperationsService->getAll($request->all());
            return $this->listDataResponse($services);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function store(ServiceOperationRequest $request)
    {
        try{
            $service = $this->serviceOperationsService->create($request->validated());
            return $this->singleModelResponse($service, HttpStatus::CREATED, CrudStatus::CREATED->value);
        }
        catch (Exception $e) {
           return $this->errorResponse($e);
        }
    }

    public function update(ServiceOperationRequest $request, string $id)
    {
        try{
            $service = $this->serviceOperationsService->update($id, $request->validated());
            return $this->singleModelResponse($service, HttpStatus::OK, CrudStatus::UPDATED->value);
        }
        catch (ModelNotFoundException $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        }
        catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy(string $id)
    {
        try{
            $service = $this->serviceOperationsService->delete($id);
            return $this->singleModelResponse($service, HttpStatus::OK, CrudStatus::DELETED->value);
        }
        catch (ModelNotFoundException $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        }
        catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
