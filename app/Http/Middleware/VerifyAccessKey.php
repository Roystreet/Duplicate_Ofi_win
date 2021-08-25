<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccessKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     protected $AUTH_HEADER    = 'secret';
     protected $CONTENT_HEADER = 'Content-Type';

     public function __construct()
     {
       $this->secret = config('api_secret.secret');
     }


    public function handle($request, Closure $next)
    {
      $response = [];
      $secret;
      $type;

      //VALIDO EL TIPO DE DATA
      if($request->hasHeader($this->CONTENT_HEADER)){
        $type = $request->header($this->CONTENT_HEADER);
      }else {
        $response['status']  = 400;
        $response['data']['posts']['Error'] = 'An invalid secret, signature, expiration, or url';
        return response()->json($response, 400);
      }

      //VALIDO EL INGRESO DEL TOKEN
      if($request->hasHeader($this->AUTH_HEADER)){
        $secret = $request->header($this->AUTH_HEADER);
      }else {
        $response['status']  = 400;
        $response['data']['posts']['Error'] = 'No found secret in header';
        return response()->json($response, 400);
      }


      if($type == "application/json" && $secret  == $this->secret){
        return $next($request);
      }

      else {
        if($type != "application/json"){
          $response['status']  = 450;
          $response['data']['posts']['Error'] = 'Invalid JSON request';
          return response()->json($response, 450);
        }

        $response['status']  = 400;
        $response['data']['posts']['Error'] = 'Invalid Auth';
        return response()->json($response, 400);

      }


    }
}
