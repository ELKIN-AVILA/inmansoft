<?php



namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Localizacion;
use App\Departamentos;
use App\Dependencias;
use App\Equipos;
use App\Sede;
use App\Tipequipo;
use App\Mantenimiento;
use App\Tipmante;
use App\Tipcomponente;
use App\Componentes;
use App\Compoxequipo;
use App\Programas;
use App\Versionpro;
use App\Softwarexequipo;
use Illuminate\Support\Facades\DB;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
	    $sede=Sede::all();
		$localizacion=Localizacion::all();
		$tipcomponente=Tipcomponente::all();
	    $nequipo=array();
	    foreach($sede as $msede){
		    $localizacion=DB::table('localizacion')->where('sede_id','=',$msede->id)->count();
		    array_push($nequipo,$localizacion);
		}
		$programas=Programas::all();
		$versiones=Versionpro::all();
		$departamentos=Departamentos::all();
		$tipmante=Tipmante::all();
		$componentes=Componentes::all();
	    return view('adminlte::home',['sede'=>$sede,'departamentos'=>$departamentos,'tipmante'=>$tipmante,'nequipos'=>$nequipo,'tipcomponente'=>$tipcomponente,'programas'=>$programas,'version'=>$versiones,'componentes'=>$componentes]);
    }

    public function traerdepartamentos(Request $request){
        if($request->ajax()){
            $departamentos=Departamentos::where('sede_id','=',$request->id)->get();
            $sede=Sede::where('id','=',$request->id)->get();
            return response()->json(['departamentos'=>$departamentos]);
        }
    }
    public function traerdependencias(Request $request){
        if($request->ajax()){
            $dependencias=Dependencias::where('departamentos_id','=',$request->id)->get();
            return response()->json(['dependencias'=>$dependencias]);
        }
    }
    public function traerequipos(Request $request){
	    if($request->ajax()){
		    $equi=Localizacion::where('dependencias_id','=',$request->id)->get();
		    $equipos=array();
		    $tipo=array();
		    $mantenimientos=array();
		    foreach($equi as $mequi){
			    $eq=Equipos::where('id','=',$mequi['equipos_id'])->get();
			    foreach($eq as $meq){
				    $mant=Mantenimiento::where('equipos_id','=',$meq['id'])->get();
				    $tip=Tipequipo::where('id','=',$meq['tipequipo_id'])->get();
				    array_push($tipo,$tip);
				    array_push($mantenimientos,$mant);
			    }
			    array_push($equipos,$eq);
		    }
		    return response()->json(['equipos'=>$equipos,'tipo'=>$tipo,'mantenimiento'=>$mantenimientos]);
	    }
    }
    public function equipos(Request $request){
	    $sede=sede::all();
	    $departamentos=$request->departamentos;
	    $dependencias=$request->dependencias;
	    $localizacion=DB::table('localizacion')->where([['sede_id','=',$request->sede_id],['departamentos_id','=',$departamentos],['dependencias_id','=',$dependencias]])->get();
	    $equipos=array();
	    $tipo=array();
	    $mantenimientos=array();
	    foreach($localizacion as $mequi){
		    $eq=Equipos::where('id','=',$mequi->equipos_id)->get();
		    foreach($eq as $meq){
			    $tip=Tipequipo::where('id','=',$meq['tipequipo_id'])->get();
			    array_push($tipo,$tip);
		    }
		    array_push($equipos,$eq);
	    }
	    return response()->json(['equipos'=>$equipos,'tipoequ'=>$tipo]);
    }
    public function mantenimientos(Request $request){
	    if($request->ajax()){
		    $mantenimientos=Mantenimiento::where('equipos_id','=',$request->id)->get();
		    return response()->json($mantenimientos);
	    }
    } 
	public function componentes(Request $request){
		if($request->ajax()){
			/**poner tipcomponente */
			$equipos=Equipos::where('id','=',$request->id)->get();
			$componentesx=Compoxequipo::where('equipos_id','=',$request->id)->get();
			$componente=array();
			$tipcomponente=array();
			foreach($componentesx as $mcompo){
					$componentes=Componentes::where('id','=',$mcompo->componentes_id)->get();
					foreach($componentes as $mcomp){
						array_push($componente,['id'=>$mcomp->id,'nombre'=>$mcomp->nombre]);
						$tipcom=Tipcomponente::where('id','=',$mcomp->tipcomponentes_id)->get();
						foreach($tipcom as $mtip){
							array_push($tipcomponente,['nombre'=>$mtip->nombre]);
						}
					}
			}
			return response()->json(['componente'=>$componente,'componentes'=>$componentesx,'equipo'=>$equipos,'tipcomponente'=>$tipcomponente]);
		}
	}
	public function traecomponentes(Request $request){
		if($request->ajax()){
			$componentes=Componentes::where('tipcomponentes_id','=',$request->id)->get();
			return response()->json($componentes);
		}
	}
	public function eliminarcomponente(Request $request){
		if($request->ajax()){
			$compoxequipo=Compoxequipo::where('id','=',$request->id)->get();
			$id="";
			foreach($compoxequipo as $mcomp){
				$id=$mcomp->equipos_id;
			}
			$componente=Compoxequipo::where('id','=',$request->id);
			$componente->delete();
			return response()->json(['msg'=>'Se elimino correctamente el componente','idequipo'=>$id]);
		}
	}
	public function editarcomponente(Request $request){
		if($request->ajax()){
			$componente=Compoxequipo::where('id','=',$request->id)->get();
			$tip="";
			foreach($componente as $mco){
				$tipcomp=Tipcomponente::where('id','=',$mco->componentes_id)->get();
				foreach($tipcomp as $mtip){
						$tip=$mtip->id;
				}
			}
			return response()->json(['componente'=>$componente,'tip'=>$tip]);
		}
	}
	public function guardarcomponente(Request $request){
		if($request->ajax()){
			$compoxequipo=new Compoxequipo();
			$compoxequipo->equipos_id=$request->idequi;
			$compoxequipo->componentes_id=$request->componente;
			$compoxequipo->save();
			return response()->json(['msg'=>'Se asigno correctamente el componente','idequipo'=>$request->idequi]);
		}
	}
	public function traeprogramas(Request $request){
		if($request->ajax()){
				$equipost=Equipos::where('id','=',$request->id)->get();
				$verpro=Softwarexequipo::where('equipos_id','=',$request->id)->get();
				$programas=array();
				foreach($verpro as $mpro){
					$versi=Versionpro::where('id','=',$mpro->versionpro_id)->get();
					foreach($versi as $mver){
						$pro=Programas::where('id','=',$mver->programas_id)->get();
						foreach($pro as $mpro){
							array_push($programas,$mpro->nombre);
						}
					}
				}
				$pro=Programas::all();
				$version=Versionpro::all();
				return response()->json(['pro'=>$pro,'programas'=>$programas,'equipo'=>$equipost,'softxequi'=>$verpro,'version'=>$version]);
				
		}
	}
	public function traeversiones(Request $request){
		if($request->ajax()){
			$versiones=Versionpro::where('programas_id','=',$request->id)->get();
			return response()->json($versiones);
		}
	}
	public function softwarexequipo(Request $request){
		if($request->ajax()){
			$software=new Softwarexequipo();
			$software->equipos_id=$request->idequipo;
			$software->versionpro_id=$request->version;
			$software->licencia=$request->licencia;
			$software->fechainst=$request->fechainst;
			$software->fechacaducid =$request->fechacadu;
			$software->save();
			return response()->json(['msg'=>"Se asigno el programa",'idequipo'=>$request->idequipo]);
		}
	}
	public function eliminarpro(Request $request){
		if($request->ajax()){
			$software=Softwarexequipo::where('id','=',$request->id)->get();
			$idequipo="";
			foreach($software as $msoft){
				$idequipo=$msoft->equipos_id;
			}
			$software1=Softwarexequipo::where('id','=',$request->id);
			$software1->delete();
			return response()->json(['msg'=>'Se elimino el registro','idequipo'=>$idequipo]);
		}
	}
	public function editarpro(Request $request){
		if($request->ajax()){
			$software=Softwarexequipo::where('id','=',$request->id)->get();
			$programas="";
			foreach($software as $msoft){
				$version=Versionpro::where('id','=',$msoft->versionpro_id)->get();
				foreach($version as $mversion){
					$programas=$mversion->programas_id;
				}
			}
			return response()->json(['software'=>$software,'programa_id'=>$programas]);
		}
	}
	public function actualizarpro(Request $request){
		if($request->ajax()){

			$software=Softwarexequipo::where('id','=',$request->id)->update(['versionpro_id'=>$request->version,'licencia'=>$request->licencia,'fechainst'=>$request->fechainst,'fechacaducid'=>$request->fechacadu]);
			return response()->json(['msg'=>'Se actualizo el registro','idequipo'=>$request->idequipo]);
		}
	}
	public function hojavida(Request $request){
		if($request->ajax()){
			$equipos=Equipos::where('id','=',$request->id)->get();
			$software=Softwarexequipo::where('equipos_id','=',$request->id)->get();
			$programas=array();
			$versiones=array();
			foreach($software as $msoft){
				$ver=Versionpro::where('id','=',$msoft->versionpro_id)->get();
				foreach($ver as $mver){
					array_push($versiones,$mver->nombre);
					$progra=Programas::where('id','=',$mver->programas_id)->get();
					foreach($progra as $mpro){
						array_push($programas,$mpro->nombre);
					}
				}
			}
			return response()->json(['equipos'=>$equipos,'programas'=>$programas,'versiones'=>$versiones]);
		}
	}
}
