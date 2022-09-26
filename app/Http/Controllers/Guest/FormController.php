<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormAttribute;
use App\Models\FormAttributeItem;
use App\Models\UserForm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Nette\Utils\Json;

class FormController extends Controller
{
    public function index($slug) {
        $form = Form::where('slug', $slug)->first();
        if ($form) {
            $data['attributes'] = FormAttribute::where('form_id', $form->id)->get();
            return view('open_recruitment.register', $data);
        }
        return redirect()->back();
    }

    public function save(Request $request, $form_id, $user_id) {
        $keys = FormAttribute::where('form_id', $form_id)->pluck('key');
        $vals = [];
        foreach ($keys as $k) $vals[$k] = 'required';
        $user_form = UserForm::where('form_id', $form_id)->where('user_id', $user_id)->first();

        if (!$user_form) {
            $user_form = UserForm::create([
                "form_id" => $form_id,
                "user_id" => $user_id,
                "data" => Json::encode($request->only($keys)),
            ]);
        }

        return response()->json([
            "message" => "Store success",
            "status" => 200,
            "body" => $user_form,
        ]);
    }

    public function store2(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $form = Form::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
        ]);

        return response()->json([
            "message" => "Store success",
            "status" => 200,
            "body" => $form,
        ]);
    }
}
