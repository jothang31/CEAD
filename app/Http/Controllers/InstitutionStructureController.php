<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use \ArrayObject;

use App\CeadUser;
use App\CeadUsersInfo;
use App\CeadStatus;
use App\CeadGroupXGroup;
use App\CeadUserXUser;
use App\CeadGroupXUser;

class InstitutionStructureController extends Controller
{
    public function show () {

    	// $users = CeadUser::join('CEAD_USERS_INFOS', 'CEAD_USERS.CU_CODE', '=', 'CEAD_USERS_INFOS.CU_CODE')
    	// 				 ->join('CEAD_STATUSES', 'CEAD_USERS.CS_CODE', '=', 'CEAD_STATUSES.CS_CODE')
    	// 				 ->where('CEAD_STATUSES.CS_CODE', '=', '1')
     //                     ->select(
     //                        'CEAD_USERS.CU_CODE AS code',
     //                        DB::raw("CONCAT_WS(
     //                            ' ', 
     //                            CUI_FIRST_NAME,
     //                            CUI_MIDDLE_NAME,
     //                            CUI_LAST_NAME,
     //                            CUI_SECOND_SURNAME
     //                        ) AS name"),
     //                        'CU_NAME_PICTURE_PROFILE AS avatar'
     //                        )
     //                     ->get();

      $groups = CeadGroupXGroup::join('CEAD_GROUPS', 'CEAD_GROUP_X_GROUPS.CG_PARENT_CODE', '=', 'CEAD_GROUPS.CG_CODE')
                              ->select(
                                  'CEAD_GROUPS.CG_CODE AS code', 
                                  'CG_SUBCODE AS subcode'
                              )
                              ->distinct('CEAD_GROUPS.code')
                              ->get();

    	return view('institutionalstructure', compact('groups'));

    }

    public function get (request $request) {

        $code = $request->code;

        $groups = CeadGroupXGroup::join('CEAD_GROUPS', 'CEAD_GROUP_X_GROUPS.CG_PARENT_CODE', '=', 'CEAD_GROUPS.CG_CODE')
                              ->select(
                                 'CEAD_GROUPS.CG_CODE AS code', 
                                 'CG_SUBCODE AS subcode'
                              )
                              ->distinct('code')
                              ->get();

        $groups = $groups->toArray();

        array_walk($groups, function (&$group) {

            $subgroups = CeadGroupXGroup::join('CEAD_GROUPS', 'CEAD_GROUP_X_GROUPS.CG_CODE', '=', 'CEAD_GROUPS.CG_CODE')
                                        ->where('CEAD_GROUP_X_GROUPS.CG_PARENT_CODE', '=', $group['code'])
                                        ->select(
                                            'CEAD_GROUPS.CG_CODE AS code', 
                                            'CG_SUBCODE AS subcode'
                                        )
                                        ->get();

            $group['groups'] = $subgroups->toArray();            

        });

        $group = CeadUser::join('CEAD_GROUP_X_USERS', 'CEAD_USERS.CU_CODE', '=', 'CEAD_GROUP_X_USERS.CU_CODE')
                         ->join('CEAD_GROUPS', 'CEAD_GROUP_X_USERS.CG_CODE', '=', 'CEAD_GROUPS.CG_CODE')
                         ->leftJoin('CEAD_GROUP_X_GROUPS', 'CEAD_GROUPS.CG_CODE', '=', 'CEAD_GROUP_X_GROUPS.CG_CODE')
                         ->where([
                                ['CEAD_GROUP_X_USERS.CU_CODE', '=', $code],
                                ['CEAD_GROUP_X_USERS.CS_CODE', '=', 1]
                            ])
                         ->select(
                            'CEAD_GROUPS.CG_CODE AS code',
                            'CG_SUBCODE AS subcode',
                            'CG_PARENT_CODE AS parentCode'
                         )
                         ->get();

        $users = CeadUser::join('CEAD_USER_X_USERS', 'CEAD_USERS.CU_CODE', '=', 'CEAD_USER_X_USERS.CU_CODE')
                         ->where([
                            ['CEAD_USER_X_USERS.CU_LEADER_CODE', '=', $code],
                            ['CEAD_USER_X_USERS.CS_CODE', '=', 1]
                         ])
                         ->select('CEAD_USERS.CU_CODE AS code')
                         ->get();



        return compact('groups', 'group', 'users');



    }

