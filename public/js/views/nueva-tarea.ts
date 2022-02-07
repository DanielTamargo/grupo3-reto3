/**
 * Mostrará más o menos barras de progreso de prioridad en base a el valor de esta
 * De esta manera, quedará representado de una forma más visual la urgencia de la tarea
 * @param {number} prioridad valor de la prioridad
 */
function actualizarProgressBars(prioridad: number): void {
    switch (prioridad) {
        case 1:
            document.getElementById('prioridad-pb-2').style.display = "none";
            document.getElementById('prioridad-pb-3').style.display = "none";
            document.getElementById('prioridad-pb-4').style.display = "none";
            document.getElementById('prioridad-pb-5').style.display = "none";
            document.getElementById('prioridad-texto').innerHTML = "Prioridad de la tarea - Baja";
            break;
        case 2:
            document.getElementById('prioridad-pb-2').style.display = "block";
            document.getElementById('prioridad-pb-3').style.display = "none";
            document.getElementById('prioridad-pb-4').style.display = "none";
            document.getElementById('prioridad-pb-5').style.display = "none";
            document.getElementById('prioridad-texto').innerHTML = "Prioridad de la tarea - Leve";
            break;
        case 3:
            document.getElementById('prioridad-pb-2').style.display = "block";
            document.getElementById('prioridad-pb-3').style.display = "block";
            document.getElementById('prioridad-pb-4').style.display = "none";
            document.getElementById('prioridad-pb-5').style.display = "none";
            document.getElementById('prioridad-texto').innerHTML = "Prioridad de la tarea - Moderada";
            break;
        case 4:
            document.getElementById('prioridad-pb-2').style.display = "block";
            document.getElementById('prioridad-pb-3').style.display = "block";
            document.getElementById('prioridad-pb-4').style.display = "block";
            document.getElementById('prioridad-pb-5').style.display = "none";
            document.getElementById('prioridad-texto').innerHTML = "Prioridad de la tarea - Grave";
            break;
        case 5:
            document.getElementById('prioridad-pb-2').style.display = "block";
            document.getElementById('prioridad-pb-3').style.display = "block";
            document.getElementById('prioridad-pb-4').style.display = "block";
            document.getElementById('prioridad-pb-5').style.display = "block";
            document.getElementById('prioridad-texto').innerHTML = "Prioridad de la tarea - Urgencia";
            break;
    }
}

function actualizarRange(evt: any): void {
    let p_prioridad: HTMLInputElement = <HTMLInputElement> document.getElementById('prioridad');
    p_prioridad.value = evt.target.value;
    actualizarProgressBars(Number(evt.target.value));
}

function controlarPrioridad(evt: any): void {
    if (evt.target.value > 5) evt.target.value = 5;
    if (evt.target.value < 1) evt.target.value = 1;

    let p_prioridad_range: HTMLInputElement = <HTMLInputElement> document.getElementById('prioridad-range');
    p_prioridad_range.value = evt.target.value;

    actualizarProgressBars(Number(evt.target.value));
}

function controlarIntro(evt: any): void {
    if (evt.keyCode == 13) // <- ENTER (para evitar que presione enter y envie el formulario a medias)
        evt.preventDefault();
    controlarPrioridad(evt);
}

// Listeners
document.getElementById('prioridad-range').addEventListener('change', actualizarRange);
document.getElementById('prioridad').addEventListener('change', controlarPrioridad);
document.getElementById('prioridad').addEventListener('keypress', controlarIntro);

// Inicializamos las progress bars
let prioridad: HTMLInputElement = <HTMLInputElement> document.getElementById('prioridad');
actualizarProgressBars(Number(prioridad.value));
