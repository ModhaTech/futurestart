<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactUs;
use App\Models\Metatags;
use App\Traits\MailsendTrait;
use Session;
use Illuminate\Http\Request;

class ContactUsController extends ApiController
{

	public function contactUs(Request $request){
		try{
			$rules = array(
                'name' => ['required','string', 'max:50'],
                'phone' => ['required','numeric'],
                'email' => ['required'],
                'message' => ['required']
	        );

	        $validator = Validator::make($request->all(), $rules);
	        if ($validator->fails()) {
	            return $this->respondValidationError('Fields Validation Failed.', $validator);
	        }

	        $Contactus = new ContactUs();
            $Contactus->name = $request['name'];
            $Contactus->phone = $request['phone'];
            $Contactus->email = $request['email'];
            $Contactus->message = $request['message'];
            $Contactus->save();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Data Submitted Successfully',
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}

}