<div class=" d-flex justify-content-center p-5">
    <div>
        <h1 class="text-center mb-5 fw-bold">Probando Cosas</h1>
       
        <p>ACA VA EL FORMULARIO DONDE EL USUARIO PONE SUS CREDENCIALES</p>

        <?PHP

        $usuarioProvisto='tramirez_dv';
        $claveProvista='clave123';

        


        /*echo "<pre>";
        print_r($usuarioProvisto);
        echo "</pre>";


        

        echo "<pre>";
        print_r($claveProvista);
        echo "</pre>";


          (new Autenticacion())->log_in($usuarioProvisto, $claveProvista);

          echo "<pre>";
          print_r($_SESSION);
          echo "</pre>";*/

        // $usuarioProvisto="jperez_dv";
        // $passwordProvisto="password123";

       

        // echo "<pre>";
        // print_r($usuarioProvisto);
        // echo "</pre>";


        // echo "<pre>";
        // print_r($passwordProvisto);
        // echo "</pre>";

        //


        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";

        (new Autenticacion())->log_out();
        ?>





    </div>
</div>