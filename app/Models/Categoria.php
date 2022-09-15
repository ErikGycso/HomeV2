<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function getCategoriaPadre()
    {
        return Categoria::find($this->categoria_id);
    }
    
    public function getCategoriasHijas()
    {
        return Categoria::where([['categoria_id',$this->id],['visible',1]])->orderBy('orden')->get();
    }
    public function getCategoriasHijasProductos()
    {
        return Categoria::select('categorias.*')->join('productos_categorias', 'productos_categorias.categoria_id', '=', 'categorias.id')->join('productos', 'productos_categorias.producto_id', '=', 'productos.id')->where([['categorias.categoria_id',$this->id],['categorias.visible',1],['productos.visible',1]])->orderBy('orden')->get();
    }
    public function getCategoriasHijasMenu()
    {
        return Categoria::where([['categoria_id',$this->id],['visible',1],['visible_menu',1]])->orderBy('orden')->get();
    }
}
