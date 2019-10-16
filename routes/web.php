<?php


Route::get('/', function () {
    return view('adminlte::auth.login');
});
Route::group(['middleware' => 'auth'], function () {
        /**Principal */
        Route::post('/Home/traedepar','HomeController@traerdepartamentos');
        Route::post('/Home/traerdependencias','HomeController@traerdependencias');
        Route::post('/Home/traerequipos','HomeController@traerequipos');   
        Route::post('/Home/equipos','HomeController@equipos'); 
        Route::post('/Home/mantenimientos','HomeController@mantenimientos');
        /**Componentes */
        Route::post('/Home/componentes','HomeController@componentes');
        Route::post('/Home/traecomponente','HomeController@traecomponentes');
        Route::post('/Home/guardarcomponente','HomeController@guardarcomponente');
        Route::post('/Home/eliminarcomponente','HomeController@eliminarcomponente');
        Route::post('/Home/editarcomponente','HomeController@editarcomponente');
        Route::post('/Home/actualizarcomponente','HomeController@actualizarcomponente');

        /**Mantenimientos */
        Route::post('/Home/detmantenimientos','HomeController@detmantenimientos');
        Route::post('/Home/guardardetmante','HomeController@guardardetmante');
        Route::post('/Home/infomantenimiento','HomeController@infomantenimiento');
        Route::get('/Home/infomantepdf/{id}','HomeController@infomantepdf');


        /**fin componentes */
        Route::post('/Home/traeprogramas','HomeController@traeprogramas');
        Route::post('/Home/traeversiones','HomeController@traeversiones');
        Route::post('/Home/guardarprogequi','HomeController@softwarexequipo');
        Route::post('/Home/guardarprogequiactu','HomeController@actualizarpro');
        Route::post('/Home/editarpro','HomeController@editarpro');
        Route::post('/Home/eliminarpro','HomeController@eliminarpro');
        /* Hoja de vida*/
        Route::post('/Home/hojavi','HomeController@hojavida');
        Route::get('/Home/hojavireporte/{id}','HomeController@hojavidareporte');

        

        /**Departamentos */
        Route::get('/Departamentos','DepartamentosController@index');
        Route::post('/Departamentos/guardar','DepartamentosController@guardar');
        Route::post('/Departamentos/editar','DepartamentosController@editar');
        Route::post('/Departamentos/actualizar','DepartamentosController@actualizar');
        Route::post('/Departamentos/eliminar','DepartamentosController@eliminar');
        /**Dependencias */
        Route::get('/Dependencias','DependenciasController@index');
        Route::post('/Dependencias/guardar','DependenciasController@guardar');
        Route::post('/Dependencias/editar','DependenciasController@editar');
        Route::post('/Dependencias/actualizar','DependenciasController@actualizar');
        Route::post('/Dependencias/eliminar','DependenciasController@eliminar');
        Route::post('/Dependencias/traedepar','DependenciasController@traedepar');

        /** Marca equipos */
        Route::get('/Marcaequi','MarcaequiController@index');
        Route::post('/Marcaequi/guardar','MarcaequiController@guardar');
        Route::post('/Marcaequi/editar','MarcaequiController@editar');
        Route::post('/Marcaequi/actualizar','MarcaequiController@actualizar');
        Route::post('/Marcaequi/eliminar','MarcaequiController@eliminar');
        

        /**cargo */
        Route::get('/Cargo','CargoController@index');
        Route::post('/Cargo/guardar','CargoController@guardar');
        Route::post('/Cargo/editar','CargoController@editar');
        Route::post('/Cargo/actualizar','CargoController@actualizar');
        Route::post('/Cargo/eliminar','CargoController@eliminar');
        /*Tipequipo */
        Route::get('/Tipequipo','TipequipoController@index');
        Route::post('/Tipequipo/guardar','TipequipoController@guardar');
        Route::post('/Tipequipo/editar','TipequipoController@editar');
        Route::post('/Tipequipo/actualizar','TipequipoController@actualizar');
        Route::post('/Tipequipo/eliminar','TipequipoController@eliminar');
        /**Modelequi */
        Route::get('/Modelequi','ModelequiController@index');
        Route::post('/Modelequi/guardar','ModelequiController@guardar');
        Route::post('/Modelequi/editar','ModelequiController@editar');
        Route::post('/Modelequi/actualizar','ModelequiController@actualizar');
        Route::post('/Modelequi/eliminar','ModelequiController@eliminar');
       /**Proveedores */
       Route::get('/Proveedores','ProveedoresController@index');
       Route::post('/Proveedores/guardar','ProveedoresController@guardar');
       Route::post('/Proveedores/editar','ProveedoresController@editar');
       Route::post('/Proveedores/actualizar','ProveedoresController@actualizar');
       Route::post('/Proveedores/eliminar','ProveedoresController@eliminar');
        /* Equipos*/
        Route::get('/Equipos','EquiposController@index');
        Route::post('/Equipos/guardar','EquiposController@guardar');
        Route::post('/Equipos/editar','EquiposController@editar');
        Route::post('/Equipos/actualizar','EquiposController@actualizar');
        Route::post('/Equipos/eliminar','EquiposController@eliminar');
        Route::post('/Equipos/traemodelo','EquiposController@traemodelo');

        Route::get('descargar','EquiposController@pdf')->name('equipos.pdf');
        Route::post('/Equipos/informacion','EquiposController@informacion');
        /**Empleados */
        Route::get('/Empleados','EmpleadosController@index');
        Route::post('/Empleados/guardar','EmpleadosController@guardar');
        Route::post('/Empleados/editar','EmpleadosController@editar');
        Route::post('/Empleados/actualizar','EmpleadosController@actualizar');
        Route::post('/Empleados/eliminar','EmpleadosController@eliminar');
        /**Responsable equipos */        
        Route::get('/Responsables','ResponsablesController@index');
        Route::post('/Responsables/guardar','ResponsablesController@guardar');
        Route::post('/Responsables/editar','ResponsablesController@editar');
        Route::post('/Responsables/actualizar','ResponsablesController@actualizar');
        Route::post('/Responsables/eliminar','ResponsablesController@eliminar');
       /*Sedes  */
        Route::get('/Sedes','SedeController@index');
        Route::post('/Sedes/guardar','SedeController@guardar');
        Route::post('/Sedes/editar','SedeController@editar');
        Route::post('/Sedes/actualizar','SedeController@actualizar');
        Route::post('/Sedes/eliminar','SedeController@eliminar');
        /**Localizacion */
        Route::get('/Localizacion','LocalizacionController@index');
        Route::post('/Localizacion/guardar','LocalizacionController@guardar');
        Route::post('/Localizacion/editar','LocalizacionController@editar');
        Route::post('/Localizacion/actualizar','LocalizacionController@actualizar');
        Route::post('/Localizacion/eliminar','LocalizacionController@eliminar');
        Route::post('/Localizacion/traedepen','LocalizacionController@traerdependencias');
        /*Cronograma de mantenimiento*/
        Route::get('/Cronomantenimiento','CronomantenimientoController@index');
        Route::post('/Cronomantenimiento/guardar','CronomantenimientoController@guardar');
        Route::post('/Cronomantenimiento/editar','CronomantenimientoController@editar');
        Route::post('/Cronomantenimiento/actualizar','CronomantenimientoController@actualizar');
        Route::post('/Cronomantenimiento/eliminar','CronomantenimientoController@eliminar');
        Route::post('/Cronomantenimiento/depart','CronomantenimientoController@depart');
        Route::post('/Cronomantenimiento/dependencias','CronomantenimientoController@dependencias');
        Route::post('/Cronomantenimiento/guardardet','CronomantenimientoController@guardardet');
        Route::post('/Cronomantenimiento/traernombre','CronomantenimientoController@traernombre');
        Route::post('/Cronomantenimiento/traerjefe','CronomantenimientoController@traerjefe');
        Route::get('/Cronomantenimiento/reporte','CronomantenimientoController@reporte');
       
        /*jefe departamentos*/        
        Route::get('/Jefedependencia','JefedependenciasController@index');
        Route::post('/Jefedependencia/guardar','JefedependenciasController@guardar');
        Route::post('/Jefedependencia/editar','JefedependenciasController@editar');
        Route::post('/Jefedependencia/actualizar','JefedependenciasController@actualizar');
        Route::post('/Jefedependencia/eliminar','JefedependenciasController@eliminar');
        Route::post('/Jefedependencia/depart','JefedependenciasController@depart');
        Route::post('/Jefedependencia/dependencias','JefedependenciasController@dependencias');
        /**Programas */
        Route::get('/Programas','ProgramasController@index');
        Route::post('/Programas/guardar','ProgramasController@guardar');
        Route::post('/Programas/editar','ProgramasController@editar');
        Route::post('/Programas/eliminar','ProgramasController@eliminar');
        Route::post('/Programas/actualizar','ProgramasController@actualizar');
        Route::post('/Programas/agregar','ProgramasController@agregar');
        Route::post('/Programas/guardarvers','ProgramasController@guardarvers');
        Route::post('/Programas/eliminarver','ProgramasController@eliminarvers');
        /* Componentes */
        Route::get('/Componentes','ComponentesController@index');
        Route::post('/Componentes/guardar','ComponentesController@guardar');
        Route::post('/Componentes/editar','ComponentesController@editar');
        Route::post('/Componentes/actualizar','ComponentesController@actualizar');
        Route::post('/Componentes/eliminar','ComponentesController@eliminar');
        /**Tipcomponente */
        Route::get('/Tipcomponente','TipcomponenteController@index');
        Route::post('/Tipcomponente/guardar','TipcomponenteController@guardar');
        Route::post('/Tipcomponente/editar','TipcomponenteController@editar');
        Route::post('/Tipcomponente/actualizar','TipcomponenteController@actualizar');
        Route::post('/Tipcomponente/eliminar','TipcomponenteController@eliminar');
        /**Tipmantenimiento */
        Route::get('/Tipmante','TipmanteController@index');
        Route::post('/Tipmante/guardar','TipmanteController@guardar');
        Route::post('/Tipmante/editar','TipmanteController@editar');
        Route::post('/Tipmante/actualizar','TipmanteController@actualizar');
        Route::post('/Tipmante/eliminar','TipmanteController@eliminar');
        
    });
