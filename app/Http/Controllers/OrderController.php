<?php
namespace App\Http\Controllers;

use App\Models\Order; // ✅ Import du modèle
use App\Models\Product;
use App\Http\Requests\ProductRequest; 
use App\Http\Requests\OrderRequest; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Wilaya;
use App\Models\Commune;
class OrderController extends Controller
{
    
public function index(Request $request)
{
    if(session('role')=='admin'){
    $search = $request->input('search');

    if ($search != null && $search != "") {
        // Utiliser Eloquent ici, avec la relation chargée
        $orders = Order::with('produits')
                    ->where('phone', $search)
                    ->paginate(10); 
                    // ou ->get() si tu ne veux pas de pagination
         $count=DB::table('orders')->where('phone','=',$search)->count();

        return view('orders.index', compact('orders','count'));
    }

    $orders = Order::with('produits')->latest()->paginate(10);
     $count=DB::table('orders')->count();
    return view('orders.index', compact('orders','count'));
}
 return redirect()->route('produits.index');


}




    /**
     * Show the form for creating a new resource.
     */
public function create(Request $request)
{  
   
    // Récupérer l'ID du produit envoyé par l'URL
    $product = Product::findOrFail($request->query('product_id'));
     $wilayas = Wilaya::all();
      $communes = Commune::all();

    
    return view('orders.create', compact('product','wilayas','communes'));
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    
    // 1. On valide les données du formulaire
        $data = $request->validate([
        'nom'        => 'required|string|max:255',
        'prenom'     => 'required|string|max:255',
        'phone'      =>'required',
        'wilaya'     => 'required|string',
        'ville'      => 'required|string',
        'adresse'    => 'required|string',
        'status'     => 'nullable|string',
        'total'      => 'required|numeric',
        'product_id' => 'required|exists:products,id',
        'quantite'   => 'required|integer|min:1',
    ]);
    // 2. On crée la commande (sans les données de produit)
    $order = Order::create([
        'nom'     => $data['nom'],
        'prenom'  => $data['prenom'],
        'phone'   => $data['phone'],
        'total'   => $data['total'],
        'wilaya'  => $data['wilaya'],
        'ville'   => $data['ville'],
         'methode_livraison' => $data['methode_livraison'] ?? 'domicile',
        'adresse' => $data['adresse'],
        'status'  => $data['status'] ?? 'en attente',
    ]);
 ;
    // 3. On ajoute le produit dans la table pivot avec la quantité
    $order->produits()->attach($data['product_id'], [
        'quantite' => $data['quantite'],
    ]);

    return redirect()->route('produits.index')->with('success', 'Commande enregistrée avec succès.');
}


    /**
     * Display the specified resource.
     */
public function show(Order $order)
{       if(session('role')=='admin'){
   
   
   
    return view('orders.show', compact('order'));
       }

 return redirect()->route('produits.index');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        if(session('role')=='admin'){

    $product=$order->produits()->first();
    $products=Product::all();
     $wilayas = Wilaya::all();
      $communes = Commune::all();

   
      return view('orders.edit',compact('order','product','products','wilayas','communes'));  
    }

 return redirect()->route('produits.index');

}

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    { 
        if(session('role')=='admin'){
    $form=$request->validated();
       
        $order->update($form);
         $order->produits()->sync([
            $form['product_id'] => ['quantite' => $form['quantite']]
        ]);
         return redirect()->route('orders.show',compact('order'))->with('updated','Commande mis à jour avec succès.');
    }
     return redirect()->route('produits.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if(session('role')=='admin'){
        $order->delete();
          return redirect()->route('orders.index')->with('destroyed', 'La commande a été bien supprimée.');

        }
         return redirect()->route('produits.index');

    }
}
