<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class EnquiryRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::guest();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'    => 'required',
            'email'   => 'required|email',
            'contact' => 'required',
            'message' => 'required',
            'product_id' => 'exists:products,id',
		];
	}

    public function all()
    {
        $data = parent::all();

        if(isset($data['i_am_not_human'])) abort(404);
        if($data['leave_blank'] !== '') abort(404);

        $data['name'] = ucwords(strtolower($data['name']));
        $data['email'] = strtolower($data['email']);

        return $data;
    }
}
