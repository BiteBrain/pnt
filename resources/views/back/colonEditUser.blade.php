@extends('layout.front')

@section('content')

    <div class="Register-header Semana">
        <h1>USUARIO INSCRITO AL PREMIO TEATRO COlÓN</h1>
    </div>
    <form action="{{ url('admin/usuarios/colon')}}" enctype="multipart/form-data" method="get" class=" Register-form Semana-form"> <!-- //route('colonUpdate', $award->id) -->
        <!--<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">-->
        <!--<input type="hidden" id="url" value="{{ url('ajaxTempFiles') }}">-->

        <h2 class="col-12">DATOS BÁSICOS DE LA ORGANIZACIÓN</h2>
        <div class=" row Register-contentLabel">
            <label class="col-10 small-10" for="org_name">
                <span>Nombre de la agrupación, grupo constituído o unión temporal</span>
                <input type="text" name="org_name" id="org_name" value="{{$award->organization->name}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_name')}}</span>
                @endif
            </label>

            <!--<label for="org_region" class="col-5  small-10">
                <div class="Register-contentSelect">
                    <span>Región</span>
                    <input type="text" name="org_region" id="org_region" value="{{$award->organization->region}}">
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_region')}}</span>
                @endif
            </label>-->

            <label for="org_city" class="col-5  small-10">
                <div class="Register-contentSelect">
                    <span>Ciudad</span>
                    <span class="Register-arrowSelect">▼</span>
                    <select name="org_city" id="org_city">
                        <option value="">Selecciona una ciudad</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" @if((session('Error') && old('org_city') == $city->id) || ($award->organization && $award->organization->city_id == $city->id)) selected @endif >{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_city')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="org_address">
                <span>Dirección física</span>
                <input type="text" name="org_address" id="org_address" value="{{$award->organization->address}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_address')}}</span>
                @endif
            </label>
            <label class="col-5 small-10" for="org_phone">
                <span>Teléfono fijo</span>
                <input type="text" name="org_phone" id="org_phone" value="{{$award->organization->phone}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_phone')}}</span>
                @endif
            </label>
            <label class="col-5 small-10" for="org_mobile">
                <span>Teléfono Celular</span>
                <input type="text" name="org_mobile" id="org_mobile" value="{{$award->organization->mobile}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_mobile')}}</span>
                @endif
            </label>
            <label class="col-5 small-10" for="org_email">
                <span>Correo principal</span>
                <input type="email" name="org_email" id="org_email" value="{{$award->organization->email}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_email')}}</span>
                @endif
            </label>
            <label class="col-5 small-10" for="org_website">
                <span>Sitio Web</span>
                <input type="text" name="org_website" id="org_website" value="{{$award->organization->website}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('org_website')}}</span>
                @endif
            </label>

            <label class="col-12 small-10 row Colon-social" for="group_name">
                <span  class="col-12 ">Redes sociales (facebook, instagram, twitter)</span>
                <?php $socials = explode(',', $award->organization->socials)?>
                <input class="col-4" type="text" name="facebook" id="facebook" value="{{$socials[0]}}">
                <input  class="col-4" type="text" name="instagram" id="instagram" value="{{$socials[1]}}">
                <input class="col-4"  type="text" name="twitter" id="twitter" value="{{$socials[2]}}">
                @if (count($errors) > 0)
                    <span class="col-4" style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('facebook')}}</span>
                    <span class="col-4" style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('instagram')}}</span>
                    <span class="col-4" style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('twitter')}}</span>
                @endif
            </label>

        </div>
        <h2 class="col-12">DATOS DE LA PRODUCCIÓN ARTÍSTICA</h2>
        <div class=" row Register-contentLabel">
            <label class="col-10 small-10" for="prd_name">
                <span>Nombre del espectáculo</span>
                <input type="text" name="prd_name" id="prd_name" value="{{$award->production->name}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('prd_name')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="prd_date">
                <span>Fecha de estreno</span>
                <input type="date" name="prd_date" id="prd_date" value="{{$award->production->release_date}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('prd_date')}}</span>
                @endif
            </label>

            <label for="prd_genre" class="col-5  small-10">
                <div class="Register-contentSelect">
                    <span>Género:</span>
                    <span class="Register-arrowSelect">▼</span>
                    <select name="prd_genre" id="prd_genre">
                        <option value="Teatro">Teatro</option>
                        <option value="Circo - Teatro" @if($award->production->genre == 'Circo - Teatro') selected @endif >Circo - Teatro</option>
                        <option value="Danza - Teatro" @if($award->production->genre == 'Danza - Teatro') selected @endif >Danza - Teatro</option>
                        <option value="Teatro Musical" @if($award->production->genre == 'Teatro Musical') selected @endif >Teatro Musical</option>
                    </select>
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('prd_genre')}}</span>
                @endif
            </label>

            @foreach($award->files as $file)
                @if($file->file_type_id == 1)
                    <label class="col-5 small-10" for="type1">
                        <span>Sinópsis (.pdf)</span>
                        <div class="Register-file">
                            <span class="Register-actions">
                                <a style="margin-right: 2px" href="{{asset('uploads/colon/' . $file->name)}}" target="_blank" class="Register-openFile">Abrir</a>
                                <!--<span class="Register-addFile">Cambiar</span>-->
                            </span>
                            <span class="Register-tooltip">{{$file->name}}</span>
                            <!--<input type="file" id="type1">-->
                            <input type="hidden" name="type1" value="{{$file->name}}">
                        </div>
                        @if (count($errors) > 0)
                            <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type1')}}</span>
                        @endif
                    </label>
                        @continue
                    @elseif($file->file_type_id == 2)
                    <label class="col-5 small-10" for="type2">
                        <span>Texto o libreto (.pdf)</span>
                        <div class="Register-file">
                            <span class="Register-actions">
                                <a style="margin-right: 2px" href="{{asset('uploads/colon/' . $file->name)}}" target="_blank" class="Register-openFile">Abrir</a>
                                <!--<span class="Register-addFile">Cambiar</span>-->
                            </span>
                            <span class="Register-tooltip">{{$file->name}}</span>
                            <!--<input type="file" id="type2">--
                            <input type="hidden" name="type2" value="{{$file->name}}">
                        </div>
                        @if (count($errors) > 0)
                            <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type2')}}</span>
                        @endif
                    </label>
                        @continue
                    @elseif($file->file_type_id == 3)
                        <label class="col-5 small-10" for="type3">
                            <span>Certificado de registro de Derechos de Autor</span>
                            <div class="Register-file">
                                <span class="Register-actions">
                                    <a style="margin-right: 2px" href="{{asset('uploads/colon/' . $file->name)}}" target="_blank" class="Register-openFile">Abrir</a>
                                    <!--<span class="Register-addFile">Cambiar</span>
                                </span>
                                <span class="Register-tooltip"> {{$file->name}}</span>-->
                                <!--<input type="file" id="type3">-->
                                <input type="hidden" name="type3" value="{{$file->name}}">
                            </div>
                            @if (count($errors) > 0)
                                <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type3')}}</span>
                            @endif
                        </label>
                        @continue
                    @elseif($file->file_type_id == 4)
                        <label class="col-5 small-10" for="type4">
                            <span>Certificación de música original en caso de tenerla</span>
                            <div class="Register-file">
                                <span class="Register-actions">
                                    <a style="margin-right: 2px" href="{{asset('uploads/colon/' . $file->name)}}" target="_blank" class="Register-openFile">Abrir</a>
                                    <!--<span class="Register-addFile">Cambiar</span>-->
                                </span>
                                <span class="Register-tooltip">{{$file->name}}</span>
                                <!--<input type="file" id="type4">-->
                                <input type="hidden" name="type4" value="{{$file->name}}">
                            </div>
                            @if (count($errors) > 0)
                                <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type4')}}</span>
                            @endif
                        </label>
                        @continue
                    @elseif($file->file_type_id == 5)
                        <label class="col-5 small-10" for="type5">
                            <span>Dossier del espectáculo (.pdf)</span>
                            <div class="Register-file">
                                <span class="Register-actions">
                                    <a style="margin-right: 2px" href="{{asset('uploads/colon/' . $file->name)}}" target="_blank" class="Register-openFile">Abrir</a>
                                    <!--<span class="Register-addFile">Cambiar</span>-->
                                </span>
                                <span class="Register-tooltip">{{$file->name}}</span>
                                <!--<input type="file" id="type5">-->
                                <input type="hidden" name="type5" value="{{$file->name}}">
                            </div>
                            @if (count($errors) > 0)
                                <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type5')}}</span>
                            @endif
                        </label>
                        @continue
                    @elseif($file->file_type_id == 6)
                        <label class="col-5 small-10" for="type6">
                            <span>Soporte de 5 presentaciones realizadas hasta el 30 de Sept</span>
                            <div class="Register-file">
                                <span class="Register-actions">
                                    <a style="margin-right: 2px" href="{{asset('uploads/colon/' . $file->name)}}" target="_blank" class="Register-openFile">Abrir</a>
                                    <!--<span class="Register-addFile">Cambiar</span>-->
                                </span>
                                <span class="Register-tooltip">{{$file->name}}</span>
                                <!--<input type="file" id="type6">-->
                                <input type="hidden" name="type6" value="{{$file->name}}">
                            </div>
                            @if (count($errors) > 0)
                                <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type6')}}</span>
                            @endif
                        </label>
                        @continue
                    @elseif($file->file_type_id == 7)
                        <label class="col-5 small-10" for="type7">
                            <span>Hoja de Vida de c/u de los integrantes</span>
                            <div class="Register-file">
                                <span class="Register-actions">
                                    <a style="margin-right: 2px" href="{{asset('uploads/colon/' . $file->name)}}" target="_blank" class="Register-openFile">Abrir</a>
                                    <!--<span class="Register-addFile">Cambiar</span>-->
                                </span>
                                <span class="Register-tooltip" >{{$file->name}} </span>
                                <!--<input type="file" id="type7">-->
                                <input type="hidden" name="type7" value="{{$file->name}}">
                            </div>
                            @if (count($errors) > 0)
                                <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('type7')}}</span>
                            @endif
                        </label>
                        @continue
                    @endif
                @endforeach

                <label class="col-10 small-10" for="prd_video">
                    <span>Registro audiovisual (vínculo a video del espectáculo)</span>
                    <textarea class="col-12" name="prd_video" id="prd_video" placeholder="Grabación completa del espectáculo en buena calidad de imagen (mínimo 1280x720 ) y audio. Deberá ser en plano general y sin edición.">{{$award->production->link_video}}</textarea>
                    @if (count($errors) > 0)
                        <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('prd_video')}}</span>
                    @endif
                </label>
        </div>

        <h2 class="col-12">DATOS DEL REPRESENTANTE LEGAL</h2>

        <div class="row Register-contentLabel">
            <label class="col-5 small-10" for="rep_name">
                <span>Nombres</span>
                <input type="text" name="rep_name" id="rep_name" value="{{$award->propietor->name}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_name')}}</span>
                @endif
            </label>
            <label class="col-5 small-10" for="rep_last_name">
                <span>Apellidos</span>
                <input type="text" name="rep_last_name" id="rep_last_name" value="{{$award->propietor->last_name}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_last_name')}}</span>
                @endif
            </label>
            <label for="rep_doc_typ" class="col-5  small-10">
                <div class="Register-contentSelect">
                    <span>Tipo de Documento de Identidad:</span>
                    <span class="Register-arrowSelect">▼</span>
                    <select name="rep_doc_typ" id="rep_doc_typ">
                        <option value="2">Cédula</option>
                        <option value="3" @if($award->propietor->document_type_id == 2) selected @endif >Cédula de Extranjería</option>
                        <option value="4" @if($award->propietor->document_type_id == 3) selected @endif >Pasaporte</option>
                    </select>
                </div>
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_doc_typ')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="rep_doc_number">
                <span>Número de documento</span>
                <input type="text" name="rep_doc_number" id="rep_doc_number" value="{{$award->propietor->document_number}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_doc_number')}}</span>
                @endif
            </label>

            <label class="col-5 small-10" for="rep_mobile">
                <span>Teléfono celular</span>
                <input type="text" name="rep_mobile" id="rep_mobile" value="{{$award->propietor->mobile}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_mobile')}}</span>
                @endif
            </label>

            <div class="col-5"></div>

            <label class=" col-5 small-10" for="rep_email1">
                <span>Correo electrónico</span>
                <input type="email" name="rep_email1" id="rep_email1" value="{{$award->propietor->email1}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_email1')}}</span>
                @endif
            </label>

            <label class=" col-5 small-10" for="rep_email2">
                <span>Correo electrónico 2</span>
                <input type="email" name="rep_email2" id="rep_email2" value="{{$award->propietor->email2}}">
                @if (count($errors) > 0)
                    <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('rep_email2')}}</span>
                @endif
            </label>
            {{--<h2 class="small-12">CATEGORIA(S) DE POSTULACIÓN</h2>
            <section class="row between small-12" id="Categories">
                <!--
                *************************************
                ************* CHECKBOX 1 ************
                *************************************
                -->
            <!--    <label class="col-4 small-12 CheckboxContainer @if(old('check1') || (isset($award) && (isset($award) && $award->awardCategory(1) ))) active @endif" for="check1">
                    <span class="Checkbox">
                        <span>MEJOR OBRA</span>
                        <input type="checkbox" name="check1" id="check1" value="1" @if(old('check1') || (isset($award) && $award->awardCategory(1))) checked="checked" @endif >
                    </span>
                </label>
                <label for="" class=" from-large col-8"><span class="Empty"></span></label>
                <label for="" style="display:none"><span class="Empty"></span></label>

                <!--
                *************************************
                ************* CHECKBOX 2 ************
                *************************************
                -->

            {{--<label class="col-4 small-12 CheckboxContainer @if(old('check2') || (isset($award) && $award->awardCategory(2))) active @endif" for="check2">
                    <span class="Checkbox">
                        <span>MEJOR DIRECTOR</span>
                        <input type="checkbox" name="check2" id="check2" value="2" @if(old('check2') || (isset($award) && $award->awardCategory(2))) checked="checked" @endif>
                    </span>
                </label>
                <label for="" class="from-large col-8"><span class="Empty"></span></label>
                <label for="" style="display:none"><span class="Empty"></span></label>

                <!--
                *************************************
                ************* CHECKBOX 3 ************
                *************************************


                <label class="small-12 col-4 CheckboxContainer @if(old('check3') || (isset($award) && $award->awardCategory(3))) active @endif" for="check3">
                    <span class="Checkbox">
                        <span>MEJOR DRAMATURGIA</span>
                        <input type="checkbox" name="check3" id="check3" value="3" @if(old('check3') || (isset($award) && $award->awardCategory(3))) checked="checked" @endif>
                    </span>
                </label>
                <label for="" class="from-large col-8"><span class="Empty"></span></label>
                <label for="" style="display:none"><span class="Empty"></span></label>

                <!--
                *************************************
                ************* CHECKBOX 4 ************
                *************************************


                <label class="CheckboxContainer @if(old('check4') || (isset($award) && $award->awardCategory(4))) col-4 active @endif small-12" for="check4">
                    <span class="Checkbox">
                        <span>MEJOR DISEÑO DE ESCENOGRAFÍA</span>
                        <input type="checkbox" name="check4" id="check4" value="4" @if(old('check4') || (isset($award) && $award->awardCategory(4))) checked="checked" @endif>
                    </span>
                </label>

                <label class="col-4 small-12 @if(!(old('check4') || (isset($award) && $award->awardCategory(4)))) hidden @endif" for="type20">
                    <div class="Register-file">
                        <span class="Register-actions">
                            <a style="margin-right: 2px" href="{{asset('uploads/colon/')}}/@if($award->file(20)){{$award->file(20)->name}}@endif" target="_blank" class="Register-openFile">Abrir</a>
                            <!--<span class="Register-addFile">Cambiar</span>-->
                   {{--</span>
                        <span class="Register-tooltip">
                            @if((session('Error') && old('type20')) || (isset($award) && $award->file(20)))
                                @if(session('Error'))
                                    {{old('type20')}}
                                @else
                                    {{$award->file(20)->name}}
                                @endif
                            @else
                                Fotos ilustrativas (.zip .rar) 5 - 10
                            @endif
                        </span>
                        <!--<input type="file" id="type20" types="zip,rar">-->
                        <input type="hidden" name="type20"
                               @if(session('Error'))
                               value="{{old('type20')}}"
                               @elseif(isset($award) && $award->file(20))
                               value="{{$award->file(20)->name}}"
                                @endif >
                    </div>
                </label>
                <label class=" @if(!(old('check4') || (isset($award) && $award->awardCategory(4)))) hidden @endif col-4 small-12" for="type21">
                    <div class="Register-file">
                        <span class="Register-actions">
                            <a style="margin-right: 2px" href="{{asset('uploads/colon/')}}/@if($award->file(21)){{$award->file(21)->name}}@endif" target="_blank" class="Register-openFile">Abrir</a>
                            <!--<span class="Register-addFile">Cambiar</span>-->
                        </span>
                        <span class="Register-tooltip">
                            @if((session('Error') && old('type21')) || (isset($award) && $award->file(21)))
                                @if(session('Error'))
                                    {{old('type21')}}
                                @else
                                    {{$award->file(21)->name}}
                                @endif
                            @else
                                Bocetos de diseños (.pdf)
                            @endif
                        </span>
                        <!--<input type="file" id="type21" types="pdf" accept="application/pdf">-->
                        <input type="hidden" name="type21"
                               @if(session('Error'))
                               value="{{old('type21')}}"
                               @elseif(isset($award) && $award->file(21))
                               value="{{$award->file(21)->name}}"
                                @endif >
                    </div>
                </label>

                <!--
                *************************************
                ************* CHECKBOX 5 ************
                *************************************
                -->

                <label class="CheckboxContainer @if(old('check5') || (isset($award) && $award->awardCategory(5))) col-4 active @endif small-12" for="check5">
                    <span class="Checkbox">
                        <span>MEJOR DISEÑO DE MAQUILLAJE</span>
                        <input type="checkbox" name="check5" id="check5" value="5" @if(old('check5') || (isset($award) && $award->awardCategory(5))) checked="checked" @endif>
                    </span>
                </label>
                <label class=" @if(!(old('check5') || (isset($award) && $award->awardCategory(5)))) hidden @endif col-4 small-12" for="type22">
                    <div class="Register-file">
                            <span class="Register-actions">
                                <a style="margin-right: 2px" href="{{asset('uploads/colon/')}}/@if($award->file(22)){{$award->file(22)->name}}@endif" target="_blank" class="Register-openFile">Abrir</a>
                                <!--<span class="Register-addFile">Cambiar</span>-->
                            </span>
                            <span class="Register-tooltip">
                                @if((session('Error') && old('type22')) || (isset($award) && $award->file(22)))
                                    @if(session('Error'))
                                        {{old('type22')}}
                                    @else
                                        {{$award->file(22)->name}}
                                    @endif
                                @else
                                    Fotos ilustrativas (.zip .rar) 5 - 10
                                @endif
                            </span>
                        <!--<input type="file" id="type22" types="zip,rar">-->
                        <input type="hidden" name="type22"
                               @if(session('Error'))
                               value="{{old('type22')}}"
                               @elseif(isset($award) && $award->file(22))
                               value="{{$award->file(22)->name}}"
                                @endif >
                    </div>
                </label>
                <label class=" @if(!(old('check5') || (isset($award) && $award->awardCategory(5)))) hidden @endif col-4 small-12" for="type23">
                    <div class="Register-file">
                            <span class="Register-actions">
                                <a style="margin-right: 2px" href="{{asset('uploads/colon/')}}/@if($award->file(23)){{$award->file(23)->name}}@endif" target="_blank" class="Register-openFile">Abrir</a>
                                <!--<span class="Register-addFile">Cambiar</span>-->
                            </span>
                            <span class="Register-tooltip">
                                @if((session('Error') && old('type23')) || (isset($award) && $award->file(23)))
                                    @if(session('Error'))
                                        {{old('type23')}}
                                    @else
                                        {{$award->file(23)->name}}
                                    @endif
                                @else
                                    Bocetos de diseños (.pdf)
                                @endif
                            </span>
                        <!--<input type="file" id="type23" types="pdf" accept="application/pdf">-->
                        <input type="hidden" name="type23"
                               @if(session('Error'))
                               value="{{old('type23')}}"
                               @elseif(isset($award) && $award->file(23))
                               value="{{$award->file(23)->name}}"
                                @endif >
                    </div>
                </label>

                <!--
                *************************************
                ************* CHECKBOX 6 ************
                *************************************
                -->

                <label class="CheckboxContainer @if(old('check6') || (isset($award) && $award->awardCategory(6))) col-4 active @endif small-12" for="check6">
                    <span class="Checkbox">
                        <span>MEJOR DISEÑO DE VESTUARIO</span>
                        <input type="checkbox" name="check6" id="check6" value="6" @if(old('check6') || (isset($award) && $award->awardCategory(6))) checked="checked" @endif>
                    </span>
                </label>
                <label class=" @if(!(old('check6') || (isset($award) && $award->awardCategory(6)))) hidden @endif col-4 small-12" for="type24">
                    <div class="Register-file">
                            <span class="Register-actions">
                                <a style="margin-right: 2px" href="{{asset('uploads/colon/')}}/@if($award->file(24)){{$award->file(24)->name}}@endif" target="_blank" class="Register-openFile">Abrir</a>
                                <!--<span class="Register-addFile">Cambiar</span>-->
                            </span>
                            <span class="Register-tooltip">
                                @if((session('Error') && old('type24')) || (isset($award) && $award->file(24)))
                                    @if(session('Error'))
                                        {{old('type24')}}
                                    @else
                                        {{$award->file(24)->name}}
                                    @endif
                                @else
                                    Fotos ilustrativas (.zip .rar) 5 - 10
                                @endif
                            </span>
                        <!--<input type="file" id="type24"  types="zip,rar">-->
                        <input type="hidden" name="type24"
                               @if(session('Error'))
                               value="{{old('type24')}}"
                               @elseif(isset($award) && $award->file(24))
                               value="{{$award->file(24)->name}}"
                                @endif >
                    </div>
                </label>
                <label class=" @if(!(old('check6') || (isset($award) && $award->awardCategory(6)))) hidden @endif col-4 small-12" for="type25">
                    <div class="Register-file">
                            <span class="Register-actions">
                                <a style="margin-right: 2px" href="{{asset('uploads/colon/')}}/@if($award->file(25)){{$award->file(25)->name}}@endif" target="_blank" class="Register-openFile">Abrir</a>
                                <!--<span class="Register-addFile">Cambiar</span>-->
                            </span>
                            <span class="Register-tooltip">
                                @if((session('Error') && old('type25')) || (isset($award) && $award->file(25)))
                                    @if(session('Error'))
                                        {{old('type25')}}
                                    @else
                                        {{$award->file(25)->name}}
                                    @endif
                                @else
                                    Bocetos de diseños (.pdf)
                                @endif
                            </span>
                        <!--<input type="file" id="type25" types="pdf" accept="application/pdf">-->
                        <input type="hidden" name="type25"
                               @if(session('Error'))
                               value="{{old('type25')}}"
                               @elseif(isset($award) && $award->file(25))
                               value="{{$award->file(25)->name}}"
                                @endif >
                    </div>
                </label>

                <!--
                *************************************
                ************* CHECKBOX 7 ************
                *************************************
                -->

                <label class="CheckboxContainer @if(old('check7') || (isset($award) && (isset($award) && $award->awardCategory(7)))) col-4 active @endif small-12" for="check7">
                    <span class="Checkbox">
                        <span>MEJOR DISEÑO DE ILUMINACIÓN</span>
                        <input type="checkbox" name="check7" id="check7" value="7" @if(old('check7') || (isset($award) && $award->awardCategory(7))) checked="checked" @endif>
                    </span>
                </label>
                <label class=" @if(!(old('check7') || (isset($award) && $award->awardCategory(7)))) hidden @endif col-4  small-12" for="type26">
                    <div class="Register-file">
                            <span class="Register-actions">
                                <a style="margin-right: 2px" href="{{asset('uploads/colon/')}}/@if($award->file(26)){{$award->file(26)->name}}@endif" target="_blank" class="Register-openFile">Abrir</a>
                                <!--<span class="Register-addFile">Cambiar</span>-->
                            </span>
                            <span class="Register-tooltip">
                                @if((session('Error') && old('type26')) || (isset($award) && $award->file(26)))
                                    @if(session('Error'))
                                        {{old('type26')}}
                                    @else
                                        {{$award->file(26)->name}}
                                    @endif
                                @else
                                    Fotos ilustrativas (.zip .rar) 5 - 10
                                @endif
                            </span>
                        <!--<input type="file" id="type26"  types="zip,rar">-->
                        <input type="hidden" name="type26"
                               @if(session('Error'))
                               value="{{old('type26')}}"
                               @elseif(isset($award) && $award->file(26))
                               value="{{$award->file(26)->name}}"
                                @endif >
                    </div>
                </label>
                <label class=" @if(!(old('check7') || (isset($award) && $award->awardCategory(7)))) hidden @endif col-4 small-12" for="type27">
                    <div class="Register-file">
                            <span class="Register-actions">
                                <a style="margin-right: 2px" href="{{asset('uploads/colon/')}}/@if($award->file(27)){{$award->file(27)->name}}@endif" target="_blank" class="Register-openFile">Abrir</a>
                                <!--<span class="Register-addFile">Cambiar</span>-->
                            </span>
                            <span class="Register-tooltip">
                                @if((session('Error') && old('type27')) || (isset($award) && $award->file(27)))
                                    @if(session('Error'))
                                        {{old('type27')}}
                                    @else
                                        {{$award->file(27)->name}}
                                    @endif
                                @else
                                    Bocetos de diseños (.pdf)
                                @endif
                            </span>
                        <!--<input type="file" id="type27" types="pdf" accept="application/pdf">-->
                        <input type="hidden" name="type27"
                               @if(session('Error'))
                               value="{{old('type27')}}"
                               @elseif(isset($award) && $award->file(27))
                               value="{{$award->file(27)->name}}"
                                @endif >
                    </div>
                </label>

                <!--
                *************************************
                ************* CHECKBOX 8 ************
                *************************************
                -->

                <label class="CheckboxContainer @if(old('check8') || (isset($award) && $award->awardCategory(8))) col-4 active @endif small-12" for="check8">
                    <span class="Checkbox">
                        <span>MEJOR DISEÑO DE SONIDO</span>
                        <input type="checkbox" name="check8" id="check8" value="8" @if(old('check8') || (isset($award) && $award->awardCategory(8))) checked="checked" @endif>
                    </span>
                </label>
                <label class="col-8 small-12 @if(!(old('check8') || (isset($award) && $award->awardCategory(8)))) hidden @endif " for="cat_sound">
                    <input placeholder="Vinculo audio (Banda sonora espectáculo)" type="text" name="cat_sound" id="cat_sound"
                           @if(session('Error'))
                           value="{{old('cat_sound')}}"
                           @elseif(isset($award))
                           value="{{$award->sound}}"
                            @endif >

                    @if (count($errors) > 0)
                        <span style="color: #ed6b6b; font-size: .85rem;">{{$errors->first('cat_sound')}}</span>
                    @endif
                </label>
                <label for="" style="display:none"><span class="Empty"></span></label>

                <!--
                *************************************
                ************* CHECKBOX 9 ************
                *************************************
                -->

                <label class="CheckboxContainer col-4 small-12 @if(old('check9') || (isset($award) && $award->awardCategory(9))) active @endif" for="check9">
                    <span class="Checkbox">
                        <span>MEJOR ACTOR</span>
                        <input type="checkbox" name="check9" id="check9" value="9" @if(old('check9') || (isset($award) && $award->awardCategory(9))) checked="checked" @endif>
                    </span>
                </label>
                <label for="" class="from-large col-8"><span class="Empty"></span></label>
                <label for="" style="display:none"><span class="Empty"></span></label>

                <!--
                *************************************
                ************* CHECKBOX 10 ***********
                *************************************
                -->

                <label class="CheckboxContainer col-4 small-12 @if(old('check10') || (isset($award) && $award->awardCategory(10))) active @endif" for="check10">
                    <span class="Checkbox">
                        <span>MEJOR ACTRÍZ</span>
                        <input type="checkbox" name="check10" id="check10" value="10" @if(old('check10') || (isset($award) && $award->awardCategory(10))) checked="checked" @endif>
                    </span>
                </label>
                <label for="" class="col-8"><span class="Empty"></span></label>
                <label for="" style="display:none"><span class="Empty"></span></label>

            </section>--}}
        </div>
        <div class="center row"><button style="">IR ATRÁS</button></div>
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
    </script>
@endsection
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection