<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function index()
    {
        return 'view transactions';
    }

    public function show(int  $transactionId) : string
    {
        return 'Transaction Details' .$transactionId;
    }

    public function create()
    {
        return 'Form to create a transaction';
    }

    public function store(Request $request) : string
    {
        return 'Store transaction';
    }
}
