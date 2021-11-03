<?php

namespace App\Models;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public const ORDERCODE = 'COD';
    public const TYPE_ADMIN = 'COD';
    public const TYPE_USER = 'COD';

    public function guest()
    {
    	return $this->belongsTo(Guest::class,"id_guest");
    }

    public function package()
    {
    	return $this->belongsTo(Package::class,"id_package");
    }

    public static function generateCodCode()
	{
		$dateCode = self::ORDERCODE . '-' . date('Ymd') . '-' .General::integerToRoman(date('m')). '-' .General::integerToRoman(date('d')). '-' . strtoupper(substr(md5(uniqid(rand(1,6))), 0, 6)) . '-';

		$lastOrder = self::select([DB::raw('MAX(transactions.session_ID) AS last_code')])
			->where('session_ID', 'like', $dateCode . '%')
			->first();
            // dd($lastOrder);

		$lastOrderCode = !empty($lastOrder) ? $lastOrder['last_code'] : null;
		
		$orderCode = $dateCode . rand();
		if ($lastOrderCode) {
			$lastOrderNumber = str_replace($dateCode, '', $lastOrderCode);
			$nextOrderNumber = sprintf('%05d', (int)$lastOrderNumber + 1);
			
			$orderCode = $dateCode . $nextOrderNumber;
		}

		if (self::_isOrderCodeExists($orderCode)) {
			return generateOrderCode();
		}

		return $orderCode;
	}

    private static function _isOrderCodeExists($orderCode)
	{
		return Transaction::where('session_ID', '=', $orderCode)->exists();
	}
}
