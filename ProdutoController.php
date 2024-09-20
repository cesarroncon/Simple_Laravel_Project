<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

use Illuminate\Support\Str;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::paginate(5);
        $categorias = Categoria::all();

        return view('admin.produtos',compact('produtos','categorias'));

        //return "index";
        //$produtos = Produto::paginate(3);
        //return view('site.home', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produto = $request->all();

        if($request->imagem){
            $produto['imagem'] = $request->imagem->store('produtos');
        }

        $produto['slug'] = Str::slug($request->nome);

        $produto = Produto::create($produto);

        return redirect()->route('admin.produtos')->with('success','Produto criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        // Valida os dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagem opcional com restrições
            'id_categoria' => 'required|exists:categorias,id', // Verifica se o ID da categoria existe na tabela 'categorias'
        ]);
        
        // Encontra o produto
        $produto = Produto::findOrFail($request->id);

        //verificar se tem imagem
        if($request->imagem){
            $produto['imagem'] = $request->imagem->store('produtos');
        }

        //construir slug com nome
        $slug = Str::slug($request->nome);

        // Atualiza os campos
        $produto->id = $request->id;
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->descricao = $request->descricao;
        $produto->slug = $slug;
        $produto->id_categoria = $request->id_categoria;

        // Atualiza a imagem se houver um novo upload
        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('produtos', 'public');
            $produto->imagem = $imagePath;
        }

        // Salva as mudanças no banco de dados
        $produto->save();

        return redirect()->route('admin.produtos')->with('success','Produto atualizado com sucesso');
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) 
    {
        // Encontrar o produto pelo ID
        $produto = Produto::find($request->id);
        
        // Verificar se o produto existe antes de tentar deletá-lo
        if ($produto) {
            $produto->delete(); // Exclui o produto
            return redirect()->route('admin.produtos')->with('success', 'Produto apagado com sucesso!');
        }

        // Se o produto não for encontrado
        return redirect()->route('site.home')->with('error', 'Produto não encontrado.');
    }
}
