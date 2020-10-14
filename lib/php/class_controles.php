<?php
if ( !class_exists( 'controlesBCN' ) ) {
	class controlesBCN {

		public function __construct(){

		}
		
		public function inputText($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// PLACEHOLDER => Visual de campo
			// REQUIRED => Si es requerido el valor
			// READONLY => Si es solo lectura
			// DISABLED => Si es solo lectura
			// MINLEN => minimo de Caracteres
			// MAXLEN => maximo de Caracteres
			// CLICK => onclick
			// CHANGE => onChange
			// BLUR => OnBlur
			// KEYUP => onKeyUp
			// KEYDOWN => onKeyDown
			// KEYPRESS => onJeyPress
			// EVENTS => Eventos personalizados

			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$min_len = "";
			$max_len = "";
			$col_label = 2;
			$col_field = 9;
			$css="";
			$css_label="";
			$style="";
			$placeholder = "";
			$required = "";
			$readonly="";
			$disabled="";
			$eventos = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("MINLEN",$param)){ $min_len=' data-minlength="'.$param["MINLEN"].'" '; }
			if (array_key_exists("MAXLEN",$param)){ $max_len=' maxlength="'.$param["MAXLEN"].'" '; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("READONLY",$param)){ if ($param["READONLY"]){ $readonly=' readonly="yes" '; } }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("KEYUP",$param)){ $eventos.=' onkeyup="'.$param["KEYUP"].'" '; }
			if (array_key_exists("KEYDOWN",$param)){ $eventos.=' onkeydown="'.$param["KEYDOWN"].'" '; }
			if (array_key_exists("KEYPRESS",$param)){ $eventos.=' onkeypress="'.$param["KEYPRESS"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" style="<?php echo $style; ?>" placeholder="<?php echo $placeholder; ?>" class="form-control <?php echo $css; ?>" value="<?php echo $value; ?>" <?php echo $min_len; ?> <?php echo $max_len; ?> <?php echo $readonly; ?> <?php echo $disabled; ?> <?php echo $required; ?> <?php echo $eventos; ?> />
			</div>
			<?php			
		}

		public function inputHidden($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// VALUE => valor del objeto
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$value="";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			?>
			<input type="hidden" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" />
			<?php			
		}

		public function inputFile($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// VALUE => valor del objeto
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<input type="file" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="" />
			</div>
			<?			
		}

		public function inputPassword($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// PLACEHOLDER => Visual de campo
			// REQUIRED => Si es requerido el valor
			// READONLY => Si es solo lectura
			// DISABLED => Si es solo lectura
			// MINLEN => minimo de Caracteres
			// MAXLEN => maximo de Caracteres
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$min_len = "";
			$max_len = "";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder = "";
			$required = "";
			$readonly = "";
			$disabled= "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("MINLEN",$param)){ $min_len=' data-minlength="'.$param["MINLEN"].'" '; }
			if (array_key_exists("MAXLEN",$param)){ $max_len=' maxlength="'.$param["MAXLEN"].'" '; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("READONLY",$param)){ if ($param["READONLY"]){ $readonly=' readonly="yes" '; } }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("KEYUP",$param)){ $eventos.=' onkeyup="'.$param["KEYUP"].'" '; }
			if (array_key_exists("KEYDOWN",$param)){ $eventos.=' onkeydown="'.$param["KEYDOWN"].'" '; }
			if (array_key_exists("KEYPRESS",$param)){ $eventos.=' onkeypress="'.$param["KEYPRESS"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<input type="password" id="<?php echo $id; ?>" name="<?php echo $id; ?>" style="<?php echo $style; ?>" placeholder="<?php echo $placeholder; ?>" class="form-control <?php echo $css; ?>" value="<?php echo $value; ?>"  <?php echo $min_len; ?> <?php echo $max_len; ?> <?php echo $readonly; ?> <?php echo $disabled; ?> <?php echo $required; ?> />
			</div>
			<?			
		}

		public function inputEmail($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// PLACEHOLDER => Visual de campo
			// REQUIRED => Si es requerido el valor
			// READONLY => Si es solo lectura
			// DISABLED => Si es solo lectura
			// CLICK => onclick
			// CHANGE => onChange
			// BLUR => OnBlur
			// KEYUP => onKeyUp
			// KEYDOWN => onKeyDown
			// KEYPRESS => onJeyPress
			// EVENTS => Eventos personalizados
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder = "";
			$required = "";
			$readonly = "";
			$disabled= "";
			$eventos = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("READONLY",$param)){ if ($param["READONLY"]){ $readonly=' readonly="yes" '; } }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("KEYUP",$param)){ $eventos.=' onkeyup="'.$param["KEYUP"].'" '; }
			if (array_key_exists("KEYDOWN",$param)){ $eventos.=' onkeydown="'.$param["KEYDOWN"].'" '; }
			if (array_key_exists("KEYPRESS",$param)){ $eventos.=' onkeypress="'.$param["KEYPRESS"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<input type="email" id="<?php echo $id; ?>" name="<?php echo $id; ?>" style="<?php echo $style; ?>" placeholder="<?php echo $placeholder; ?>" class="form-control <?php echo $css; ?>" value="<?php echo $value; ?>" <?php echo $readonly; ?> <?php echo $disabled; ?> <?php echo $required; ?> <?php echo $eventos; ?> />
			</div>
			<?			
		}

		public function inputInteger($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// PLACEHOLDER => Visual de campo
			// MIN => valor minimo
			// MIN => valor maximo
			// REQUIRED => Si es requerido el valor
			// READONLY => Si es solo lectura
			// DISABLED => Si es solo lectura
			// CLICK => onclick
			// CHANGE => onChange
			// BLUR => OnBlur
			// KEYUP => onKeyUp
			// KEYDOWN => onKeyDown
			// KEYPRESS => onJeyPress
			// EVENTS => Eventos personalizados
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder = "";
			$required = "";
			$min = "";
			$max = "";
			$readonly = "";
			$disabled= "";
			$eventos = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("READONLY",$param)){ if ($param["READONLY"]){ $readonly=' readonly="yes" '; } }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("MIN",$param)){ $min=' min="'.$param["MIN"].'" '; }
			if (array_key_exists("MAX",$param)){ $max=' max="'.$param["MAX"].'" '; }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("KEYUP",$param)){ $eventos.=' onkeyup="'.$param["KEYUP"].'" '; }
			if (array_key_exists("KEYDOWN",$param)){ $eventos.=' onkeydown="'.$param["KEYDOWN"].'" '; }
			if (array_key_exists("KEYPRESS",$param)){ $eventos.=' onkeypress="'.$param["KEYPRESS"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<input type="number" id="<?php echo $id; ?>" name="<?php echo $id; ?>" style="<?php echo $style; ?>" placeholder="<?php echo $placeholder; ?>" class="form-control <?php echo $css; ?>" value="<?php echo $value; ?>" <?php echo $min; ?> <?php echo $max; ?> <?php echo $readonly; ?> <?php echo $disabled; ?> <?php echo $required; ?>  <?php echo $eventos; ?> />
			</div>
			<?			
		}

		public function inputDecimal($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// PLACEHOLDER => Visual de campo
			// REQUIRED => Si es requerido el valor
			// READONLY => Si es solo lectura
			// DISABLED => Si es solo lectura
			// CLICK => onclick
			// CHANGE => onChange
			// BLUR => OnBlur
			// KEYUP => onKeyUp
			// KEYDOWN => onKeyDown
			// KEYPRESS => onJeyPress
			// EVENTS => Eventos personalizados
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder = "";
			$required = "";
			$readonly = "";
			$disabled= "";
			$eventos = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("READONLY",$param)){ if ($param["READONLY"]){ $readonly=' readonly="yes" '; } }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("KEYUP",$param)){ $eventos.=' onkeyup="'.$param["KEYUP"].'" '; }
			if (array_key_exists("KEYDOWN",$param)){ $eventos.=' onkeydown="'.$param["KEYDOWN"].'" '; }
			if (array_key_exists("KEYPRESS",$param)){ $eventos.=' onkeypress="'.$param["KEYPRESS"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" style="<?php echo $style; ?>" placeholder="<?php echo $placeholder; ?>" class="form-control decimal <?php echo $css; ?>" data-thousands="." data-decimal="," value="<?php echo $value; ?>" <?php echo $readonly; ?> <?php echo $disabled; ?> <?php echo $required; ?>  <?php echo $eventos; ?> />
			</div>
			<?			
		}

		public function inputDate($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// PLACEHOLDER => Visual de campo
			// REQUIRED => Si es requerido el valor
			// MINLEN => minimo de Caracteres
			// MAXLEN => maximo de Caracteres
			// CLICK => onclick
			// CHANGE => onChange
			// BLUR => OnBlur
			// KEYUP => onKeyUp
			// KEYDOWN => onKeyDown
			// KEYPRESS => onJeyPress
			// EVENTS => Eventos personalizados

			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$min_len = "";
			$max_len = "";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder = "";
			$required = "";
			$readonly="";
			$disabled="";
			$eventos = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("MINLEN",$param)){ $min_len=' data-minlength="'.$param["MINLEN"].'" '; }
			if (array_key_exists("MAXLEN",$param)){ $max_len=' maxlength="'.$param["MAXLEN"].'" '; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("KEYUP",$param)){ $eventos.=' onkeyup="'.$param["KEYUP"].'" '; }
			if (array_key_exists("KEYDOWN",$param)){ $eventos.=' onkeydown="'.$param["KEYDOWN"].'" '; }
			if (array_key_exists("KEYPRESS",$param)){ $eventos.=' onkeypress="'.$param["KEYPRESS"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" style="<?php echo $style; ?>" placeholder="<?php echo $placeholder; ?>" class="form-control date-picker <?php echo $css; ?>" readonly="yes" value="<?php echo $value; ?>" <?php echo $min_len; ?> <?php echo $max_len; ?> <?php echo $readonly; ?> <?php echo $disabled; ?> <?php echo $required; ?> <?php echo $eventos; ?> />
			</div>
			<?			
		}


		public function textArea($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// ROWS => Nro de Filas del textarea
			// COLS => Ancho en Columnas
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// REQUIRED => Si es requerido el valor
			// READONLY => Si es solo lectura
			// DISABLED => Si es solo lectura
			// CLICK => onclick
			// CHANGE => onChange
			// BLUR => OnBlur
			// KEYUP => onKeyUp
			// KEYDOWN => onKeyDown
			// KEYPRESS => onJeyPress
			// EVENTS => Eventos personalizados
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$rows = "";
			$cols = "";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder="";
			$readonly = "";
			$required = "";
			$disabled= "";
			$eventos = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("ROWS",$param)){ if ($param["ROWS"]>0){ $rows = ' rows="'.$param["ROWS"].'" '; } }
			if (array_key_exists("COLS",$param)){ if ($param["COLS"]>0){ $cols = ' cols="'.$param["COLS"].'" '; } }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("READONLY",$param)){ if ($param["READONLY"]){ $readonly=' readonly="yes" '; } }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("KEYUP",$param)){ $eventos.=' onkeyup="'.$param["KEYUP"].'" '; }
			if (array_key_exists("KEYDOWN",$param)){ $eventos.=' onkeydown="'.$param["KEYDOWN"].'" '; }
			if (array_key_exists("KEYPRESS",$param)){ $eventos.=' onkeypress="'.$param["KEYPRESS"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<textarea name="<?php echo $id; ?>" id="<?php echo $id; ?>" class="form-control <?php echo $css; ?>" style="<?php echo $style; ?>" placeholder="<?php echo $placeholder; ?>" <?php echo $rows; ?> <?php echo $cols; ?> <?php echo $disabled; ?> <?php echo $readonly; ?>  <?php echo $required; ?> <?php echo $eventos; ?> ><?php echo $value; ?></textarea>
			</div>
			<?			
		}

		public function select($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// PLACEHOLDER => Visual de campo
			// REQUIRED => Si es requerido el valor
			// ITEMS => Items del select
			// DISABLED => Si es solo lectura
			// CLICK => onclick
			// CHANGE => onChange
			// BLUR => OnBlur
			// EVENTS => Eventos personalizados
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder = "";
			$items = "";
			$required = "";
			$disabled = "";
			$eventos = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("ITEMS",$param)){ $items=$param["ITEMS"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<select name="<?php echo $id; ?>" id="<?php echo $id; ?>" class="form-control <?php echo $css; ?>" style="<?php echo $style; ?>" <?php echo $disabled; ?> <?php echo $required; ?> <?php echo $eventos; ?> >
					<? 
					if ($placeholder!=""){ echo '<option value="">'.$placeholder.'</option>'; } 
					if (is_array($items)){
						foreach($items as $key => $val){
							if ($key==$value){ $selected = ' selected="selected" '; } else { $selected=""; }
							echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
						}
					}
					?>
				</select>
			</div>
			<?			
		}

		public function selectGroup($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// PLACEHOLDER => Visual de campo
			// REQUIRED => Si es requerido el valor
			// ITEMS => Items del select
			// DISABLED => Si es solo lectura
			// CLICK => onclick
			// CHANGE => onChange
			// BLUR => OnBlur
			// EVENTS => Eventos personalizados
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder = "";
			$items = "";
			$required = "";
			$disabled = "";
			$eventos = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("ITEMS",$param)){ $items=$param["ITEMS"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("PLACEHOLDER",$param)){ $placeholder=$param["PLACEHOLDER"]; }
			if (array_key_exists("REQUIRED",$param)){ if ($param["REQUIRED"]){ $required="required"; } }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("CLICK",$param)){ $eventos.=' onclick="'.$param["CLICK"].'" '; }
			if (array_key_exists("CHANGE",$param)){ $eventos.=' onchange="'.$param["CHANGE"].'" '; }
			if (array_key_exists("BLUR",$param)){ $eventos.=' onblur="'.$param["BLUR"].'" '; }
			if (array_key_exists("EVENTS",$param)){ $eventos.=$param["EVENTS"]; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<select name="<?php echo $id; ?>" id="<?php echo $id; ?>" class="form-control <?php echo $css; ?>" style="<?php echo $style; ?>" <?php echo $disabled; ?> <?php echo $required; ?> <?php echo $eventos; ?> >
					<? 
					if ($placeholder!=""){ echo '<option value="">'.$placeholder.'</option>'; } 
					if (is_array($items)){
						$temp = "";
						foreach($items as $key => $val){
							if ($temp!=$val["grupo"]){
								echo '<optgroup label="'.$val["grupo"].'">';
								$temp = $val["grupo"];
							}
							if ($key==$value){ $selected = ' selected="selected" '; } else { $selected=""; }
							echo '<option value="'.$key.'" '.$selected.'>'.$val["valor"].'</option>';
						}
					}
					?>
				</select>
			</div>
			<?			
		}

		public function selectColor($param){
			/***********************************************/
			/******PARAMETROS*******************************/
			/***********************************************/
			// ID => id y nombre del objeto
			// LABEL => etiqueta del objeto
			// VALUE => valor del objeto
			// CSS => css del objeto
			// CSS_LABEL => css de la etiqueta
			// COL_LABEL => columnas bootstrap etiqueta
			// COL_FIELD => columnas bootstrap campo
			// STYLE => Estilo personalizados del objeto
			// REQUIRED => Si es requerido el valor
			// DISABLED => Si es solo lectura
			/***********************************************/
			if (!is_array($param)){ echo "Error en Parametros"; return; }
			$id="";
			$label="";
			$value="";
			$css="";
			$css_label="";
			$col_label = 2;
			$col_field = 9;
			$style="";
			$placeholder = "";
			$required = "";
			$disabled = "";
			if (array_key_exists("ID",$param)){ $id=$param["ID"]; }
			if (array_key_exists("VALUE",$param)){ $value=$param["VALUE"]; }
			if (array_key_exists("CSS",$param)){ $css=$param["CSS"]; }
			if (array_key_exists("CSS_LABEL",$param)){ $css_label=$param["CSS_LABEL"]; }
			if (array_key_exists("COL_LABEL",$param)){ $col_label=$param["COL_LABEL"]; }
			if (array_key_exists("COL_FIELD",$param)){ $col_field=$param["COL_FIELD"]; }
			if (array_key_exists("STYLE",$param)){ $style=$param["STYLE"]; }
			if (array_key_exists("DISABLED",$param)){ if ($param["DISABLED"]){ $disabled=' disabled="disabled" '; } }
			if (array_key_exists("REQUIRED",$param)){ $required="required"; }
			if (array_key_exists("LABEL",$param)){
				$label = '<label class="col-sm-'.$col_label.' control-label no-padding-right '.$css_label.'" for="'.$id.'">'.$param["LABEL"].'</label>';
			}
			echo $label;
			?>
			<div class="col-sm-<?php echo $col_field; ?>">
				<select name="<?php echo $id; ?>" id="<?php echo $id; ?>" class="form-control <?php echo $css; ?>" style="<?php echo $style; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
					<option <?php if ($value=="#ac725e"){ echo ' selected="selected" '; } ?> value="#ac725e">#ac725e</option>
					<option <?php if ($value=="#d06b64"){ echo ' selected="selected" '; } ?> value="#d06b64">#d06b64</option>
					<option <?php if ($value=="#f83a22"){ echo ' selected="selected" '; } ?> value="#f83a22">#f83a22</option>
					<option <?php if ($value=="#fa573c"){ echo ' selected="selected" '; } ?> value="#fa573c">#fa573c</option>
					<option <?php if ($value=="#ff7537"){ echo ' selected="selected" '; } ?> value="#ff7537">#ff7537</option>
					<option <?php if ($value=="#ffad46"){ echo ' selected="selected" '; } ?> value="#ffad46">#ffad46</option>
					<option <?php if ($value=="#42d692"){ echo ' selected="selected" '; } ?> value="#42d692">#42d692</option>
					<option <?php if ($value=="#16a765"){ echo ' selected="selected" '; } ?> value="#16a765">#16a765</option>
					<option <?php if ($value=="#7bd148"){ echo ' selected="selected" '; } ?> value="#7bd148">#7bd148</option>
					<option <?php if ($value=="#b3dc6c"){ echo ' selected="selected" '; } ?> value="#b3dc6c">#b3dc6c</option>
					<option <?php if ($value=="#fbe983"){ echo ' selected="selected" '; } ?> value="#fbe983">#fbe983</option>
					<option <?php if ($value=="#fad165"){ echo ' selected="selected" '; } ?> value="#fad165">#fad165</option>
					<option <?php if ($value=="#92e1c0"){ echo ' selected="selected" '; } ?> value="#92e1c0">#92e1c0</option>
					<option <?php if ($value=="#9fe1e7"){ echo ' selected="selected" '; } ?> value="#9fe1e7">#9fe1e7</option>
					<option <?php if ($value=="#9fc6e7"){ echo ' selected="selected" '; } ?> value="#9fc6e7">#9fc6e7</option>
					<option <?php if ($value=="#4986e7"){ echo ' selected="selected" '; } ?> value="#4986e7">#4986e7</option>
					<option <?php if ($value=="#9a9cff"){ echo ' selected="selected" '; } ?> value="#9a9cff">#9a9cff</option>
					<option <?php if ($value=="#b99aff"){ echo ' selected="selected" '; } ?> value="#b99aff">#b99aff</option>
					<option <?php if ($value=="#c2c2c2"){ echo ' selected="selected" '; } ?> value="#c2c2c2">#c2c2c2</option>
					<option <?php if ($value=="#cabdbf"){ echo ' selected="selected" '; } ?> value="#cabdbf">#cabdbf</option>
					<option <?php if ($value=="#cca6ac"){ echo ' selected="selected" '; } ?> value="#cca6ac">#cca6ac</option>
					<option <?php if ($value=="#f691b2"){ echo ' selected="selected" '; } ?> value="#f691b2">#f691b2</option>
					<option <?php if ($value=="#cd74e6"){ echo ' selected="selected" '; } ?> value="#cd74e6">#cd74e6</option>
					<option <?php if ($value=="#a47ae2"){ echo ' selected="selected" '; } ?> value="#a47ae2">#a47ae2</option>
					<option <?php if ($value=="#555"){ echo ' selected="selected" '; } ?> value="#555">#555</option>
				</select>
			</div>
			<?			
		}

		public function panelButtons($modulo, $id) {
			?>
			<div class="hidden-sm hidden-xs action-buttons">
				<a class="blue" href="#" onclick="op<?php echo $modulo; ?>('Ver<?php echo $modulo; ?>',<?php echo $id; ?>);">
					<i class="ace-icon fa fa-search-plus bigger-130"></i>
				</a>
				<a class="green" href="#" onclick="op<?php echo $modulo; ?>('Editar<?php echo $modulo; ?>',<?php echo $id; ?>);">
					<i class="ace-icon fa fa-pencil bigger-130"></i>
				</a>
				<a class="red" href="#" onclick="op<?php echo $modulo; ?>('Eliminar<?php echo $modulo; ?>',<?php echo $id; ?>);">
					<i class="ace-icon fa fa-trash-o bigger-130"></i>
				</a>
			</div>
			<?php
		}

		public function viewButton($modulo, $id) {
			?>
			<div class="hidden-sm hidden-xs action-buttons">
				<a class="blue" href="#" onclick="op<?php echo $modulo; ?>('Ver<?php echo $modulo; ?>',<?php echo $id; ?>);">
					<i class="ace-icon fa fa-search-plus bigger-130"></i>
				</a>
			</div>
			<?php
		}

		public function editButton($modulo, $id) {
			?>
			<div class="hidden-sm hidden-xs action-buttons">
				<a class="green" href="#" onclick="op<?php echo $modulo; ?>('Editar<?php echo $modulo; ?>',<?php echo $id; ?>);">
					<i class="ace-icon fa fa-pencil bigger-130"></i>
				</a>
			</div>
			<?php
		}

		public function deleteButton($modulo, $id) {
			?>
			<div class="hidden-sm hidden-xs action-buttons">
				<a class="red" href="#" onclick="op<?php echo $modulo; ?>('Eliminar<?php echo $modulo; ?>',<?php echo $id; ?>);">
					<i class="ace-icon fa fa-trash-o bigger-130"></i>
				</a>
			</div>
			<?php
		}

		function groupButtons($modulo,$accion){
			?>
			<div class="form-group center">
				<?php if ($accion!="Ver{$modulo}"){ ?>
				<button type="submit" class="btn btn-sm btn-success">
					<i class="ace-icon fa fa-floppy-o icon-on-right bigger-110"></i>
					Guardar
				</button>
				<button type="button" class="btn btn-sm btn-info" onclick="cancelar<?php echo $modulo; ?>();">
					<i class="ace-icon fa fa-minus-square icon-on-right bigger-110"></i>
					Cancelar
				</button>
				<? } ?>
				<button type="button" class="btn btn-sm btn-warning" onclick="regresar<?php echo $modulo; ?>();">
					<i class="ace-icon fa fa-hand-o-left icon-on-right bigger-110"></i>
					Regresar
				</button>
			</div>
			<?php
		}

		function basicButtons($modulo){
			?>
			<div class="form-group center">
				<button type="submit" class="btn btn-sm btn-success">
					<i class="ace-icon fa fa-floppy-o icon-on-right bigger-110"></i>
					Guardar
				</button>
				<button type="button" class="btn btn-sm btn-info" onclick="cancelar<?php echo $modulo; ?>();">
					<i class="ace-icon fa fa-minus-square icon-on-right bigger-110"></i>
					Cancelar
				</button>
			</div>
			<?php
		}

		function reportButtons(){
			?>
			<div class="form-group center">
				<button type="button" id="btn_filtrar" class="btn btn-sm btn-success" onclick="filtrarReporte();">
					<i class="ace-icon fa fa-filter icon-on-right bigger-110"></i>
					Filtrar
				</button>
				<button type="button" id="btn_limpiar" class="btn btn-sm btn-danger" onclick="limpiarReporte();">
					<i class="ace-icon fa fa-minus-square icon-on-right bigger-110"></i>
					Limpiar
				</button>
				<button type="button" id="btn_imprimir" class="btn btn-sm btn-info2" onclick="imprimirReporte();">
					<i class="ace-icon fa fa-print icon-on-right bigger-110"></i>
					Imprimir
				</button>
				<button type="button" id="btn_excel" class="btn btn-sm btn-warning" onclick="exportarReporte(1);">
					<i class="ace-icon fa fa-file-excel-o icon-on-right bigger-110"></i>
					Exportar a EXCEL
				</button>
				<button type="button" id="btn_pdf" class="btn btn-sm btn-secondary" onclick="exportarReporte(2);">
					<i class="ace-icon fa fa-file-pdf-o icon-on-right bigger-110"></i>
					Exportar a PDF
				</button>
			</div>
			<?php
		}

		function genericButton($id, $value, $function, $icon = ""){
			?>
			<button type="button" id="<?php echo $id; ?>" class="btn btn-sm btn-success pull-right" style="margin-right: 5px; margin-left: 5px;" onclick="<?php echo $function; ?>">
				<?php echo $icon; ?>
				<?php echo $value; ?>
			</button>
			<?php
		}

		function newButton($modulo){
			?>
			<button type="button" class="btn btn-sm btn-success pull-right" onclick="op<?php echo $modulo; ?>('Nuevo<?php echo $modulo; ?>',0);">
				<i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
				Nuevo
			</button>
			<?php
		}

		function saveButton(){
			?>
			<button type="submit" class="btn btn-sm btn-success">
				<i class="ace-icon fa fa-floppy-o icon-on-right bigger-110"></i>
				Guardar
			</button>
			<?php
		}

		function cancelButton($modulo){
			?>
			<button type="button" class="btn btn-sm btn-info" onclick="cancelar<?php echo $modulo; ?>();">
				<i class="ace-icon fa fa-minus-square icon-on-right bigger-110"></i>
				Cancelar
			</button>
			<?php
		}

		function returnButton($modulo){
			?>
			<button type="button" class="btn btn-sm btn-warning" onclick="regresar<?php echo $modulo; ?>();">
				<i class="ace-icon fa fa-hand-o-left icon-on-right bigger-110"></i>
				Regresar
			</button>
			<?php
		}

		function basicForm($modulo){
			$_modulo = strtolower($modulo);
			?>
				<form class="form-horizontal" role="form" method="post" id="form<?php echo $modulo; ?>">
					<input type="hidden" id="bcn_serial" name="bcn_serial" value="<?php echo date("Ymdhis"); ?>">
			<?php
		}

		function initForm($modulo,$id,$end=false,$sufijo="s",$upload=false){
			if ($sufijo==false) $sufijo =""; 
			$_modulo = strtolower($modulo);
			?>
				<form class="form-horizontal" role="form" method="post" id="form<?php echo $modulo; ?>" <?php if ($upload){ ?> enctype="multipart/form-data" <?php } ?> >
					<input type="hidden" id="menu" name="menu" value="<?php echo $modulo.$sufijo; ?>">
					<input type="hidden" id="bcn_serial" name="bcn_serial" value="<?php echo date("Ymdhis"); ?>">
					<input type="hidden" id="accion<?php echo $_modulo; ?>" name="accion<?php echo $_modulo; ?>" value="Guardar<?php echo $modulo; ?>">
					<input type="hidden" id="id<?php echo $_modulo; ?>" name="id<?php echo $_modulo; ?>" value="<?php echo $id; ?>">
			<?php
			if ($end){
				?></form><?php	
			}
		}

		function initFormReport($id,$accion="",$end=false){
			?>
				<form class="form-horizontal" role="form" method="post" id="form<?php echo $id; ?>" action="<?php echo $accion; ?>" target="_blank">
					<input type="hidden" id="bcn_serial" name="bcn_serial" value="<?php echo date("Ymdhis"); ?>">
			<?php
			if ($end){
				?></form><?php	
			}
		}

		function endForm(){
			?></form><?php
		}

		function divDatosReporte(){
		?>
			<div class="row">
				<div id="div_datos_tabla" class="col-sm-12"></div>
			</div>
		<?
		}

		function basicScript($modulo,$orden='[ 0, "asc" ]',$sufijo="s"){
			if ($sufijo==false) $sufijo = "";
			$_modulo = strtolower($modulo);
			?>
			<script src="assets/js/jquery.dataTables.min.js"></script>
			<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
			<script src="assets/js/dataTables.select.min.js"></script>
			<script type="text/javascript">
				jQuery(function($) {
					$('#dynamic-table').DataTable({
						ordering: true,
						order:[<?php echo $orden; ?>],
			            "language": {
			                "url": "assets/js/dataTables_es.json"
			            }
					}) ;
					$.fn.datepicker.dates['es'] = {
						days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
						daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
						daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
						months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
						monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
						today: "Hoy",
						monthsTitle: "Meses",
						clear: "Borrar",
						weekStart: 1,
						format: "dd-mm-yyyy"
					};					
					$('.date-picker').datepicker({ 
						 language: 'es',
						autoclose: true, 
						todayHighlight: true, 
					});
				});

				function cancelar<?php echo $modulo; ?>(){
	            	$("#form<?php echo $modulo; ?>")[0].reset();
	            	if ("<?php echo strtolower($modulo); ?>"=="matricula") listacursos.bootstrapDualListbox('refresh');
				}

				function regresar<?php echo $modulo; ?>(){
	            	op<?php echo $modulo; ?>("Mostrar<?php echo $modulo.$sufijo; ?>",0);
				}

				function op<?php echo $modulo; ?>(acc,id){
	            	$("#accion<?php echo $_modulo; ?>").val(acc);
	            	$("#id<?php echo $_modulo; ?>").val(id);
	            	if (acc=="Eliminar<?php echo $modulo; ?>"){
						descrip = $("#<?php echo $_modulo; ?>_"+id).html();
						$.confirm({
						    title: '<?php echo formatTitle($modulo); ?>',
						    content: 'Desea eliminar <?php echo formatTitle($_modulo); ?> '+ descrip,
						    buttons: {
						        confirm: { 
						        	text:"Aceptar",
						        	action: function () {
						            	$("#form<?php echo $modulo; ?>").submit();
						        }},
						        cancel:{ text:"Cancelar" } 
						    }
						});
	            	} else {
		            	$("#form<?php echo $modulo; ?>").submit();
	            	}
				}

				$('.chosen-select').chosen({allow_single_deselect:true}); 				
			</script>
			<?php
		}

		function reportScript($id,$destino,$validacion=""){
			?>
			<script type="text/javascript">
				jQuery(function($) {
					$.fn.datepicker.dates['es'] = {
						days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
						daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
						daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
						months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
						monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
						today: "Hoy",
						monthsTitle: "Meses",
						clear: "Borrar",
						weekStart: 1,
						format: "dd-mm-yyyy"
					};					
					$('.date-picker').datepicker({ 
						 language: 'es',
						autoclose: true, 
						todayHighlight: true, 
					});
				});

				function filtrarReporte(){
				    <?php echo $validacion; ?>
				    cargando(true);
				    $("#tp_salida").val("0");
				    $.post("<?php echo $destino; ?>", 
				    	   $("#form<?php echo $id; ?>").serialize(), 
						   function(data){  
						       	$("#div_datos_tabla").html(data);
	                         	$('html, body').animate({ scrollTop: $("#div_datos_tabla").offset().top }, 500);          
						   }
					);
				}

				function limpiarReporte(){
	            	$("#form<?php echo $id; ?>")[0].reset();
				    $("#tp_salida").val(0);
	            	$(".chosen-select").trigger("chosen:updated");
	            	$("#div_datos_tabla").html("");
				}

				function exportarReporte(valor){
				    <?php echo $validacion; ?>
				    $("#tp_salida").val(valor);
					$('#form<?php echo $id; ?>').submit();					
				}

				function imprimirReporte(){
				    <?php echo $validacion; ?>
				    $("#tp_salida").val(3);
					$('#form<?php echo $id; ?>').submit();					
				}

				$('.chosen-select').chosen({allow_single_deselect:true}); 
			</script>
			<?php
		}

		function tableScript($modulo,$orden='[ 0, "asc" ]'){
			$_modulo = strtolower($modulo);
			?>
			<script src="assets/js/jquery.dataTables.min.js"></script>
			<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
			<script src="assets/js/dataTables.select.min.js"></script>
			<script type="text/javascript">
				jQuery(function($) {
					$('#dynamic-table').DataTable({
						ordering: true,
						order:[<?php echo $orden; ?>],
			            "language": {
			                "url": "assets/js/dataTables_es.json"
			            }
					}) ;
				});
			</script>
			<?php
		}

		function editorScript(){
			?>
			<script src="assets/js/summernote/summernote.min.js"></script>
			<script src="assets/js/summernote/lang/summernote-es-ES.min.js"></script>
			<script type="text/javascript">
				$(".editor").summernote({  height: 200, lang: 'es-ES' });
			</script>
			<?php
		}

		function cancelScript($modulo){
			$_modulo = strtolower($modulo);
			?>
			<script type="text/javascript">
				function cancelar<?php echo $modulo; ?>(){
	            	$("#form<?php echo $modulo; ?>")[0].reset();
				}
			</script>
			<?php
		}

	}
}
?>