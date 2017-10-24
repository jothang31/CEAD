@extends('layout')

@section('title')
  Regiones
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
  			<div class="container-fluid">
  				<div class="avatar-container middle-top-over circle">
                    <img src="{{ asset('assets/custom/images/pictures/default/location.png') }}" class="avatar" alt="">
      			</div> 
  				<form method="get" id="formCountryDepartment" action="../../countrydepartment/save">
  				  	<input type="hidden" name="formId" value="formCountryDepartment">
  				  	<input type="hidden" name="dataTarget" value="selectCountryDepartment">
		            <div class="row">
		                <div class="col-xs-12">
		                    <div class="title-center unmargin">
		                         <h5 class="title">DEPARTAMENTO</h5>
		                    </div>
		                </div>
		            </div>
		        	<div class="form-group row">
		            	<label for="inputCountryDepartmentCode" class="col-sm-2 col-form-label">Departamento</label>
		            	<div class="col-sm-4">
		              		<input type="text" class="form-control" id="inputCountryDepartmentCode" name="countryDepartmentCode" placeholder="Código">
		            	</div>
		            	<label for="inputCountryDepartmentName" class="col-sm-2 col-form-label">Nombre</label>
		            	<div class="col-sm-4">
		              		<input type="text" class="form-control" id="inputCountryDepartmentName" name="countryDepartmentName" placeholder="Nombre">
		            	</div>
		        	</div>	
		            <div class="form-group row">
		                <div class="col-xs-12 text-right">
		                    <input type="submit" class="btn btn-primary" name="inputSave" value="Guardar">
		                </div>
		            </div>	          	
  				</form>
  				<form method="get" id="formMunicipality" action="../../municipality/save">
  				  	<input type="hidden" name="formId" value="formMunicipality">  	
  					<input type="hidden" name="dataTarget" value="selectZoneMunicipality">
  					<input type="hidden" name="dataTargetContryDepartment" value="selectZoneCountryDepartment">
 		            <div class="row">
		                <div class="col-xs-12">
		                    <div class="title-center unmargin">
		                         <h5 class="title">MUNICIPIO</h5>
		                    </div>
		                </div>
		            </div>
  					<div class="form-group row">
  						<label for="selectMunicipalityCountryDepartment" class="col-sm-2 col-form-label">Departamento</label>
  						<div class="col-sm-2">  							
	  						<select name="countryDepartment" id="selectMunicipalityCountryDepartment">
			                @foreach($countryDepartments as $countryDepartment)
			            
			                  <option value={{ $countryDepartment->CCD_CODE }}>{{ $countryDepartment->CCD_NAME }}</option>

			                @endforeach
	  						</select>
  						</div>
  					</div>
		        	<div class="form-group row">
		            	<label for="inputMunicipalityCode" class="col-sm-2 col-form-label">Código</label>
		            	<div class="col-sm-4">
		              		<input type="text" class="form-control" id="inputMunicipalityCode" name="municipalityCode" placeholder="Código">
		            	</div>
		            	<label for="inputMunicipalityName" class="col-sm-2 col-form-label">Nombre</label>
		            	<div class="col-sm-4">
		              		<input type="text" class="form-control" id="inputMunicipalityName" name="municipalityName" placeholder="Nombre">
		            	</div>
		          	</div>
		            <div class="form-group row">
		                <div class="col-xs-12 text-right">
		                    <input type="submit" class="btn btn-primary" name="inputSave" value="Guardar">
		                </div>
		        	</div>		
  				</form>
  				<form method="get" id="formZone" action="../../zone/save">
  				  	<input type="hidden" name="formId" value="formZone"> 
 		            <div class="row">
		                <div class="col-xs-12">
		                    <div class="title-center unmargin">
		                         <h5 class="title">ZONA</h5>
		                    </div>
		                </div>
		            </div>
  					<div class="form-group row">
  						<label for="selectZoneCountryDepartment" class="col-sm-2 col-form-label">Departamento</label>
  						<div class="col-sm-2">		
	  						<select name="countryDepartment" id="selectZoneCountryDepartment" data-target="selectZoneMunicipality">
			                @foreach($countryDepartments as $countryDepartment)
			            
			                  <option value={{ $countryDepartment->CCD_CODE }}>{{ $countryDepartment->CCD_NAME }}</option>

			                @endforeach
	  						</select>
  						</div>
  						<label for="selectZoneMunicipality" class="col-sm-2 col-form-label">Municipio</label>
  						<div class="col-sm-2">		
	  						<select name="municipality" id="selectZoneMunicipality">
			                @foreach($municipalities as $municipality)
			            
			                  <option value={{ $municipality->CM_CODE }}>{{ $municipality->CM_NAME }}</option>

			                @endforeach 
	  						</select>
  						</div>
  					</div>
		        	<div class="form-group row">
		            	<label for="inputZoneCode" class="col-sm-2 col-form-label">Código</label>
		            	<div class="col-sm-4">
		              		<input type="text" class="form-control" id="inputZoneCode" name="zoneCode" placeholder="Código">
		            	</div>
		            	<label for="inputZoneName" class="col-sm-2 col-form-label">Nombre</label>
		            	<div class="col-sm-4">
		              		<input type="text" class="form-control" id="inputZoneName" name="zoneName" placeholder="Nombre">
		            	</div>
		          	</div>
		        	<div class="form-group row">
  						<label for="selectZoneType" class="col-sm-2 col-form-label">Tipo</label>
  						<div class="col-sm-2">		
	  						<select name="zoneType" id="selectZoneType">
			                @foreach($zoneTypes as $zoneType)
			            
			                  <option value={{ $zoneType->CZT_CODE }}>{{ $zoneType->CZT_NAME }}</option>

			                @endforeach 	  							
	  						</select>
  						</div>
   						<label for="selectZoneType" class="col-sm-2 col-form-label">Nivel</label>
  						<div class="col-sm-2">		
	  						<select name="zoneLevel" id="selectZoneType">
			                @foreach($zoneLevels as $zoneLevel)
			            
			                  <option value={{ $zoneLevel->CZL_CODE }}>{{ $zoneLevel->CZL_NAME }}</option>

			                @endforeach 	  							
	  						</select>
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
  <script src="{{ asset('assets/custom/js/regionnew.js') }}"></script>
@endsection