<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use App\CeadCountryDepartment;
use App\CeadGender;
use App\CeadMaritalStatus;
use App\CeadZone;
use App\CeadMunicipality;
use App\CeadProfile;
use App\CeadUser;
use App\CeadContactInfo;
use App\CeadUsersInfo;
use App\CeadPhoneNumber;

class UserController extends Controller
{

    public function get (Request $request) {

        $code = $request->code;

        $user = CeadUser::join('CEAD_USERS_INFOS', 'CEAD_USERS.CU_CODE', '=', 'CEAD_USERS_INFOS.CU_CODE')
                        ->join('CEAD_MARITAL_STATUSES', 'CEAD_USERS_INFOS.CMS_CODE', '=', 'CEAD_MARITAL_STATUSES.CMS_CODE')
                        ->join('CEAD_GENDERS', 'CEAD_USERS_INFOS.CG_CODE', '=', 'CEAD_GENDERS.CG_CODE')
                        ->where('CEAD_USERS.CU_CODE', '=', $code)
                        ->select(
                            'CEAD_USERS_INFOS.CUI_CODE',
                            'CU_ID AS userId', 
                            'CU_NAME_PICTURE_PROFILE AS avatar', 
                            DB::raw("CONCAT_WS(
                                ' ', 
                                CUI_FIRST_NAME,
                                CUI_MIDDLE_NAME,
                                CUI_LAST_NAME,
                                CUI_SECOND_SURNAME
                            ) AS name"),
                            DB::raw("DATE_FORMAT(CUI_BORN_DATE, '%d/%m/%Y') AS born"),
                            'CMS_NAME AS maritalStatus',
                            'CG_DESCRIPTION AS gender'
                        )
                        ->get();

        // Extraemos el codigo de CEAD_USERS_INFOS
        $user = $user->toArray();

        $contactInfos = CeadContactInfo::join('CEAD_USERS_INFOS', 'CEAD_CONTACT_INFOS.CUI_CODE', '=', 'CEAD_USERS_INFOS.CUI_CODE')
                                       ->join('CEAD_CONTACT_INFO_TYPES', 'CEAD_CONTACT_INFOS.CCIT_CODE', '=', 'CEAD_CONTACT_INFO_TYPES.CCIT_CODE')
                                       ->join('CEAD_ZONES', 'CEAD_CONTACT_INFOS.CZ_CODE', '=', 'CEAD_ZONES.CZ_CODE')
                                       ->join('CEAD_MUNICIPALITIES', 'CEAD_ZONES.CM_CODE', '=', 'CEAD_MUNICIPALITIES.CM_CODE')
                                       ->join('CEAD_COUNTRY_DEPARTMENTS', 'CEAD_MUNICIPALITIES.CCD_CODE', '=', 'CEAD_COUNTRY_DEPARTMENTS.CCD_CODE')
                                       ->where('CEAD_CONTACT_INFOS.CUI_CODE', '=', $user[0]['CUI_CODE'])
                                       ->select(
                                             'CEAD_CONTACT_INFOS.CCI_CODE',
                                             'CEAD_CONTACT_INFOS.CCIT_CODE AS type',
                                             'CCI_EMAIL AS email',
                                             'CCI_ADDRESS AS address',
                                             'CZ_NAME AS zone',
                                             'CM_NAME AS municipality',
                                             'CCD_NAME AS countryDepartment'
                                       )
                                       ->get();

        $contactInfos = $contactInfos->toArray();

        array_walk ($contactInfos, function (&$contactInfo, $key) {

            $phoneNumbers = CeadPhoneNumber::join('CEAD_CONTACT_INFOS', 'CEAD_PHONE_NUMBERS.CCI_CODE', '=', 'CEAD_CONTACT_INFOS.CCI_CODE')
                                           ->where('CEAD_PHONE_NUMBERS.CCI_CODE', '=', $contactInfo['CCI_CODE'])
                                           ->select(
                                                'CPNT_CODE AS type',
                                                'CPN_NUMBER AS phoneNumber'
                                           )
                                           ->get();

            $phoneNumbers = $phoneNumbers->toArray();

            $contactInfo['phoneNumbers'] = $phoneNumbers;

        });

        array_walk($user, function (&$u, $key) use ($contactInfos){

            $u['contactInfos'] = $contactInfos;

        });

        return $user;

    } 

