function actualizarProgressBars(prioridad) {
    switch (prioridad) {
        case 1:
            document.getElementById('prioridad-pb-2').style.display = "none";
            document.getElementById('prioridad-pb-3').style.display = "none";
            document.getElementById('prioridad-pb-4').style.display = "none";
            document.getElementById('prioridad-pb-5').style.display = "none";
            break;
        case 2:
            document.getElementById('prioridad-pb-2').style.display = "block";
            document.getElementById('prioridad-pb-3').style.display = "none";
            document.getElementById('prioridad-pb-4').style.display = "none";
            document.getElementById('prioridad-pb-5').style.display = "none";
            break;
        case 3:
            document.getElementById('prioridad-pb-2').style.display = "block";
            document.getElementById('prioridad-pb-3').style.display = "block";
            document.getElementById('prioridad-pb-4').style.display = "none";
            document.getElementById('prioridad-pb-5').style.display = "none";
            break;
        case 4:
            document.getElementById('prioridad-pb-2').style.display = "block";
            document.getElementById('prioridad-pb-3').style.display = "block";
            document.getElementById('prioridad-pb-4').style.display = "block";
            document.getElementById('prioridad-pb-5').style.display = "none";
            break;
        case 5:
            document.getElementById('prioridad-pb-2').style.display = "block";
            document.getElementById('prioridad-pb-3').style.display = "block";
            document.getElementById('prioridad-pb-4').style.display = "block";
            document.getElementById('prioridad-pb-5').style.display = "block";
            break;
    }
}
function actualizarRange(evt) {
    var p_prioridad = document.getElementById('prioridad');
    p_prioridad.value = evt.target.value;
    actualizarProgressBars(Number(evt.target.value));
}
function controlarPrioridad(evt) {
    if (evt.target.value > 5)
        evt.target.value = 5;
    if (evt.target.value < 1)
        evt.target.value = 1;
    var p_prioridad_range = document.getElementById('prioridad-range');
    p_prioridad_range.value = evt.target.value;
    actualizarProgressBars(Number(evt.target.value));
}
function controlarIntro(evt) {
    if (evt.keyCode == 13)
        evt.preventDefault();
    controlarPrioridad(evt);
}
document.getElementById('prioridad-range').addEventListener('change', actualizarRange);
document.getElementById('prioridad').addEventListener('change', controlarPrioridad);
document.getElementById('prioridad').addEventListener('keypress', controlarIntro);
actualizarProgressBars(1);
//# sourceMappingURL=nueva-tarea.js.map