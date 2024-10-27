<?php include("../Conexion/conectaBase.php");

if($_POST["idiomax"]=='1'){include("../vistas/Idioma/espanol.php");

}
else if($_POST ["idiomax"] = = '2'){include(
    "../vistas/Idioma/ingles.php"
);

} $sd =new conexion();

$sd->conectar();

$txtFHRCalendario55=$_POST["txtFHRCalendario55x"];

$txtFHRCalendario66=$_POST["txtFHRCalendario66x"];

$txtFolioSP=$_POST["txtFolioSPx"];

$txtPedidoSP=$_POST["txtPedidoSPx"];

$selectEstatusDoc=$_POST["selectEstatusSPx"];

$selectEstatusSP=$_POST["selectEstatusPartidax"];

$selectSupervisorSP=$_POST["selectSupervisorSPx"];

$comboEstadoSP=$_POST["comboEstadoSPx"];

$selectSalaSP=$_POST["selectSalaSPx"];

$selectTecnicoSP=$_POST["selectTecnicoSPx"];

$selectOperadoresSP=$_POST["selectOperadoresSPx"];

$comboDepartamentos=$_POST["comboDepartamentox"];

$obtRef=$_POST["refaccionx"];

$paisID=$_POST["paisIDx"];

$proyecto=$_POST["proyectox"];

//echo".$obtRef.";

$var='';

$n=0;

$refIDx = mssql_query(
    "select * from crefaccion where clave = '".$obtRef."'"
);

$refID=mssql_fetch_array($refIDx);

if($refID["clave"]!=$obtRef){echo"La clave no Existe";

return -1;

} if($refID["refaccionid"]==''){$refID["refaccionid"]='%';

} //echo".$refID[refaccionid].";

//echo".$comboEstadoSP. - .$selectSalaSP. - .$selectEstatusSP.";

if($selectEstatusSP = = '%'){$selectEstatusSP2 = "tr.estatusidfk like '%'";

}/ / if($selectEstatusSP = = 30){$selectEstatusSP2 = "(tr.estatusidfk=30 or tr.estatusidfk=87 or tr.estatusidfk=29)";

} if($selectEstatusSP==29){$selectEstatusSP2="dr.estatusidfk=29";

} if($selectEstatusSP==31){$selectEstatusSP2="dr.estatusidfk=31";

} if($selectEstatusSP==33){$selectEstatusSP2="dr.estatusidfk=33";

} if($selectEstatusSP==43){$selectEstatusSP2="dr.estatusidfk=43";

} if($selectEstatusSP==47){$selectEstatusSP2="dr.estatusidfk=47";

} if($selectEstatusSP==51){$selectEstatusSP2="dr.estatusidfk=51";

} if($txtFolioSP!='' || $txtPedidoSP!=''){$var=1;

if($txtFolioSP!=''){$sol="tr.folio_solicitudidfk='".$txtFolioSP."'";

$solAyde="f.folio_solicitudid='".$txtFolioSP."'";

}else{$sol='solicitud_refaccionid='.$txtPedidoSP;

$solAyde="s.solicitud_refaccionid=".$txtPedidoSP;

}$sql = mssql_query(
    "SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk,cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,su.nombre supervisor, cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial, dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
INNER JOIN tfolio_solicitud ts ON (ts.folio_solicitudid=tr.folio_solicitudidfk)
INNER JOIN csala cs ON (cs.salaid=ts.salaidfk)
INNER JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
INNER JOIN ctecnico ct ON (ct.tecnicoid=tr.tecnicoidfk)
INNER JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)

INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where ".$sol."
union
SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk,cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,'', cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
LEFT JOIN torden_Servicio ts ON (convert(varchar, (ts.ordenid))=tr.folio_solicitudidfk)
INNER JOIN csala cs ON (cs.salaid=ts.salaidfk)
INNER JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
INNER JOIN cusuario ct ON (ct.usuarioid=tr.tecnicoidfk)
--INNER JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where ".$sol." "
);

$numRows = mssql_num_rows($sql);

