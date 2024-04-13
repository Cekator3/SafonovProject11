<?php

namespace App\Http\Controllers\Catalog;

use App\Enums\UserRole;
use App\Services\Admin\BaseModels\BaseModelsGetterService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Admin\BaseModels\BaseModelRepository;

class CatalogItemsController
{
    private function getUserRole() : UserRole
    {
        $user = Auth::user();
        if ($user === null)
            return UserRole::Guest;
        switch ($user->role)
        {
            case UserRole::Customer:
                return UserRole::Customer;
            case UserRole::Admin:
                return UserRole::Admin;
        }
    }

    /**
     * Displays the catalog items.
     */
    public function showCatalogItems(Request $request) : View
    {
        $models = new BaseModelsGetterService();
        return view('catalog.items', ['models' => $models->getAll(), 'userRole' => $this->getUserRole()]);
    }

    /**
     * Tries to find relevant catalog items
     */
    public function searchCatalogItems(Request $request) : View|RedirectResponse
    {
        // ...
        $searchQuery = $request->query('search', '');
        $models = new BaseModelsGetterService();

        // Apply the search query if exists
        $result = [];
        if ($searchQuery === '')
            $result = $models->getAll();
        else
            $result = $models->find($searchQuery);

        return view('catalog.items', ['models' => $result, 'userRole' => $this->getUserRole()]);
    }
}
