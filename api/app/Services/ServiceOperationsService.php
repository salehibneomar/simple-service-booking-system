<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Enums\ServiceStatus;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceOperationsService
{

    public function getAll(array $filters = []): LengthAwarePaginator {
        $perPage = $filters['per_page'] ?? 20;
        $services = Service::query();
        $isCustomer = Auth::user()->role === UserRole::CUSTOMER;

        if ($isCustomer) {
            $services->where('status', ServiceStatus::AVAILABLE->value);
        }

        return $services->paginate($perPage);
    }

    public function create(array $data) : Service
    {
        $service = new Service();
        $service->fill($data);
        $service->save();

        return $service;
    }

    public function delete(string $id) : Service
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return $service;
    }

    public function update(string $id, array $data) : Service
    {
        $service = Service::findOrFail($id);
        $service->fill($data);
        $service->save();

        return $service;
    }
}
