<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cronomantenimiento;
use App\Detcronomantenimiento;
use App\Sede;
use App\Departamentos;
use App\Dependencias;
use App\Jefedependencia;
use App\Empleados;
use App\Localizacion;
use App\Mantenimiento;
use App\user;
use App\Equipos;
use  Anouar\Fpdf\Facades\Fpdf as Fpdf;
use Mail;

class CronomantenimientoController extends Controller
{
    public function index(){
        $cronomantenimiento=Cronomantenimiento::all();
        $detcrono=Detcronomantenimiento::all();
        $sede=Sede::all();
        $departamentos=Departamentos::all();
        $dependencias=Dependencias::all();
        return view('Cronomantenimiento.index',['cronomantenimiento'=>$cronomantenimiento,'detcrono'=>$detcrono,'sede'=>$sede,'departamentos'=>$departamentos,'dependencias'=>$dependencias]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $cronomantenimiento=new Cronomantenimiento();
            $cronomantenimiento->nombre=$request->nombre;
            $cronomantenimiento->usuarios_id=auth()->id();
            $cronomantenimiento->fecha=date("Y-m-d");
            $cronomantenimiento->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function depart(Request $request){
        if($request->ajax()){
            $departamentos=Departamentos::where('sede_id','=',$request->id)->get();
            return response()->json($departamentos);
        }
    }
    public function dependencias(Request $request){
        if($request->ajax()){
            $dependencias=Dependencias::where('departamentos_id','=',$request->id)->get();
            return response()->json(['dependencias'=>$dependencias]);
        }
    }
    public function traernombre(Request $request){
        if($request->ajax()){
            $detcronomantenimiento=Detcronomantenimiento::where('cronomantenimiento_id','=',$request->id)->get();
            $nomsede=array();
            $nomdepart=array();
            $nombredependencias=array();
            foreach($detcronomantenimiento as $mdet){
                $sede=Sede::all();
                $depart=Departamentos::all();
                $dependencias=Dependencias::all();
                foreach($sede as $mse){
                    if($mse->id==$mdet->sede_id){
                        array_push($nomsede,$mse->nombre);
                    }
                }
                foreach($depart as $mdepar){
                    if($mdepar->id==$mdet->departamentos_id){
                        array_push($nomdepart,$mdepar->nombre);
                    }
                }
                foreach($dependencias as $mdepen){
                    if($mdepen->id==$mdet->dependencias_id){
                        array_push($nombredependencias,$mdepen->nombre);
                    }
                }
            }
            $cronomantenimiento=Cronomantenimiento::where('id','=',$request->id)->get();
            return response()->json(['cronomantenimiento'=>$cronomantenimiento,'detcrono'=>$detcronomantenimiento,'nomsede'=>$nomsede,'nomdepart'=>$nomdepart,'nomdepen'=>$nombredependencias]);
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $cronomantenimiento=Cronomantenimiento::where('id','=',$request->id)->get();
            return response()->json($cronomantenimiento);

        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $cronomantenimiento=Cronomantenimiento::where('id','=',$request->id)->update(['nombre'=>$request->nombre]);
            return response()->json("Se actualizo el nombre del cronograma");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $detcrono=Detcronomantenimiento::where('cronomantenimiento_id','=',$request->id)->get();
            $band="";
            if(is_null($detcrono)){
                $band="false";
                $cronomantenimiento=Cronomantenimiento::find($request->id);
                $cronomantenimiento->delete();            
            }else{
                $band="true";
            }
            return response()->json(['val'=>$band]);
        }
    }
    public function guardardet(Request $request){
        if($request->ajax()){
            $numequipo=Localizacion::where('sede_id','=',$request->sede)->where('departamentos_id','=',$request->departamentos)->where('dependencias_id','=',$request->dependencias)->get();
            $num=count($numequipo);
            $detcrono=new Detcronomantenimiento(); 
            $detcrono->cronomantenimiento_id=$request->iddet;
            $detcrono->sede_id=$request->sede;
            $detcrono->departamentos_id=$request->departamentos;
            $detcrono->jefedependencia_id =$request->idjefe;
            $detcrono->dependencias_id=$request->dependencias;
            $detcrono->fechaini=$request->fci;
            $detcrono->fechafin=$request->fcf;
            $detcrono->estado="P";
            $detcrono->numequipo=$num;
            $detcrono->save();
            $cronomantenimiento=Cronomantenimiento::where('id','=',$request->iddet)->get();
            $cronofecha="";
            foreach($cronomantenimiento as $mcron){
                $cronofecha=$mcron->fecha;
            }
            $nomdependencia=Dependencias::find($request->dependencias);
            $nombredependencia=$nomdependencia->nombre;
            $idemple='';
            $jefedepende=Jefedependencia::where('dependencias_id','=',$request->dependencias)->get();
            foreach($jefedepende as $mjefe){
                $idemple=$mjefe->empleados_id;
            }
            $empleado=Empleados::find($idemple);
            $nomemple=$empleado->prinom ." ". $empleado->priape;
            $correoemple=$empleado->correo;
            $fecini=$request->fci;
            $fecfin=$request->fcf;             
            foreach($numequipo as $mmant){
                $equipos=Equipos::find($mmant->equipos_id);
                if($equipos->tipequipo_id == 1 || $equipos->tipequipo_id == 3 ){
                    $mantenim=new Mantenimiento();
                    $mantenim->fecha=$cronofecha;
                    $mantenim->cronomantenimiento_id=$request->iddet;
                    $mantenim->equipos_id=$mmant->equipos_id;
                    $mantenim->tipo="P"; 
                    $mantenim->tipmante_id=3;
                    $mantenim->save();
                }
            }
            $this->correo($nomemple,$correoemple,$nombredependencia,$fecini,$fecfin);
            return response()->json("Se creo el registro");

        }
    }
    public function Correo($nomemple,$correoemple,$nombredependencia,$fecini,$fecfin){
        $to_name = 'Inmansoft';
        $to_email = $correoemple;
        $data = array('nombre'=>$nomemple,'dependencia'=>$nombredependencia,'fecini'=>$fecini,'fecfin'=>$fecfin);
        
        Mail::send('emails.mail', $data, function($message) use ($to_email, $to_name) {
            $message->to($to_email)->subject($to_name);
            
        });
    }
    public function correoview(){
        $nombre='ELKIN';
        $dependencias="SISTEMAS";
        $fecini=2;
        $fecfin=19;
        return view('emails.mail',['nombre'=>$nombre,'dependencia'=>$dependencias,'fecini'=>$fecini,'fecfin'=>$fecfin]);

    }
    public function traerjefe(Request $request){
        if($request->ajax()){
            $jefe=Jefedependencia::where('sede_id','=',$request->sede)->where('departamentos_id','=',$request->departamentos)->where('dependencias_id','=',$request->id)->get();
            $nombre=array();
            $id;
            foreach($jefe as $mjefe){
                $empleados=Empleados::all();
                foreach($empleados as $emple){
                    if($emple->id==$mjefe->empleados_id){
                        array_push($nombre,$emple->priape." ". $emple->segape." ".$emple->prinom." ".$emple->segnom);
                        $id=$mjefe->id;
                    }
                }      
            }
            return response()->json(['idjefe'=>$id,'jefe'=>$nombre]);
        }
    }
    public function reporte(Request $request){
            $id=$request->id;
            $crono=Cronomantenimiento::where('id','=',$id)->get();
            
            $fpdf = new Fpdf();
            $fpdf::AddPage('L','Legal');
            $fpdf::SetFont('Arial','B',16);
            $fpdf::SetTitle("CRONOGRAMA MANTENIMIENTO DE EQUIPOS",true);
            $fpdf::Image('img/camara.png',40,10,32);
            $fpdf::SetXY(10,10);
            $fpdf::Cell(340,30,"",1,0,'C');
            $fpdf::SetFont('Arial','',12);
            $fpdf::SetXY(310,10);
            $fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
            $fpdf::SetXY(310,18.3);
            $fpdf::Cell(40,8.3,"VERSION 1",1,1,'C');
            $fpdf::SetXY(310,26.6);
            $fpdf::Cell(40,8.3,"Pagina 1 de 1",1,1,'C');
            $fpdf::SetXY(35,10);
            $fpdf::SetFont('Arial','B',16);    
            $fpdf::Cell(315,20,'CRONOGRAMA MANTENIMIENTO DE EQUIPOS',0,1,'C');
            $fpdf::SetXY(10,35);
            $idus="";
            foreach($crono as $mcro){
                $idus=$mcro->usuarios_id;
            }
            $usuarios=User::find($idus);
            $fpdf::SetFont('Arial','',10);
            $fpdf::Cell(26.2,5,'AUTOR',1,0,'L');
            $fpdf::Cell(78.75,5,$usuarios->name,1,0,'C'); 
            $fpdf::Cell(52.5,5,'CARGO',1,0,'C'); 
            $fpdf::Cell(78.75,5,'',1,0,'C'); 
            $fpdf::Cell(40.2,5,utf8_decode('FECHA GENERACIÓN'),1,0,'C'); 
            $fechge="";
            foreach($crono as $mcro){
                $fechge=$mcro->fecha;
            }
            $fpdf::Cell(63.5,5,$fechge,1,1,'C'); 
            $fpdf::Ln();
            $fpdf::Ln();
            $fpdf::Ln();
            $fpdf::SetXY(10,40);    
            $fpdf::SetFont('Arial','',10);
            $fpdf::Cell(20,10,"#",1,0,'C');
            $fpdf::Cell(27,10,utf8_decode("FECHA INICIAL"),1,0,'C');
            $fpdf::Cell(27,10,utf8_decode("FECHA FINAL"),1,0,'C');
            $fpdf::Cell(20,10,"SEDE",1,0,'C');
            $fpdf::Cell(40,10,"DEPARTAMENTO",1,0,'C');
            $fpdf::Cell(40,10,"DEPENDENCIA",1,0,'C');
            $fpdf::Cell(40,10,"FECHA NOTIFICACION",1,0,'C');
            $fpdf::Cell(65,10,"ENCARGADO DEPENDENCIA",1,0,'C');
            $fpdf::Cell(61,10,"FIRMA ENCARGADO",1,1,'C');
            $detcrono=Detcronomantenimiento::where('cronomantenimiento_id','=',$id)->get();
            $cont=0;
            foreach($detcrono as $mdet){
                $cont+=1;
                $sede=Sede::find($mdet->sede_id);
                $departamento=Departamentos::find($mdet->departamentos_id);
                $dependencias=Dependencias::find($mdet->dependencias_id);
                $jefe=Jefedependencia::where('dependencias_id','=',$dependencias->id)->get();
                $nomb="";
                foreach($jefe as $mjefe){
                    $empleados=Empleados::where('id','=',$mjefe->empleados_id)->get();
                    foreach($empleados as $memple){
                        $nomb=$memple->priape." ".$memple->prinom;
                    }
                }
                $crono=Cronomantenimiento::find($mdet->cronomantemiento_id);
                $fpdf::SetX(10);
                $fpdf::Cell(20,5,$cont,1,0,'C',0);
                $fpdf::Cell(27,5,$mdet->fechaini,1,0,'C',0); 
                $fpdf::Cell(27,5,$mdet->fechafin,1,0,'C',0); 
                $fpdf::Cell(20,5,$sede->nombre,1,0,'C',0);  
                $fpdf::Cell(40,5,$departamento->nombre,1,0,'C',0);   
                $fpdf::Cell(40,5,$dependencias->nombre,1,0,'C',0);   
                $fpdf::Cell(40,5,date("Y-m-d"),1,0,'C',0);   
                $fpdf::Cell(65,5,$nomb,1,0,'C',0);   
                $fpdf::Cell(61,5,"",1,1,'C',0);
            
            }
            $fpdf::SetX(10);
            $fpdf::Cell(40,5,"FIRMA AUTOR",1,0,'C',0);
            $fpdf::Cell(300,5,"",1,1,'C',0);
            $fpdf::Output('D');
            exit;        
        
    }
   
}
