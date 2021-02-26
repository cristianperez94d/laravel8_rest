<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    private function successResponse($data, $code, $message){
        return response()->json(['response'=>$data, 'message'=>$message], $code);
    }

    protected function errorResponse($message, $code){
    return response()->json(['error' => $message , 'code' => $code] ,$code);
    }

    protected function showAll(Collection $collection, $code = 200, $message = "Ok"){
        
        if( $collection->isEmpty() ){
            return $this->successResponse(['data' => $collection], $code);
        }
        
        $resource = $collection->first()->resource;
        $resourceCollection = $collection->first()->resourceCollection;        
        $collection = $this->transformCollection($collection, $resource, $resourceCollection);
        
        $collection = $this->paginate($collection);
        
        return $this->successResponse($collection, $code, $message);
    }
    
    protected function showOne(Model $instance, $code = 200, $message = "Ok"){   
        $resource = $instance->resource;
        $instance = $this->transformModel($instance, $resource);
        return $this->successResponse($instance, $code, $message);
    }    
    
    // paginar los datos
    protected function paginate ($collection){
        
        $rules = [
            'per_page' => ['integer', 'min:2', 'max:50']
        ];
        
        $validar = Validator::make(request()->all(), $rules);
        if($validar->fails()){
            return $this->errorResponse($validar->errors(), 404);
        }
        $page = LengthAwarePaginator::resolveCurrentPage();
        
        $perPage = 3;
        if(request()->has('per_page')){
            $perPage = (int) request()->per_page;
        }
        
        $results = $collection->slice( ($page-1) * $perPage, $perPage )->values();
        
        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);
        
        // Agregar la lsita de parametros para ser ordenados porque LengthAwarePaginator elimina todos los parametros por defecto
        $paginated->appends( request()->all() );
        
        return $paginated;
        
    }    

      // transformation of model with resource
    private function transformModel(Model $model, $resource){
        $transform =  new $resource($model);

        return $transform;
    }

    // transformer of collections with resource
    private function transformCollection(Collection $collection, $resource, $resourceCollection){
        $transform = $resource::collection($collection);    
        
        return new $resourceCollection($transform);
    }


}
