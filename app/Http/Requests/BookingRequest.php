<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $date = str_replace(' ', '', $this->date);
        $date = Carbon::parse($date)->format('Y-m-d');
        return [
            'date' => 'required|date_format:d. m. Y',
            'time' => [
                'required', 'array', 'max:15',
                Rule::unique('bookings')->where('date', $date)
            ],
            'time.*' => 'required|distinct|date_format:H:i',
        ];
    }

    public function messages()
    {
        $date = str_replace(' ', '', $this->date);
        $date = Carbon::parse($date)->format('d. m. Y');
        if ( is_array($this->time) ) {
            foreach ( $this->time as $time);
        }
        $time = isset($time) ? $time : "";
        return [
            'time.unique' => 'Termín ' . $date . ' ' . $time  . ' už existuje!',
            'time.*.distinct' => 'Termín ' . $date . ' ' . $time . ' je duplicitný!',
            'time.max' => 'Čas nesmie obsahovať viac ako :max poožiek!',
            'time.*.required' => 'Všetky polia sú povinné!',
        ];
    }
}
