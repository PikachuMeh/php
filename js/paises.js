
async function agregar_fruta() {
    let tok = await token()
    let paisData = await paises(tok['auth_token']); // Replace with your actual country data
    
    let paisSelect = document.getElementById('paisSelect');
    paisSelect.innerHTML = '';
    paisData.forEach(function(paiss,index) {
      let op = document.createElement("option")
      op.value = paisData[index]['country_name']
      op.id = index
      op.innerText = paisData[index]['country_name']
      paisSelect.appendChild(op)  

    })
    
}

async function populateEstados() {

    let tok = await token()
    let estadoSelect = document.getElementById('estadoSelect');
    estadoSelect.innerHTML = ''; // Clear existing options
    
    let states = await estado(pais.value,tok['auth_token'])
    states.forEach(function(paiss,index) {
      let op = document.createElement("option");
      op.value = states[index]['state_name']; // Assuming estado has a 'nombre' property
      op.innerText = states[index]['state_name'];
      estadoSelect.appendChild(op);
    });
}


