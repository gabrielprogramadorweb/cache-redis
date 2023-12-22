<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProdutoControlador extends Controller
{
    function index()
    {
        // Função para armazenar dados em cache através do Redis
        $expiracao = 1; // minutos
        $produtos = Cache::remember('todososprodutos', $expiracao, function () {
            return Produto::with('categorias')->get();
        });

        return view('produtos', compact('produtos'));
    }
}
