<div class="container text-center">
    <h2><?= $_GET['titulo'] ?></h2>
    <p>Generado desde Backend</p>
</div>

<div class="container mt-3">
  <table class="table table-border">
    <colgroup>
      <col style="width:5%;">
      <col style="width:20%;">
      <col style="width:30%;">
      <col style="width:15%;">
      <col style="width:15%;">
      <col style="width:15%;">
    </colgroup>
    <thead>
      <tr class="bg-primary">  
        <th>#</th>
        <th>Nick</th>
        <th>Nombre</th>
        <th>C. Ojos</th>
        <th>C. Cabello</th>
        <th>C. Piel</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $registro): ?>
          <tr>
            <td><?= $registro['id'] ?></td>
            <td><?= $registro['superhero_name'] ?></td>
            <td><?= $registro['full_name'] ?></td>
            <td><?= $registro['eye_colour'] ?></td>
            <td><?= $registro['hair_colour'] ?></td>
            <td><?= $registro['skin_colour'] ?></td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>