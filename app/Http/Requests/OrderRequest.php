<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::user();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'billing_email' => 'email',
		];

        foreach($this->request->get('products') as $key => $val) {
            $rules['products.'.$key] = 'required|exists:products,id';
            $rules['unit_prices.'.$key] = 'required|numeric|min:0';
            $rules['quantities.'.$key] = 'required|numeric|min:1';
        }

        return $rules;
    }

    public function all()
    {
        $data = parent::all();
        $data['billing_name'] = ucwords(strtolower($data['billing_name']));
        return $data;
    }

}
