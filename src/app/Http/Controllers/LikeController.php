<?php

namespace App\Http\Controllers;

use App\Http\Requests\Like\StoreLikeRequest;
use App\Models\Like;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function __invoke(StoreLikeRequest $request)
    {
        $data = $request->validated();
        Like::create($data);
        return Response::HTTP_OK;
    }
}
