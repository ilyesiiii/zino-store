<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Wilaya;
use App\Models\Commune;
use App\Http\Requests\ProductRequest; // Corrected the class name from ProductReqeust to ProductRequest
class ProductController extends Controller
{
     public function index(Request $request){
         $wilayas = Wilaya::all();
           
           $search=$request->input('search');
           if($search !=Null && $search !=''){
              $produits=DB::table('products')->where('nom','like',$search.'%')->paginate(10);
              $count=DB::table('products')->where('nom','like',$search.'%')->count();     
              return  view('produits.index',compact('produits','count'));
           }
 
        $count=0;  
         $produits=Product::paginate(10);
        
         return  view('produits.index',compact('produits','count'));
     }
   public function destroy($id)
{
    // 🔍 1. Récupérer le produit à supprimer
    $product = Product::findOrFail($id);

    // 🔁 2. Parcourir toutes les commandes qui contiennent ce produit
    foreach ($product->orders as $order) {

        // 📊 3. Compter combien de produits contient cette commande
        $productCount = $order->produits()->count();

        if ($productCount === 1) {
            // ✅ Si la commande contient seulement CE produit
            // 🗑️ On peut supprimer toute la commande
            $order->delete();
        } else {
            // ❌ Sinon, la commande contient plusieurs produits
            // 🔗 On détache seulement le produit actuel
            $order->produits()->detach($product->id);
        }
    }

    // 🗑️ 4. Supprimer le produit
    $product->delete();

    // ✅ 5. Redirection avec message
    return redirect()->route('produits.index')
        ->with('destroyed', 'Le produit et ses commandes associées ont été supprimés.');
}

     public function create(){
        if(session('role')=='admin'){

        
         return view('produits.create');}
          return redirect()->route('produits.index');

     }
     public function store(ProductRequest $request){
        if(session('role')=='admin'){
         $form=$request->validated();
         $imgpath=$request->file('image')->store('products','public');
         $form['image']=$imgpath;
           Product::create($form);
           return redirect()->route('produits.index')->with('success','le produit est bien ajoute');
        }
         return redirect()->route('produits.index');

     }
     public function show($id){
         $product=Product::FindOrFail($id);
         $count=$product->stock;
            return view('produits.show',compact('product','count'));
     }
     public function edit($id){
     
        if(session('role')=='admin'){
         $product=Product::FindOrFail($id);
         
         return view('produits.edit',compact('product'));
     }
      return redirect()->route('produits.index');
    }

public function update(ProductRequest $request, Product $produit)

{
  
    
    // Vérifier que l'utilisateur est administrateur
    if (session('role') === 'admin') {

        // Valider les données du formulaire
        $form = $request->validated();
         
        // Si une nouvelle image est uploadée
        if ($request->hasFile('image')) {
               
            // Stocker la nouvelle image dans le disque "public" dans le dossier "products"
            $form['image'] =$request->file('image')->store('products','public');
            
        }

        // Mettre à jour le produit avec les données validées
        $produit->update($form);

        // Redirection avec message de succès
        return redirect()->route('produits.index')->with('updated', 'Produit mis à jour avec succès.');
    }

    // Si l'utilisateur n'est pas admin, le rediriger sans mise à jour
    return redirect()->route('produits.index')->with('error', 'Accès non autorisé.');
}


   }

