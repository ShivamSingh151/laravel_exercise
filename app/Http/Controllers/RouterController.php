<?php

namespace App\Http\Controllers;

use App\Http\Services\RouterService;
use Illuminate\Http\Request;
use App\Models\User;

class RouterController extends Controller
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
        
        return view('router.index', ['items' => $items, 'params' => $params]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('router.create');
    }

    public function is_valid_domain_name($domain_name) {
        return (preg_match("/^([a-zd](-*[a-zd])*)(.([a-zd](-*[a-zd])*))*$/i", $domain_name) //valid characters check
        && preg_match("/^.{1,253}$/", $domain_name) //overall length check
        && preg_match("/^[^.]{1,63}(.[^.]{1,63})*$/", $domain_name) ); //length of every label
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
        unset($data['_token']);

        $validatedData = $request->validate([
            'domain' => ['required', 'unique:routers'],
            'loopback' => ['required', 'ipv4', 'unique:routers'],
            'mac' => ['required', 'unique:routers'],
        ]);


        $_check_domain = $this->is_valid_domain_name($data['domain']);
        
        if ($_check_domain == false) {
	        return back()->with('errorMsg','Please enter valid domain');
        }
        
        if(!filter_var($data['loopback'], FILTER_VALIDATE_IP)) {
	        return back()->with('errorMsg','Please enter valid loopback');
		}

		if(!filter_var($data['mac'], FILTER_VALIDATE_MAC)) {
	        return back()->with('errorMsg','Please enter valid mac');
		}

        $this->service->store($data);
        return redirect()->route('router.index')->with('success', 'Router added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function show(Router $router)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->service->edit($id);
        return view('router.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$data = $request->toArray();
        unset($data['_token']);
        
        $validatedData = $request->validate([
            'domain' => 'required|unique:routers,domain,'.$id,
            'loopback' => 'required|ipv4|unique:routers,loopback,'.$id,
            'mac' => 'required|unique:routers,mac,'.$id,
        ]);
        
    	$data['status'] = (isset($data['status'])) ? '1' : '0';
        
        $_check_domain = $this->is_valid_domain_name($data['domain']);
        
        if ($_check_domain == false) {
	        return back()->with('errorMsg','Please enter valid domain');
        }
        
        if(!filter_var($data['loopback'], FILTER_VALIDATE_IP)) {
	        return back()->with('errorMsg','Please enter valid loopback');
		}

		if(!filter_var($data['mac'], FILTER_VALIDATE_MAC)) {
	        return back()->with('errorMsg','Please enter valid mac');
        }
        
        $this->service->update($data, $id);
        return redirect()->route('router.index')->with('success', 'Router updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function destroy(Router $router)
    {
        //
    }

    public function getToken(Request $request){
        // dd("sd");
        $user = User::where('email', 'jd@test.com')->firstOrFail();
	    echo $user->createToken('bearer')->accessToken;
    }
}
