<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormEmail;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
  use ResponseTrait;

  public function contact(Request $request) {
    try {
      $rules = ["name" => "required", "email" => "required|email", "phone" => "nullable|numeric|min:10", "message" => "required"];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errors = $validator->errors()->all();
        return $this->validationResponse($errors);
      }

      // TODO: Send email
      return $request->all();
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
