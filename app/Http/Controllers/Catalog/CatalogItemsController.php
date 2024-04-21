<?php

namespace App\Http\Controllers\Catalog;

use App\Enums\OrderStatus;
use App\Enums\UserRole;
use App\Repositories\Orders\OrderRepository;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Catalog\CatalogItemsGetterService;

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
            default:
                assert(false, 'Role '.$user->role.' not implemented yet');
        }
    }

    /**
     * Displays the catalog items.
     */
    public function showCatalogItems(Request $request) : View
    {
        $models = new CatalogItemsGetterService();
        return view('catalog.items', ['models' => $models->getAll(), 'userRole' => $this->getUserRole()]);
    }

    /**
     * Tries to find relevant catalog items
     */
    public function searchCatalogItems(Request $request) : View
    {
        $searchQuery = $request->string('search', '');
        $models = new CatalogItemsGetterService();

        // Apply the search query if exists
        $result = [];
        if ($searchQuery === '')
            $result = $models->getAll();
        else
            $result = $models->find($searchQuery);

        return view('catalog.items', ['models' => $result, 'userRole' => $this->getUserRole()]);
    }

    private function getUserCurrentOrderStatus() : OrderStatus | null
    {
        $orders = new OrderRepository();
        $userId = Auth::user()->id;
        return $orders->getCurrentOrderStatus($userId);
    }

    /**
     * Displays the details about catalog item.
     */
    public function showCatalogItem(Request $request, int $baseModelId) : View
    {
        $models = new CatalogItemsGetterService();
        $userRole = $this->getUserRole();
        $userCurrentOrderStatus = null;
        if ($userRole === UserRole::Customer)
            $userCurrentOrderStatus = $this->getUserCurrentOrderStatus();
        return view('catalog.item', ['model' => $models->get($baseModelId), 'userRole' => $this->getUserRole(), 'userCurrentOrderStatus' => $userCurrentOrderStatus]);
    }
}
