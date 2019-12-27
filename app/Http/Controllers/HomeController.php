<?php



namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Anouar\Fpdf\Facades\Fpdf as Fpdf;
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
use App\Responsables;
use App\Empleados;
use App\Modelequi;
use App\Marcaequi;
use App\Fotos;
use App\Transladoequip;
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
		$dependencias=Dependencias::all();
	    return view('adminlte::home',['sede'=>$sede,'departamentos'=>$departamentos,'dependencias'=>$dependencias,'tipmante'=>$tipmante,'nequipos'=>$nequipo,'tipcomponente'=>$tipcomponente,'programas'=>$programas,'version'=>$versiones,'componentes'=>$componentes]);
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
		$emple=array();
	    foreach($localizacion as $mequi){
		    $eq=Equipos::where('id','=',$mequi->equipos_id)->get();
		    foreach($eq as $meq){
				$responsables=Responsables::where('equipos_id','=',$meq->id)->get();
				foreach($responsables as $mres){
					$empleados=Empleados::where('id','=',$mres->empleados_id)->get();
					foreach($empleados as $memple){
						array_push($emple,$memple->priape." ". $memple->segape." ".$memple->prinom);
					}
				}
			    $tip=Tipequipo::where('id','=',$meq['tipequipo_id'])->get();
			    array_push($tipo,$tip);
		    }
		    array_push($equipos,$eq);
	    }
	    return response()->json(['equipos'=>$equipos,'tipoequ'=>$tipo,'responsables'=>$emple]);
    }
    public function mantenimientos(Request $request){
	    if($request->ajax()){
		    $mantenimientos=Mantenimiento::where('equipos_id','=',$request->id)->get();
		    return response()->json(['mantenimientos'=>$mantenimientos,'idequipo'=>$request->id]);
	    }
	} 
	public function guardarmantenimiento(Request $request){
		if($request->ajax()){
			$mantenimiento=new Mantenimiento();
			$mantenimiento->fecha=$request->fecha;
			$mantenimiento->equipos_id=$request->idequipo;
			$mantenimiento->tipmante_id=$request->tipmante_id;
			$mantenimiento->usuarios_id=Auth::id();
			$mantenimiento->tipo='N';
			$mantenimiento->estado='N';
			$mantenimiento->save();
			return response()->json(['msg'=>'Se creo el mantenimiento','idequipo'=>$request->idequipo]);
		}
	}
	public function guardardetmante(Request $request){
		if($request->ajax()){
			$detmantenimiento= new Detmantenimiento();
			$detmantenimiento->mantenimiento_id=$request->idmante;
			$detmantenimiento->descripcion=$request->descripcion;
			$detmantenimiento->save();
			$mantenimiento=Mantenimiento::where('id','=',$request->idmante)->update(['estado'=>'R','usuarios_id'=>Auth::id()]);
			$idequipo="";
			$mante=Mantenimiento::where('id','=',$request->idmante)->get();
			
			return response()->json(['msg'=>'Se guardo el detalle del mantenimiento','idequipo'=>$mante]);
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
		$equipo=Equipos::find($mantenimiento->equipos_id);
		$responsable=Responsables::find($mantenimiento->equipos_id);
		$empleados=Empleados::find($responsable->empleados_id);
		$localizacion=Localizacion::where('equipos_id',$mantenimiento->equipos_id)->get();	
		$fpdf = new Fpdf();
		$fpdf::AddPage('L','Legal');
		$fpdf::SetFont('Arial','B',16);
		$fpdf::SetTitle("Formato de Mantenimiento Equipo-".$equipo->numplaca,true);
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
		$fpdf::SetFont('Arial','',10);
		$fpdf::Cell(85,8,"FECHA DE MANTENIMIENTO",1,0,'C');
		$fpdf::Cell(85,8,$mantenimiento->fecha,1,0,'C');
		$fpdf::Cell(85,8,"NOMBRE RESPONSABLE MANTENIMIENTO",1,0,'C');
		$fpdf::Cell(85,8,$usuarios->name,1,1,'C'); 
		$fpdf::Cell(85,8,"NUMERO PLACA",1,0,'C');
		$fpdf::Cell(85,8,$equipo->numplaca,1,0,'C');
		$fpdf::Cell(85,8,"RESPONSABLE DEL EQUIPO",1,0,'C');
		$fpdf::Cell(85,8,$empleados->priape." ".$empleados->prinom,1,1,'C');
		foreach($localizacion as $mlocali){
			$departamentos=Departamentos::find($mlocali->departamentos_id);
			$dependencias=Dependencias::find($mlocali->dependencias_id);
			$fpdf::Cell(85,8,"DEPARTAMENTO",1,0,'C');
			$fpdf::Cell(85,8,$departamentos->nombre,1,0,'C');
			$fpdf::Cell(85,8,"DEPENDENCIA",1,0,'C');
			$fpdf::Cell(85,8,$dependencias->nombre,1,1,'C');
		}
			$x="";
			$y="";
			$w="";
			$nombre="";
			switch($equipos->tipequipo_id){
				case 1:
					$x="X";
					break;
				case 2:
					$w="X";
					break;
				case 3:
					$y="X";
					break;
				default:
					$tipequip=Tipequipo::find($equipos->tipequipo_id);
					$nombre=$tipequip->nombre;
					break;
			}
			$fpdf::Cell(42.5,8,"PC DE ESCRITORIO",1,0,'C');
			$fpdf::Cell(42.5,8,$x,1,0,'C');
			$fpdf::Cell(42.5,8,"PORTATIL",1,0,'C');
			$fpdf::Cell(42.5,8,$y,1,0,'C');
			$fpdf::Cell(42.5,8,"IMPRESORA",1,0,'C');
			$fpdf::Cell(42.5,8,$w,1,0,'C');
			$fpdf::Cell(36.5,8,"OTROS",1,0,'C');
			$fpdf::Cell(48.5,8,$nombre,1,1,'C');
		$modelequ=Modelequi::find($equipos->modelequi_id);
		$fpdf::Cell(85,8,"MODELO",1,0,'C');
		$fpdf::Cell(85,8,$modelequ->nombre,1,0,'C');
		$fpdf::Cell(85,8,"SERIAL",1,0,'C');
		$fpdf::Cell(85,8,$equipos->serial,1,1,'C');
		$fpdf::Cell(68,8,"TIPO MANTENIMIENTO",1,0,'C');
		$p="";
		$c="";
		switch($mantenimiento->tipmante_id){
			case 1:
				$p="X";
				break;
			case 2:
				$c="X";
				break;
			case 3:
				$p="X";
				$c="X";
				break;
		}
		$fpdf::Cell(68,8,"PREVENTIVO",1,0,'C');
		$fpdf::Cell(68,8,$p,1,0,'C');
		$fpdf::Cell(68,8,"CORRECTIVO",1,0,'C');
		$fpdf::Cell(68,8,$c,1,1,'C');
		$fpdf::Cell(340,8,"DESCRIPCION",1,1,'C');
		foreach($detmantenimiento as $mdet){
			$fpdf::MultiCell(340,8,$mdet->descripcion,1,'J');
		}
		/**poner D */
		$fpdf::Output('D');
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
			$consulta=Compoxequipo::where([['equipos_id','=',$request->idequi],['componentes_id','=',$request->componente]])->first();
			if($consulta){
				return response()->json(['msg'=>'Ya esta asignado el componente','idequipo'=>$request->idequi]);
			}else{
				$compoxequipo=new Compoxequipo();
				$compoxequipo->equipos_id=$request->idequi;
				$compoxequipo->componentes_id=$request->componente;
				$compoxequipo->save();
				return response()->json(['msg'=>'Se asigno correctamente el componente','idequipo'=>$request->idequi]);
			}
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
			$consulta=Softwarexequipo::where([['equipos_id','=',$request->idequipo],['versionpro_id','=',$request->version]])->first();
			if($consulta){
				return response()->json(['msg'=>"Ya esta asignado el programa",'idequipo'=>$request->idequipo]);
			}else{
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
			$fpdf::AddPage('P','Legal');
			$fpdf::SetFont('Arial','B',16);
			$fpdf::Image('img/camara.png',40,10,32);
			$fpdf::SetXY(10,10);
			$fpdf::Cell(200,30,"",1,0,'C');
			$fpdf::SetFont('Arial','',12);
			$fpdf::SetXY(170,10);
			$fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
			$equipos=Equipos::find($id);
			$fpdf::SetFont('Arial','B',12);
			$fpdf::Cell(200,8,"HOJA DE VIDA ",0,1,'C');
			$fpdf::SetFont('Arial','',12);
			$fpdf::Ln();
			$fpdf::SetXY(10,40);
			$tipoequipo=Tipequipo::find($equipos->tipequipo_id);
			$marcaequipo=Marcaequi::find($equipos->marcaequi_id);
			$modelo=Modelequi::find($equipos->modelequi_id);
			$fpdf::SetFillColor(200,213,216);
			$fpdf::Cell(80,8,"NUMERO DE PLACA",1,0,'L',1);
			$fpdf::Cell(120,8,$equipos->numplaca,1,1,'C');
			$fpdf::Cell(30,8,"TIPO EQUIPO",1,0,'C',1);
			$fpdf::Cell(70,8,$tipoequipo->nombre,1,0,'C');
			$fpdf::Cell(50,8,"MARCA EQUIPO",1,0,'C',1);
			$fpdf::Cell(50,8,$marcaequipo->nombre,1,1,'C');
			$fpdf::Cell(30,8,"MODELO ",1,0,'C',1);
			$fpdf::Cell(70,8,$modelo->nombre,1,0,'C');
			$fpdf::Cell(50,8,"SERIAL",1,0,'C',1);
			$fpdf::Cell(50,8,$equipos->serial,1,1,'C');
			$fpdf::SetFillColor(180,240,255);
			$fpdf::SetFont('Arial','B',12);
			$fpdf::Cell(200,8,"SOFTWARE DEL EQUIPO",1,1,'C',1);
			$fpdf::SetFont('Arial','',12);
			$fpdf::SetFillColor(200,213,216);
			$fpdf::Cell(100,8,"Programa",1,0,'C',1);
			$fpdf::Cell(100,8,"Version",1,1,'C',1);
			$software=Softwarexequipo::where('equipos_id','=',$id)->get();
			foreach($software as $msof){
				$version=Versionpro::where('id','=',$msof->versionpro_id)->get();
				foreach($version as $mver){
					$programas=Programas::where('id','=',$mver->programas_id)->get();
					foreach($programas as $mpro){
						$fpdf::Cell(100,8,$mpro->nombre,1,0,'C');
						$fpdf::Cell(100,8,$mver->nombre,1,1,'C');
					}
				}
			}
			$fpdf::SetFillColor(180,240,255);
			$fpdf::SetFont('Arial','B',12);
			$fpdf::Cell(200,8,"HARDWARE DEL EQUIPO",1,1,'C',1);
			$fpdf::SetFont('Arial','',12);
			$fpdf::SetFillColor(200,213,216);
			$fpdf::Cell(100,8,"Tipo componente",1,0,'C',1);
			$fpdf::Cell(100,8,"Componente",1,1,'C',1);
			$componexequipo=Compoxequipo::where('equipos_id','=',$id)->get();
			foreach($componexequipo as $mcompoequ){
				$componente=Componentes::where('id','=',$mcompoequ->componentes_id)->get();
				foreach($componente as $mcompo){
					$tipcomponente=Tipcomponente::where('id','=',$mcompo->tipcomponentes_id)->get();
					foreach($tipcomponente as $mtip){
						$fpdf::Cell(100,8,$mtip->nombre,1,0,'C');
						$fpdf::Cell(100,8,$mcompo->nombre,1,1,'C');
					}
				}
			}
			$fpdf::footer();
			$fpdf::Output('D');
			exit;        

	}
	public function fotosmantenimiento(Request $request){
		if($request->hasFile('fotoid')){
			$file=$request->file('fotoid');
			$name=time().$file->getClientOriginalName();
			$file->move(\public_path().'/img/mantenimientos/',$name);
		}
		$fotos=new Fotos();
		$fotos->url=$name;
		$fotos->observacion=$request->observafoto;
		$fotos->mantenimiento_id=$request->idequifotos;
		$fotos->save();
		return response()->json(['msg'=>'Se adjunto la imagen','id'=>$request->idequifotos]);
	}
	public function traefotosmantenimiento(Request $request){
		if($request->ajax()){
			$fotos=Fotos::where('mantenimiento_id','=',$request->id)->get();
			return response()->json($fotos);
		}
	}
	public function traelocalizacion(Request $request){
		if($request->ajax()){
			$localizacion=Localizacion::where('equipos_id','=',$request->id)->get();
			$translado=array();
			$transla=Transladoequip::where('equipos_id','=',$request->id)->get();
			foreach($transla as $mtransl){
				$fecha=substr($mtransl->created_at,0,10);
				$sede=Sede::find($mtransl->sedepro_id);
				$departamento=Departamentos::find($mtransl->departamentospro_id);
				$dependencias=Dependencias::find($mtransl->dependenciaspro_id);
				array_push($translado,['sede'=>$sede->nombre,'departamento'=>$departamento->nombre,'dependencia'=>$dependencias->nombre,'observacion'=>$mtransl->observacion,'fecha'=>$fecha]);
			}
			return response()->json(['localizacion'=>$localizacion,'translado'=>$translado]);
		}
	}
	public function guardartranslado(Request $request){
		if($request->ajax()){
			$transladoequip=new Transladoequip();
			$transladoequip->equipos_id=$request->equipo_id;
			$transladoequip->sedepro_id=$request->sedepro_id;
			$transladoequip->departamentospro_id=$request->departamentospro_id;
			$transladoequip->dependenciaspro_id=$request->dependenciaspro_id;
			$transladoequip->sedeactu_id=$request->sedeactu;
			$transladoequip->departamentosactu_id=$request->departamentosactu;
			$transladoequip->dependenciasactu_id=$request->dependenciaactu;
			$transladoequip->observacion=$request->observacion;
			$transladoequip->save();
			$localizacion=Localizacion::where('equipos_id','=',$request->equipo_id)->update(['sede_id'=>$request->sedeactu,'departamentos_id'=>$request->departamentosactu,'dependencias_id'=>$request->dependenciaactu]);
			return response()->json("Se guardo exitosamente el registro");
			
		}
	}
}

