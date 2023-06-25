<!doctype html>
<html lang="es">

<head>
  <title>Filtro 1</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body style="background: center/cover no-repeat url('./img/marjan-blan-jhARm0AqF_E-unsplash.jpg'); min-height: 100vh; color: aliceblue;">

  <div class="container">
    
    <!-- Cabecera -->
    <div class="row text-center mt-3">
      <h3>Super héroes - Filtro 1</h3>
      <p>Reportes en formato PDF</p>
    </div>

    <!-- Filtro -->
    <div class="row">
      <div class="col-md-12">
        <!-- Inicio de card -->
        <div class="card">
          <!-- Filtro de casas y bando -->
          <div class="card-header bg-warning bg-opacity-25 text-dark">
            Filtro de casas y bando
          </div>
          <div class="card-body">
            <div class="row">
              <!-- Primer filtro de casas -->
              <div class="col-md-5">
                <label for="">Casa distribuidora</label>
                <select name="" id="casas" class="form-select">
                  <option value="0">Seleccione</option>
                </select>
              </div>
              <!-- Segundo filtro de bandos -->
              <div class="col-md-5">
                <label for="">Bando</label>
                <select name="" id="bando" class="form-select">
                  <option value="0">Seleccione</option>
                </select>
              </div>
              <div class="col-md-2 mt-4">
                <div class="d-grid">
                  <button type="button" id="generarPDF" class="btn btn-secondary">Generar PDF</button>
                </div>
              </div>
            </div>
          </div><!-- Fin card-body -->
        </div><!-- Fin de card -->
      </div>
    </div>

    <!-- Datos - tabla -->
    <div class="row mt-2">
      <div class="col-md-12">
        <table class="table display   responsive nowrap" style="background: rgba(0, 0, 0, 0.05); backdrop-filter: blur(15px);" id="table-superhero">
          <colgroup>
            <col width="5%">
            <col width="20%">
            <col width="35%">
            <col width="20%">
            <col width="20%">
          </colgroup>
          <thead class="table-info">
            <tr>
              <th>ID</th>
              <th>Nick</th>
              <th>Hombre</th>
              <th>Raza</th>
              <th>Casa Publicadora</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const selectCasas = document.querySelector("#casas");
      const selectBando = document.querySelector("#bando");
      const tabla = document.querySelector("#table-superhero tbody") 
      const btnGenerar = document.querySelector("#generarPDF"); 
      let filtroPDF = -1; 

      function getPublishers() {
        const parametros = new URLSearchParams();
        parametros.append('operacion', 'listAll');

        fetch(`../controllers/publisher.php?${parametros}`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            datos.forEach(element => {
              const optionTag = document.createElement("option");
              optionTag.value = element.id;
              optionTag.text = element.publisher_name;
              selectCasas.appendChild(optionTag);
            })
          }).catch(error => {
            console.log(error)
          })

      }
      function getAlignment() {
        const parametros = new URLSearchParams();
        parametros.append('operacion', 'listAll');

        fetch(`../controllers/alignment.php?${parametros}`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            datos.forEach(element => {
              const optionTag = document.createElement("option");
              optionTag.value = element.id;
              optionTag.text = element.alignment;
              selectBando.appendChild(optionTag);
            })
          }).catch(error => {
            console.log(error)
          })
      }
      function render() {
        const optionCasa = parseInt(selectCasas.value);
        const optionBando = parseInt(selectBando.value);
        const operador = optionBando >= 1 ? optionBando : "0";
        const parametros = new URLSearchParams();
        parametros.append('operacion', 'listByPublisherAndAlignment');
        parametros.append('publisher_id', optionCasa);
        parametros.append('alignment_id', operador);

        fetch(`../controllers/superhero.php?${parametros}`)
          .then(respuesta => respuesta.text()) 
          .then(datos => {
            if (!datos || datos.length === 0) {
              alert('No hay datos disponibles.');
              tabla.innerHTML = "";
              selectBando.value = 0
              filtroPDF = -1;
            } else { 
              registro = JSON.parse(datos)
              tabla.innerHTML = ""; 
              filtroPDF = 1 

              registro.forEach(element => {

                let tableRow =
                  `
                <tr class='text-light'>
                  <td>${element['id']}</td>
                  <td>${element['superhero_name']}</td>
                  <td>${element['full_name']}</td>
                  <td>${element['race']}</td>
                  <td>${element['publisher']}</td>
                </tr>            
                `
                tabla.innerHTML += tableRow;

              })
            }
          })
      }
      function PDFBuild() {
        if (selectBando.value == 0) {
          alert("Debes elegir un bando para poder crear el PDF");
        } 
        else if (filtroPDF > 0) {
          const parametros = new URLSearchParams();
          parametros.append("publisher_id", selectCasas.value)
          parametros.append("alignment_id", selectBando.value)
          parametros.append("titulo", selectCasas.options[selectCasas.selectedIndex].text)

          window.open(`../reports/filtro1/reporte.php?${parametros}`, '_blank')
        } 
        else {
          alert("No existen datos disponibles para generar el PDF");
        }
      }
      selectCasas.addEventListener('change', render);
      selectBando.addEventListener('change', render);
      btnGenerar.addEventListener('click', PDFBuild)

      getPublishers();
      getAlignment();

    })
  </script>

</body>

</html>
