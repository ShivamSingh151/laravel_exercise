<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RouterService;
use App\Models\Router;

class RouteapiController extends Controller
{
    protected $service;

    public function __construct(RouterService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $domain 	=  isset($request['domain']) && $request['domain'] != '' ? $request['domain'] : '';
        $loopback   =  isset($request['loopback']) && $request['loopback'] != '' ? $request['loopback'] : '';
        $mac   =  isset($request['mac']) && $request['mac'] != '' ? $request['mac'] : '';
        
        $params = ['domain' => $domain, 'loopback' => $loopback, 'mac' => $mac];

        $items = $this->service->paginateWithParams($params, $perPage=2);
        
        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->toArray();
        // dd($data);
        try{            
            $validation = \Validator::make(
                array(
                    'domain'         => array('required','unique:routers,domain,'.$data['domain']),
                    'loopback'      => array('required','unique:routers,ipv4,'.$data['loopback']),
                    'mac'           => array('required'),
                ),
                array(
                    'required' => 'The :attribute field can not be blank.'
                )
            );

            if ($validation->fails()) {
                $arrErrMsg = $validation->messages()->toArray();
                
                if(!empty($arrErrMsg['domain']) && $arrErrMsg['domain'][0] == 'The loopback or domain has already been taken.'){
                    return \Response::json(['statusCode' => 400, 'message' => 'domain already in use', 'type' => 'DOMAIN_ALREADY_EXIST'], 400);
                }else{
                    return \Response::json(['statusCode' => 400, 'message' => $arrErrMsg[array_key_first($arrErrMsg)][0], 'type' => 'SyntaxError'], 400);
                }
            }
            
        }catch(\Exception $e){
            return \Response::json(['statusCode' => 400, 'message' => 'Invalid data', 'type' => 'SyntaxError'], 400);
        }

        if(Router::firstOrCreate(
        [
          'domain' => $data['domain'],
          'loopback' => $data['loopback'],
          'mac' => $data['mac']
        ])){
            return \Response::json(['statusCode' => 200, 'message' => 'Inserted', 'type' => 'success'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = json_decode($request->getContent(), true);
        print_r($data);exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = json_decode($request->getContent(), true);

        try{
            $validation = \Validator::make(
                            array(
                                'domain'         => $data['domain'],
                                'loopback'       => $data['loopback'],
                                'mac'            => $data['mac']
                            ),
                            array(
                                'domain'         => array('required','unique:routers,domain,'.$id),
                                'loopback'      => array('required','unique:routers,loopback,'.$id),
                                'mac'           => array('required'),
                            ),
                            array(
                                'required' => 'The :attribute field can not be blank.'
                            )
                        );
            if ($validation->fails()) {
                $arrErrMsg = $validation->messages()->toArray();
                if(!empty($arrErrMsg['domain']) && $arrErrMsg['domain'][0] == 'The loopback or domain has already been taken.'){
                    return \Response::json(['statusCode' => 400, 'message' => 'domain already in use', 'type' => 'DOMAIN_ALREADY_EXIST'], 400);
                }else{
                    return \Response::json(['statusCode' => 400, 'message' => $arrErrMsg[array_key_first($arrErrMsg)][0], 'type' => 'SyntaxError'], 400);
                }
            }
            
        }catch(\Exception $e){
            return \Response::json(['statusCode' => 400, 'message' => 'Invalid data', 'type' => 'SyntaxError'], 400);
        }
        if(Router::where('id', $id)->update(
        [
          'domain' => $data['domain'],
          'loopback' => $data['loopback'],
          'mac' => $data['mac']
        ])){
            return \Response::json(['statusCode' => 201, 'message' => 'Updated', 'type' => 'success'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = "Not found.";
        $router = Router::find($id);
        // dd($router);
        if($router){
            $status = $router->delete();
            if($status){
                $msg = "Deleted.";
            }else{
                $msg = "Something went wrong!";
            }
        }

        return \Response::json(['statusCode' => 200, 'message' => $msg, 'type' => 'success'], 200);
    }
}
