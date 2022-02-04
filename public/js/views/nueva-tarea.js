/**
 * Mostrará más o menos barras de progreso de prioridad en base a el valor de esta
 * De esta manera, quedará representado de una forma más visual la urgencia de la tarea
 * @param {number} prioridad valor de la prioridad
 */
function actualizarProgressBars(prioridad) {
    switch (prioridad) {
        case 2:
            document.getElementById('prioridad-pb-2').classList.remove('d-none');
            document.getElementById('prioridad-pb-3').classList.add('d-none');
            document.getElementById('prioridad-pb-4').classList.add('d-none');
            document.getElementById('prioridad-pb-5').classList.add('d-none');
            break;
        case 3:
            document.getElementById('prioridad-pb-2').classList.remove('d-none');
            document.getElementById('prioridad-pb-3').classList.add('d-none');
            document.getElementById('prioridad-pb-4').classList.add('d-none');
            document.getElementById('prioridad-pb-5').classList.add('d-none');
            break;
        case 4:
            document.getElementById('prioridad-pb-2').classList.remove('d-none');
            document.getElementById('prioridad-pb-3').classList.remove('d-none');
            document.getElementById('prioridad-pb-4').classList.remove('d-none');
            document.getElementById('prioridad-pb-5').classList.add('d-none');
            break;
        case 5:
            document.getElementById('prioridad-pb-2').classList.remove('d-none');
            document.getElementById('prioridad-pb-3').classList.remove('d-none');
            document.getElementById('prioridad-pb-4').classList.remove('d-none');
            document.getElementById('prioridad-pb-5').classList.remove('d-none');
            break;
    }
}
function actualizarRange(evt) {
    var p_prioridad = document.getElementById('prioridad');
    p_prioridad.value = evt.target.value;
}
function controlarPrioridad(evt) {
    if (evt.target.value > 5)
        evt.target.value = 5;
    if (evt.target.value < 1)
        evt.target.value = 1;
    var p_prioridad_range = document.getElementById('prioridad-range');
    p_prioridad_range.value = evt.target.value;
}
function controlarIntro(evt) {
    console.log(evt);
    if (evt.keyCode == 13) // <- ENTER (para evitar que presione enter y envie el formulario a medias)
        evt.preventDefault();
    controlarPrioridad(evt);
}
// Listener
document.getElementById('prioridad-range').addEventListener('change', actualizarRange);
document.getElementById('prioridad').addEventListener('change', controlarPrioridad);
document.getElementById('prioridad').addEventListener('keypress', controlarIntro);
