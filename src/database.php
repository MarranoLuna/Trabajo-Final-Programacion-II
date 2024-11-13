<?php
  class Database {
    public $conn;

    public function __construct(){
      $this->connect();
    }

    public function connect(){
        $this->conn = new PDO('mysql:host=localhost;dbname=asistencias','root','');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }


    public function obtener_usuario_por_email($email) {
      $sql = "SELECT * FROM profesores WHERE email = :email";
      $stmt = $this->conn->prepare($sql); 
      $stmt->bindParam(':email', $email);
      $stmt->execute();
  
      return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna el usuario o false si no existe
  }


    public function exists_profesor_legajo($legajo){
        $sql = "SELECT * FROM profesores WHERE legajo = :legajo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':legajo', $legajo);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
          return true;
        } else {
          return false;
        }
    }

    public function exists_profesor_dni($dni){
      $sql = "SELECT * FROM profesores WHERE dni = :dni";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':dni', $dni);
      $stmt->execute();
      
      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
  }


    public function exists_alumno($dni){
      $sql = "SELECT * FROM alumnos WHERE dni = :dni";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':dni', $dni);
      $stmt->execute();
      
      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
  }

  public function exists_materia($materia,$cue){
    $sql = "SELECT * FROM materias WHERE materia = :materia AND cue = :cue";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':materia', $materia);
    $stmt->bindParam(':cue', $cue);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
}

  public function exists_instituto($cue){
    $sql = "SELECT * FROM institutos WHERE cue = :cue";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':cue', $cue);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

    public function buscar_alumno_por_dni($dni){
      $sql = "SELECT * FROM alumnos WHERE dni = :dni";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':dni', $dni);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
      } else {
        return false;
      }
    }

    public function buscar_alumno($dni){
      $sql = "SELECT * FROM alumnos WHERE dni = :dni";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
      $stmt->execute();
      $alumno = $stmt->fetch(PDO::FETCH_ASSOC);
      return $alumno;
    }

    public function buscar_instituto($cue){
      $sql = "SELECT * FROM institutos WHERE cue = :cue";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':cue', $cue, PDO::PARAM_INT);
      $stmt->execute();
      $instituto = $stmt->fetch(PDO::FETCH_ASSOC);
      return $instituto;
    }

    public function buscar_materia($id_materia){
      $sql = "SELECT * FROM materias WHERE id_materia = :id_materia";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':id_materia', $id_materia);
      $stmt->execute();
      $materia = $stmt->fetch(PDO::FETCH_ASSOC);
      return $materia;
    }
    

    public function obtener_materias_por_instituto($cue){
      $sql = "SELECT * FROM materias WHERE cue = :cue";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':cue', $cue);
      $stmt->execute();
      if ($stmt->rowCount() > 0){ 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    }

    public function vincular_alumno_materia($dni,$id_materia){
      $sql = "INSERT INTO alumnos_materias(dni,id_materia) VALUES(:dni,:id_materia)";
      $stmt = $this->conn->prepare($sql); 
      $stmt->bindParam(':dni', $dni);
      $stmt->bindParam(':id_materia', $id_materia);
      $stmt->execute();
    }

    public function alta_profesor($legajo,$nombre,$apellido,$email,$pass,$dni){
      $sql = "INSERT INTO profesores(legajo,nombre,apellido,email,contraseña,dni) VALUES(:legajo, :nombre, :apellido, :email, :pass, :dni)";
      $stmt = $this->conn->prepare($sql); 
      $stmt->bindParam(':legajo', $legajo);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':apellido', $apellido);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':pass', $pass);
      $stmt->bindParam(':dni', $dni);
      $stmt->execute();
    }

    public function insertar_profesor_instituto($legajo,$cue){
      $sql = "INSERT INTO profesores_institutos(legajo,cue) VALUES(:legajo, :ncue)";
      $stmt = $this->conn->prepare($sql); 
      $stmt->bindParam(':legajo', $legajo);
      $stmt->bindParam(':cue', $cue);
      $stmt->execute();
    }

    public function alta_instituto($cue, $nombre, $direccion, $requisito){
      $sql = "INSERT INTO institutos(cue,nombre,direccion,id_requisito) VALUES(:cue, :nombre, :direccion, :requisito)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':cue', $cue);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':direccion', $direccion);
      $stmt->bindParam(':requisito', $requisito);
      $stmt->execute();
    }

    public function alta_materia($materia, $cue){
      $sql = "INSERT INTO materias(materia, cue) VALUES(:materia, :cue)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':materia', $materia);
      $stmt->bindParam(':cue', $cue);
      $stmt->execute();
    }

    public function alta_alumno($dni, $nombre, $apellido, $email, $fecha_nacimiento,$cue){
      $sql = "INSERT INTO alumnos(dni, nombre, apellido, email, fecha_nacimiento, cue) VALUES(:dni, :nombre, :apellido, :email, :fecha_nacimiento, :cue)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':dni', $dni);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':apellido', $apellido);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
      $stmt->bindParam(':cue', $cue);
      $stmt->execute();
    }

    public function traer_alumnos($cue,$id_materia){
      $sql = "SELECT * FROM alumnos a inner join alumnos_materias am on a.dni = am.dni inner join materias mat 
      on am.id_materia = mat.id_materia WHERE mat.id_materia = :id_materia AND mat.cue = :cue";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':cue', $cue);
      $stmt->bindParam(':id_materia', $id_materia);
      $stmt->execute();
      $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $alumnos;
   }

   public function traer_alumnos_por_instituto($cue){
    $sql = "SELECT * FROM alumnos  WHERE cue = :cue";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':cue', $cue);
    $stmt->execute();
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $alumnos;
 }


 public function verificarCumple($fecha, $id_materia) {
  $mes = date('m', strtotime($fecha)); 
  $dia = date('d', strtotime($fecha));

  $sql = "SELECT * FROM alumnos a 
          INNER JOIN alumnos_materias am ON a.dni = am.dni 
          WHERE id_materia = :id_materia";

  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':id_materia', $id_materia);
  $stmt->execute();

  $cumpleanieros = [];

  while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $fecha_nacimiento = $fila['fecha_nacimiento'];
      $mes_nacimiento = date('m', strtotime($fecha_nacimiento));
      $dia_nacimiento = date('d', strtotime($fecha_nacimiento));

      if ($mes == $mes_nacimiento && $dia == $dia_nacimiento) {
        $cumpleanieros[] = $fila['nombre'] . " " . $fila['apellido'];
      }
  }
  return $cumpleanieros;
}



    public function traer_institutos(){
      $sql = "SELECT cue,nombre,direccion FROM institutos";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

    public function traerMaterias($cue) {
      $sql = "SELECT * FROM materias WHERE cue = :cue";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':cue', $cue);
      $stmt->execute();
      return $stmt;
    }

    public function traer_materias_por_instituto($cue) { 
      $sql = "SELECT * FROM materias WHERE cue = :cue"; 
      $stmt = $this->conn->prepare($sql); 
      $stmt->bindParam(':cue', $cue); 
      $stmt->execute(); 
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener_nombre_materia($cue,$id_materia){
      $sql = "SELECT m.materia AS nombre_materia, m.id_materia
      FROM institutos i INNER JOIN materias m ON i.cue = m.cue 
      WHERE m.id_materia = :id_materia AND i.cue = :cue";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':cue', $cue);
      $stmt->bindParam(':id_materia', $id_materia);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      return $resultado ? $resultado['nombre_materia'] : null;
    }

    public function obtener_nombre_instituto($cue,$id_materia){
      $sql = "SELECT i.nombre AS nombre_instituto
      FROM institutos i INNER JOIN materias m ON i.cue = m.cue 
      WHERE m.id_materia = :id_materia AND i.cue = :cue";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':cue', $cue);
      $stmt->bindParam(':id_materia', $id_materia);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      return $resultado ? $resultado['nombre_instituto'] : null;
    }

    public function guardar_asistencia($dni, $id_materia, $fecha, $estado_asistencia){
      $sql = "SELECT * FROM asistencias WHERE fecha = :fecha AND id_materia = :id_materia AND dni = :dni";
      $stmt = $this->conn->prepare($sql); 
      $stmt->bindParam(':fecha', $fecha);
      $stmt->bindParam(':id_materia', $id_materia);
      $stmt->bindParam(':dni', $dni);
      $stmt->execute();
  
      if ($stmt->rowCount() > 0) {
          $sql = "UPDATE asistencias SET estado = :estado WHERE fecha = :fecha AND id_materia = :id_materia AND dni = :dni";
      } else {
          $sql = "INSERT INTO asistencias (fecha, id_materia, dni, estado) VALUES (:fecha, :id_materia, :dni, :estado)";
      }
      
      $stmt = $this->conn->prepare($sql); 
      $stmt->bindParam(':fecha', $fecha);
      $stmt->bindParam(':id_materia', $id_materia);
      $stmt->bindParam(':dni', $dni);
      $stmt->bindParam(':estado', $estado_asistencia);
      $stmt->execute();
  }


  public function existeAsistencia($fecha, $id_materia) {
    $sql = "SELECT * FROM asistencias WHERE fecha = :fecha AND id_materia = :id_materia";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':id_materia', $id_materia);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $sql = "SELECT a.nombre, a.apellido, a.dni, asis.estado AS estado  #se obtiene la lista de todos los alumnos para la materia y fecha especificadas, junto con su estado de asistencia
                FROM alumnos a
                INNER JOIN alumnos_materias am ON a.dni = am.dni
                INNER JOIN materias mat ON am.id_materia = mat.id_materia
                LEFT JOIN asistencias asis ON a.dni = asis.dni AND asis.fecha = :fecha AND asis.id_materia = :id_materia
                WHERE mat.id_materia = :id_materia";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id_materia', $id_materia);
        $stmt->execute();
        $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $alumnos;
    } else {
        $sql = "SELECT a.nombre, a.apellido, a.dni       #solo se obtiene la lista de todos los alumnos en esa materia
                FROM alumnos a
                INNER JOIN alumnos_materias am ON a.dni = am.dni
                INNER JOIN materias mat ON am.id_materia = mat.id_materia
                WHERE mat.id_materia = :id_materia";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_materia', $id_materia);
        $stmt->execute();
        $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $alumnos;
    }
}

  

    public function obtener_vinculos($dni) {
      $sql = "SELECT id_materia FROM alumnos_materias WHERE dni = :dni";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':dni', $dni); 
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC); 
  }    

  public function eliminar_vinculo($dni, $id_materia) {
    $sql = "DELETE FROM alumnos_materias WHERE dni = :dni AND id_materia = :id_materia";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':id_materia', $id_materia);
    $stmt->execute();
  }

  public function guardar_notas($dni, $id_examen, $id_materia, $nota) {
    $sql = "SELECT * FROM alumnos_examen WHERE dni = :dni AND id_examen = :id_examen AND id_materia = :id_materia";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':id_examen', $id_examen);
    $stmt->bindParam(':id_materia', $id_materia);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $sql = "UPDATE alumnos_examen SET nota = :nota WHERE dni = :dni AND id_examen = :id_examen AND id_materia = :id_materia";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':id_examen', $id_examen);
        $stmt->bindParam(':id_materia', $id_materia);
        $stmt->bindParam(':nota', $nota);
        $stmt->execute();
    } else {
        $sql = "INSERT INTO alumnos_examen(dni, id_examen, id_materia, nota) VALUES(:dni, :id_examen, :id_materia, :nota)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':id_examen', $id_examen);
        $stmt->bindParam(':id_materia', $id_materia);
        $stmt->bindParam(':nota', $nota);
        $stmt->execute();
    }
}


  public function modificar_alumno($dni,$nombre,$apellido,$email,$fecha_nacimiento){
    $sql = "UPDATE alumnos SET nombre = :nombre, apellido = :apellido, email = :email, fecha_nacimiento = :fecha_nacimiento WHERE dni = :dni";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function modificar_instituto($nombre, $direccion, $cue){
    $sql = "UPDATE institutos SET nombre = :nombre, direccion = :direccion WHERE cue = :cue";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':cue', $cue);
    $stmt->execute();
  }

  public function modificar_materia($materia, $cue, $id_materia){
    $sql = "UPDATE materias SET materia = :materia, cue = :cue WHERE id_materia = :id_materia";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':materia', $materia);
    $stmt->bindParam(':cue', $cue);
    $stmt->bindParam(':id_materia', $id_materia);
    $stmt->execute();
  }

  public function traer_examenes_por_materia($id_materia, $dni) {
    $sql = "SELECT id_examen, nota FROM alumnos_examen WHERE id_materia = :id_materia AND dni = :dni";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_materia', $id_materia);
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
  }

  public function traer_alumno($dni) {
    $sql = "SELECT * FROM alumnos WHERE dni = :dni";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function total_asistencias($dni,$id_materia) {
  $sql = "SELECT count(*) FROM asistencias WHERE dni = :dni AND id_materia = :id_materia ";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':dni', $dni);
  $stmt->bindParam(':id_materia', $id_materia);
  $stmt->execute();
  return $stmt->fetchColumn();
}

