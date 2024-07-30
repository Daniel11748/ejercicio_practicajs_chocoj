const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnBuscar = document.getElementById('btnBuscar');
const btnCancelar = document.getElementById('btnCancelar');
const btnLimpiar = document.getElementById('btnLimpiar');
const tablaServicios = document.getElementById('tablaServicios');
const btnEliminar = document.getElementById('btnEliminar');
const formulario = document.querySelector('form');

btnModificar.parentElement.style.display = 'none'
btnCancelar.parentElement.style.display = 'none'

const getServicios = async (alerta = 'si',) => {
    const cliente = formulario.ser_cli_id.value
    const vehiculo = formulario.ser_veh_id.value
    const fecha = formulario.ser_fecha.value
    const descripcion = formulario.ser_descripcion.value
    const costo = formulario.ser_costo.value
    const url = `/ejercicio_practicajs_chocoj/controllers/servicios/index.php?ser_cli_id=${cliente}&ser_veh_id=${vehiculo}&ser_fecha=${fecha}&ser_descripcion=${descripcion}&ser_costo=${costo}`
    const config = {
        method: 'GET'
    }
    
    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);

        tablaServicios.tBodies[0].innerHTML = ''
        const fragment = document.createDocumentFragment()
        let contador = 1;
        if (respuesta.status == 200) {
            if (alerta == 'si') {
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: 'Servicios encontrados',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
            }

            if (data.length > 0) {
                data.forEach(servicio => {
                    const tr = document.createElement('tr')
                    const celda1 = document.createElement('td')
                    const celda2 = document.createElement('td')
                    const celda3 = document.createElement('td')
                    const celda4 = document.createElement('td')
                    const celda5 = document.createElement('td')
                    const celda6 = document.createElement('td')
                    const celda7 = document.createElement('td')
                    const celda8 = document.createElement('td')
                    const buttonModificar = document.createElement('button')
                    const buttonEliminar = document.createElement('button')

                    celda1.innerText = contador;
                    celda2.innerText = servicio.ser_cli_id;
                    celda3.innerText = servicio.ser_veh_id;
                    celda4.innerText = servicio.ser_fecha;
                    celda5.innerText = servicio.ser_descripcion;
                    celda6.innerText = servicio.ser_costo;




                    buttonModificar.textContent = 'Modificar'
                    buttonModificar.classList.add('btn', 'btn-warning', 'w-100')
                    buttonModificar.addEventListener('click', () => llenardatos(servicio))

                    buttonEliminar.textContent = 'Eliminar'
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100')
                    buttonEliminar.addEventListener('click', () => eliminar(vehiculo))

                    celda7.appendChild(buttonModificar)
                    celda8.appendChild(buttonEliminar)

                    tr.appendChild(celda1)
                    tr.appendChild(celda2)
                    tr.appendChild(celda3)
                    tr.appendChild(celda4)
                    tr.appendChild(celda5)
                    tr.appendChild(celda6)
                    tr.appendChild(celda7)
                    tr.appendChild(celda8)
                    fragment.appendChild(tr);

                    contador++
                });

            } else {
                const tr = document.createElement('tr')
                const td = document.createElement('td')
                td.innerText = 'Servicio No registrado'
                td.colSpan = 8;

                tr.appendChild(td)
                fragment.appendChild(tr)
            }
        } else {
            console.log('Error al buscar los datos');
        }

        tablaServicios.tBodies[0].appendChild(fragment)
    } catch (error) {
        console.log(error);
    }
}
getServicios();


