$(document).ready(function () {
  console.log("jquery is working");
  $("#task-result").hide();
  // Cuando inicia la aplicacion obtenemos todos los datos de nuestra base de datos
  fetchTasks();

  // Trabajamos con el evento de search
  $("#search").keyup(function (e) {
    // si viene algo por el id search hacemo lo siguiente
    if ($("#search").val()) {
      // Guardamos su valor en una variable
      let search = $("#search").val();
      // Hacemos una peticion POST a nuestro backEnd con los datos de search
      $.ajax({
        url: "task-search.php",
        type: "POST",
        data: { search },
        success: function (response) {
          // Si nos devuelve datos lo convertimos en formato Json y creamos un template para añadir al html el resultado
          let tasks = JSON.parse(response);
          let template = "";
          tasks.forEach((task) => {
            template += `
              <li>Name: ${task.name} 
                <li>Description: ${task.description}</li>
              </li>
              <hr>
            `;
          });
          // Añadimos el resultado en container y volvemos a mostrar la card task-result
          $("#container").html(template);
          $("#task-result").show();
        },
      });
    }
  });
});

let edit = false;

// Trabajamos con el evento del formulario de ingreso
$("#task-form").submit(function (e) {
  e.preventDefault();
  // Creamos un objeto para guardar los datos del formulario
  const postData = {
    name: $("#name").val(),
    description: $("#description").val(),
    id: $("#taskId").val()
  };

  let url = edit === false ? "task-add.php" : "task-update.php";
  console.log(url);

  // Enviamos los datos al backEnd para que procese esos datos y nos de una respuesta
  $.post(url, postData, function (response) {
    console.log(response);
    // Obtenemos los datos actualizados de la base de datos.
    fetchTasks();

    let message = edit === false ? 
    {text: "task added successfully",
     style: "linear-gradient(to right, #00b09b, #96c93d)"} : 
    {text: "task edited successfully",
      style: "linear-gradient(to right, #00b0a1, #3dc2c9)"};

    Toastify({
      text: message.text,
      duration: 2000,
      newWindow: true,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "right", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      style: {
        background: message.style,
      },
      onClick: function () {}, // Callback after click
    }).showToast();

    // Cuando obtenemos la respuesta reseteamos el formulario
    $("#task-form").trigger("reset");
  });
});

function fetchTasks() {
  $.ajax({
    url: "task-list.php",
    type: "GET",
    success: function (response) {
      // Si nos devuelve datos los vamos recorriendo y agregando en la tabla
      let tasks = JSON.parse(response);
      let template = "";
      tasks.forEach((task) => {
        template += `
        <tr taskId="${task.id}">
          <td>${task.id}</td>
          <td>${task.name}</td>
          <td>${task.description}</td>
          <td> 
          <a class="btn btn-info task-update" href="#" role="button"><i class="fa-regular fa-pen-to-square"></i></a>  
          <a class="btn btn-danger task-delete" href="#" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a> 
          </td>
        </tr>`;
      });
      // Añadimos el resultado en container y volvemos a mostrar la card task-result
      $("#tasks").html(template);
    },
  });
}

// Escuchamos el evento onClick del boton eliminar
$(document).on("click", ".task-delete", function () {
  // Buscamos el id del elemento que necesitamos eliminar y lo almacenamos en una variable id
  let element = $(this)[0].parentElement.parentElement;
  let id = $(element).attr("taskId");

  // Creamos un mensaje de alerta para preguntar si estamos seguros de eliminar esta fila
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        "Deleted!",
        "task successfully deleted",
        "success",
        // Enviamos al BackEnd el contenido de la variable id y escuchamos su respuesta
        $.post("task-delete.php", { id }, function (response) {
          console.log(response);
        })
      );
    }
    fetchTasks();
  });
});

// Escuchamos el evento onClick del boton editar
$(document).on("click", ".task-update", function (e) {
  // Buscamos el id del elemento que necesitamos eliminar y lo almacenamos en una variable id
  let element = $(this)[0].parentElement.parentElement;
  let id = $(element).attr("taskId");

  // Enviamos al BackEnd el contenido de la variable id y escuchamos su respuesta
  $.post("task-single.php", { id }, function (response) {
    let task = JSON.parse(response);
    $("#name").val(task.name);
    $("#description").val(task.description);
    $("#taskId").val(task.id);
    edit = true;
  });
});
