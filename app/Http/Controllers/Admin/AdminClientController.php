<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminClientInterface;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    private $clientInterface;
    public function __construct(AdminClientInterface $interface)
    {
        $this->clientInterface = $interface;
    }

    public function index()
    {
        return $this->clientInterface->index();
    }

    public function delete(Request $request)
    {
        return $this->clientInterface->delete($request);
    }
}