const guardarServicios = async (e) => {
    e.preventDefault();
    btnGuardar.disabled = true;

    const url = '/ejercicio_practicajs_chocoj/controllers/servicios/index.php'
    const formData = new FormData(formulario)
    formData.append('tipo', 1)
    formData.delete('ser_id')
    const config = {
        method: 'POST',
        body: formData
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { mensaje, codigo, detalle } = data
        Swal.mixin({
            toast: true,
            position: "top-start",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
        if (respuesta.status == 200) {
            
        } else {
            console.log(detalle);
        }
        
    } catch (error) {
        console.log(error);
    }
    getServicios(alerta = 'no');
    formulario.reset();
    btnGuardar.disabled = false;
}

const limpiar = async (e) => {
    e.preventDefault();
    btnLimpiar.disabled = true;


    formulario.reset()
    getServicios(alert = 'no');
    btnBuscar.parentElement.style.display = ''
    btnGuardar.parentElement.style.display = ''
    btnLimpiar.parentElement.style.display = ''
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.parentElement.style.display = 'none'

    btnLimpiar.disabled = false;
}


const llenardatos = (servicio) => {
    formulario.ser_id.value = servicio.ser_id
    formulario.ser_cli_id.value = servicio.ser_cli_id
    formulario.ser_veh_id.value = servicio.ser_veh_id
    formulario.ser_fecha.value = servicio.ser_fecha
    formulario.ser_descripcion.value = servicio.ser_descripcion
    formulario.ser_costo.value = servicio.ser_costo
    btnBuscar.parentElement.style.display = 'none'
    btnGuardar.parentElement.style.display = 'none'
    btnLimpiar.parentElement.style.display = 'none'
    btnModificar.parentElement.style.display = ''
    btnCancelar.parentElement.style.display = ''
}

const modificar = async (e) => {
    e.preventDefault();
    btnModificar.disabled = true;

    const url = '/ejercicio_practicajs_chocoj/controllers/servicios/index.php'
    const formData = new FormData(formulario);
    formData.append('tipo', 2);
    const config = {
        method: 'POST',
        body: formData
    };

    try {
        console.log('Enviando datos:', ...formData.entries());
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log('Respuesta recibida:', data);
        const { mensaje, codigo, detalle } = data;
        if (respuesta.status == 200) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: mensaje,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
            formulario.reset()
            getServicios(alerta = 'no');
            btnBuscar.parentElement.style.display = ''
            btnGuardar.parentElement.style.display = ''
            btnLimpiar.parentElement.style.display = ''
            btnModificar.parentElement.style.display = 'none'
            btnCancelar.parentElement.style.display = 'none'

        } else {
            console.log('Error:', detalle);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error al guardar',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    } catch (error) {
        console.log('Error de conexión:', error);
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "error",
            title: 'Error de conexión',
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
    }

    const llenardatos = (servicio) => {
        formulario.ser_id.value = servicio.ser_id
        formulario.ser_cli_id.value = servicio.ser_cli_id
        formulario.ser_veh_id.value = servicio.ser_veh_id
        formulario.ser_fecha.value = servicio.ser_fecha
        formulario.ser_descripcion.value = servicio.ser_descripcion
        formulario.ser_costo.value = servicio.ser_costo
        btnBuscar.parentElement.style.display = 'none'
        btnGuardar.parentElement.style.display = 'none'
        btnLimpiar.parentElement.style.display = 'none'
        btnModificar.parentElement.style.display = ''
        btnCancelar.parentElement.style.display = ''
    }
  
    btnModificar.disabled = false;
}

const cancelar = async (e) => {
    e.preventDefault();
    btnCancelar.disabled = true;

    formulario.reset()
    getServicios();
    btnBuscar.parentElement.style.display = ''
    btnGuardar.parentElement.style.display = ''
    btnLimpiar.parentElement.style.display = ''
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.parentElement.style.display = 'none'

    btnCancelar.disabled = false;

}

const eliminar = async (vehiculo) => {
    const confirmacion = await Swal.fire({
        title: 'ACCION PELIGROSA',
        text: "¡Este dato se eliminará permanentemente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar Servicio!',
        cancelButtonText: 'Cancelar'
    });

    if (confirmacion.isConfirmed) {
        const url = '/ejercicio_practicajs_chocoj/controllers/servicios/index.php';
        const formData = new FormData();
        formData.append('tipo', 3);
        formData.append('ser_id', servicio.ser_id);
        const config = {
            method: 'POST',
            body: formData
        };

        try {
            console.log('Enviando datos:', ...formData.entries());
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log('Respuesta recibida:', data);
            const { mensaje, codigo, detalle } = data;
            if (respuesta.status == 200) {
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: mensaje,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();

                getServicios(alerta = 'no');
            } else {
                console.log('Error:', detalle);
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "error",
                    title: 'Error al eliminar',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
            }
        } catch (error) {
            console.log('Error de conexión:', error);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error de conexión',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    }

}

formulario.addEventListener('submit', guardarServicios)
btnBuscar.addEventListener('click', getServicios)
btnModificar.addEventListener('click', modificar)
btnCancelar.addEventListener('click', cancelar)
btnLimpiar.addEventListener('click', limpiar) 
