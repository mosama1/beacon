<?php namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Beacon\Promotion;
use Beacon\CouponPromotion;
use Beacon\Location;

use Image as Img;

class CouponPromotionsController extends Controller
{
	/**
	 * Display a form for consult a coupon.
	 *
	 * @return a view
	 */
	public function index()
	{		
		return view( 'promotions.verify_coupon' ) ;
	}


	/****
	 * Verify a code in location (verification code)
	 *
	 * @param  $request
	 * @return Response
	 */
	public function check_code_location(Request $request)
	{
		// Validación de los datos		
		//
		try {

			// no puede estra en blanco
			if ( empty( $request->verification_code ) )
			{
				throw new \Exception('Indique el códido de verificación.');
			}

			// debe ser solo números
			if ( !is_numeric( $request->verification_code ) )
			{
				throw new \Exception('Error al indicar el código de verificación.');
			}

			// debe poseer un ancho fijo de 4 dìgitos
			if ( strlen( $request->verification_code ) != 4 )
			{
				throw new \Exception('El código de verificación no posee el número de caracteres esperado.');
			}

			$code_location = Location::where([
						['verification_code', '=', $request->verification_code]
					])->get();

			if ( $code_location->count() > 0)
			{
				return response()->json(['code' => 1, 'message' => '' ]);
			}
			else
			{
				throw new \Exception('El código de verificación no está registrado.');
			}

		} catch (\Exception $e) {

			return response()->json(['code' => 0, 'message' => $e->getMessage() ]);
		}
	}


	/****
	 * Verify a code in location (verification code)
	 *
	 * @param  $request
	 * @return Response
	 */
	public function check_code_coupon(Request $request)
	{
		// Validación de los datos		
		//
		try {
			// no puede estra en blanco
			if ( empty( $request->coupon_code ) )
			{
				throw new \Exception('Indique el códido del cupón.');
			}

			// debe poseer un ancho fijo de 10 dìgitos
			if ( strlen( $request->coupon_code ) != 10 )
			{
				throw new \Exception('El código del cupón no posee el número de caracteres esperado.');
			}

			$coupon_promotion = CouponPromotion::where([
						['code_coupon', '=', $request->coupon_code]
					])->first();

			
			if ( $coupon_promotion )
			{

				$expiration_date = strtotime( '+30 minutes', strtotime( $coupon_promotion->created_at ) );
				$expiration_date = date( 'Y-m-d H:i:s', $expiration_date );

				$date_expired = New \DateTime( $expiration_date );
				$today = New \DateTime( 'now' );
				$dteDiff  = $date_expired->diff($today);				

				if ( $dteDiff->y > 0  || $dteDiff->m > 0 || $dteDiff->d > 0 ) // el cupón fué generado hace más de un día
				{
					
					throw new \Exception( 'Cupón vencido, ya no es válido para ser canjeado.' );
				}
				else
				{
					// vefirico si aún tiene de vigencia
					if (  $dteDiff->d < 1 && $dteDiff->h > 0   )
					{

						$hora = $dteDiff->h > 1 ? 'horas.' : 'hora.';
						throw new \Exception( 'El cupón venció ya hace ' . $dteDiff->h . ' ' . $hora );
					}
				}

				return response()->json(['code' => 1 , 'message' => $coupon_promotion->toJson() ]);
			}
			else
			{

				throw new \Exception('El cupón indicado no está registrado.');
			}
		} catch (\Exception $e) {

			return response()->json(['code' => 0, 'message' => $e->getMessage() ]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request )
	{
		$coupon_promotion = CouponPromotion::where([
					['code_coupon', '=', $request->coupon_code ],
				])->first();		
		
		if ( $coupon_promotion )
		{
			$coupon_promotion->used_coupon = 1;
			$coupon_promotion->save();

			return redirect()->route('index_coupon_promotions')->with(['message' => 'Cupón canjeado correctamente.', 'type' => 'success']);
		}
		else
		{

			return redirect()->route('index_coupon_promotions')->with(['message' => 'El cupón no pudo ser canjeado.', 'type' => 'error']);
		}
	}
}
