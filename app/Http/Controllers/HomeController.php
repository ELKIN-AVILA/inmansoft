<?php



namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
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
use App\Detmantenimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Anouar\Fpdf\Facades\Fpdf as Fpdf;

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
	public function guardardetmante(Request $request){
		if($request->ajax()){
			$detmantenimiento= new Detmantenimiento();
			$detmantenimiento->mantenimiento_id=$request->idmante;
			$detmantenimiento->descripcion=$request->descripcion;
			$detmantenimiento->save();
			$mantenimiento=Mantenimiento::where('id','=',$request->idmante)->update(['estado'=>'R','usuarios_id'=>Auth::id()]);

			return response()->json(['msg'=>'Se guardo el detalle del mantenimiento','idmante'=>$request->idmante]);
		}
	}
	public function infomantenimiento(Request $request){
		if($request->ajax()){
			$mantenimiento=Mantenimiento::find($request->id);
			$tipmante=Tipmante::find($mantenimiento->tipmante_id);
			$usuarios=User::find($mantenimiento->usuarios_id);
			$detmantenimiento=Detmantenimiento::where('mantenimiento_id','=',$request->id)->get();
			return response()->json(['mantenimiento'=>$mantenimiento,'tipmante'=>$tipmante,'usuario'=>$usuarios,'detmantenimiento'=>$detmantenimiento]);
		}
	}
	public function infomantepdf(Request $request,$id){
		$mantenimiento=Mantenimiento::find($id);
		$tipmante=Tipmante::find($mantenimiento->tipmante_id);
		$usuarios=User::find($mantenimiento->usuarios_id);
		$detmantenimiento=Detmantenimiento::where('mantenimiento_id','=',$id)->get();
		$fpdf = new Fpdf();
            $fpdf::AddPage('L','Legal');
            $fpdf::SetFont('Arial','B',16);
            $fpdf::Image('img/camara.png',40,13,32);
            $fpdf::SetXY(10,10);
            $fpdf::Cell(340,32,"",1,0,'C');
            $fpdf::SetFont('Arial','',12);
            $fpdf::SetXY(310,10);
			$fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
			$equipos=Equipos::find($mantenimiento->equipos_id);
			$fpdf::Cell(340,8,"Formato De Mantenimiento ",0,1,'C');
			$fpdf::Cell(340,8,$equipos->numplaca,0,1,'C');
			$fpdf::Ln();
			$fpdf::Cell(85,8,"Fecha del mantenimiento:",1,0,'C');
			$fpdf::Cell(85,8,$mantenimiento->fecha,1,0,'C');
			$fpdf::Cell(85,8,"Nombre responsable mantenimiento",1,0,'C');
			$fpdf::Cell(85,8,"",1,1,'C');
				

            $fpdf::Output('');
            exit; 
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
	public function actualizarcomponente(Request $request){
		if($request->ajax()){
			$compoxequipo=Compoxequipo::where('id','=',$request->id)->update(['componentes_id'=>$request->componente]);
			return response()->json(['msg'=>"Se Actualizo el componente",'idequipo'=>$request->idequipo]);
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
			$compoxequipo=Compoxequipo::where('equipos_id','=',$request->id)->get();
			$componente=array();
			$tipcomponente=array();
			foreach($compoxequipo as $mcomp){
				$comp=Componentes::where('id','=',$mcomp->componentes_id)->get();
				foreach($comp as $mcompone){
					array_push($componente,$mcompone->nombre);
					$tipcom=Tipcomponente::where('id','=',$mcompone->tipcomponentes_id)->get();
					foreach($tipcom as $mtip){
						array_push($tipcomponente,$mtip->nombre);
					}
				}	
			}
			return response()->json(['equipos'=>$equipos,'programas'=>$programas,'versiones'=>$versiones,'componentes'=>$componente,'tipcomponente'=>$tipcomponente]);
		}
	}
	public function hojavidareporte(Request $request,$id){
			$fpdf = new Fpdf();
            $fpdf::AddPage('L','Legal');
            $fpdf::SetFont('Arial','B',16);
            $fpdf::Image('img/camara.png',40,10,32);
            $fpdf::SetXY(10,10);
            $fpdf::Cell(340,30,"",1,0,'C');
            $fpdf::SetFont('Arial','',12);
            $fpdf::SetXY(310,10);
			$fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
			$equipos=Equipos::find($id);
			$fpdf::Cell(340,8,"Hoja de vida ".$equipos->numplaca,0,1,'C');
            $fpdf::Output('');
            exit;        
        
	}
}

