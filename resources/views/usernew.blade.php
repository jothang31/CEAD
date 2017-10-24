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
    <div class="middle-container padding-top">
      <div class="avatar-container middle-top-over circle">
        <img src="{{ asset('assets/custom/images/pictures/users/avatar.png') }}" class="avatar" id="userAvatar" data-target="inputAvatar" alt="">
      </div>
      <div class="container-fluid"> 
        <form  method="post" id="formUser" action="new/save">
          <input type="hidden" name="formId" value="formUser">
          <input type="file" name="avatar" id="inputAvatar" accept="image/*" style="display: none;"> 
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
              <input type="text" name="user" class="form-control" id="inputUser" placeholder="Usuario">
            </div>
            <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
            <div class="col-sm-4">
              <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Contraseña">
            </div>
          </div>
          <div class="form-group row">
            <label for="selectProfile" class="col-sm-2 col-form-label">Perfil</label>
            <div class="col-sm-3">
              <select name="profile" id="selectProfile">
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
              <input type="text" name="firstName" class="form-control" id="inputFirstName" placeholder="Primer nombre">
            </div>
            <label for="inputMiddleName" class="col-sm-2 col-form-label">Segundo nombre</label>
            <div class="col-sm-4">
              <input type="text" name="middleName" class="form-control" id="inputMiddleName" placeholder="Segundo nombre">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputLastName" class="col-sm-2 col-form-label">Primer apellido</label>
            <div class="col-sm-4">
              <input type="text" name="lastName" class="form-control" id="inputLastName" placeholder="Primer apellido">
            </div>
            <label for="inputSecondSurname" class="col-sm-2 col-form-label">Segundo apellido</label>
            <div class="col-sm-4">
              <input type="text" name="secondSurname" class="form-control" id="inputSecondSurname" placeholder="Segundo apellido">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputBornDate" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
            <div class="col-sm-2">
              <input type="date" name="bornDate"  class="form-control" id="inputBornDate" placeholder="dd/mm/yyyy">
            </div>         
            <label for="selectGender" class="col-sm-2 col-form-label">Sexo</label>
            <div class="col-sm-2">
             <select name="gender" id="selectGender">
              @foreach($genders as $gender)
          
                <option value={{ $gender->CG_CODE }}>{{ $gender->CG_DESCRIPTION }}</option>

              @endforeach
             </select>
            </div>
            <label for="selectMaritalStatus" class="col-sm-2 col-form-label">Estado civil</label>
            <div class="col-sm-2">
             <select name="maritalStatus" id="selectMaritalStatus">
              @foreach($maritalstatus as $maritalstat)
          
                <option value={{ $maritalstat->CMS_CODE }}>{{ $maritalstat->CMS_NAME }}</option>

              @endforeach
             </select>
            </div>            
          </div>
          <div class="form-group row">
            <label for="inputCellPhoneNumber" class="col-sm-2 col-form-label">Celular</label>
            <div class="col-sm-2">
              <input type="text" name="cellPhoneNumber" class="form-control" id="inputCellPhoneNumber" placeholder="Celular">
            </div>
            <label for="inputMail" class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-3">
              <input type="mail"  name="mail" class="form-control" id="inputMail" placeholder="Correo">
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
             <select name="residentCountryDepartment" id="selectResidentCountryDepartment"  data-target="selectResidentMunicipality">
              @foreach($countryDepartments as $countryDepartment)
          
                <option value={{ $countryDepartment->CCD_CODE }}>{{ $countryDepartment->CCD_NAME }}</option>

              @endforeach
             </select>
            </div>      
            <label for="selectResidentMunicipality" class="col-sm-2 col-form-label">Municipio</label>
            <div class="col-sm-2">
             <select name="residenMunicipality" id="selectResidentMunicipality" data-target="selectResidentZone">
              @foreach($municipalities as $municipality)
          
                <option value={{ $municipality->CM_CODE }}>{{ $municipality->CM_NAME }}</option>

              @endforeach
             </select>
            </div>      
            <label for="selectResidentZone" class="col-sm-2 col-form-label">Zona</label>
            <div class="col-sm-2">
             <select name="residentZone" id="selectResidentZone">
              @foreach($zones as $zone)
          
                <option value={{ $zone->CZ_CODE }}>{{ $zone->CZ_NAME }}</option>

              @endforeach
             </select>
            </div>                 
          </div>
          <div class="form-group row">
            <label for="inputResidentAddress" class="col-sm-2 col-form-label">Dirección</label>
            <div class="col-sm-4">
              <input type="text"  name="residentAddress" class="form-control" id="inputResidentAddress" placeholder="Dirección">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputResidentPhoneNumber" class="col-sm-2 col-form-label">Teléfono</label>
            <div class="col-sm-2">
              <input type="text" name="residentPhoneNumber" class="form-control" id="inputResidentPhoneNumber" placeholder="Teléfono">
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
               <select name="workCountryDepartment" id="selectWorkCountryDepartment" data-target="selectWorkMunicipality">
                @foreach($countryDepartments as $countryDepartment)
            
                  <option value={{ $countryDepartment->CCD_CODE }}>{{ $countryDepartment->CCD_NAME }}</option>

                @endforeach
               </select>
              </div>      
              <label for="selectWorkMunicipality" class="col-sm-2 col-form-label">Municipio</label>
              <div class="col-sm-2">
               <select name="workMunicipality" id="selectWorkMunicipality" data-target="selectWorkZone">
                @foreach($municipalities as $municipality)
            
                  <option value={{ $municipality->CM_CODE }}>{{ $municipality->CM_NAME }}</option>

                @endforeach             
               </select>
              </div>      
              <label for="selectWorkZone" class="col-sm-2 col-form-label">Zona</label>
              <div class="col-sm-2">
               <select name="workZone" id="selectWorkZone" >
                @foreach($zones as $zone)
            
                  <option value={{ $zone->CZ_CODE }}>{{ $zone->CZ_NAME }}</option>

                @endforeach
               </select>
              </div>              
            </div>
            <div class="form-group row">
              <label for="inputWorkAddress" class="col-sm-2 col-form-label">Dirección</label>
              <div class="col-sm-4">
                <input type="text"  name="workAddress" class="form-control" id="inputWorkAddress" placeholder="Dirección">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputWorkCellPhoneNumber" class="col-sm-2 col-form-label">Celular</label>
              <div class="col-sm-2">
                <input type="text" name="workCellPhoneNumber" class="form-control" id="inputWorkCellPhoneNumber" placeholder="Celular">
              </div> 
              <label for="inputWorkPhoneNumber" class="col-sm-2 col-form-label">Teléfono</label>
              <div class="col-sm-2">
                <input type="text" name="workPhoneNumber" class="form-control" id="inputWorkPhoneNumber" placeholder="Teléfono">
              </div>
              <label for="inputWorkMail" class="col-sm-1 col-form-label">Correo</label>
              <div class="col-sm-3">
                <input type="mail" name="workMail" class="form-control" id="inputWorkMail" placeholder="Correo">
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
               <select name="studyCountryDepartment" id="selectStudyCountryDepartment" data-target="selectStudyMunicipality">
                @foreach($countryDepartments as $countryDepartment)
            
                  <option value={{ $countryDepartment->CCD_CODE }}>{{ $countryDepartment->CCD_NAME }}</option>

                @endforeach
               </select>
              </div>      
              <label for="selectStudyMunicipality" class="col-sm-2 col-form-label">Municipio</label>
              <div class="col-sm-2">
               <select name="studyMunicipality" id="selectStudyMunicipality" data-target="selectStudyZone">
                @foreach($municipalities as $municipality)
            
                  <option value={{ $municipality->CM_CODE }}>{{ $municipality->CM_NAME }}</option>

                @endforeach                   
               </select>
              </div>      
              <label for="selectStudyZone" class="col-sm-2 col-form-label">Zona</label>
              <div class="col-sm-2">
               <select name="studyZone" id="selectStudyZone">
                @foreach($zones as $zone)
            
                  <option value={{ $zone->CZ_CODE }}>{{ $zone->CZ_NAME }}</option>

                @endforeach             
               </select>
              </div>              
            </div>
            <div class="form-group row">
              <label for="inputStudyAddress" class="col-sm-2 col-form-label">Dirección</label>
              <div class="col-sm-4">
                <input type="text" name="studyAddress" class="form-control" id="inputStudyAddress" placeholder="Dirección">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputStudyMail" class="col-sm-2 col-form-label">Correo</label>
              <div class="col-sm-3">
                <input type="text" name="studyMail" class="form-control" id="inputStudyMail" placeholder="Correo">
              </div>
            </div>
          </div> 
          <div class="form-group row">
            <div class="col-xs-12 text-right">
              <input type="submit" name="inputSave"  class="btn btn-primary" value="Guardar">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('custom-js')
  <script src="{{ asset('assets/custom/js/usernew.js') }}"></script>
@endsection