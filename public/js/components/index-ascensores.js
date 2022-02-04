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
                            ${this.attributes.seleccionar_ascensor ? `<th scope="col">WIP1</th>` : `<th scope="col">WIP2</th>`}
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
        return `
            <style>
                .ascensor {
                    background-color: #2f2f2f;
                }
                .ascensor-2 {
                    background-color: #2f2f2f;
                    font-size: 14px;
                }
                .ascensor-3 {
                    background-color: #2f2f2f;
                    text-align: center;
                }
                .ascensor-4 {
                    text-align: center;
                    background-color: #2f2f2f;
                    color: white;
                }
                .ascensor-5 {
                    background-color: #fffff;
                    color: black;
                }
                .ascensor-6 {
                    background-color: #2f2f2f;
                    color: white;
                }
                .ascensor-7 {
                    background-color: #2f2f2f;
                    color: green;
                }
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

export default IndexAscensores;