    public function getMatch (Request $request) {

        $string = preg_replace('/-+|\s/', '', trim($request->string));
        $string = strtolower($string);
        $target = $request->dataTarget;

        $matches = null;

        if ($string) {

        // Obtenemos los usuarios que concuerdan
        $matches = CeadUser::join('CEAD_USERS_INFOS', 'CEAD_USERS.CU_CODE', '=', 'CEAD_USERS_INFOS.CU_CODE')
                           ->where('CU_ID', 'like', '%'.$string.'%')
                           ->orWhere(DB::raw('LOWER(CONCAT(
                                CUI_FIRST_NAME, 
                                CUI_MIDDLE_NAME,
                                CUI_LAST_NAME,
                                CUI_SECOND_SURNAME
                            ))'), 'like', '%'.$string.'%')
                           ->select('CEAD_USERS.CU_CODE AS code', DB::raw("CONCAT_WS(
                                ' ', 
                                CUI_FIRST_NAME,
                                CUI_MIDDLE_NAME,
                                CUI_LAST_NAME,
                                CUI_SECOND_SURNAME
                            ) AS name"), 'CU_NAME_PICTURE_PROFILE AS avatar')
                           ->distinct('CEAD_USERS.CU_CODE')
                           ->take(5)
                           ->get();
        }

        return compact('target', 'matches');

    }

    public function show () {

        return view('user');

    }

    public function newShow () {

        // Variables fillable
        $countryDepartments = CeadCountryDepartment::all();
        $municipalities;
        $zones;
        
        $profiles = CeadProfile::all();//where('CP_CODE', '<>', 1)->get();
        $genders = CeadGender::all();
        $maritalstatus = CeadMaritalStatus::all();

        if (count($countryDepartments->toArray())) {

            // Solo los municipios del primer departamento
            $countryDepartmentCode = $countryDepartments->toArray()[0]['CCD_CODE'];
            $municipalities = CeadMunicipality::where('CCD_CODE', '=', $countryDepartmentCode)->get();

            if (count($municipalities->toArray())) {
                
                $municipality = $municipalities->toArray()[0]['CM_CODE'];
                // solo las zonas del primer municipio
                $zones = CeadZone::where('CM_CODE', '=', $municipality);

            } else {

                $municipalities = [];

            }

        } else {

            $countryDepartments = [];

        }

        // Retornamos la vista
        return view('usernew', compact(
            'profiles',
            'genders', 
            'maritalstatus',
            'countryDepartments',
            'municipalities',
            'zones'
        ));

    }

    public function updateShow (Request $request) {

        return view('userupdate');

    }

    public function save(Request $request) {

        $avatar = $request->avatar;

        // Datos de ingreso
    	$user = trim($request->user);
        $password = trim($request->password);
        $avatarName = $user.'-'.date('YmdHms');
        $profile = $request->profile;

        // Datos personales
        $firsName = trim($request->firstName);
        $middleName = trim($request->middleName);
        $lastName = trim($request->lastName);
        $secondSurname = trim($request->secondSurname);
        $bornDate = date('Y-m-d', strtotime(str_replace('/', '-', trim($request->bornDate))));
        $gender = $request->gender;
        $maritalStatus = $request->maritalStatus;
        
        // Datos de contacto y localización
        $cellPhoneNumber = trim($request->cellPhoneNumber);
        $mail = trim($request->mail);
        $residentPhoneNumber = $request->residentPhoneNumber;
        $residentZone = $request->residentZone;
        $residentAddress = $request->residentAddress;
        $workZone = $request->workZone;
        $workCellPhoneNumber = $request->workCellPhoneNumber;
        $workAddress = $request->workAddress;
        $workPhoneNumber = $request->workPhoneNumber;
        $workMail = $request->workMail;
        $studyZone = $request->studyZone;
        $studyAddress = $request->studyAddress;
        $studyMail = $request->studyMail;
        $workContainerStatus = $request->workContainerStatus;
        $studyContainerStatus = $request->studyContainerStatus;

        // Otros datos
        $form = $request->formId;

        DB::beginTransaction();

        try {

            /* 
            |---------------------------------------------------
            | Transacción 1
            |---------------------------------------------------
            | Creamos el objeto que referencia a CEAD_USERS
            */

            $ceadUser = new CeadUser;

            // Agregamos los datos
            $ceadUser->CU_ID = $user;
            $ceadUser->CU_PASSWORD = md5($password);
            $ceadUser->CU_NAME_PICTURE_PROFILE = $avatarName;
            $ceadUser->CP_CODE = $profile;
            $ceadUser->CS_CODE = 1;

            // Guardamos los datos;
            $ceadUser->save();

            /*
            |---------------------------------------------------
            | Transacción 2
            |---------------------------------------------------
            | Creamos el objeto que referencia a CEAD_USERS_INFOS
            */

            // Recuperamos la llave principal de CeadUsers
            $recordUser = CeadUser::all()->last();

            $ceadUsersInfo = new CeadUsersInfo;

            // Agregamos los datos
            $ceadUsersInfo->CUI_FIRST_NAME = $firsName;
            $ceadUsersInfo->CUI_MIDDLE_NAME = $middleName;
            $ceadUsersInfo->CUI_LAST_NAME = $lastName;
            $ceadUsersInfo->CUI_SECOND_SURNAME = $secondSurname;
            $ceadUsersInfo->CUI_BORN_DATE = $bornDate;
            $ceadUsersInfo->CMS_CODE = $maritalStatus;
            $ceadUsersInfo->CG_CODE = $gender;
            $ceadUsersInfo->CU_CODE = $recordUser->CU_CODE;

            $ceadUsersInfo->save();

            /*
            |---------------------------------------------------
            | Transacción 3
            |---------------------------------------------------
            | Creamos el objeto que referencia a CEAD_CONTACT_INFOS
            */

            // Recuperamos la llave primaria de CeadUsersInfo
            $recordUserInfo = CeadUsersInfo::all()->last();

            $ceadContactInfo = new CeadContactInfo;

            $contactInfos = array(
                array(
                    'CCI_EMAIL' => $mail,
                    'CCI_ADDRESS' => $residentAddress,
                    'CZ_CODE' => $residentZone,
                    'CUI_CODE' => $recordUserInfo->CUI_CODE,
                    'CCIT_CODE' => 1
                )
            );

            // Agregamos los datos
            CeadContactInfo::insert($contactInfos);

            /*
            |---------------------------------------------------
            | Transacción 4
            |---------------------------------------------------
            | Creamos el objeto que referencia a CEAD_PHONES 
            | que posteriormente tambien lo utilizamos en otras 
            | transacciones
            */

            // Recuperamos la llave primaria de CeadContactInfo
            $recordContactInfo = CeadContactInfo::all()->last();

            // Declaramos la variable que contiene mas de 1 inserción
            // puesto que al realizarla de otra manera produce error

            $phoneNumbers = [];

            if ($cellPhoneNumber) {
                
                array_push( 
                    $phoneNumbers,
                    array(
                        'CPN_NUMBER' => $cellPhoneNumber, 
                        'CPNT_CODE' => 1,
                        'CCI_CODE' => $recordContactInfo->CCI_CODE,
                    )
                );

            }

            if ($residentPhoneNumber) {

                array_push(
                    $phoneNumbers, 
                    array(
                        'CPN_NUMBER' => $residentPhoneNumber,
                        'CPNT_CODE' => 2,  
                        'CCI_CODE' => $recordContactInfo->CCI_CODE,
                    )
                );

            }

            // Agregamos los datos
            CeadPhoneNumber::insert($phoneNumbers);

            // Creamos el arreglo que contendra todos los numeros
            $phoneNumbers = [];

            if ($workContainerStatus) {

                $contactInfos = array(
                    array(
                        'CCI_EMAIL' => $workMail,
                        'CCI_ADDRESS' => $workAddress,
                        'CZ_CODE' => $workZone,
                        'CUI_CODE' => $recordUserInfo->CUI_CODE,
                        'CCIT_CODE' => 2
                    )
                );

                // Agregamos los datos
                CeadContactInfo::insert($contactInfos);

                // Recuperamos la llave primaria de CeadContactInfo
                $recordContactInfo = CeadContactInfo::all()->last();  

                if ($workCellPhoneNumber) {

                    array_push( 
                        $phoneNumbers,
                        array(
                            'CPN_NUMBER' => $workCellPhoneNumber,
                            'CPNT_CODE' => 1,
                            'CCI_CODE' => $recordContactInfo->CCI_CODE
                        )
                    );

                }

                if ($workPhoneNumber) {

                    array_push( 
                        $phoneNumbers,
                        array(
                            'CPN_NUMBER' => $workPhoneNumber, 
                            'CPNT_CODE' => 2,
                            'CCI_CODE' => $recordContactInfo->CCI_CODE
                        )
                    );

                }

                // Insertamos los datos
                CeadPhoneNumber::insert($phoneNumbers);

            }

            if ($studyContainerStatus) {

                $contactInfos = array(
                    array(
                        'CCI_EMAIL' => $studyMail,
                        'CCI_ADDRESS' => $studyAddress,
                        'CZ_CODE' => $studyZone,
                        'CUI_CODE' => $recordUserInfo->CUI_CODE,
                        'CCIT_CODE' => 3
                    )
                );

                // Agregamos los datos
                CeadContactInfo::insert($contactInfos);

            }

            // Finalmente guardamos la imagen del avatar en la carpeta
            // assets/custom/images/pictures/users/
            $avatar->move(public_path('assets/custom/images/pictures/users/'), $avatarName);

            DB::commit();

        } catch (Exception $e) {
            
            DB::rollBack();

            throw new Exception("Problemas al guardar los datos", $e->getMessage());
            
        }

        return compact('form');

    }

    public function update (Request $request) {



    }
}
