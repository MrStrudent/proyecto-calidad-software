<?php
include ('../app/config.php');
include ('../admin/layout/parte1.php');
include ('../app/controllers/roles/listado_de_roles.php');
include ('../app/controllers/usuarios/listado_de_usuarios.php');
include ('../app/controllers/niveles/listado_de_niveles.php');
include ('../app/controllers/grados/listado_de_grados.php');
include ('../app/controllers/materias/listado_de_materias.php');
include ('../app/controllers/administrativos/listado_de_administrativos.php');
include ('../app/controllers/docentes/listado_de_docentes.php');
include ('../app/controllers/estudiantes/listado_de_estudiantes.php');
include ('../app/controllers/estudiantes/reportes_estudiantes_grados.php');
include ('../app/controllers/estudiantes/reporte_estudiantes.php');

?>

<div class="content-wrapper">
    <br>
    <div class="container">
        <div class="row">
            <h1><?=APP_NAME;?></h1>
        </div>
        <br>

<?php
/* ============================================================
   VISTA DOCENTE
   ============================================================ */
if ($rol_sesion_usuario == "DOCENTE") {

    foreach ($docentes as $docente) {
        if ($docente['email'] == $email_sesion) {

            $especialidad = $docente['especialidad'];
            $rol = $docente['nombre_rol'];
            $profesion = $docente['profesion'];
            $direccion = $docente['direccion'];
            $antiguedad = $docente['antiguedad'];
            break;
        }
    }
?>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos del docente</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <td><b>Nombre y apellidos:</b></td>
                            <td><?=$nombres_sesion_usuario." ".$apellidos_sesion_usuario;?></td>
                        </tr>
                        <tr>
                            <td><b>Profesión:</b></td>
                            <td><?=$profesion;?></td>
                        </tr>
                        <tr>
                            <td><b>Especialidad:</b></td>
                            <td><?=$especialidad;?></td>
                        </tr>
                        <tr>
                            <td><b>Rol:</b></td>
                            <td><?=$rol;?></td>
                        </tr>
                        <tr>
                            <td><b>Dirección:</b></td>
                            <td><?=$direccion;?></td>
                        </tr>
                        <tr>
                            <td><b>Antigüedad (años):</b></td>
                            <td><?=$antiguedad;?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
/* ============================================================
   VISTA ESTUDIANTE
   ============================================================ */
} elseif ($rol_sesion_usuario == "ESTUDIANTE") {

    foreach($estudiantes as $estudiante){
        if($email_sesion == $estudiante["email"]){
            $id_estudiante = $estudiante['id_estudiante'];
            $nivel = $estudiante['nivel'];
            $curso = $estudiante['curso'];
            $grupo = $estudiante['paralelo'];
            $turno = $estudiante['turno'];
            break;
        }
    }
?>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos del estudiante</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <td><b>Nombre y apellidos:</b></td>
                            <td><?=$nombres_sesion_usuario." ".$apellidos_sesion_usuario;?></td>
                        </tr>
                        <tr>
                            <td><b>Clave identidad:</b></td>
                            <td><?=$ci_sesion_usuario;?></td>
                        </tr>
                        <tr>
                            <td><b>Grado y grupo:</b></td>
                            <td><?=$curso.' '.$grupo;?></td>
                        </tr>
                        <tr>
                            <td><b>Nivel:</b></td>
                            <td><?=$nivel;?></td>
                        </tr>
                        <tr>
                            <td><b>Turno:</b></td>
                            <td><?=$turno;?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="bi bi-hospital"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><b>Calificaciones</b></span>
                    <a href="<?=APP_URL;?>/admin/calificaciones/reporte_estudiantes.php?id_estudiante=<?=$id_estudiante;?>" class="btn btn-primary btn-sm">Ingresar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="bi bi-calendar-range"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><b>Reportes</b></span>
                    <a href="<?=APP_URL;?>/admin/kardex/reporte_estudiante.php?id_estudiante=<?=$id_estudiante;?>" class="btn btn-info btn-sm">Ingresar</a>
                </div>
            </div>
        </div>
    </div>

<?php
/* ============================================================
   VISTA ADMINISTRADOR (AHORA CORRECTAMENTE UBICADA)
   ============================================================ */
} elseif ($rol_sesion_usuario == "ADMINISTRADOR") {
?>
    <div class="row">

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php
                            $contador_roles = 0;
                            foreach ($roles as $role){
                                $contador_roles = $contador_roles + 1;
                            }
                            ?>
                            <h3><?=$contador_roles;?></h3>
                            <p>Roles registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas"><i class="bi bi-bookmarks"></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/roles" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $contador_usuarios = 0;
                            foreach ($usuarios as $usuario){
                                $contador_usuarios = $contador_usuarios + 1;
                            }
                            ?>
                            <h3><?=$contador_usuarios;?></h3>
                            <p>usuarios registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas"><i class="bi bi-people-fill"></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/usuarios" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $contador_niveles = 0;
                            foreach ($niveles as $nivele){
                                $contador_niveles = $contador_niveles + 1;
                            }
                            ?>
                            <h3><?=$contador_niveles;?></h3>
                            <p>Niveles registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas"><i class="bi bi-bookshelf"></i></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/niveles" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>



                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $contador_grados = 0;
                            foreach ($grados as $grado){
                                $contador_grados = $contador_grados + 1;
                            }
                            ?>
                            <h3><?=$contador_grados;?></h3>
                            <p>Grados registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas"><i class="bi bi-bar-chart-steps"></i></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/grados" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            $contador_materias = 0;
                            foreach ($materias as $materia){
                                $contador_materias = $contador_materias + 1;
                            }
                            ?>
                            <h3><?=$contador_materias;?></h3>
                            <p>Materias registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas"><i class="bi bi-book-half"></i></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/materias" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <p>Chat de IA</p>
                            <p>Empieza a chatear con AMLO 5</p>
                        </div>
                        <div class="icon">
                            <i class="fas"><i class="bi bi-chat-dots"></i></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/chat" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-default">
                        <div class="inner">
                            <?php
                            $contador_administrativos = 0;
                            foreach ($administrativos as $administrativo){
                                $contador_administrativos = $contador_administrativos + 1;
                            }
                            ?>
                            <h3><?=$contador_administrativos;?></h3>
                            <p>Administrativos registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas"style="color: grey"><i class="bi bi-person-badge"></i></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/administrativos" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <?php
                            $contador_docentes = 0;
                            foreach ($docentes as $docente){
                                $contador_docentes = $contador_docentes + 1;
                            }
                            ?>
                            <h3><?=$contador_docentes;?></h3>
                            <p>Docentes registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas" style="color: white"><i class="bi bi-person-video3"></i></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/docentes" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <?php
                            $contador_estudiantes = 0;
                            foreach ($estudiantes as $estudiante){
                                $contador_estudiantes = $contador_estudiantes + 1;
                            }
                            ?>
                            <h3><?=$contador_estudiantes;?></h3>
                            <p>Estudiantes registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas" style=""><i class="bi bi-backpack2"></i></i></i>
                        </div>
                        <a href="<?=APP_URL;?>/admin/estudiantes" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>

<?php
/* ============================================================
   OTROS ROLES → Vista general
   ============================================================ */
} else {

    $sql_datos = "SELECT * FROM usuarios as usu 
                  INNER JOIN roles as rol ON rol.id_rol = usu.rol_id
                  INNER JOIN personas as per ON per.usuario_id = usu.id_usuario
                  WHERE usu.estado='1' AND usu.email ='$email_sesion'";
    $query_datos = $pdo->prepare($sql_datos);
    $query_datos->execute();
    $datos = $query_datos->fetchAll(PDO::FETCH_ASSOC);

    foreach($datos as $dato){
        $nombre_rol = $dato['nombre_rol'];
        $direccion = $dato['direccion'];
        $profesion = $dato['profesion'];
    }
?>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos del usuario</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr><td><b>Nombre y apellidos:</b></td><td><?=$nombres_sesion_usuario." ".$apellidos_sesion_usuario;?></td></tr>
                        <tr><td><b>Rol:</b></td><td><?=$nombre_rol;?></td></tr>
                        <tr><td><b>Email:</b></td><td><?=$email_sesion;?></td></tr>
                        <tr><td><b>Profesión:</b></td><td><?=$profesion;?></td></tr>
                        <tr><td><b>Dirección:</b></td><td><?=$direccion;?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos de los estudiantes</h3>
            </div>
            <div class="card-body">
                <div>
            <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <?php
        $contador =0;
        $contador_secundaria1 = 0;
        $contador_secundaria2 = 0;
        $contador_secundaria3 = 0;
        $contador_bachillerato1 = 0;
        $contador_bachillerato2 = 0;
        $contador_bachillerato3 = 0;
        $contador_bachillerato4 = 0;
        $contador_bachillerato5 = 0;
        $contador_bachillerato6 = 0;
        foreach($reportes_estudiantes as $reportes_estudiante){
             
             if($reportes_estudiante['id_grado'] == "1") $contador_secundaria1 = $contador_secundaria1 + 1; 
             if($reportes_estudiante['id_grado'] == "13") $contador_secundaria2 = $contador_secundaria2 + 1; 
             if($reportes_estudiante['id_grado'] == "14") $contador_secundaria3 = $contador_secundaria3 + 1; 
             if($reportes_estudiante['id_grado'] == "7") $contador_bachillerato1 = $contador_bachillerato1 + 1; 
             if($reportes_estudiante['id_grado'] == "8") $contador_bachillerato2 = $contador_bachillerato2 + 1; 
             if($reportes_estudiante['id_grado'] == "9") $contador_bachillerato3 = $contador_bachillerato3 + 1; 
             if($reportes_estudiante['id_grado'] == "10") $contador_bachillerato4 = $contador_bachillerato4 + 1; 
             if($reportes_estudiante['id_grado'] == "11") $contador_bachillerato5 = $contador_bachillerato5 + 1; 
             if($reportes_estudiante['id_grado'] == "12") $contador_bachillerato6 = $contador_bachillerato6 + 1;  
             
        }
        $datos_reporte_estudiantes = $contador_secundaria1.",".$contador_secundaria2.",".$contador_secundaria3.",".
        $contador_bachillerato1.",".$contador_bachillerato2.",".$contador_bachillerato3.",".
        $contador_bachillerato4.",".$contador_bachillerato5.",".$contador_bachillerato6;
        ?>
        <script>
            var grados =['Sec 1','Sec 2','Sec 3','Bac 1','Bac 2','Bac 3',
                        'Bac 4','Bac 5','Bac 6'];
                        
            var datos = [<?=$datos_reporte_estudiantes?>];

            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: grados,
                    datasets: [{
                        label:'Estudiantes por grados',
                        data: datos,
                        borderWidth: 1
                    }]
                },
                options:{
                    scales: {
                        y:{
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Estudiantes inscritos</h3>
            </div>
            <div class="card-body">
                <div>
            <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
        <?php
        $enero =0; $febrero =0; $marzo =0;$abril =0; $mayo =0; $junio =0;
        $julio =0; $agosto =0; $septiembre =0; $octubre =0; $noviembre =0; $diciembre =0;
        foreach($reportes_estudiantes as $reportes_estudiante){
            $fecha = $reportes_estudiante['fyh_creacion'];
            $fecha = strtotime($fecha);
            $mes = date("m", $fecha);
            if($mes =="01") $enero= $enero +1;
            if($mes == "02") $febrero = $febrero +1;
            if($mes == "03") $marzo = $marzo +1;
            if($mes == "04") $abril = $abril + 1;
            if($mes == "05") $mayo = $mayo + 1;
            if($mes == "06") $junio = $junio +1;
            if($mes == "07") $julio = $julio + 1;
            if($mes == "08") $agosto = $agosto + 1;
            if($mes == "09") $septiembre = $septiembre + 1;
            if($mes == "10") $octubre = $octubre + 1;
            if($mes == "11") $noviembre = $noviembre + 1;
            if($mes == "12") $diciembre = $diciembre + 1;
                
        }
        $reporte_meses = $enero.",".$febrero.",".$marzo.",".$abril.",".$mayo.",".$junio.",".$julio.",".$agosto.",".$septiembre.",".$octubre.",".$noviembre.",".$diciembre;
        ?>
        <script>
        
            var meses =['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            var datos = [<?=$reporte_meses?>];
            const ctx2 = document.getElementById('myChart2');
            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label:'Estudiantes inscritos cada mes',
                        data: datos,
                        borderWidth: 1
                    }]
                },
                options:{
                    scales: {
                        y:{
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <div class="card card-outline card-primary" style="text-align: center;">
            <div class="card-header">
                <h3 class="card-title">Estudiantes inscritos</h3>
            </div>
            <div class="card-body">
                <p><b>Estudiantes inscritos</b></p>
                <input type="text" class="knob" value="<?=$contador_estudiantes?>" data-min="0"
                data-max="1000" data-readonly="true" data-thickness="0.1"
                data-width="100" data-height="100" data-fgColor="#ba1db4" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-primary" style="text-align: center;">
            <div class="card-header">
                <h3 class="card-title">Personal docente</h3>
            </div>
            <div class="card-body">
                <p><b>Docentes disponibles </b></p>
                <input type="text" class="knob" value="<?=$contador_docentes?>" data-min="0"
                data-max="30" data-readonly="true" data-thickness="0.1"
                data-width="100" data-height="100" data-fgColor="#ba881dff" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-primary" style="text-align: center;">
            <div class="card-header">
                <h3 class="card-title">Usuarios totales</h3>
            </div>
            <div class="card-body">
                <p><b>Usuarios totales </b></p>
                <input type="text" class="knob" value="<?=$contador_usuarios?>" data-min="0"
                data-max="<?=$contador_usuarios?>" data-readonly="true" data-thickness="0.1"
                data-width="100" data-height="100" data-fgColor="#201dbaff" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-primary" style="text-align: center;">
            <div class="card-header">
                <h3 class="card-title">Administrativos</h3>
            </div>
            <div class="card-body">
                <p><b>Administrativos totales </b></p>
                <input type="text" class="knob" value="<?=$contador_administrativos?>" data-min="0"
                data-max="10" data-readonly="true" data-thickness="0.1"
                data-width="100" data-height="100" data-fgColor="#1dbabaff" disabled>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<?php
include ('../admin/layout/parte2.php');
include ('../layout/mensajes.php');
?>
<script>
    $(function () {
        $('.knob').knob({
            draw: function () {
                if (this.$.data('skin') == 'tron') {
                    var a   = this.angle(this.cv)  // Angle
                        ,
                        sa  = this.startAngle          // Previous start angle
                        ,
                        sat = this.startAngle         // Start angle
                        ,
                        ea                            // Previous end angle
                        ,
                        eat = sat + a                 // End angle
                        ,
                        r   = true

                    this.g.lineWidth = this.lineWidth

                    this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3)

                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.value)
                        this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3)
                        this.g.beginPath()
                        this.g.strokeStyle = this.previousColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                        this.g.stroke()
                    }

                    this.g.beginPath()
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                    this.g.stroke()

                    this.g.lineWidth = 2
                    this.g.beginPath()
                    this.g.strokeStyle = this.o.fgColor
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                    this.g.stroke()

                    return false
                }
            }
        })
    });
</script>