    public function save (Request $request) {

    	$user = $request->user;
      $group = $request->group;
      $subgroup = $request->subgroup;
      $users = json_decode($request->users, true);

      // Creamos una copia del arreglo de usuarios
      $usersObject = new ArrayObject($users);

      $usersCopy = $usersObject->getArrayCopy();

      // Abrimos un bloque transaccional
      DB::beginTransaction();

      try {

          // Obtenemos los usuarios miembro y los comparamos con el arreglo copia
          // si no existe en el arreglo entonces lo desactivamos de la BD
          // si existe entonces simplemente lo sacamos del arreglo copia

          $usersSaved = CeadUser::join('CEAD_USER_X_USERS', 'CEAD_USERS.CU_CODE', '=', 'CEAD_USER_X_USERS.CU_CODE')
                                ->where([
                                  ['CEAD_USER_X_USERS.CU_LEADER_CODE', '=', $user],
                                  ['CEAD_USER_X_USERS.CS_CODE', '=', 1]
                                ])
                                ->select(
                                  'CEAD_USERS.CU_CODE AS code'
                                )
                                ->get();

          $usersSaved = $usersSaved->toArray();

          foreach ($usersSaved as $userSaved) {

              $usersKey = null;
              
              foreach ($users as $key => $userValue) {
                  
                  if (array_search($userValue['code'], $userSaved)) {
                      
                      $usersKey = $key;

                      break;

                  }

              }

              // Si no lo encontró entonces desactivamos el registro
              // caso contrario eliminamos el usuario del arreglo copia
              if ($usersKey === null) {

                  CeadUserXUser::where('CU_CODE', '=', $userSaved['code'])
                               ->update(['CS_CODE' => 2]);

                  // Ponesmos en estado inactivo el registro de relación
                  // de ususarios a grupos
                  CeadGroupXUser::where('CU_CODE', '=', $userSaved['code'])
                                ->update(['CS_CODE' => 2]);
                  
              } else {

                  // Actualizamos el estado de relación entre usuario y grupo
                  $this->groupXUsersRefresh($userSaved['code'], $subgroup, $group);

                  // Eliminamos el registro del arreglo copia
                  unset($usersCopy[$usersKey]);

              }

          }

          // A este punto del proceso ya tenemos en el arreglo copia los 
          // usuarios que deben ser insertados puesto que no tenían como 
          // lider al usuario actual
          foreach ($usersCopy as $userCopy) {
              
              CeadUserXUser::insert([[
                              'CU_CODE' => $userCopy['code'],
                              'CU_LEADER_CODE' => $user,
                              'CS_CODE' => 1
                           ]]);

              // Eliminamos cualquier relacion previa que haya tenido el usuario
              // con un grupo

              CeadGroupXUser::where('CU_CODE', '=', $userCopy['code'])
                            ->update(['CS_CODE' => 2]);

              // Insertamos un nuevo registro en la relación de usuarios y grupos
              // tomando como predefinida el grupo al que pertenece el lider

              // Si el lider pertenece a una subred
              if ($subgroup) {

                  CeadGroupXUser::insert([[
                                 'CU_CODE' => $userCopy['code'],
                                 'CG_CODE' => $subgroup,
                                 'CS_CODE' => 1
                            ]]);
                
              // Si pertenece a una red  
              } elseif ($group) {
                  
                  CeadGroupXUser::insert([[
                                 'CU_CODE' => $userCopy['code'],
                                 'CG_CODE' => $group,
                                 'CS_CODE' => 1
                            ]]);

              // Si esta en blanco entonces sus miembros tambien
              } else {

                  // No hacemos nada

              }

          }

          // Actualizamos el grupo al que pertenece el ususario
          $this->groupXUsersRefresh($user, $subgroup, $group);

          // Guardamos los datos
          DB::commit();

      } catch (Error $e) {

          DB::rollBack();

          throw new Exception("Problemas al guardar los datos", $e->getMessage());

      }

    }

    public function update (Request $request) {

    	return 'Until work';

    }

    public function subgroup (Request $request) {

        $group = $request->group;
        $target = $request->target;

        $subgroups = CeadGroupXGroup::join('CEAD_GROUPS', 'CEAD_GROUP_X_GROUPS.CG_CODE', '=', 'CEAD_GROUPS.CG_CODE')
                                    ->where('CG_PARENT_CODE', '=', $group)
                                    ->select(
                                        'CEAD_GROUPS.CG_CODE AS code',
                                        'CG_SUBCODE AS subcode'
                                    )
                                    ->get();

        return compact('subgroups', 'target');

    }

    private function groupXUsersRefresh($user, $subgroup, $group) {

        // Recuperamos el subgrupo o el grupo para el usuario actual
        $actualGroup = CeadGroupXUser::join('CEAD_USERS', 'CEAD_GROUP_X_USERS.CU_CODE', '=', 'CEAD_USERS.CU_CODE')
                               ->join('CEAD_GROUPS',  'CEAD_GROUP_X_USERS.CU_CODE', '=', 'CEAD_GROUPS.CG_CODE')
                               ->where([
                                    ['CEAD_USERS.CU_CODE', '=', $user],
                                    ['CEAD_GROUP_X_USERS.CS_CODE', '=', 1]
                                ])
                               ->select('CGXU_CODE as code')
                               ->get();

        $actualGroup = $actualGroup->toArray();
        
        // Si la petición incluye un subgrupo entonces
        if ($subgroup) {


            if (!count($actualGroup)) {

                // Insertamos
                CeadGroupXUser::insert([[
                                    'CU_CODE' => $user,
                                    'CG_CODE' => $subgroup,
                                    'CS_CODE' => 1
                               ]]);

            // Si la relación existía de antemano
            } elseif ($group == $actualGroup[0]['code']) {
                                
                // No hacemos nada                  

            } else {
                
                // Actualizamos
                CeadGroupXUser::where([
                                  ['CU_CODE', '=', $user],
                                  ['CS_CODE', '=', 1]
                              ])
                              ->update(['CG_CODE' => $subgroup]);

            }
        
        // Caso en que solo se haya seleccionado la red
        } elseif ($group) {
            
            if (!count($actualGroup)) {

                // Insertamos
                CeadGroupXUser::insert([[
                                    'CU_CODE' => $user,
                                    'CG_CODE' => $group,
                                    'CS_CODE' => 1
                               ]]);

            // Si la relación existía de antemano
            } elseif ($group == $actualGroup[0]['code']) {
                                
                // no hacemos nada                  

            } else {
                
                // Actualizamos
                CeadGroupXUser::where([
                                  ['CU_CODE', '=', $user],
                                  ['CS_CODE', '=', 1]
                              ])
                              ->update(['CG_CODE' => $group]);

            }

        } else {

            // Actualizamos el registro para poner en estado inactivo
            // las relaciones entre grupo y usuarios
            CeadGroupXUser::where([
                                ['CU_CODE', '=', $user]
                          ])
                          ->update(['CS_CODE' => 2]);

        }

    }
}