public function total_asistencias_presentes($dni,$id_materia) {
  $sql = "SELECT count(*) FROM asistencias WHERE dni = :dni AND id_materia = :id_materia AND estado ='presente'";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':dni', $dni);
  $stmt->bindParam(':id_materia', $id_materia);
  $stmt->execute();
  return $stmt->fetchColumn();
}

public function requisitos() {
  $sql = "SELECT * FROM requisitos";
  $stmt = $this->conn->prepare($sql);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function guardarRequisitoPromocion($parciales,$trabajo,$asistencia){
    $sql = "UPDATE requisitos SET promocion_nota = :parciales, promocion_tp = :trabajo, promocion_asistencia = :asistencia";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':parciales', $parciales);
    $stmt->bindParam(':trabajo', $trabajo);
    $stmt->bindParam(':asistencia', $asistencia);
    $stmt->execute();
}

public function guardarRequisitoRegular($parciales,$trabajo,$asistencia){
  $sql = "UPDATE requisitos SET regularizar_nota = :parciales, regularizar_tp = :trabajo, regularizar_asistencia = :asistencia";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':parciales', $parciales);
  $stmt->bindParam(':trabajo', $trabajo);
  $stmt->bindParam(':asistencia', $asistencia);
  $stmt->execute();
}

public function eliminar_alumno($dni) {
  $sql = "DELETE FROM alumnos WHERE dni = :dni";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':dni', $dni);
  $stmt->execute();
}

public function eliminar_materia($id_materia) {
  $sql = "DELETE FROM materias WHERE id_materia = :id_materia";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':id_materia', $id_materia);
  $stmt->execute();
}

public function eliminar_instituto($cue) {
  $sql = "DELETE FROM institutos WHERE cue = :cue";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':cue', $cue);
  $stmt->execute();
}


   
  }


 




    