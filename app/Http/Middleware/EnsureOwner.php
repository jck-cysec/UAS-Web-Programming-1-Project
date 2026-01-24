<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EnsureOwner
{
    /**
     * Ensure the authenticated user owns the resource.
     * Usage: ->middleware('ensure.owner:App\\Models\\Order,order')
     */
    public function handle(Request $request, Closure $next, $modelClass = null, $param = null)
    {
        $route = $request->route();
        $paramName = $param ?: ($route && count($route->parameters()) ? array_key_first($route->parameters()) : null);

        if (!$paramName) {
            abort(403);
        }

        $routeValue = $route->parameter($paramName);

        if ($routeValue instanceof Model) {
            $model = $routeValue;
        } elseif ($modelClass) {
            if (!class_exists($modelClass)) {
                abort(403);
            }
            $model = $modelClass::find($routeValue);
            if (!$model) {
                abort(404);
            }
        } else {
            abort(403);
        }

        $userId = Auth::user()?->id;
        $ownerCandidates = ['user_id','owner_id','customer_id','admin_id','created_by'];

        foreach ($ownerCandidates as $field) {
            if (isset($model->{$field}) && $model->{$field} == $userId) {
                return $next($request);
            }
        }

        if ($model instanceof \App\Models\User && $model->getKey() == $userId) {
            return $next($request);
        }

        abort(403);
    }
}
