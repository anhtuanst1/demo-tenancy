<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stancl\Tenancy\Tenant;

class TenantController extends Controller
{
	public function viewCreateTenant()
	{
		$slug = 'tenant';

		return view('tenant.create', compact(
            'slug'
        ));
	}

	public function createTenant(Request $request)
	{
		$domain = $request->domain . '.' . env('ROOT_DOMAIN');
		if (Tenant::new()->withDomains([$domain])->save()) {
			$response = [
	            'message'       => 'Create successfully!',
	            'alert-type'    => 'success'
	        ];

			return redirect()->route('viewCreateTenant')->with($response);
		} else {
			$response = [
	            'message'       => 'Create Fail.',
	            'alert-type'    => 'error'
	        ];

			return redirect()->back()->withInput()->with($response);
		}
	}
}
