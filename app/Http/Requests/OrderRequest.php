<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'phone' => 'required|digits_between:9,10',
        'adresse' => 'required|string|max:255',
        'ville' => 'required|string|max:100',
        'wilaya' => 'required|string|max:100',
        'methode_livraison' => 'required|string',
        'status' => 'required|in:en attente,expédiée,livrée,annulée',
        'product_id' => 'required|exists:products,id',
        'quantite' => 'required|integer|min:1',
         'total' => 'required |nullable|numeric',
        'Livraison' => 'required |nullable|numeric'

        ];
    }
}
