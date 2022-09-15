<?php

namespace App\Http\Controllers;

use App\Http\Utilidades\UtilidadGeneral;
use App\Models\Acceso;
use App\Models\Categoria;
use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ProductosController extends Controller
{

    public function categoria($categoria)
    {

    }
    public function getBreadcrumbs($categoria)
    {
        if($categoria=='inicio'){
            $categoria=Categoria::where([['url_amigable',$categoria]])->first();
            $migajas[]=['href'=>'/','text'=>'Inicio','disabled'=>false,'id'=>'','id_arbol'=>''];
            $migajas[]=['href'=>route('home.productoCategoria', ['categoria' => 'inicio']),'text'=>'Productos','disabled'=>true,'id'=>1,'id_arbol'=>'categoria_1'];
            return json_encode(['migajas'=>$migajas,'categoria'=>$categoria]);
        }
        $categoria=Categoria::where([['url_amigable',$categoria]])->first();
        $cate=$categoria['categoriaPadre'];
        $migajas=[];
        
        $migajas[]=['href'=>route('home.productoCategoria', ['categoria' => $categoria->url_amigable]),'text'=>$categoria->nombre,'disabled'=>true,'id'=>$categoria->id,'id_arbol'=>'categoria_'.$categoria->id];
        while(isset($cate['id'])) {
            $migajas[]=['href'=>route('home.productoCategoria', ['categoria' => $cate->url_amigable]),'text'=>$cate->nombre,'disabled'=>false,'id'=>$cate->id,'id_arbol'=>'categoria_'.$cate->id];
        }
        $migajas[]=['href'=>route('home.productoCategoria', ['categoria' => 'inicio']),'text'=>'Productos','disabled'=>false,'id'=>1,'id_arbol'=>'categoria_1'];
        $migajas[]=['href'=>'/','text'=>'Inicio','disabled'=>false,'id'=>'','id_arbol'=>''];
        return json_encode(['migajas'=>array_reverse($migajas),'categoria'=>$categoria]);
    }
    public function getFiltros($categoria)
    {
        $categoria=Categoria::where([['url_amigable',$categoria]])->first();
        $arbol=UtilidadGeneral::ArbolCategoria(Categoria::find(1),$categoria->id);
        $ids_categ=UtilidadGeneral::getIdsArbolCategoria($categoria->id);
        $marcas=UtilidadGeneral::getFiltroMarcas($ids_categ);
        
        return json_encode(['arbol'=>$arbol,'filtros_categorias'=>$categoria->getCategoriasHijasProductos(),'marcas'=>$marcas]);
    }
    public function getProductos()
    {
        $categoria=Categoria::where([['url_amigable',$_POST['categoria']]])->first();
        $ids_categ=UtilidadGeneral::getIdsArbolCategoria($categoria->id);
        $productos=Producto::join('productos_categorias', 'productos_categorias.producto_id', '=', 'productos.id')
        ->leftJoin('imagenes_productos', function($join)
            {
                $join->on('imagenes_productos.producto_id', '=', 'productos.id');
                $join->on('imagenes_productos.posicion', '=', DB::raw('1'));
            })
        ->select('productos.id','nombre','url_amigable',DB::raw("coalesce(directorio,'') as directorio"))
        ->whereIn('productos_categorias.categoria_id', $ids_categ);
        if(!empty($_POST['filCategorias'])){
            $productos=$productos->whereIn('productos_categorias.categoria_id',explode(",", $_POST['filCategorias']));
        }
        if(!empty($_POST['filMarcas'])){
            $productos=$productos->whereIn('productos.marca',explode(",", $_POST['filMarcas']));
        }
        /*
        if(!empty($_POST['filCaracteristicas'])){
            $productos=$productos->whereIn('',explode(",", $_POST['filCaracteristicas']));
        }
        */
        $productos=$productos->groupBy(['productos.id','productos.nombre','productos.url_amigable','imagenes_productos.directorio'])->get()->toArray();
        return json_encode($productos);
    }
}
