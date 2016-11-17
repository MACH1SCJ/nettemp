<?php
    $save = isset($_POST['save']) ? $_POST['save'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
    $unit2 = isset($_POST['unit2']) ? $_POST['unit2'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
	 $ico = isset($_POST['ico']) ? $_POST['ico'] : '';
    $save_id = isset($_POST['save_id']) ? $_POST['save_id'] : '';
	 $add = isset($_POST['add']) ? $_POST['add'] : '';
   	 
    if ($save == 'save1'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE types SET title='$title',unit2='$unit2',unit='$unit',type='$type',ico='$ico' WHERE id='$save_id'") or header("Location: html/errors/db_error.php");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
    if ($add == 'add1'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title) VALUES ('$type','$unit','$unit2','$ico','$title')") or header("Location: html/errors/db_error.php");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
    if ($add == 'del1'){
    $db = new PDO('sqlite:dbf/nettemp.db');
	 $db->exec("DELETE FROM types WHERE id='$save_id'") or die ("cannot insert to DB");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
    if ($add == "default") { 
    $db = new PDO("sqlite:dbf/nettemp.db");	
    $db->exec("DELETE from types") or header("Location: html/errors/db_error.php");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max, value1, value2, value3) VALUES ('temp', '°C', '°F', 'media/ico/temp2-icon.png' ,'Temperature','-150', '3000', '85', '185' ,'127.9')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('lux', 'lux', 'lux', 'media/ico/sun-icon.png' ,'Lux','8000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('humid', '%', '%', 'media/ico/rain-icon.png' ,'Humidity','0', '110')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('press', 'hPa', 'hPa', 'media/ico/Science-Pressure-icon.png' ,'Pressure','1100')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('water', 'm3', 'm3', 'media/ico/water-icon.png' ,'Water','0', '100')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('gas', 'm3', 'm3', 'media/ico/gas-icon.png' ,'Gas','0', '100')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('elec', 'kWh', 'W', 'media/ico/Lamp-icon.png' ,'Electricity','0', '99999999')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('watt', 'W', 'W', 'media/ico/watt.png' ,'Watt','-10000', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('volt', 'V', 'V', 'media/ico/volt.png' ,'Volt','-10000', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('amps', 'A', 'A', 'media/ico/amper.png' ,'Amps','0', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('dist', 'cm', 'cm', 'media/ico/Distance-icon.png' ,'Distance','0', '100000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('trigger', '', '', 'media/ico/alarm-icon.png' ,'Trigger','0', '100000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('rainfall', 'mm/m2', 'mm/m2', '' ,'Rainfall','0', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('speed', 'km/h', 'km/h', '' ,'Speed','0', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('wind', '°', '°', '' ,'Wind','0', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('uv', 'index', 'index', '' ,'UV','0', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('storm', 'km', 'km', '' ,'Storm','0', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('lightining', '', '', '' ,'Lightining','0', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max) VALUES ('hosts', 'ms', 'ms', '' ,'Host','0', '10000')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title) VALUES ('system', '%', '%', '' ,'System','0', '100')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title) VALUES ('gpio', 'H/L', 'H/L', '' ,'GPIO')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title) VALUES ('group', '', '', '' ,'')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title) VALUES ('relay', '', '', '' ,'')");
	$db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title) VALUES ('baterry', '', '', '' ,'Baterry')");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();	
    }
?>

<div class="panel panel-default">
<div class="panel-heading">Types</div>

<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">

<?php
$rows = $db->query("SELECT * FROM types");
$row = $rows->fetchAll();
?>
<thead>
<tr>
<th></th>
<th>Type</th>
<th>Unit</th>
<th>Unit2</th>
<th>ICO</th>
<th>Title</th>
<th>Min</th>
<th>Max</th>
<th>Exclude Value1</th>
<th>Exclude Value2</th>
<th>Exclude Value3</th>
<th></th>
</tr>
</thead>


<tr>
	 <td>
	 </td>
	 <td class="col-md-0">
    <form action="" method="post" style="display:inline!important;">
		<input type="text" name="type" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
     <td class="col-md-0">
		<input type="text" name="unit" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
     <td class="col-md-0">
		<input type="text" name="unit2" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="ico" size="25" maxlength="30" value="" class="form-control input-sm"/>
    </td>
	<td class="col-md-0">
		<input type="text" name="title" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="min" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="max" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="value1" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="value2" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="value3" size="10" maxlength="30" value="" class="form-control input-sm"/>
    </td>
    
    
    
    <td class="col-md-0">
	
    </td>
    <td class="col-md-0">
		<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> </button>
		<input type="hidden" name="add" value="add1"/>
    </form>
    </td>
</tr>
<?php 
   foreach ($row as $a) { 	
	?>
<tr>
	 <td>
	 <?php echo $type="<img src=\"".$a['ico']."\" alt=\"\" title=\"".$a['title']."\"/>"; ?>
	 </td>
	 <td class="col-md-0">
    <form action="" method="post" style="display:inline!important;">
		<input type="text" name="type" size="10" maxlength="30" value="<?php echo $a['type']; ?>" class="form-control input-sm"/>
    </td>
     <td class="col-md-0">
		<input type="text" name="unit" size="10" maxlength="30" value="<?php echo $a['unit']; ?>" class="form-control input-sm"/>
    </td>
     <td class="col-md-0">
		<input type="text" name="unit2" size="10" maxlength="30" value="<?php echo $a['unit2']; ?>" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="ico" size="10" maxlength="30" value="<?php echo $a['ico']; ?>" class="form-control input-sm"/>
    </td>
	<td class="col-md-0">
		<input type="text" name="title" size="10" maxlength="30" value="<?php echo $a['title']; ?>" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="min" size="10" maxlength="30" value="<?php echo $a['min']; ?>" class="form-control input-sm"/>
    </td>
	<td class="col-md-0">
		<input type="text" name="max" size="10" maxlength="30" value="<?php echo $a['max']; ?>" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="value1" size="10" maxlength="30" value="<?php echo $a['value1']; ?>" class="form-control input-sm"/>
    </td>
    <td class="col-md-0">
		<input type="text" name="value2" size="10" maxlength="30" value="<?php echo $a['value2']; ?>" class="form-control input-sm"/>
    </td>
	<td class="col-md-0">
		<input type="text" name="value3" size="10" maxlength="30" value="<?php echo $a['value3']; ?>" class="form-control input-sm"/>
    </td>
    
    
    
    <td class="col-md-0">
		<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-save"></span> </button>
		<input type="hidden" name="save_id" value="<?php echo $a['id']; ?>" />
		<input type="hidden" name="save" value="save1"/>
    </td>
    </form>
    <td class="col-md-0">
    <form action="" method="post" style="display:inline!important;">
		<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </button>
		<input type="hidden" name="save_id" value="<?php echo $a['id']; ?>" />
		<input type="hidden" name="add" value="del1"/>
    </form>
    </td>
</tr>
   
<?php
	}
	?>
<tr>
    <td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
	<td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
    <td class="col-md-0">
    </td>
    <td colspan="2" class="col-md-0">
	 <form action="" method="post" style="display:inline!important;">
		<button class="btn btn-xs btn-info">Defaults <span class="glyphicon glyphicon-refresh"></span> </button>
		<input type="hidden" name="add" value="default"/>
    </form>
	 </td>
</tr>


</table>
</div>
