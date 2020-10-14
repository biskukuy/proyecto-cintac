<?php
if ( !class_exists( 'ConexionBCN' ) ) {
	class ConexionBCN {
		public $nro_filas;
		public $ultimo_id;
		public $debug;

		public function __construct() {
			global $GLOBALES;
			$this->servidor = $GLOBALES["servidor"];
			$this->basedatos = $GLOBALES["basedatos"];
			$this->usuario = $GLOBALES["usuariobd"];
			$this->password = $GLOBALES["passwordbd"];
			$this->nro_filas = 0;
			$this->ultimo_id = 0;
			$this->debug = false;
		}

		protected function conectar() {
			return new mysqli($this->servidor, $this->usuario, $this->password, $this->basedatos);
		}
		
		public function consulta($query) {
			$db = $this->conectar();
			$result = $db->query($query);
			$this->nro_filas = $result->num_rows;
			$results = array();
			while ($row = $result->fetch_object()) {
				$results[] = $row;
			}
			return $results;
		}

		public function ejecutar($query) {
			$db = $this->conectar();
			$result = $db->query($query);
			$this->auditoriaSQL($query);
			return $result;
		}

		public function seleccionar($tabla, $campos="*", $where="", $adicional="") {
			$db = $this->conectar();
			$where = (array) $where;
			$where_clause = '';
			
			$where_clause = $this->prep_array($where,3);
			if ($where_clause!=""){ $where_clause = " WHERE ".$where_clause; }

			$query = "SELECT {$campos} FROM {$tabla} {$where_clause} {$adicional}";
			$result = $db->query($query);
			$this->nro_filas = $result->num_rows;
			$results = array();
			while ($row = $result->fetch_object()) {
				$results[] = $row;
			}

			return $results;
		}

		public function existe($tabla,$where,$notWhere=""){
			$db = $this->conectar();
			$where = (array) $where;
			if ($notWhere!=""){ $notWhere = (array) $notWhere; }
			$where_clause = '';
			$where_not_clause = '';
			
			$where_clause = $this->prep_array($where,3);
			$where_not_clause = $this->prep_array($notWhere,3);

			if ($where_clause!=""){ $where_clause = " WHERE ".$where_clause; }
			if ($where_not_clause!=""){ $where_clause .= " AND NOT ".$where_not_clause; }

			$query = "SELECT * FROM {$tabla} {$where_clause} limit 1";

			$result = $db->query($query);
			if ($result->num_rows > 0){
				return true;				
			}

			return false;
		}
		
		public function insertar($tabla, $datos) {
			if ( empty( $tabla ) || empty( $datos ) ) {
				return false;
			}
			$db = $this->conectar();
			$datos = (array) $datos;
			
			list( $campos, $valores) = $this->prep_array($datos);

			$query = "INSERT INTO {$tabla} ({$campos}) VALUES ({$valores})";
			if (!$this->debug){
				$result = $db->query($query);
				if ( $db->affected_rows > 0 ) {
					$this->ultimo_id = $db->insert_id;
					$this->auditoria("INSERTAR",$tabla,$datos);
					return true;
				}
			} else {
				echo $query;
			}
			
			return false;
		}

		public function actualizar($tabla, $datos, $where) {
			if ( empty( $tabla ) || empty( $datos ) ) {
				return false;
			}
			$db = $this->conectar();
			$datos = (array) $datos;
			$where = (array) $where;
			$where_clause = '';
						
			$valores = $this->prep_array($datos, 2);
			$where_clause = $this->prep_array($where, 3);
			if ($where_clause!=""){ $where_clause = " WHERE ".$where_clause; }

			$query = "UPDATE {$tabla} SET {$valores} {$where_clause}";

			if (!$this->debug){
				$result = $db->query($query);
				if ( $db->affected_rows > 0 ) {
					$this->auditoria("ACTUALIZAR",$tabla,$datos,$where);
					return true;
				}
			} else {
				echo $query;
			}
			
			return false;
		}
		
		public function eliminar($tabla, $where) {
			$db = $this->conectar();
			$where = (array) $where;

			$where_clause = $this->prep_array($where, 3);
			if ($where_clause!=""){ $where_clause = " WHERE ".$where_clause; }

			$query = "DELETE FROM {$tabla} {$where_clause}";
			//echo $query;
			if (!$this->debug){
				$result = $db->query($query);
				if ( $db->affected_rows > 0 ) {
					$this->auditoria("ELIMINAR",$tabla,"",$where);
					return true;
				}
			} else {
				echo $query;
			}

			return false;
		}

		public function real_escape($var){
			$db = $this->conectar();
			return $db->real_escape_string($var);			
		}

		private function prep_array($datos, $type=1) {
			$campos = "";
			$valores = "";
			$where = array();
			$i = 0;
			if (is_array($datos)){
				foreach ( $datos as $field => $value ) {
					$campos .= "{$field},";
					$valores .= "'{$value}',";
					if ( $type != 1) {
						$where[$i] = $field."='{$value}'";
					}				
					$i++;
				}
				
				$campos = substr($campos, 0, -1);
				$valores = substr($valores, 0, -1);

				if ($type==1){
					return array( $campos, $valores);				
				} else if ($type==2){
					$where = implode(",",$where);
					return $where;				
				} else {
					$where = implode(" and ",$where);
					return $where;				
				}
			} else {
				return "";
			}
		}

		private function auditoria($accion,$tabla,$datos,$donde=""){
			global $USUARIO;
			$db = $this->conectar();
			$campos = "";
			$valores = "";
			$donde = $this->ajustarTexto($this->prep_array($donde,3));
			if (is_array($datos)){
				foreach ( $datos as $field => $value ) {
					if($campos!="") $campos .= ",";
					$campos .= $field;
					if($valores!="") $valores .= ",";
					$valores .= $this->ajustarTexto("'".$value."'");
				}
			}
			$time = time();
			$query = "INSERT INTO lms_auditoria (idusuario, fechahora, accion, tabla, campos, valores, donde) 
						VALUES ('{$USUARIO->id}','{$time}','{$accion}','{$tabla}','{$campos}','{$valores}','{$donde}')";
			$result = $db->query($query);
		}

		private function auditoria_sql($accion,$tabla,$campos,$valores,$donde=""){
			global $USUARIO;
			$db = $this->conectar();
			$time = time();
			$query = "INSERT INTO lms_auditoria (idusuario, fechahora, accion, tabla, campos, valores, donde) 
						VALUES ('{$USUARIO->id}','{$time}','{$accion}','{$tabla}','{$campos}','{$valores}','{$donde}')";
			$result = $db->query($query);
		}


		public function auditoriaSQL($query){
			$ejecuta = false;
			$query = strtolower($query);
			if (strpos($query, "insert")>=0){
				$ejecuta = true;
				$accion = "INSERTAR";
			} else if (strpos($query, "update")>=0){
				$ejecuta = true;
				$accion = "ACTUALIZAR";
			} else if (strpos($query, "delete")>=0){
				$ejecuta = true;
				$accion = "ELIMINAR";
			}
			if ($ejecuta){
				$tabla = $this->obtenerTabla($query,$accion);
				$campos = "";
				$valores = $this->ajustarTexto($query);
				//$campos = $this->obtenerCampos($query,$accion);
				//$valores = $this->obtenerValores($query,$accion);
				$donde = $this->obtenerDonde($query,$accion);
				$this->auditoria_sql($accion,$tabla,$campos,$valores,$donde="");
			}
		}

		public function obtenerTabla($query,$accion){
			$arr=array("INSERTAR" => "into", "ACTUALIZAR" => "update", "ELIMINAR" => "from");
			$query = strtolower($query);
			$arr_des = explode($arr[$accion],$query);
			$arr_des = explode(" ",$arr_des[1]);
			foreach ($arr_des as $value) {
				if (trim($value)!="") return $value;
			}
		}

		public function obtenerCampos($query,$accion){
			$arr=array("INSERTAR" => "(", "ACTUALIZAR" => "set");
			if ($accion!="ELIMINAR"){
				$query = strtolower($query);
				$arr_des = explode($arr[$accion],$query);
				$arr_des =$arr_des[1];
				if ($accion=="INSERTAR"){
					$arr_des = explode(")",$arr_des);
					return $arr_des[0];
				} else {
					$campos = "";
					if (strpos($arr_des, "where")!=false){
						$arr_des = explode("where",$arr_des);
						$arr_des = $arr_des[0];
					}
					$arr_des = explode(",",$arr_des);
					foreach ($arr_des as  $value) {
						$arr = explode("=",$value);
						if($campos!="") $campos .= ",";
						$campos .=$arr[0];
					}
					return $campos;
				}
			} else {
				return "";
			}
		}

		public function obtenerValores($query,$accion){
			$arr=array("INSERTAR" => "(", "ACTUALIZAR" => "set");
			if ($accion!="ELIMINAR"){
				$query = strtolower($query);
				$arr_des = explode($arr[$accion],$query);
				if ($accion=="INSERTAR"){
					$arr_des =$arr_des[2];
					$arr_des = explode(")",$arr_des);
					return $this->ajustarTexto($arr_des[0]);
				} else {
					$campos = "";
					if (strpos($arr_des, "where")!=false){
						$arr_des = explode("where",$arr_des);
						$arr_des = $arr_des[0];
					}
					$arr_des = explode(",",$arr_des);
					foreach ($arr_des as  $value) {
						$arr = explode("=",$value);
						if($campos!="") $campos .= ",";
						$campos .=$this->ajustarTexto($arr[1]);
					}
					return $campos;
				}
			} else {
				return "";
			}
		}

		public function obtenerDonde($query,$accion){
			if ($accion!="INSERTAR"){
				$query = strtolower($query);
				if (strpos($arr_des, "where")!=false){ 
					$arr_des = explode("where",$query);
					return $arr_des[1];
				} else {
					return "";
				}
			} else {
				return "";
			}
		}

		private function ajustarTexto($texto){
			$texto = str_replace("'","\'",$texto);
			$texto = str_replace('"','\"',$texto);
			return $texto;
		}

	}
}
?>