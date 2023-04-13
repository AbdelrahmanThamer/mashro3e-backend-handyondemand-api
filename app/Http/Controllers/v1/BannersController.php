<?php
/*
  Authors : initappz (Rahul Jograna)
  Website : https://initappz.com/
  App Name : Handy Service Full App Flutter
  This App Template Source code is licensed as per the
  terms found in the Website https://initappz.com/license
  Copyright and Good Faith Purchasers © 2022-present initappz.
*/
namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banners;
use App\Models\Products;
use App\Models\Category;
use App\Models\Freelancer;
use App\Models\Cities;
use Validator;
use DB;
class BannersController extends Controller
{
    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'city_id' => 'required',
            'cover' => 'required',
            'type' => 'required',
            'value' => 'required',
            'from' => 'required',
            'to' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
                'status'=> 500
            ];
            return response()->json($response, 404);
        }

        $data = Banners::create($request->all());
        if (is_null($data)) {
            $response = [
            'data'=>$data,
            'message' => 'error',
            'status' => 500,
        ];
        return response()->json($response, 200);
        }
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getById(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
                'status'=> 500
            ];
            return response()->json($response, 404);
        }

        $data = Banners::find($request->id);

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
                'status'=> 500
            ];
            return response()->json($response, 404);
        }
        $data = Banners::find($request->id)->update($request->all());

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function delete(Request $request){
     $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
                'status'=> 500
            ];
            return response()->json($response, 404);
        }
        $data = Banners::find($request->id);
        if ($data) {
            $data->delete();
            $response = [
                'data'=>$data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'success' => false,
            'message' => 'Data not found.',
            'status' => 404
        ];
        return response()->json($response, 404);
    }


    public function getMoreData(Request $request){
        $response = [
            'categories'=>Category::all(),
            'freelancer'=>Freelancer::where('type','freelancer')->get(),
            'cities'=>Cities::all(),
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getAll(){
        $data = DB::table('banners')
        ->select('banners.id as id','banners.city_id as city_id','banners.cover as cover','banners.type as type','banners.value as value','banners.title as title',
        'banners.from as from','banners.to as to','banners.status as status','banners.extra_field as extra_field','cities.name as city_name')
        ->join('cities','banners.city_id','cities.id')
        ->get();
        foreach($data as $loop){

            if($loop->type == 0){
                $loop->cateInfo = Category::find($loop->value);
            }

            if($loop && $loop->type && $loop->type !=null && $loop->type == 1){
                $loop->individualInfo = Freelancer::where('id',$loop->value)->first();
            }

        }
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }


    public function getInfoById(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
                'status'=> 500
            ];
            return response()->json($response, 404);
        }


        $data = Banners::find($request->id);

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        if($data->type == 2 || $data->type == '2'){
            $data['freelancerInfo'] = Freelancer::select('id','name','uid')->where('uid',$data->value)->get();
        }
        if($data->type == 3 || $data->type == '3'){
            $ids = explode(',',$data->value);
            $data['freelancerInfo'] = Freelancer::select('id','name','uid')->WhereIn('uid',$ids)->get();
        }

        if($data->type == 6 || $data->type == '6'){
            $ids = explode(',',$data->value);
            $data['productInfo'] = Products::select('id','name')->WhereIn('id',$ids)->get();
        }

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }
}
