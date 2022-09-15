<?php

namespace App\Http\Utilidades;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

class UtilidadGeneral
{
    public static function updateMenu()
    {
        $nav = Categoria::where([['visible', 1], ['visible_menu', 1], ['categoria_id', 1]])->orderBy('orden')->get()->toArray();
        foreach ($nav as &$item2) {
            $item2['children'] = Categoria::where([['visible', 1], ['visible_menu', 1], ['categoria_id', $item2['id']]])->orderBy('orden')->get()->toArray();
            $item2['have_children'] = count($item2['children']) == 0 ? 0 : 1;
            $item2['url_amigable'] = route('home.productoCategoria', ['categoria' => $item2['url_amigable']]);
            foreach ($item2['children'] as &$item3) {
                $item3['children'] = Categoria::where([['visible', 1], ['visible_menu', 1], ['categoria_id', $item3['id']]])->orderBy('orden')->get()->toArray();
                $item3['have_children'] = count($item3['children']) == 0 ? 0 : 1;
                $item3['url_amigable'] = route('home.productoCategoria', ['categoria' => $item3['url_amigable']]);
            }
        }
        
        $servicios = [
            ['nombre' => 'CCTV', 'url' => 'cctv', 'children' => [], 'have_children' => 0],
            ['nombre' => 'Credencialización', 'url' => 'credencializacion', 'children' => [], 'have_children' => 0],
            ['nombre' => 'Control de acceso', 'url' => 'control_acceso', 'children' => [], 'have_children' => 0],
            ['nombre' => 'Cableado estruturado', 'url' => 'cableado_estruturado', 'children' => [['nombre' => 'Soluciones Inalámbricas', 'url' => 'soluciones_inalambricas'],['nombre' => 'Voz y datos', 'url' => 'voz_datos']], 'have_children' => 1],
            ['nombre' => 'Desarrollo de Software', 'url' => 'desarrollo_software', 'children' => [['nombre' => 'Software a Medida', 'url' => 'software_medida'],['nombre' => 'Control Escolar', 'url' => 'control_escolar']], 'have_children' => 1],
        ];
        Cache::forever('menu', json_encode(['productos'=>$nav,'servicios'=>$servicios]));
    }
    public static function getIdsArbolCategoria($id)
    {
        $arreglo_ids=[$id];
        while (!empty($id)) {
            $idss = Categoria::where([['visible', 1],['categoria_id', $id]])->orderBy('orden')->get()->toArray();
            $id=[];
            foreach ($idss as $key => $ids) {
                $id[]=$ids['id'];
                $arreglo_ids[]=$ids['id'];
            }
        }
        return $arreglo_ids;
    }
    public static function ArbolCategoria($model,$id_activo){
        $arbol=[];
        foreach ($model->getCategoriasHijas() as $key => $hijo) {
            $arbol[$hijo->id]=['nombre'=>$hijo->nombre,'url'=>"/categorias/".$hijo->url_amigable,'class'=>$hijo->id==$id_activo? 'activo':'oculto'];
            $arbol[$hijo->id]['hijos']=self::ArbolCategoria($hijo,$id_activo);
        }
        return $arbol;
    }
    public static function getFiltros($ids_categoria,$marcas_get)
    {
        $sql="SELECT cat_filtro.clave,cat_filtro.tipo,cat_filtro.caracteristica FROM filtro_producto filtro INNER JOIN cat_filtro ON filtro.clave = cat_filtro.clave WHERE filtro.id_producto in (SELECT prod.id from producto prod INNER JOIN producto_categoria pro_cat ON prod.id=pro_cat.id_producto where pro_cat.id_categoria in(".implode(',',$ids_categoria).")".(count($marcas_get)>0?(' and prod.marca in ("'.implode('","',$marcas_get).'") '):'')." group by prod.id) GROUP BY cat_filtro.clave,cat_filtro.tipo,cat_filtro.caracteristica ORDER BY cat_filtro.tipo,cat_filtro.prioridad";
        $rows = DB::connection()->select($sql, []);
        $filtros=[];
        foreach ($rows as $key => $row) {
            $filtros[$row['tipo']][$row['clave']]=$row['caracteristica'];
        }
        return $filtros;
    }
    public static function getFiltroMarcas($ids_categoria)
    {
        $ids=implode(",", $ids_categoria);
        $sql="SELECT marca, COUNT(marca) as cantidad,REPLACE(marca,' ','') as id FROM productos prod INNER JOIN productos_categorias procat on prod.id=procat.producto_id where procat.categoria_id in ($ids) GROUP BY marca";
        $rows = DB::connection()->select($sql, []);
        
        return $rows;
    }
    public static function getFiltroCategorias($ids_categoria)
    {
        return Categoria::where([['categoria_id',$ids_categoria],['visible',1]])->orderBy('orden')->get();
    }
}
