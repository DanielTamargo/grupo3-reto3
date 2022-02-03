@extends('layouts.app')

@section('content')
    <div class="container px-4">
        <input type="hidden" id="seleccionar-ascensor" value="{{ isset($seleccionar_ascensor) && $seleccionar_ascensor ? 'true' : 'false' }}">
        <input type="hidden" id="assets-component-index-ascensores" value="{{ asset('js/components/index-ascensores.js') }}">
        
        <index-ascensores 
            seleccionar_ascensor="{{ isset($seleccionar_ascensor) && $seleccionar_ascensor ? 'true' : 'false' }}"
            link_css="{{ asset('css/app.css') }}"
        ></index-ascensores>
        {{--
        <div class="ascensores">
            
            <h3 class="text-muted">Lista de ascensores instalados</h3>  
            <div class="row my-3">
                <div class="col-4">
                    <p class="mb-1">Número de referencia</p>
                    <input class="form-control" id="filtro-num_ref" type="text" placeholder="1PU...">
                </div>
                <div class="col-8">
                    <p class="mb-1">Ubicación</p>
                    <input class="form-control" id="filtro-ubicacion" type="text" placeholder="Calle....">
                </div>
            </div>      
            <table class="border table table-hover rounded empleados">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Num. Ref.</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Ubicación</th>
                        @if (isset($seleccionar_ascensor) && $seleccionar_ascensor)
                            <th scope="col">Acción</th>
                        @else
                            <th scope="col">F.Instalación</th>
                            <th scope="col">F.Ult.Revisión</th> 
                        @endif
                    </tr>
                </thead>
                <tbody id="lista-ascensores">
                    @foreach ($ascensores as $ascensor)
                        <tr>
                            <th scope="row">{{ $ascensor->num_ref }}</th>
                            @if (isset($seleccionar_ascensor) && $seleccionar_ascensor)
                                <td>{{ $ascensor->modelo->nombre }}</td>
                            @else
                                <td><a class="empleados" href="">{{ $ascensor->modelo->nombre }}</a></td>
                            @endif
                            <td>{{ $ascensor->ubicacion }}</td>
                            @if (isset($seleccionar_ascensor) && $seleccionar_ascensor)
                                <td><a class="empleados" id="ascensor-{{ $ascensor->num_ref }}" href="#seleccion-ascensor">Seleccionar</a></td>    
                            @else
                                <td>{{ $ascensor->fecha_instalacion }}</td>
                                <td>{{ $ascensor->fecha_ultima_revision }}</td>
                            @endif
                        </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>
        --}}
        <script src="{{ asset('js/lib/jquery-3.6.0.min.js')}}"></script>
        <script>
            class IndexAscensores extends HTMLElement {
                constructor() {
                    super();
                    this.shadowDOM = this.attachShadow({mode: 'open'});
                }
            
                connectedCallback() {
                    this.mapComponentAttributes();
                    this.render();
                    this.initComponent();
                }

                mapComponentAttributes() {
                    const attributesMapping = [
                        'seleccionar_ascensor',
                        'link_css'
                    ];
                    attributesMapping.forEach(key => {
                        if (!this.attributes[key]) {
                            this.attributes[key] = {value: ''};
                        }
                    });
                }
            
                mapComponentAttributes() {
                    const attributesMapping = [
                        'seleccionar_ascensor',
                        'link_css'
                    ];
                    attributesMapping.forEach(key => {
                        if (!this.attributes[key]) {
                            this.attributes[key] = {value: ''};
                        }
                    });
                }

                render() {
                    this.shadowDOM.innerHTML = `
                        ${this.templateCss()}
                        ${this.template()}
                    `;
                }
            
                template() {
                    console.log(this.attributes.seleccionar_ascensor);
                    
                    // Peparar contenido
                    let contenido = `
                    <link href="${this.attributes.link_css.value}" rel="stylesheet">
                    <div class="tag-componente">
                        <div class="ascensores">
                            <h3 class="text-muted">Lista de ascensores instalados</h3>  
                            <div class="row my-3">
                                <div class="col-4">
                                    <p class="mb-1">Número de referencia</p>
                                    <input class="form-control" id="filtro-num_ref" type="text" placeholder="1PU...">
                                </div>
                                <div class="col-8">
                                    <p class="mb-1">Ubicación</p>
                                    <input class="form-control" id="filtro-ubicacion" type="text" placeholder="Calle....">
                                </div>
                            </div>      
                            <table class="border table table-hover rounded empleados">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">Num. Ref.</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Ubicación</th>
                                        ${this.attributes.seleccionar_ascensor.value ? `<th scope="col">WIP1</th>` : `<th scope="col">WIP2</th>`}
                                    </tr>
                                </thead>
                                <tbody id="lista-ascensores">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>`;
                    
                    return contenido;
                }
            
                templateCss() {
                    // TODO dani:
                    return `
                        <style>

                        </style>
                    `;
                }

                initComponent() {
                    this.$tag = this.shadowDOM.querySelector('.tag-componente');
                }
            
                disconnectedCallback() {
                    this.remove();
                }
            
            }

            window.customElements.define('index-ascensores', IndexAscensores);
         </script>
        <script src="{{ asset('js/views/ascensores.js')}}" defer></script>  
         
    </div>
@endsection