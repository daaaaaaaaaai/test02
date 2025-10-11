<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Prefecture;

class ZipcodeController extends Controller
{
    //
    public function search($zipcode)
    {
        $zipcode = preg_replace('/[^0-9]/', '', $zipcode);

        if (!preg_match('/^\d{7}$/', $zipcode)) {
            return response()->json(['error' => '郵便番号は7桁で入力してください'], 422);
        }

        $response = Http::get("https://zipcloud.ibsnet.co.jp/api/search", [
            'zipcode' => $zipcode,
        ]);

        $data = $response->json();

        if (empty($data['results'])) {
            return response()->json(['error' => '住所が見つかりません'], 404);
        }

        $result = $data['results'][0];

        $pref = Prefecture::where('text', $result['address1'])->first();

        return response()->json([
            'prefecture' => $pref ? $pref->prefecture : null,
            'city'       => $result['address2'] ?? '',
            'address'    => $result['address3'] ?? '',
        ]);
    }
}
