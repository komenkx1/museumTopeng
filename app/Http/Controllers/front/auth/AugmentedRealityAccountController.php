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
    public function login(Request $request)
    {
        // DB::beginTransaction();

        if (Auth::guard('augmentedRealities')->attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::guard('augmentedRealities')->check()) {
                $oldSession = SessionModel::where('augmented_reality_accounts_id', Auth::guard('augmentedRealities')->user()->id)->count(); // can multiple spesific 
                if ($oldSession > 0) {
                    Auth::guard('augmentedRealities')->logout();
                    return redirect("/")->with('info', 'Your Account Is Logged In Another Device! Please Logout To Login On This Device');
                } else {
                    $newSession = SessionModel::create([
                        "augmented_reality_accounts_id" => Auth::guard('augmentedRealities')->user()->id,
                        "ip_address" => $this->getIp(),
                        "user_agent" => $request->header('User-Agent'),
                        "payload" => Session::getId(),
                    ]);
                }
            }

            return redirect()->route("ArReader");
        } else {
            return redirect("/")->with('info', 'Wrong Username or Password!');
        }
    }

    public function logout(Request $request)
    {
        // dd( Session::getId());
        $oldSession = SessionModel::where('augmented_reality_accounts_id',  Auth::guard('augmentedRealities')->user()->id)->first(); // destroy session on db (sementara pake ini dulu)
        // dd($oldSession);
        SessionModel::destroy($oldSession->id);
        //    dd(  Auth::guard('augmentedRealities')->user()); 
        Auth::guard('augmentedRealities')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect("/");
    }

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
