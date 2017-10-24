@extends('layout')

@section('title')
  Usuarios
@endsection

@section('main-list')
  <div class="main-list center">
    <a href="/" class="main-list-item actived">INICIO</a>
      <a href="../user" class="main-list-item actived">USUARIOS</a>
      <a href="../region" class="main-list-item actived">REGIONES</a>
    <a href="../../logout" class="main-list-item">SALIR</a>
  </div>
@endsection

@section('main-section')
  <div class="parallax-container parallax-default">
  </div>
  <div class="handling-container">
    <div class="middle-container">
      <div class="avatar-container middle-top-over">
        <img src="{{ asset('assets/custom/images/pictures/default/avatar-1.png') }}" class="avatar" alt="">
      </div>
      <div class="container-fluid"> 
        <form  method="post" action="admin/user/save">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-xs-12">
              <div class="title-center unmargin">
                <h5 class="title">DATOS DE INGRESO</h5>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputUser" class="col-sm-2 col-form-label">Usuario</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputUser" name="user" placeholder="Usuario">
            </div>
            <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
            <div class="col-sm-4">
              <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Contraseña">
            </div>
          </div>
          <div class="form-group row">
            <label for="selectProfile" class="col-sm-2 col-form-label">Perfil</label>
            <div class="col-sm-3">
              <select id="selectProfile" name="profile">
              @foreach($profiles as $profile)

                <option value={{ $profile->CP_CODE }}>{{ $profile->CP_NAME }}</option>

              @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="title-center unmargin">
                <h5 class="title">DATOS PERSONALES</h5>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputFirstName" class="col-sm-2 col-form-label">Primer nombre</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputFirstName" name="firstName" placeholder="Primer nombre">
            </div>
            <label for="inputMiddleName" class="col-sm-2 col-form-label">Segundo nombre</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputMiddleName" name="middleName" placeholder="Segundo nombre">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputLastName" class="col-sm-2 col-form-label">Primer apellido</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputLastName" name="lastName" placeholder="Primer apellido">
            </div>
            <label for="inputSecondSurname" class="col-sm-2 col-form-label">Segundo apellido</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputSecondSurname" name="secondSurname" placeholder="Segundo apellido">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputBornDate" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
            <div class="col-sm-2">
              <input type="date" class="form-control" id="inputBornDate" name="bornDate" placeholder="dd/mm/yyyy">
            </div>         
            <label for="selectGender" class="col-sm-2 col-form-label">Sexo</label>
            <div class="col-sm-2">
             <select id="selectGender" name="gender">
              @foreach($genders as $gender)
          
                <option value={{ $gender->CG_CODE }}>{{ $gender->CG_DESCRIPTION }}</option>

              @endforeach
             </select>
            </div>
            <label for="selectMaritalStatus" class="col-sm-2 col-form-label">Estado civil</label>
            <div class="col-sm-2">
             <select id="selectMaritalStatus" name="maritalStatus">
              @foreach($maritalstatus as $maritalstat)
          
                <option value={{ $maritalstat->CMS_CODE }}>{{ $maritalstat->CMS_NAME }}</option>

              @endforeach
             </select>
            </div>            
          </div>
          <div class="form-group row">
            <label for="inputCellPhoneNumber" class="col-sm-2 col-form-label">Celular</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="inputCellPhoneNumber" name="cellPhoneNumber" placeholder="Celular">
            </div>
            <label for="inputMail" class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-3">
              <input type="mail" class="form-control" id="inputMail" name="mail" placeholder="Correo">
            </div>   
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="title-center">
                <h5 class="title">RESIDENCIA</h5>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="selectResidentCountryDepartment" class="col-sm-2 col-form-label">Departamento</label>
            <div class="col-sm-2">
             <select name="selectDepartment" id="selectResidentCountryDepartment" name="residentCountryDepartment" data-target="selectResidentMunicipality">
              @foreach($countryDepartments as $countryDepartment)
          
                <option value={{ $countryDepartment->CCD_CODE }}>{{ $countryDepartment->CCD_NAME }}</option>

              @endforeach
             </select>
            </div>      
            <label for="selectResidentMunicipality" class="col-sm-2 col-form-label">Municipio</label>
            <div class="col-sm-2">
             <select name="selectMunicipality" id="selectResidentMunicipality" data-target="selectResidentZone">
              @foreach($municipalities as $municipality)
          
                <option value={{ $municipality->CM_CODE }}>{{ $municipality->CM_NAME }}</option>

              @endforeach
             </select>
            </div>      
            <label for="selectResidentZone" class="col-sm-2 col-form-label">Zona</label>
            <div class="col-sm-2">
             <select name="" id="selectResidentZone" name="residentZone">
              @foreach($zones as $zone)
          
                <option value={{ $zone->CZ_CODE }}>{{ $zone->CZ_NAME }}</option>

              @endforeach
             </select>
            </div>                 
          </div>
          <div class="form-group row">
            <label for="inputResidentAddress" class="col-sm-2 col-form-label">Dirección</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputResidentAddress" name="residentAddress" placeholder="Dirección">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputResidentPhoneNumber" class="col-sm-2 col-form-label">Teléfono</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="inputResidentPhoneNumber" name="residentPhoneNumber" placeholder="Teléfono">
            </div>             
          </div>  
          <div class="row">
            <div class="col-xs-12">
                <div class="title-center">
                  <label class="label-button" role="button">
                      <input type="checkbox" name="workContainerStatus" data-target="workContainer">
                      <h5 class="title">TRABAJO</h5>
                  </label>
                </div>
            </div>
          </div> 
          <div class="undisplay" id="workContainer">
            <div class="form-group row">
              <label for="selectWorkCountryDepartment" class="col-sm-2 col-form-label">Departamento</label>
              <div class="col-sm-2">
               <select name="" id="selectWorkCountryDepartment" name="workCountryDepartment" data-target="selectWorkMunicipality">
                @foreach($countryDepartments as $countryDepartment)
            
                  <option value={{ $countryDepartment->CCD_CODE }}>{{ $countryDepartment->CCD_NAME }}</option>

                @endforeach
               </select>
              </div>      
              <label for="selectWorkMunicipality" class="col-sm-2 col-form-label">Municipio</label>
              <div class="col-sm-2">
               <select name="" id="selectWorkMunicipality" name="workMunicipality" data-target="selectWorkZone">
                @foreach($municipalities as $municipality)
            
                  <option value={{ $municipality->CM_CODE }}>{{ $municipality->CM_NAME }}</option>

                @endforeach             
               </select>
              </div>      
              <label for="selectWorkZone" class="col-sm-2 col-form-label">Zona</label>
              <div class="col-sm-2">
               <select name="" id="selectWorkZone" name="workZone">
                @foreach($zones as $zone)
            
                  <option value={{ $zone->CZ_CODE }}>{{ $zone->CZ_NAME }}</option>

                @endforeach
               </select>
              </div>              
            </div>
            <div class="form-group row">
              <label for="inputWorkAddress" class="col-sm-2 col-form-label">Dirección</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="inputWorkAddress" name="workAddress" placeholder="Dirección">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputWorkCellPhoneNumber" class="col-sm-2 col-form-label">Celular</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="inputWorkCellPhoneNumber" name="workCellPhoneNumber" placeholder="Celular">
              </div> 
              <label for="inputWorkPhoneNumber" class="col-sm-2 col-form-label">Teléfono</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="inputWorkPhoneNumber" name="workPhoneNumber" placeholder="Teléfono">
              </div>
              <label for="inputWorkMail" class="col-sm-1 col-form-label">Correo</label>
              <div class="col-sm-3">
                <input type="mail" class="form-control" id="inputWorkMail" name="workMail" placeholder="Correo">
              </div>    
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
                <div class="title-center">
                  <label class="label-button" role="button">
                      <input type="checkbox" name="studyContainerStatus" data-target="studyContainer">
                      <h5 class="title">ESTUDIO</h5>
                  </label>
                </div>
            </div>
          </div>
          <div class="undisplay" id="studyContainer">
            <div class="form-group row">
              <label for="selectStudyCountryDepartment" class="col-sm-2 col-form-label">Departamento</label>
              <div class="col-sm-2">
               <select name="" id="selectStudyCountryDepartment" name="studyCountryDepartment" data-target="selectStudyMunicipality">
                @foreach($countryDepartments as $countryDepartment)
            
                  <option value={{ $countryDepartment->CCD_CODE }}>{{ $countryDepartment->CCD_NAME }}</option>

                @endforeach
               </select>
              </div>      
              <label for="selectStudyMunicipality" class="col-sm-2 col-form-label">Municipio</label>
              <div class="col-sm-2">
               <select id="selectStudyMunicipality" name="studyMunicipality" data-target="selectStudyZone">
                @foreach($municipalities as $municipality)
            
                  <option value={{ $municipality->CM_CODE }}>{{ $municipality->CM_NAME }}</option>

                @endforeach                   
               </select>
              </div>      
              <label for="selectStudyZone" class="col-sm-2 col-form-label">Zona</label>
              <div class="col-sm-2">
               <select id="selectStudyZone" name="studyZone">
                @foreach($zones as $zone)
            
                  <option value={{ $zone->CZ_CODE }}>{{ $zone->CZ_NAME }}</option>

                @endforeach             
               </select>
              </div>              
            </div>
            <div class="form-group row">
              <label for="inputStudyAddress" class="col-sm-2 col-form-label">Dirección</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="inputStudyAddress" name="studyAddress" placeholder="Dirección">
              </div>
            </div>
          </div> 
          <div class="form-group row">
            <div class="col-xs-12 text-right">
              <input type="submit" class="btn btn-primary" name="inputSave" value="Guardar">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('custom-js')
  <script src="{{ asset('assets/custom/js/userupdate.js') }}"></script>
@endsection