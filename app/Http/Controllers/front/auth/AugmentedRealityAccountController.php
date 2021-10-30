<?php


namespace App\Http\Controllers\front\auth;

use App\Http\Controllers\Controller;
use App\Models\AugmentedRealityAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Session as SessionModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AugmentedRealityAccountController extends Controller
{
    public function index()
    {
        return view("front.auth.loginAugmentedReality");
    }

    public function login(Request $request)
    {
        DB::beginTransaction();
        $userInput = AugmentedRealityAccount::where("username", $request->username)->first();
        if ($userInput) {
            $oldSession = SessionModel::where('augmented_reality_accounts_id', $userInput->id)->get(); // can multiple spesific
            if ($oldSession->count() > 0) {
                return redirect('/')->with("danger", "anda sudah login di perangkat lain, silahkan logout terlebih dahulu");
            } else {
                if (Auth::guard('augmentedRealities')->attempt(['username' => $request->username, 'password' => $request->password])) {
                    $newSession = SessionModel::create([
                        "augmented_reality_accounts_id" => Auth::guard('augmentedRealities')->user()->id,
                        "ip_address" => $this->getIp(),
                        "user_agent" => $request->header('User-Agent'),
                        "payload" => Session::getId(),

                    ]);
                    return "berhasil";
                }
            }
        } else {
            return 'Wrong Username/Password';
        }
        DB::commit();
    }

    public function logout()
    {
        $oldSession = SessionModel::where('payload', Session::getId())->first();
        // dd($oldSession);
        SessionModel::destroy($oldSession->id);
        //    dd(  Auth::guard('augmentedRealities')->user()); 
        Auth::guard('augmentedRealities')->logout();
        return redirect("/");
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
