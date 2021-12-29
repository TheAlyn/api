<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Tarefa;

class TarefasController extends Controller
{
    // Função Listando todas as tarefas
    public function list() {
       $array = ['error' => ''];

       $array['list'] = Tarefa::all();

       return $array;
    }
    // Função Listando Tarefa por ID
    public function listar($id) {
        $array = ['error' => ''];
 
        $tarefa = Tarefa::find($id);

        if($tarefa){
            $array['tarefa'] = $tarefa;
        } else {
            $array['error'] = 'A tarefa '.$id.' não existe';
        }
 
        return $array;
    }
    // Função para adicionar Tarefa
    public function addAction(Request $request) {
        $array = ['error' => ''];
        // Fazendo a validação dos campos obrigatorios
        $rules = [
            'titulo' => 'required|min:3',
            'id_usuario' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            $array['error'] = $validator->messages();
            return $array;
        }

        $titulo = $request->input('titulo');
        $id_usuario = $request->input('id_usuario');
        // Inserindo no Banco de Dados
        $tarefa = new Tarefa();
        $tarefa->titulo = $titulo;
        $tarefa->id_usuario = $id_usuario;
        $tarefa->save();
        
        return $array;
    }

    public function editAction($id, Request $request) {
        $array = ['error' => ''];

        // Validando
        $rules = [
            'titulo' => 'min:3',
            'id_usuario' => '',
            'resolvido' => 'boolean'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            $array['error'] = $validator->messages();
            return $array;
        }

        $titulo = $request->input('titulo');
        $id_usuario = $request->input('id_usuario');
        $resolvido = $request->input('resolvido');

        // Atualizando o item
        $tarefa = Tarefa::find($id);
        if($tarefa){
           $data = [];
           if($request->titulo){
            $data += ['titulo' => $request->titulo];
           }
           if($request->id_usuario){
            $data += ['id_usuario' => $request->id_usuario];
           }
           if($request->resolvido){
            $data += ['resolvido' => $request->resolvido];
           }
           
           print_r($data);
           
           Tarefa::find($id)->update($data);
           $tarefa->save();

        } else {
            $array['error'] = 'A tarefa '.$id.' não existe, logo, não pode ser atualizado.';
        }

        return $array;
    }
    // Função para Deletar
    public function del() {
        
    }

    public function done() {
        
    }
}
