<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends Request {

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
        return [
            'design_no' => 'required',
            'name' => 'required',
            'description' => 'required',
            'images' => 'required'
        ];
    }

    public function all()
    {
        $data = parent::all();
        $data['name'] = ucwords(strtolower($data['name']));
        $data['fabric'] = ucwords(strtolower($data['fabric']));
        $data['sizes'] = strtoupper($data['sizes']);
        $data['length'] = ucwords(strtolower($data['length']));
        $data['neckline'] = ucwords(strtolower($data['neckline']));
        $data['rinse_care'] = ucwords(strtolower($data['rinse_care']));
        $data['description'] = preg_replace_callback('/([.!?])\s*(\w)/', function ($matches) {
            return strtoupper($matches[1] . ' ' . $matches[2]);
        }, ucfirst(strtolower($data['description'])));

        return $data;
    }

}
