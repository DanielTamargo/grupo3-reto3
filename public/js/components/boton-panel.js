// Creamos una clase que extenderá de HTMLElement para poder usarlo como web-component
class BotonPanel extends HTMLElement {
    constructor() {
        super();
        this.shadowDOM = this.attachShadow({mode: 'open'}); // <- Modo open para que sea visible e interactuable
    }

    // Método que escuchará cuando el componente se crea y se conecta,
    //   digamos que es como un 'constructor', una vez se conecta le mapeamos
    //   los atributos añadidos, pintamos el elemento en la vista y lo inicializamos
    connectedCallback() {
        this.mapComponentAttributes();
        this.render();
        this.initComponent();
    }

    // Método que mapeará los atributos añadidos al elemento en el HTML, es decir, es la forma de recibir parámetros y
    //    variables desde fuera del componente
    mapComponentAttributes() {
        const attributesMapping = [
            'rol',
            'texto',
            'index_tab',
            'ruta',
        ];
        attributesMapping.forEach(key => {
            if (!this.attributes[key]) {
                this.attributes[key] = {value: ''}; // <- valor por defecto
            }
        });
    }

    // Método que pintará el elemento en la vista
    //    Este método se apoyará en los métodos template y templateCss para cargar todo su contenido y estilos
    render() {
        this.shadowDOM.innerHTML = `
            ${this.templateCss()}
            ${this.template()}
        `;
    }

    // Método que genera el contenido del elemento
    template() {
        // Cómo acceder a las variables mapeadas, ejemplo: this.attributes.ruta.value

        // Peparar contenido
        let contenido = `
        <div id="boton-panel" class="boton-panel" onclick="this.getRootNode().host.redirigirARuta()">
            <div class="button">
                <div class="button__content">
                    <p class="button__text">${this.attributes.texto.value}</p>
                </div>
            </div>
        </div>
        `;

        return contenido;
    }

    // Método que aplica estilos al elemento
    templateCss() {
        return `
            <style>
                @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap");
                *,
                *::before,
                *::after {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    font-family: "Roboto", sans-serif;
                }

                .button {
                    margin: 10px;

                    border-radius: 8px;
                    padding: 1em;
                    width: fit-content;
                    min-width: 240px;
                    background-color: #ad70e8;

                    box-shadow: 0 0 8px 1px gray;

                    animation: 200ms animacion-boton-reverse ease forwards;
                }
                .button:hover {
                    cursor: pointer;
                    animation: animacion-boton 300ms ease forwards;
                }
                .button:active {
                    animation: animacion-boton-click 200ms ease forwards;
                }
                @keyframes animacion-boton-click {
                    0% {
                        background-color: #ad70e8;
                        color: white;
                    }
                    100% {
                        transform: scale(0.98);
                        background-color: #a55eea;
                        color: white;
                    }
                }
                @keyframes animacion-boton {
                    0% {
                        color: white;
                    }
                    100% {
                        background-color: #ad70e8;
                        color: white;
                    }
                }
                @keyframes animacion-boton-reverse {
                    100% {
                        background-color: white;
                    }
                }

                .button p {
                    text-align: center;
                    user-select: none;
                    font-weight: bold;
                }
            </style>
        `;
    }

    // Inicializará el componente en el shadowDOM
    initComponent() {
        this.$tag = this.shadowDOM.querySelector('.boton-panel');
    }

    // Método que escuchará si en algún momento 'desconectamos' el compontente y en caso de hacerlo, lo eliminaremos de la vista
    disconnectedCallback() {
        this.remove();
    }


    // ¡Métodos customizados!

    // Método que redirigirá a la ruta
    redirigirARuta() {
        window.location.href = this.attributes.ruta.value;
    }
}

// Exportamos
export default BotonPanel;
