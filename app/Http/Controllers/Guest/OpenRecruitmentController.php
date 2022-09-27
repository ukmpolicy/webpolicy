<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Setting;
use App\Models\UserForm;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class OpenRecruitmentController extends Controller
{

    private $data = [
        "nim" => "",
        "nama" => "",
        "alamat" => "",
        "tgl_lahir" => "",
        "tmp_lahir" => "",
        "no_wa" => "",
        "email" => "",
        "jurusan" => "",
        "prodi" => "",
        "pas_foto" => "",
        "bkpkkmb" => "",
        // "bukti_pemabayaran" => "",
        "bukti_follow" => "",
        "kuisioner" => "",
    ];

    public function index() {
        $data['isOpen'] = $this->isOpen();
        return view('guest.pages.open_recruitment.index', $data);
    }

    public function isOpen() {
        $settings = [];
        foreach (Setting::all() as $s) {
            $settings[$s->key] = $s->value;
        }
        date_default_timezone_set('Asia/Jakarta');
        $start = strtotime($settings['or_setting_start']);
        $end = strtotime($settings['or_setting_end']);

        // dd(date('d-m-Y H:i:s', time()), date('d-m-Y H:i:s', $start), date('d-m-Y H:i:s', $end));
        $status = $settings['or_setting_status'];
        $open = false;
        if ($status == 0) {
            $open = (time() >= $start && time() <= $end);
        }elseif ($status == 1) {
            $open = true;
        }elseif ($status == 2){
            $open = false;
        }
        return $open;
    }

    public function form() {
        if (!$this->isOpen()) {
            return redirect()->route('open-recruitment.index');
        }
        $form = Form::where('slug', 'open-recruitment')->first();
        if (!$form) $form = Form::create(['name' => 'open recruitment', 'slug' => 'open-recruitment']);

        $user_id = auth()->user()->id;
        $uf = UserForm::where('form_id', $form->id)->where('user_id', $user_id)->first();
        $data = $this->data;

        if ($uf) {
            $data = json_decode($uf->data, true);
        }

        $data['data'] = $data;

        return view('guest.pages.open_recruitment.form', $data);
    }

    public function save(Request $request) {
        if (!$this->isOpen()) {
            return redirect()->route('open-recruitment.index');
        }
        $this->validate($request, [
            "nim" => "required|numeric",
            "nama" => "required|min:3",
            "alamat" => "required",
            "tgl_lahir" => "required",
            "tmp_lahir" => "required",
            "no_wa" => "required",
            "email" => "required",
            "jurusan" => "required",
            "prodi" => "required",
            "pas_foto" => ["image", $this->imageRequired($request, "pas_foto")],
            "bkpkkmb" => ["image", $this->imageRequired($request, "bkpkkmb")],
            // "bukti_pemabayaran" => ["image", $this->imageRequired($request, "bukti_pemabayaran")],
            "bukti_follow" => ["image", $this->imageRequired($request, "bukti_follow")],
            "kusioner" => "image",
        ]);

        if ($request->has('print')) {
            return $this->print();
        }

        $form = Form::where('slug', 'open-recruitment')->first();
        $user_id = auth()->user()->id;

        $uf = UserForm::where('form_id', $form->id)->where('user_id', $user_id)->first();
        
        $data = $this->data;
        if (!$uf) {
            $uf = UserForm::create([
                "form_id" => $form->id,
                "user_id" => $user_id,
                "data" => json_encode($data),
            ]);
        }
        $baseData = json_decode($uf->data, true);
        
        $data = [
            "nim" => $this->getValue('nim', $request, $baseData),
            "nama" => $this->getValue('nama', $request, $baseData),
            "alamat" => $this->getValue('alamat', $request, $baseData),
            "tgl_lahir" => $this->getValue('tgl_lahir', $request, $baseData),
            "tmp_lahir" => $this->getValue('tmp_lahir', $request, $baseData),
            "no_wa" => $this->getValue('no_wa', $request, $baseData),
            "email" => $this->getValue('email', $request, $baseData),
            "jurusan" => $this->getValue('jurusan', $request, $baseData),
            "prodi" => $this->getValue('prodi', $request, $baseData),
            "pas_foto" => $this->uploadImage('pas_foto', $request, $baseData),
            "bkpkkmb" => $this->uploadImage('bkpkkmb', $request, $baseData),
            "bukti_follow" => $this->uploadImage('bukti_follow', $request, $baseData),
            "kuisioner" => $this->uploadImage('kuisioner', $request, $baseData),
        ];

        $uf->data = json_encode($data);
        $uf->save();
        
        return redirect()->route('open-recruitment.form')->with('success', 'Perubahan berhasil di simpan');
    }

    private function getValue($key, $request, $data) {
        if ($request->post($key)) {
            return $request->post($key);
        }
        return $data[$key];
    }

    private function uploadImage($key, $request, $data) {
        $file = $request->file($key);
        $dir = "uploads/";
        $filename = $data[$key];

        if ($file) {
            
            if (strlen(trim($filename)) > 0) {
                if (file_exists(public_path($dir.$filename))) {
                    unlink(public_path($dir.$filename));
                }
            }

            $filename = time() . rand(0,99999).'.'.$file->getClientOriginalExtension();
            $file->move($dir, $filename);
        }
        return $filename;
    }

    private function imageRequired($request, $attribute) {
        if (!$request->file($attribute)) {
            if (trim(strlen($request->all()[$attribute . '-value'])) == 0) {
                return 'required';
            }
        }
        return '';
    }

    private function print() {
        if (!$this->isOpen()) {
            return redirect()->route('open-recruitment.index');
        }
        $form = Form::where('slug', 'open-recruitment')->first();
        $user_id = auth()->user()->id;
        $uf = UserForm::where('form_id', $form->id)->where('user_id', $user_id)->first();
        $dt = json_decode($uf->data);
        $data['data'] = $this->data;
        if ($dt) {
            foreach ($dt as $k => $v) $data['data'][$k] = $v;
        }
        setlocale(LC_ALL, 'IND');
        $data['date'] = strftime('%d %B %Y');
        return view('guest.pages.open_recruitment.proof', $data);
    }

    public function manager(Request $request) {
        $members = $this->getMembers($request);
        // dd($members);
        $page = 1;
        $perPage = 10;
        $maxPage = ceil($members->count()/$perPage);
        $data['members'] = $members;
        $data['page'] = $page;
        $data['perPage'] = $perPage;
        $data['maxPage'] = $maxPage;
        return view('admin.pages.or_manager.index', $data);
    }
    

    public function getMembers(Request $request) {
        $form = Form::where('slug', 'open-recruitment')->first();

        $attendees = UserForm::where('form_id', ($form) ? $form->id : -1)->get();

        foreach ($attendees as $i => $attendee) {
            $contains = false;
            foreach (json_decode($attendee->data) as $k => $v) {
                $attendee->$k = $v;
                if ($request->search) 
                {
                    $res = strpos(strtolower($v), strtolower(trim($request->search)));
                    if ($res !== false) {
                        $contains = true;
                    }
                }
            }
            if (!$contains && $request->search) {
                unset($attendees[$i]);
            }
        }

        return $attendees;
    }
    
    public static function initSettings() {
        $data = [
            "or_setting_status" => 0,
            "or_setting_start" => time(),
            "or_setting_end" => time(),
        ];

        foreach ($data as $k => $v) {
            if (!Setting::where('key', $k)->first()) {
                $s = new Setting();
                $s->key = $k;
                $s->value = $v;
                $s->save();
            }
        }
    }
    
    public function viewSettings() {
        self::initSettings();
        $data = [];
        foreach (Setting::all() as $s) {
            $data[$s->key] = $s->value;
        }
        return view('admin.pages.or_manager.settings', $data);
    }

    public function saveSettings(Request $request) {
        $this->validate($request, [
            'or_setting_status' => 'required',
            'or_setting_start' => 'required',
            'or_setting_end' => 'required',
        ]);

        $s = Setting::where('key', 'or_setting_status')->first();
        $this->setSetting('or_setting_status', $request->or_setting_status);
        $this->setSetting('or_setting_start', date('d-m-Y H:i:s', strtotime($request->or_setting_start)));
        $this->setSetting('or_setting_end', date('d-m-Y  H:i:s', strtotime($request->or_setting_end)));

        return redirect()->back()->with('success', 'Perubahan berhasil disimpan');
    }

    private function setSetting($k, $v) {
        $s = Setting::where('key', $k)->first();
        $s->value = $v;
        $s->save();
    }

    public function download(Request $request) {
        $request->search = '';
        $data['members'] = $this->getMembers($request);
        return view('admin.pages.or_manager.download', $data);
    }
}
