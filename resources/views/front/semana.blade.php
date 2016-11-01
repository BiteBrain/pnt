@extends('layout.front')

@section('content')

    <div class="Register-header">
        <h1>FORMULARIO DE INSCRIPCIÓN PARA POSTULACIONES AL PREMIO</h1>
    </div>

    @if(session('Error'))
        <section class="Message">
            <div class="notification error">
                <span class="title">!&nbsp;&nbsp;&nbsp;&nbsp;Error</span> {{session('Error')}}<span class="close">X</span>
            </div>
        </section>
    @endif

    <form action="{{ route('semanaPost') }}" enctype="multipart/form-data" method="POST" class=" Register-form">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="url" id="url" value="{{ url('ajaxTempFiles') }}">

        <h2 class="col-12">DATOS BÁSICOS DE LA ORGANIZACIÓN</h2>
        <div class=" row Register-contentLabel">
            <label class="col-10 small-10" for="org_name">
                <span>Nombre de la agrupación, grupo constituído o unión temporal</span>

                <input type="text" name="org_name" id="org_name"
                       @if(session('Error'))
                           value="{{old('org_name')}}"
                       @elseif($organization)
                           value="{{$organization->name}}"
                       @endif>

                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_name')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="type8">
                <span>Logo, foto o imagen identificativa</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type8')) || (isset($award) && $award->file(8)))
                            @if(session('Error'))
                                {{old('type8')}}
                            @else
                                {{$award->file(8)->name}}
                            @endif
                        @else
                            '(.jpg, .jpeg, .png)
                        @endif
                    </span>

                    <input type="file" id="type8" types="jpg|png|jpg" accept="image/jpg,image/jpeg,image/png">
                    <input type="hidden" name="type8"
                           @if(session('Error'))
                               value="{{old('org_name')}}"
                           @elseif(isset($award) && $award->file(8))
                               value="{{$award->file(8)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type8')}}</span>
                @endif
            </label>
            <label class="col-5  small-10" for="type9">
                <span>Cámara de comercio (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type9')) || (isset($award) && $award->file(9)))
                            @if(session('Error'))
                                {{old('type9')}}
                            @elseif($award->file(9))
                                {{$award->file(9)->name}}
                            @endif
                        @else
                            Solo para grupos constituídos
                        @endif
                    </span>
                    <input type="file" id="type9" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type9"
                           @if(session('Error'))
                               value="{{old('type9')}}"
                           @elseif(isset($award) && $award->file(9))
                               value="{{$award->file(9)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type9')}}</span>
                @endif
            </label>
            <label class="col-10 small-10" for="type5">
                <span>Dossier del grupo o compañía (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type5')) || (isset($award) && $award->file(5)))
                            @if(session('Error'))
                                {{old('type5')}}
                            @else
                                {{$award->file(5)->name}}
                            @endif
                        @else
                            Trayectoria de la compañía, reseña de su director, integrantes y repertorio
                        @endif
                    </span>
                    <input type="file" id="type5" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type5"
                           @if(session('Error'))
                               value="{{old('type5')}}"
                           @elseif(isset($award) && $award->file(5))
                               value="{{$award->file(5)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type5')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="org_region">
                <span>Región</span>
                <input type="text" name="org_region" id="org_region"
                    @if(session('Error'))
                        value="{{old('org_name')}}"
                    @elseif($organization)
                        value="{{$organization->region}}"
                    @endif>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_region')}}</span>
                @endif
            </label>

            <label for="org_city" class="col-5  small-10">
                <div class="Register-contentSelect">
                    <span>Ciudad</span>
                    <span class="Register-arrowSelect">▼</span>
                    <select name="org_city" id="org_city">
                        <option value="">Selecciona una ciudad</option>
                        <option value="Bogotá" @if((session('Error') && old('org_city') == 'Bogotá') || ($organization && $organization->city == 'Bogotá')) selected @endif >Bógota</option>
                        <option value="Medellín" @if((session('Error') && old('org_city') == 'Medellín') || ($organization && $organization->city == 'Medellín')) selected @endif >Medellín</option>
                    </select>
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_city')}}</span>
                @endif
            </label>
            <label class="col-5 small-10" for="org_address">
                <span>Dirección física</span>
                <input type="text" name="org_address" id="org_address"
                       @if(session('Error'))
                           value="{{old('org_address')}}"
                       @elseif($organization)
                           value="{{$organization->address}}"
                       @endif >
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_address')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="org_phone">
                <span>Teléfono fijo</span>
                <input type="text" name="org_phone" id="org_phone"
                       @if(session('Error'))
                           value="{{old('org_phone')}}"
                       @elseif($organization)
                           value="{{$organization->phone}}"
                       @endif >
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_phone')}}</span>
                @endif
            </label>
            <label class="col-5 small-10" for="org_mobile">
                <span>Teléfono Celular</span>
                <input type="text" name="org_mobile" id="org_mobile"
                       @if(session('Error'))
                           value="{{old('org_mobile')}}"
                       @elseif($organization)
                           value="{{$organization->mobile}}"
                       @endif >
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_mobile')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="org_email">
                <span>Correo principal</span>
                <input type="email" name="org_email" id="org_email"
                       @if(session('Error'))
                           value="{{old('org_email')}}"
                       @elseif($organization)
                           value="{{$organization->email}}"
                       @endif >
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_email')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="org_website">
                <span>Sitio Web</span>
                <input type="text" name="org_website" id="org_website"
                       @if(session('Error'))
                           value="{{old('org_website')}}"
                       @elseif($organization)
                           value="{{$organization->website}}"
                       @endif >
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_website')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type16">
                <span>Hoja de vida de la agrupación, grupo constituido o de los integrantes de la unión temporal (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type16')) || (isset($award) && $award->file(16)))
                            @if(session('Error'))
                                {{old('type16')}}
                            @else
                                {{$award->file(16)->name}}
                            @endif
                        @else
                            Mínimo 3 años de experiencia verificable.
                        @endif
                    </span>
                    <input type="file" id="type16" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type16"
                           @if(session('Error'))
                               value="{{old('type16')}}"
                           @elseif(isset($award) && $award->file(16))
                               value="{{$award->file(16)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type16')}}</span>
                @endif
            </label>
        </div>
        <h2 class="col-12">DATOS BÁSICOS DEL ESPECTÁCULO</h2>
        <div class=" row Register-contentLabel">

            <label class="col-10 small-10" for="prd_name">
                <span>Nombre del espectáculo</span>
                <input type="text" name="prd_name" id="prd_name"
                       @if(session('Error'))
                           value="{{old('prd_name')}}"
                       @elseif($production)
                           value="{{$production->name}}"
                       @endif >
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('prd_name')}}</span>
                @endif
            </label>
            <label class="col-5 small-10" for="type10">
                <span>Reseña Corta en Español (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type10')) || (isset($award) && $award->file(10)))
                            @if(session('Error'))
                                {{old('type10')}}
                            @else
                                {{$award->file(10)->name}}
                            @endif
                        @else
                            400 caracteres máx
                        @endif
                    </span>
                    <input type="file" id="type10" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type10"
                           @if(session('Error'))
                               value="{{old('type10')}}"
                           @elseif(isset($award) && $award->file(10))
                               value="{{$award->file(10)->name}}"
                           @endif >

                    @if (count($errors) > 0)
                        <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type10')}}</span>
                    @endif
                </div>
            </label>
            <label for="prd_genre" class="col-5  small-10">
                <div class="Register-contentSelect">
                    <span>Género:</span>
                    <span class="Register-arrowSelect">▼</span>
                    <select name="prd_genre" id="prd_genre">
                        <option value="">Selecciona el género</option>
                        <option value="Teatro" @if((session('Error') && old('prd_genre') == 'Teatro') || ($production && $production->genre == 'Teatro')) selected @endif >Teatro</option>
                        <option value="Circo - Teatro" @if((session('Error') && old('prd_genre') == 'Circo - Teatro') || ($production && $production->genre == 'Circo - Teatro')) selected @endif >Circo - Teatro</option>
                        <option value="Danza - Teatro" @if((session('Error') && old('prd_genre') == 'Danza - Teatro') || ($production && $production->genre == 'Danza - Teatro')) selected @endif >Danza - Teatro</option>
                        <option value="Teatro Musical" @if((session('Error') && old('prd_genre') == 'Teatro Musical') || ($production && $production->genre == 'Teatro Musical')) selected @endif >Teatro Musical</option>
                    </select>
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('prd_genre')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type3">
                <span>Certificado de Registro de derechos de Autor o Autorización de uso de la obra (pdf.)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type3')) || (isset($award) && $award->file(3)))
                            @if(session('Error'))
                                {{old('type3')}}
                            @else
                                {{$award->file(3)->name}}
                            @endif
                        @else
                            Si la obra contiene piezas musicales deben ser originales para la producción.
                        @endif
                    </span>
                    <input type="file" id="type3" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type3"
                           @if(session('Error'))
                               value="{{old('type3')}}"
                           @elseif(isset($award) && $award->file(3))
                               value="{{$award->file(3)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type3')}}</span>
                @endif
            </label>

            <h3 class="col-10">PROPUESTA DE PRODUCCIÓN.</h3>
            <p> La obra producto del premio deberá tener una duración mínima de cuarenta y cinco (45) minutos. </p>
            <label class="col-10 small-10" for="type1">
                <span>Sinópsis (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type1')) || (isset($award) && $award->file(1)))
                            @if(session('Error'))
                                {{old('type1')}}
                            @else
                                {{$award->file(1)->name}}
                            @endif
                        @else
                            Máximo 20 lineas
                        @endif
                    </span>
                    <input type="file" id="type1" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type1"
                           @if(session('Error'))
                               value="{{old('type1')}}"
                           @elseif(isset($award) && $award->file(1))
                               value="{{$award->file(1)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type1')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type2">
                <span>Texto o libreto (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type2')) || (isset($award) && $award->file(2)))
                            @if(session('Error'))
                                {{old('type2')}}
                            @else
                                {{$award->file(2)->name}}
                            @endif
                        @else
                            Los textos dramáticos presentados deben ser en español. Para teatro musical, incluir las respectivas partituras y autorizaciones de los autores.
                        @endif
                    </span>
                    <input type="file" id="type2" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type2"
                           @if(session('Error'))
                               value="{{old('type2')}}"
                           @elseif(isset($award) && $award->file(2))
                               value="{{$award->file(2)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type2')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type11">
                <span>Propuesta de dirección (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type11')) || (isset($award) && $award->file(11)))
                            @if(session('Error'))
                                {{old('type11')}}
                            @else
                                {{$award->file(11)->name}}
                            @endif
                        @else
                            Puesta en escena, metodología de trabajo y proceso de creación. 2 pag. Máx.
                        @endif
                    </span>
                    <input type="file" id="type11" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type11"
                           @if(session('Error'))
                               value="{{old('type11')}}"
                           @elseif(isset($award) && $award->file(11))
                               value="{{$award->file(11)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type11')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type12">
                <span>Propuesta Estética (.pdf) <em>Enlace a condiciones y equipamiento técnico del Teatro Colón</em></span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip" style="font-size: 11px">
                        @if((session('Error') && old('type12')) || (isset($award) && $award->file(12)))
                            @if(session('Error'))
                                {{old('type12')}}
                            @else
                                {{$award->file(12)->name}}
                            @endif
                        @else
                            Bocetos de escenografía, maquillaje, utilería, vestuario, iluminación, material sonoro o musical, requerimientos de tramoya, iluminación, recursos técnicos
                        @endif
                    </span>
                    <input type="file" id="type12" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type12"
                           @if(session('Error'))
                               value="{{old('type12')}}"
                           @elseif(isset($award) && $award->file(12))
                               value="{{$award->file(12)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type12')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type13">
                <span>Cronograma (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type13')) || (isset($award) && $award->file(13)))
                            @if(session('Error'))
                                {{old('type13')}}
                            @else
                                {{$award->file(13)->name}}
                            @endif
                        @else
                            Fases de desarrollo de la propuesta, los tiempos estimados para cada una de ellas y sus responsables.
                        @endif
                    </span>
                    <input type="file" id="type13" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type13"
                           @if(session('Error'))
                               value="{{old('type13')}}"
                           @elseif(isset($award) && $award->file(13))
                               value="{{$award->file(13)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type13')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type14">
                <span>Presupuesto (.pdf) <em>Honorarios, servicios a contratar y actividades a realizar.</em></span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip" style="font-size: 10px">
                        @if((session('Error') && old('type14')) || (isset($award) && $award->file(14)))
                            @if(session('Error'))
                                {{old('type14')}}
                            @else
                                {{$award->file(14)->name}}
                            @endif
                        @else
                            Para montajes de compañías o uniones que vivan por fuera de Bogotá, incluir los costos de estadía, transporte y viáticos necesarios para montaje de la obra en el Teatro Colón
                        @endif
                    </span>
                    <input type="file" id="type14" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type14"
                           @if(session('Error'))
                               value="{{old('type14')}}"
                           @elseif(isset($award) && $award->file(14))
                               value="{{$award->file(14)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type14')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type15">
                <span>Propuesta de Financiación (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip" >
                        @if((session('Error') && old('type15')) || (isset($award) && $award->file(15)))
                            @if(session('Error'))
                                {{old('type15')}}
                            @else
                                {{$award->file(15)->name}}
                            @endif
                        @else
                            Si el valor total excede el monto de la cofinanciación explique las otras fuentes de financiación.
                        @endif
                    </span>
                    <input type="file" id="type15" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type15"
                           @if(session('Error'))
                               value="{{old('type15')}}"
                           @elseif(isset($award) && $award->file(15))
                               value="{{$award->file(15)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type15')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type7">
                <span>Hoja de Vida de c/u de los integrantes (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip" >
                        @if((session('Error') && old('type7')) || (isset($award) && $award->file(7)))
                            @if(session('Error'))
                                {{old('type7')}}
                            @else
                                {{$award->file(7)->name}}
                            @endif
                        @else
                            Actores, diseñadores, escenógrafos, etc.
                        @endif
                    </span>
                    <input type="file" id="type7" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type7"
                           @if(session('Error'))
                               value="{{old('type7')}}"
                           @elseif(isset($award) && $award->file(7))
                               value="{{$award->file(7)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type7')}}</span>
                @endif
            </label>
        </div>

        <h2 class="col-12">DATOS DEL REPRESENTANTE LEGAL</h2>

        <div class="row Register-contentLabel">
            <label class="col-5 small-10" for="rep_name">
                <span>Nombres</span>
                <input type="text" name="rep_name" id="rep_name"
                       @if(session('Error'))
                           value="{{old('rep_name')}}"
                       @elseif($propietor)
                           value="{{$propietor->name}}"
                       @endif >

                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_name')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="rep_last_name">
                <span>Apellidos</span>
                <input type="text" name="rep_last_name" id="rep_last_name"
                       @if(session('Error'))
                           value="{{old('rep_last_name')}}"
                       @elseif($propietor)
                           value="{{$propietor->last_name}}"
                       @endif >

                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_last_name')}}</span>
                @endif
            </label>
            <label for="city" class="col-5  small-10">
                <div class="Register-contentSelect">
                    <span>Tipo de Documento de Identidad:</span>
                    <span class="Register-arrowSelect">▼</span>
                    <select name="rep_doc_typ" id="rep_doc_typ">
                        <option value="1">Selecciona Documento</option>
                        <option value="2" @if((session('Error') && old('rep_doc_typ') == 2) || ($propietor && $propietor->document_type_id == 2)) selected @endif >Cédula</option>
                        <option value="3" @if((session('Error') && old('rep_doc_typ') == 3) || ($propietor && $propietor->document_type_id == 3)) selected @endif >Cédula de Extranjería</option>
                        <option value="4" @if((session('Error') && old('rep_doc_typ') == 4) || ($propietor && $propietor->document_type_id == 4)) selected @endif >Pasaporte</option>
                    </select>
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_doc_typ')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="rep_doc_number">
                <span>Número de documento</span>
                <input type="text" name="rep_doc_number" id="rep_doc_number"
                       @if(session('Error'))
                           value="{{old('rep_doc_number')}}"
                       @elseif($propietor)
                           value="{{$propietor->document_number}}"
                       @endif >
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_doc_number')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="rep_mobile">
                <span>Teléfono celular</span>
                <input type="text" name="rep_mobile" id="rep_mobile"
                       @if(session('Error'))
                           value="{{old('rep_mobile')}}"
                       @elseif($propietor)
                           value="{{$propietor->mobile}}"
                       @endif >

                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_mobile')}}</span>
                @endif
            </label>

            <div class="col-5"></div>

            <label class=" col-5 small-10" for="rep_email">
                <span>Correo institucional</span>
                <input type="email" name="rep_email" id="rep_email"
                       @if(session('Error'))
                           value="{{old('rep_email')}}"
                       @elseif($propietor)
                           value="{{$propietor->email1}}"
                       @endif >

                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_email')}}</span>
                @endif
            </label>

            <label class=" col-5 small-10" for="rep_email2">
                <span>Correo personal</span>
                <input type="email" name="rep_email2" id="rep_email2"
                       @if(session('Error'))
                           value="{{old('rep_email2')}}"
                       @elseif($propietor)
                           value="{{$propietor->email2}}"
                       @endif >

                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_email2')}}</span>
                @endif
            </label>

            <h3 class="col-10">PROPUESTA DE PRODUCCIÓN.</h3>

            <label class="col-10 small-10" for="type18">
                <span>Documento de delegación de representación (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type18')) || (isset($award) && $award->file(18)))
                            @if(session('Error'))
                                {{old('type18')}}
                            @else
                                {{$award->file(18)->name}}
                            @endif
                        @else
                            Firmado por todos los miembros de la unión temporal, en el que delegan su representación a un integrante del grupo.
                        @endif
                    </span>
                    <input type="file" id="type18" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type18" id="type18"
                           @if(session('Error'))
                               value="{{old('type18')}}"
                           @elseif(isset($award) && $award->file(18))
                               value="{{$award->file(18)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type18')}}</span>
                @endif
            </label>

            <label class="col-10 small-10" for="type17">
                <span>Carta de Compromiso</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if((session('Error') && old('type17')) || (isset($award) && $award->file(17)))
                            @if(session('Error'))
                                {{old('type17')}}
                            @else
                                {{$award->file(17)->name}}
                            @endif
                        @else
                            Aceptación de las reglas del contrato de coproducción con El Teatro Colón.
                        @endif
                    </span>
                    <input type="file" id="type17" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type17"
                           @if(session('Error'))
                               value="{{old('type17')}}"
                           @elseif(isset($award) && $award->file(17))
                               value="{{$award->file(17)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type17')}}</span>
                @endif
            </label>
            <label class="col-10 small-10" for="type19">
                <span>Fotocopia de la Cédula Representante Legal (.pdf)</span>
                <div class="Register-file">
                    <span class="Register-actions">
                        <span class="Register-addFile">Añadir archivo</span>
                    </span>
                    <span class="Register-tooltip">
                        @if(session('Error'))
                            {{old('type19')}}
                        @elseif(isset($award) && $award->file(19))
                            {{$award->file(19)->name}}
                        @endif
                    </span>
                    <input type="file" id="type19" types="pdf" accept="application/pdf">
                    <input type="hidden" name="type19"
                           @if(session('Error'))
                               value="{{old('type19')}}"
                           @elseif(isset($award) && $award->file(19))
                               value="{{$award->file(19)->name}}"
                           @endif >
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type19')}}</span>
                @endif
            </label>
        </div>

        <div class="center row"><button style="margin: 20px 0 0 0;" id="saveForm"> TERMINAR DESPUÉS</button></div>
        <div class="center row"><button style="margin: 10px 0 50px 0;"> ENVIAR</button></div>

    </form>
    <div class="preload red hidden">
        <div class="loader">
            <div class="circle-outer"></div>
            <div class="circle-inner"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/images.js')}}"></script>
    <script src="{{asset('js/tempFiles.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{asset('js/form.js')}}"></script>
    <script type="text/javascript">
        $('#sector').select2({
            closeOnSelect: false
        });

        $('#saveForm').on('click', function(){
            $(this).append('<input type="hidden" value="1" name="isUpdate">');
        });
    </script>
@endsection
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection