import { token, paises, estado } from './paises.js';

document.addEventListener('DOMContentLoaded', function () {
    agregar_fruta();
    document.getElementById('paisSelect').addEventListener('change', populateEstados);
});

async function agregar_fruta() {
    let tok = await token();
    let paisData = await paises(tok.auth_token);
    
    let paisSelect = document.getElementById('paisSelect');
    paisSelect.innerHTML = '<option value="0" disabled selected>Ingrese una opción:</option>'; // Clear existing options and add default

    paisData.forEach(function(paiss, index) {
        let op = document.createElement("option");
        op.value = paisData[index].country_name;
        op.id = index;
        op.innerText = paisData[index].country_name;
        paisSelect.appendChild(op);
    });
}

async function populateEstados() {
    let tok = await token();
    let paisSelect = document.getElementById('paisSelect');
    let estadoSelect = document.getElementById('estadoSelect');
    estadoSelect.innerHTML = '<option value="0" disabled selected>Seleccione un estado:</option>'; // Clear existing options and add default
    
    let states = await estado(paisSelect.value, tok.auth_token);
    states.forEach(function(paiss, index) {
        let op = document.createElement("option");
        op.value = states[index].state_name; // Assuming estado has a 'state_name' property
        op.innerText = states[index].state_name;
        estadoSelect.appendChild(op);
    });
}
