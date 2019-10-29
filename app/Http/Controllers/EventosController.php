<?php

namespace App\Http\Controllers;

use App\EventosModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\messages;
use App\messages_s;
use App\Upload;
use App\Events\MessageSent;
use App\Http\Controllers\Crypt;


class EventosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function AddEventos(Request $request){
        $date = Carbon::now();
        $Evento = new EventosModel;
        try {
            $Evento->accion = $request->Accion_id;
            $Evento->responsable  = (int)$request->get('responsable_id');
            $Evento->fecha_inicial  = $date;
            $Evento->fecha_final  = $request->fecha;
            $Evento->observaciones  = $request->Dobservaciones;
            $Evento->activo  = 1;
            $Evento->estado = 1;
            $Evento->archivo= "";
            $Evento->save();

            print true;
        } catch (\Exception $th) { 
            print $th;
        }      
    }

    public function getDataEventos(){
        $query = EventosModel::join('responsables','responsable','=','responsables.id_responsable')
                        ->join('estados','estado','=','id')
                        ->select('id_evento','accion','responsables.nombre','fecha_inicial','fecha_final','observaciones','estados.nombre as estado')
                        ->get();

        return $query;
    }

    public function getResponsables(){
        $query2 = DB::table('responsables')
                        //->join('eventos','responsable','=','id_Responsable')
                        ->select('id_Responsable as id','nombre')
                        ->where('responsables.activo','=',1)
                        ->get();
        $query = DB::table('eventos')
                    ->join('responsables','responsable','=','id_Responsable')
                    ->selectraw('distinct id_Responsable as id,nombre')
                    ->get();
    //    dd($query);
        return response()->json($query);
    }

    public function getDataResponsable(){
        $responsable = DB::table('responsables')
                            ->select('id_Responsable','nombre')
                            ->get();

        return response()->json($responsable);
    }

    public function edit($id){
        $user = $this->userLoginId();
        
        return view('Eventos.edit',[
         'id' => $id,
         'idUser' => $user
         ]);
    }

    public function salaChat(){
        // $user = $this->userLoginId();
        $mensajes = $this->getMessage();

        
        return view('Eventos.edit',[
//            'id' => $id,
            // 'idUser' => $user,
            'mensajes' => $mensajes
        ]);
    }

     public function Inseguro(){
        $user = $this->userLoginId();
        
        return view('Eventos.inseguro',[
         'idUser' => $user
         ]);
    } 

    public function searchEvento($id){
        
        $query = EventosModel::join('responsables','responsable','=','id_Responsable')
                            ->select('accion','responsables.nombre as responsable','eventos.created_at','observaciones')
                            ->where('id_evento',$id)->get();

        return response()->json($query);
    }

    public function chat($id){
        return view('Eventos.chat'); 
    }

    public function chatOnline(){
        return view('Eventos.chat');
    }

    public function showEvento(){
        return view('Eventos.agenda');
    }
    
    public function showBandeja(){
        return view('bandeja.bandeja');
    }

    public function userLoginId(){
        $user = Auth::user()->id;
        return $user;
    }
    public function getMessages(){
          

        $mensaje = DB::table('messages')
                        ->join('users','users.id','=','messages.user_id')
                        ->select('messages.id','messages.message','messages.user_id','users.name')
                        ->get();


        return response()->json($mensaje,200);
        // return response()->json(base64_encode($mensaje),200);
    }

    public function getMessage(){
        return  messages::with('user')->get();
    }

    public function addMessageData(Request $request){

    
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);
        broadcast(new MessageSent($message->load('user')))->toOthers();
        return ['status' => 'success'];


        // $Mensajes = new messages;

        // $Mensajes->message = $request->message;
        // $Mensajes->user_id = $request->id_user;
        // $Mensajes->evento_id = $request->id_evento;

        // $Mensajes->save();

        // broadcast(new MessageSent($Mensajes));
    }
    public function addMessageData_s(Request $request){

        $Mensajes = new messages_s;

        $Mensajes->message = $request->message;
        $Mensajes->user_id = $request->id_user;
        $Mensajes->save();

        return ['status' => 'success'];
        // broadcast(new MessageSent($Mensajes));
    }

    public function uploadfile(Request $request){

        dd($request);
        // $modelUpload = Upload::find($request->id_file);

        // $modelUpload->evento_id = $request->id_evento;
        // $modelUpload->file_name = $request->id_file;

        // $modelUpload->save();

        //dd($request->id_file)
;
        //$uploadData = Upload::find(1);

        //$uploadData->comments()->save($modelUpload);


        //dd($uploadData);
    }

    public function FileList($id){
        
            $files = DB::table('uploads')
                            ->select('file_name as name','file as url')
                            ->where('evento_id',$id)
                            ->get();
            return response()->json($files, 200);
    }

    
}