if(
    $numRows = = 0 && $txtPedidoSP != ''
){$sql = mssql_query(
    "SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk,cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,su.nombre supervisor, cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie, dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
INNER JOIN csala cs ON (cs.salaid=tr.salaidfk)
INNER JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
LEFT JOIN ctecnico ct ON (ct.tecnicoid=tr.tecnicoidfk)
LEFT JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where ".$sol." and tr.tipoPedido is null "
);

$numRows = mssql_num_rows($sql);

if(
    $numRows = = 0 && $txtPedidoSP != ''
){$sql = mssql_query(
    "SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk,cest.nombre nombreEstatus, 
convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, 
convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, '' estadoNombre, cr.clave, dr.refaccionidfk, 
d.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,
ct.nombre tecnico,'' supervisor, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
INNER JOIN cdepartamento d on (d.departamentoid=tr.departamentoidfk)
left JOIN csolicitanteMaterial ct ON (ct.solicitanteid=tr.tecnicoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where ".$sol." and tr.tipoPedido is null "
);

} } } if($txtPedidoSP=='' && $txtFolioSP==''){$var=3;

////Datos Ayde//// if($selectOperadoresSP=='%'){$operador='%';

} if($selectOperadoresSP==16){$operador=26;

} if($selectOperadoresSP==14){$operador=25;

} if($selectOperadoresSP==15){$operador=12;

} if($selectOperadoresSP==17){$operador=39;

} if($selectOperadoresSP==21){$operador=51;

} if($selectOperadoresSP==22){$operador=57;

} if($selectOperadoresSP==26){$operador=88;

} if($selectOperadoresSP==25){$operador=86;

} if($selectOperadoresSP==19){$operador=55;

} if($selectOperadoresSP==23){$operador=11;

} if($selectOperadoresSP==20){$operador=63;

} if($selectOperadoresSP==27){$operador=89;

}if($comboEstadoSP = = '%'){$consulta = "SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk, cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,su.nombre supervisor, cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
LEFT JOIN tfolio_solicitud ts ON (ts.folio_solicitudid=tr.folio_solicitudidfk)
LEFT JOIN csala cs ON (cs.salaid=ts.salaidfk)
LEFT JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN ctecnico ct ON (ct.tecnicoid=tr.tecnicoidfk)
INNER JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)
inner join cregion re on (re.regionid=cs.regionidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where dr.estatusidfk like '".$selectEstatusSP."' and tr.estatusidfk like '".$selectEstatusDoc."' and ce.estadoid like '".$comboEstadoSP."' and isnull(tr.proyecto,'') like '".$proyecto."' and ts.salaidfk like '".$selectSalaSP."' and tr.usuarioidfk like '".$selectOperadoresSP."' and tr.tecnicoidfk like '".$selectTecnicoSP."' and (convert(char(10),tr.fecha_creacion,103) BETWEEN convert(datetime,'".$txtFHRCalendario55."',103) AND convert(datetime,'".$txtFHRCalendario66."',103)) and re.paisidfk != 5 and cs.subcentroidfk is NULL and dr.refaccionidfk like '".$refID ["refaccionid"]."'
union
SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk, cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,su.nombre supervisor, cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,rr.cantidad
FROM tsolicitud_refaccion tr
INNER JOIN csala cs ON (cs.salaid=tr.salaidfk)
INNER JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
left JOIN ctecnico ct ON (ct.tecnicoid=tr.tecnicoidfk)
left JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)
inner join cregion re on (re.regionid=cs.regionidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join rubicacion_refaccion rr ON (cr.refaccionid=rr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where dr.estatusidfk like '".$selectEstatusSP."' and tr.estatusidfk like '".$selectEstatusDoc."' and ce.estadoid like '".$comboEstadoSP."' and isnull(tr.proyecto,'') like '".$proyecto."' and tr.salaidfk like '".$selectSalaSP."' and tr.usuarioidfk like '".$selectOperadoresSP."' and tr.tecnicoidfk like '".$selectTecnicoSP."' and (convert(char(10),tr.fecha_creacion,103) BETWEEN convert(datetime,'".$txtFHRCalendario55."',103) AND convert(datetime,'".$txtFHRCalendario66."',103)) and re.paisidfk != 5 and ISNULL(cs.subcentroidfk,0) = 0 and tr.tipoPedido is null and dr.refaccionidfk like '".$refID ["refaccionid"]."'
union
SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk, cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,'', cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,rr.cantidad
FROM tsolicitud_refaccion tr
INNER JOIN torden_Servicio ts ON (convert(varchar, (ts.ordenid))=tr.folio_solicitudidfk)
INNER JOIN csala cs ON (cs.salaid=ts.salaidfk)
INNER JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=ts.usuarioidfk)
INNER JOIN cusuario ct ON (ct.usuarioid=tr.tecnicoidfk)
--INNER JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)
inner join cregion re on (re.regionid=cs.regionidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join rubicacion_refaccion rr ON (cr.refaccionid=rr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where dr.estatusidfk like '".$selectEstatusSP."' and tr.estatusidfk like '".$selectEstatusDoc."' and ce.estadoid like '".$comboEstadoSP."' and isnull(tr.proyecto,'') like '".$proyecto."' and ts.salaidfk like '".$selectSalaSP."' and tr.usuarioidfk like '".$selectOperadoresSP."' and tr.tecnicoidfk like '".$selectTecnicoSP."' and (convert(char(10),tr.fecha_creacion,103) BETWEEN convert(datetime,'".$txtFHRCalendario55."',103) AND convert(datetime,'".$txtFHRCalendario66."',103)) and re.paisidfk != 5 and tr.tipoPedido = 'OS' and dr.refaccionidfk like '".$refID ["refaccionid"]."'";

$respp = 'aqui';

if($paisID = = '1'){$consulta = $consulta."union
SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk,cest.nombre nombreEstatus, 
convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, 
convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, '' estadoNombre, 
d.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,
ct.nombre tecnico,'' supervisor, cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
INNER JOIN cdepartamento d on (d.departamentoid=tr.departamentoidfk)
left JOIN csolicitanteMaterial ct ON (ct.solicitanteid=tr.tecnicoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where dr.estatusidfk like '".$selectEstatusSP."' and tr.estatusidfk like '".$selectEstatusDoc."' and d.nombre like '".$comboDepartamentos."' and isnull(tr.proyecto,'') like '".$proyecto."' and tr.usuarioidfk like '".$selectOperadoresSP."' and (convert(char(10),tr.fecha_creacion,103) BETWEEN convert(datetime,'".$txtFHRCalendario55."',103) AND convert(datetime,'".$txtFHRCalendario66."',103)) and tr.tipoPedido is null and dr.refaccionidfk like '".$refID ["refaccionid"]."'";

} $sql=mssql_query($consulta);

}
else if(
    $comboEstadoSP != '%' && $comboEstadoSP != 'ODELNORTE'
){$sql = mssql_query(
    "SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk, cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,su.nombre supervisor, cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
INNER JOIN tfolio_solicitud ts ON (ts.folio_solicitudid=tr.folio_solicitudidfk)
INNER JOIN csala cs ON (cs.salaid=ts.salaidfk)
INNER JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN ctecnico ct ON (ct.tecnicoid=tr.tecnicoidfk)
INNER JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where ".$selectEstatusSP2." and tr.estatusidfk like '".$selectEstatusDoc."' and ce.estadoid like '".$comboEstadoSP."' and isnull(tr.proyecto,'') like '".$proyecto."' and ts.salaidfk like '".$selectSalaSP."' and tr.usuarioidfk like '".$selectOperadoresSP."' and tr.tecnicoidfk like '".$selectTecnicoSP."' and (convert(char(10),tr.fecha_creacion,103) BETWEEN convert(datetime,'".$txtFHRCalendario55."',103) AND convert(datetime,'".$txtFHRCalendario66."',103)) and cs.subcentroidfk is NULL and dr.refaccionidfk like '".$refID ["refaccionid"]."'
union
SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk, cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,su.nombre supervisor, cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
INNER JOIN csala cs ON (cs.salaid=tr.salaidfk)
INNER JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN ctecnico ct ON (ct.tecnicoid=tr.tecnicoidfk)
INNER JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where ".$selectEstatusSP2." and tr.estatusidfk like '".$selectEstatusDoc."' and ce.estadoid like '".$comboEstadoSP."' and isnull(tr.proyecto,'') like '".$proyecto."' and tr.salaidfk like '".$selectSalaSP."' and tr.usuarioidfk like '".$selectOperadoresSP."' and tr.tecnicoidfk like '".$selectTecnicoSP."' and (convert(char(10),tr.fecha_creacion,103) BETWEEN convert(datetime,'".$txtFHRCalendario55."',103) AND convert(datetime,'".$txtFHRCalendario66."',103)) and cs.subcentroidfk is NULL and tr.tipoPedido is null and dr.refaccionidfk like '".$refID ["refaccionid"]."'
union
SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk, cest.nombre nombreEstatus, convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, ce.nombre estadoNombre, cs.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,ct.nombre tecnico,'', cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
INNER JOIN torden_Servicio ts ON (convert(varchar, (ts.ordenid)) = tr.folio_solicitudidfk)
INNER JOIN csala cs ON (cs.salaid=ts.salaidfk)
INNER JOIN cestado ce on (ce.estadoid=cs.estadoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=ts.usuarioidfk)
INNER JOIN cusuario ct ON (ct.usuarioid=tr.tecnicoidfk)
--INNER JOIN csupervisor su ON (su.supervisorid=ct.supervisoridfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where ".$selectEstatusSP2." and tr.estatusidfk like '".$selectEstatusDoc."' and ce.estadoid like '".$comboEstadoSP."' and isnull(tr.proyecto,'') like '".$proyecto."' and ts.salaidfk like '".$selectSalaSP."' and tr.usuarioidfk like '".$selectOperadoresSP."' and tr.tecnicoidfk like '".$selectTecnicoSP."' and (convert(char(10),tr.fecha_creacion,103) BETWEEN convert(datetime,'".$txtFHRCalendario55."',103) AND convert(datetime,'".$txtFHRCalendario66."',103)) and tr.tipoPedido = 'OS' and dr.refaccionidfk like '".$refID ["refaccionid"]."' "
);

}
else if($comboEstadoSP = = 'ODELNORTE'){$sql = mssql_query(
    "SELECT tr.solicitud_refaccionid, tr.folio_solicitudidfk, tr.estatusidfk,cest.nombre nombreEstatus, 
convert(varchar(20),tr.fecha_creacion,13) as FechaSolicitud, 
convert(varchar(20),tr.fecha_entrega,13) as FechaEntrega, convert(varchar(20),dr.fechaEnvio,13) as FechaEnvio, '' estadoNombre, 
d.nombre salaNombre, tr.observaciones, tr.paqueteria, tr.numero_guia, cu.nombre operadorNombre,
ct.nombre tecnico,'' supervisor, cu.apellido_paterno, cr.clave, dr.refaccionidfk, cr.nombre descripcion,dr.cantidad,dr.serieEnvia serie,dr.entregaParcial,dr.estatusidfk estatusPartida, ct2. nombre tecnico_recibe, his.fecha fechaRecibo,tr.proyecto,cr.cantidadStock+cantidadStockB9 cantInv
FROM tsolicitud_refaccion tr
INNER JOIN cdepartamento d on (d.departamentoid=tr.departamentoidfk)
left JOIN csolicitanteMaterial ct ON (ct.solicitanteid=tr.tecnicoidfk)
INNER JOIN cusuario cu ON (cu.usuarioid=tr.usuarioidfk)
INNER JOIN dsolicitud_refaccion dr ON (dr.solicitud_refaccionidfk=tr.solicitud_refaccionid)
INNER JOIN crefaccion cr ON (cr.refaccionid=dr.refaccionidfk)
INNER JOIN cestatus cest ON (cest.estatusid=tr.estatusidfk)
left join hisEntregaMat his ON (tr.solicitud_refaccionid = his.solicitud)
left JOIN ctecnico ct2 ON (ct2.tecnicoid=his.tecnicoidfk)
where dr.estatusidfk like '".$selectEstatusSP."' and tr.estatusidfk like '".$selectEstatusDoc."' and d.nombre like '".$comboDepartamentos."' and isnull(tr.proyecto,'') like '".$proyecto."' and tr.usuarioidfk like '".$selectOperadoresSP."' and (convert(char(10),tr.fecha_creacion,103) BETWEEN convert(datetime,'".$txtFHRCalendario55."',103) AND convert(datetime,'".$txtFHRCalendario66."',103)) and tr.tipoPedido is null and dr.refaccionidfk like '".$refID ["refaccionid"]."'"
);

}}echo "<table id='tablaSPStock' border='1' style='font-size:14px;'>
		   			<tr style='background:#EEEEEE';>
						<th align='center'>FOLIO CC
					    <th align='center'>PEDIDO STOCK
						<th align='center'>SALA
						<th align='center'>FECHA PEDIDO
						<th align='center'>CODIGO
						<th align='center'>DESCRIPCION
						<th align='center'>CANTIDAD SOLICITADA
						<th align='center'>CANTIDAD ENVIADA
						<th align='center'>CANTIDAD FALTANTE
						<th align='center'>EXISTENCIA
						<th align='center'>FECHA DE ENVIO	
						<th align='center'>FECHA DE ENTREGA					
						<th align='center'>ESTATUS PIEZA
						<th align='center'>ESTATUS PEDIDO
						<th align='center'>SERIE
						<th align='center'>PROYECTO
						<th align='center'>OBSERVACIONES
						<th align='center'>PAQUETERIA
						<th align='center'>No. GUIA
						<th align='center'>OPERADOR
						<th align='center'>RECIBE.
					</tr>";

while ($res=mssql_fetch_array($sql)){$n=$n+1;

if($selectEstatusSP = = '%'){$selectEstatusSP2 = "tr.estatusidfk like '%'";

}/ / if($selectEstatusSP = = 30){$selectEstatusSP2 = "(tr.estatusidfk=30 or tr.estatusidfk=87 or tr.estatusidfk=29)";

} if($res["estatusPartida"]==29){$estatus="Pendiente";

} if($res["estatusPartida"]==31){$estatus="Cancelado";

} if($res["estatusPartida"]==33){$estatus="Parcial";

} if($res["estatusPartida"]==43){$estatus="Sin Existencia";

} if($res["estatusPartida"]==47){$estatus="Completo";

} if($res["estatusPartida"]==51){$estatus="Similar";

}/ / if(
    $res ["estatusidfk"] = = 30 || $res ["estatusidfk"] = = 87 || $res ["estatusidfk"] = = 29
){$res ["nombreEstatus"] = 'En Proceso';

} //$res=mssql_fetch_array($sql);

/*$pedidos = mssql_query("select dr.folioRetorno as foliosRetorno from dsolicitud_refaccion dr where solicitud_refaccionidfk=".$res["solicitud_refaccionid"]." ");
 while ($pedidosx=mssql_fetch_array($pedidos)){
 if($pedidosx["foliosRetorno"]!=' '){$allPedidos=$allPedidos.$pedidosx["foliosRetorno"].',';}}*/

$numeroUno = $res["cantidad"];

$numeroDos = $res["entregaParcial"];

if($res["entregaParcial"]==0){$numeroDos=$numeroUno;

} $totalResta = $numeroUno - $numeroDos;

if($estatus=='Cancelado'){$totalResta='N/A';

} if($estatus=='Pendiente'){$totalResta=$numeroUno;

} if($estatus=='Sin Existencia'){$totalResta=$numeroUno;

}echo "<tr style='font-size:12px;'>
				
	  			<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["folio_solicitudidfk"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["solicitud_refaccionid"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["salaNombre"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["FechaSolicitud"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["clave"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["descripcion"]."</td>			
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["cantidad"]."</td>";

if(
    $estatus = = "Completo" || $estatus = = "Similar" || $estatus = = "Parcial"
){echo "
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["cantidad"]."</td>";

}
else{echo "<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["entregaParcial"]."</td>";

}echo "	<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$totalResta."</td>
		        <td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["cantInv"]."</td>";

if(
    $estatus = = 'Completo' || $estatus = = 'Similar'
){echo "
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["FechaEnvio"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["FechaEntrega"]."</td>";

}
else{echo "
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'></td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'></td>";

}echo "	<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$estatus."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["nombreEstatus"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["serie"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["proyecto"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["observaciones"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["paqueteria"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["numero_guia"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["operadorNombre"]."</td>
				<td onclick='detalleRepPed(\"".$res ["folio_solicitudidfk"]."\", \"".$res ["solicitud_refaccionid"]."\");'>".$res ["tecnico_recibe"]."<br> ".$res ["fechaRecibo"]."</br></td>
			</tr>";

}/ / FIN
while ($res = mssql_fetch_array($sql)){echo "</table>||".$n."||".$consulta."||".$respp;

$sd->desconectar();

?> 