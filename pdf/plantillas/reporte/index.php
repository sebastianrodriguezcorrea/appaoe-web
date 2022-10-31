  
<?php

  function getPlantilla($productos) {

  $plantilla ='<body>
    <header class="clearfix">
      <div id="logo">
        <img src="img/paoe.png">
      </div>
      <h1>Reporte</h1>
      
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">SERVICE</th>
            <th class="desc">DESCRIPTION</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>';

        foreach ($productos as $producto) {

          $plantilla .= '<tr>
              <td class="service">'. $producto["id"] .'</td>
              <td class="desc">'. $producto["id"] .'</td>
              <td class="unit">'. $producto["id"] .'</td>
              <td class="qty">'. $producto["id"] .'</td>
              <td class="total">'. $producto["id"] .'</td>
            </tr>';
        
        }  
          
        $plantilla .='</tbody>
      </table>
      
    </main>
    
  </body>';

  return $plantilla;

}