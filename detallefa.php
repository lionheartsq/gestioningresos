
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["admin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');

$idresidente=$_REQUEST['idresidente'];

mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.documentor as cedular,residentes.expedicionr as expedidor,residentes.fechanacimiento as fechanr,residentes.nombresr as nombrer,residentes.apellidosr as apellidosr, residentes.telefono as telefonor,residentes.celular as celularr,residentes.profesion as profesionr,residentes.email as emailr,residentes.direccionf as direccionr,residentes.ciudad as ciudadr,residentes.estudios as estudios,residentes.estadocivil as estadocr,residentes.conyuge as conyuger,residentes.tipodocumento as tipodr,residentes.eps as eps,residentes.padre as padrer,residentes.madre as madrer,asociacion.parentesco as parentescou,usuarios.nombres as nombreu,usuarios.apellidos as apellidou,usuarios.telefono as telefonou,usuarios.email as emailu,usuarios.documento 
as docu,usuarios.expedicion as expedidou,usuarios.autorizacion as autorizacion,historial.fechaingreso as fechaih,historial.motivoi as motivoi,historial.tiempoadiccion as tiempoah,historial.medidatiempo as 
canth,historial.drogasusadas as drogash,historial.problemas as problh,historial.carcel as carcelh,historial.fundaciones as fundh,historial.motivos as moth,historial.referido as referido,historial.orientador as orientador,historial.cedorientador as cedorientador,historialm.enfermedades as enfermhm,historialm.fechaexamen as fechaehm,historialm.estadosalud as estadoshm,historialm.vacunas as vacunas,historialm.diagnosis as diagnosis,historialm.medicamentos as medichm,historialm.alergias as alergias,historialm.hospitalizado as hosphm,historialm.descripcion as descrhmh from residentes join asociacion on asociacion.idresidentes=residentes.idresidentes join usuarios on asociacion.idusuarios=usuarios.idusuarios join historial on historial.idresidentes=residentes.idresidentes join historialm on historialm.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidente'");

while ($resultx = mysqli_fetch_array($result1)) {
$cedular=$resultx['cedular'];
$expedidor=$resultx['expedidor'];
$fechanr=$resultx['fechanr'];
$nombrer=$resultx['nombrer'];
$apellidosr=$resultx['apellidosr'];
$telefonor=$resultx['telefonor'];
$celularr=$resultx['celularr'];
$profesionr=$resultx['profesionr'];
$emailr=$resultx['emailr'];
$direccionr=$resultx['direccionr'];
$ciudadr=$resultx['ciudadr'];
$estudios=$resultx['estudios'];
$estadocr=$resultx['estadocr'];
$conyuger=$resultx['conyuger'];
$tipodr=$resultx['tipodr'];
$eps=$resultx['eps'];
$padrer=$resultx['padrer'];
$madrer=$resultx['madrer'];
$parentescou=$resultx['parentescou'];
$nombreu=$resultx['nombreu'];
$apellidou=$resultx['apellidou'];
$telefonou=$resultx['telefonou'];
$emailu=$resultx['emailu'];
$docu=$resultx['docu'];
$expedidou=$resultx['expedidou'];
$autorizacion=$resultx['autorizacion'];
$fechaih=$resultx['fechaih'];
$motivoi=$resultx['motivoi'];
$tiempoah=$resultx['tiempoah'];
$canth=$resultx['canth'];
$drogash=$resultx['drogash'];
$problh=$resultx['problh'];
$carcelh=$resultx['carcelh'];
$fundh=$resultx['fundh'];
$moth=$resultx['moth'];
$referido=$resultx['referido'];
$orientador=$resultx['orientador'];
$cedorientador=$resultx['cedorientador'];
$enfermhm=$resultx['enfermhm'];
$fechaehm=$resultx['fechaehm'];
$estadoshm=$resultx['estadoshm'];
$vacunas=$resultx['vacunas'];
$diagnosis=$resultx['diagnosis'];
$medichm=$resultx['medichm'];
$alergias=$resultx['alergias'];
$hosphm=$resultx['hosphm'];
$descrhmh=$resultx['descrhmh'];
}

require('tfpdf.php');
class PDF extends tFPDF
{
// Cabecera de página
function Header()
{
    // Logo
	$this->Image('images/jemr.png',0,1,216);
}

// Pie de página
function Footer()
{
$this->Image('images/jemr.jpg',0,265,216);	  	
}
}

$pdf = new PDF();

$pdf->AddPage('P','Letter');
// Arial bold 15
$pdf->SetFont('Arial','B',16);
// Movernos a la derecha
$pdf->Cell(35);
// Título
$pdf->Cell(0,15,'FORMULARIO DE INGRESO DEL RESIDENTE');
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$html = 'Bienvenido a nuestra FUNDACIÓN JESÚS ES MI ROCA; por favor llene este formulario de manera precisa, es muy importante para nosotros tener esta información para poder brindar el mejor cuidado posible para usted o para su familiar. Su privacidad es importante para nosotros. La información que comparte con nosotros permanecerá estrictamente confidencial.';
$pdf->Write(5,utf8_decode($html),'');
$pdf->Ln(10);
$pdf->Cell(65);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,utf8_decode('Información personal'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(110,10,utf8_decode('Fecha de ingreso: '.$fechaih));
$pdf->Cell(40,10,utf8_decode('Ingresa a: '.$motivoi));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Nombre: '.$nombrer.' '.$apellidosr));
$pdf->Cell(40,10,utf8_decode('Documento: '.$tipodr.' '.$cedular));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Fecha de nacimiento: '.$fechanr));
$pdf->Cell(40,10,utf8_decode('Seguro social: '.$eps));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Dirección: '.$direccionr));
$pdf->Cell(40,10,utf8_decode('Ciudad: '.$ciudadr));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Teléfono fijo: '.$telefonor));
$pdf->Cell(40,10,utf8_decode('Celular: '.$celularr));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Estado civil: '.$estadocr));
$pdf->Cell(90,10,utf8_decode('Nombre del cónyuge: '.$conyuger));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Estudios: '.$estudios));
$pdf->Cell(90,10,utf8_decode('Profesión u oficio: '.$profesionr));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Correo electrónico: '.$emailr));
$pdf->Cell(90,10,utf8_decode('Acudiente: '.$nombreu.' '.$apellidou));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Nombre del padre: '.$padrer));
$pdf->Cell(90,10,utf8_decode('Nombre de la madre: '.$madrer));
$pdf->Ln(15);
$pdf->Cell(110,10,utf8_decode('En caso de emergencia, ¿a quien podemos llamar?'));
$pdf->Ln(15);
$pdf->Cell(110,10,utf8_decode('Nombre del acudiente: '.$nombreu.' '.$apellidou));
$pdf->Cell(90,10,utf8_decode('Relación con el paciente: '.$parentescou));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Teléfono de contacto: '.$telefonou));
$pdf->Cell(90,10,utf8_decode('Correo de contacto: '.$emailu));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Tiempo en la adicción: '.$tiempoah.' '.$canth));
$pdf->Cell(90,10,utf8_decode('Drogas usadas: '.$drogash));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Problemas con la justicia: '.$problh));
$pdf->Cell(90,10,utf8_decode('Ha estado preso: '.$carcelh));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Fundaciones en las que ha estado: '.$fundh));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Motivos del retiro: '.$moth));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Cómo se enteró de nosotros: '.$referido));
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->Cell(70);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('ESTADO FÍSICO'));
$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(110,10,utf8_decode('¿Padece alguna enfermedad? : '.$enfermhm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Fecha de su último exámen físico : '.$fechaehm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('¿Cómo calificaría su estado de salud en general? : '.$estadoshm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('¿Tiene sus vacunas al día? : '.$vacunas));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Diagnóstico por el médico : '.$diagnosis));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('¿Toma algún medicamento? : '.$medichm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('¿Tiene alergias? : '.$alergias));
$pdf->Ln(10);
$pdf->Cell(90,10,utf8_decode('¿Alguna vez ha estado hospitalizado? : '.$hosphm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Si ha estado hospitalizado describa : '.$descrhmh));
$pdf->Ln(70);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,170,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,115,170,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,80,200,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,180,200,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('FIRMA PADRE O ACUDIENTE'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->Cell(35);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('AUTORIZACIÓN PARA LA PUBLICACIÓN DE'));
$pdf->Ln(10);
$pdf->Cell(35);
$pdf->Cell(0,15,utf8_decode('IMÁGENES Y VIDEOS DE LOS RESIDENTES'));
$pdf->Ln(20);
$pdf->Cell(50);
$pdf->Cell(0,15,utf8_decode('FUNDACIÓN JESÚS ES MI ROCA'));
$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$html2 = 'Con la inclusión de las nuevas tecnologías dentro de los medios didácticos al alcance de la comunidad y la posibilidad de que en estos puedan aparecer imágenes y/o videos de sus hijos, durante la realización de actividades organizadas por la Fundación, y dado que el derecho a la propia imagen está reconocido en la Constitución y la regulación por la ley sobre el derecho al honor, a la identidad personal, familiar y a la propia. 

La Junta Directiva de la FUNDACIÓN JESÚS ES MI ROCA pide a los padres y/o acudientes legales para poder publicar (o negar su publicación), las imágenes en las cuales aparezcan individualmente o en grupo en el desarrollo de su tratamiento y que se puedan realizar a los jóvenes por parte de la Fundación en las diferentes actividades realizadas en la Institución y fuera de la misma.';
$pdf->Write(5,utf8_decode($html2),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','',11);
$pdf->Cell(110,10,utf8_decode('-------------------------------------------------------------------------------------------------------------------------------------------------------------------------'));
$pdf->Ln(10);
$html3="Yo, $nombreu $apellidou con CC: $docu de $expedidou Padre o Acudiente del Residente $nombrer $apellidosr de la FUNDACIÓN JESÚS ES MI ROCA.";
$pdf->Write(5,utf8_decode($html3),'');
$pdf->Ln(10);
$html4="$autorizacion doy mi consentimiento para que mi hijo aparezca en las fotografías y/o videos que se publiquen en la página Web, y redes sociales como: Facebook, whatsapp e Instagram de la FUNDACIÓN JESÚS ES MI ROCA de forma individual o de grupo, durante la realización de actividades.";
$pdf->Write(5,utf8_decode($html4),'');
$pdf->Ln(10);
$html5="Lugar y fecha: Mesa de los santos, $fechaih.";
$pdf->Write(5,utf8_decode($html5),'');
$pdf->Ln(40);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,115,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,80,220,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,180,220,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('FIRMA DE QUIEN AUTORIZA'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));
$pdf->Ln(10);


$pdf->AddPage('P','Letter');
$pdf->Cell(45);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('AUTORIZACIÓN PARA EL MANEJO'));
$pdf->Ln(10);
$pdf->Cell(58);
$pdf->Cell(0,15,utf8_decode('DE DATOS PERSONALES'));
$pdf->Ln(20);
$pdf->SetFont('Arial','',11);
$html6="Yo $nombreu $apellidou, identificado(a) con la cédula de ciudadanía No. $docu expedida en $expedidou, manifiesto por medio de este documento que he recibido de la FUNDACIÓN JESÚS ES MI ROCA la información acerca del uso de mis datos personales, los cuales serán utilizados dentro del objeto social de la FUNDACIÓN JESÚS ES MI ROCA para los fines pertinentes por los cuales fue tomada la correspondiente información, así mismo manifiesto que me fue informado que mis datos personales serán usados por la FUNDACIÓN JESÚS ES MI ROCA, única y exclusivamente para mantenerme informado(a) sobre actividades institucionales, realizar promoción de servicios y eventos de la Institución, para el cumplimiento de obligaciones contractuales; por consiguiente manifiesto que otorgo autorización PREVIA, EXPLICITA, INEQUÍVOCA e INFORMADA a la FUNDACIÓN JESÚS ES MI ROCA, para el uso de mis datos personales, para los fines descritos anteriormente los cuales a partir del momento de la firma de la presente autorización, hará parte de la base de datos de la FUNDACIÓN JESÚS ES MI ROCA que tiene de sus residentes y demás personas relacionadas con la Institución.

Así mismo, declaro que me fueron informados los derechos que como titular de la información puedo ejercer, tales como:

1.	Conocer, actualizar y rectificar mis datos personales.
2.	Recibir información acerca del uso que la FUNDACIÓN JESÚS ES MI ROCA le da a mis datos personales.
3.	Solicitar una relación detallada acerca de mis datos personales registrados en la base de datos de la Institución.
4.	Autorizar a la FUNDACIÓN JESÚS ES MI ROCA a suministrar mis datos personales únicamente a aquellas personas o empresas que la Ley o el suscrito determinen.

La presente autorización se suscribe en Piedecuesta, a $fechaih.";
$pdf->Write(5,utf8_decode($html6),'');
$pdf->Ln(40);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,95,210,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode($nombreu.' '.$apellidou));
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));

$pdf->AddPage('P','Letter');
$pdf->Cell(45);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('AUTORIZACIÓN PARA EL MANEJO'));
$pdf->Ln(10);
$pdf->Cell(58);
$pdf->Cell(0,15,utf8_decode('DE DATOS PERSONALES'));
$pdf->Ln(20);
$pdf->SetFont('Arial','',11);
$html7="Yo $nombrer $apellidosr, identificado(a) con $tipodr No. $cedular expedida en $expedidor, manifiesto por medio de este documento que he recibido de la FUNDACIÓN JESÚS ES MI ROCA la información acerca del uso de mis datos personales, los cuales serán utilizados dentro del objeto social de la FUNDACIÓN JESÚS ES MI ROCA para los fines pertinentes por los cuales fue tomada la correspondiente información, así mismo manifiesto que me fue informado que mis datos personales serán usados por la FUNDACIÓN JESÚS ES MI ROCA, única y exclusivamente para mantenerme informado(a) sobre actividades institucionales, realizar promoción de servicios y eventos de la Institución, para el cumplimiento de obligaciones contractuales; por consiguiente manifiesto que otorgo autorización PREVIA, EXPLICITA, INEQUÍVOCA e INFORMADA a la FUNDACIÓN JESÚS ES MI ROCA, para el uso de mis datos personales, para los fines descritos anteriormente los cuales a partir del momento de la firma de la presente autorización, hará parte de la base de datos de la FUNDACIÓN JESÚS ES MI ROCA que tiene de sus residentes y demás personas relacionadas con la Institución.

Así mismo, declaro que me fueron informados los derechos que como titular de la información puedo ejercer, tales como:

1.	Conocer, actualizar y rectificar mis datos personales.
2.	Recibir información acerca del uso que la FUNDACIÓN JESÚS ES MI ROCA le da a mis datos personales.
3.	Solicitar una relación detallada acerca de mis datos personales registrados en la base de datos de la Institución.
4.	Autorizar a la FUNDACIÓN JESÚS ES MI ROCA a suministrar mis datos personales únicamente a aquellas personas o empresas que la Ley o el suscrito determinen.

La presente autorización se suscribe en Piedecuesta, a $fechaih.";
$pdf->Write(5,utf8_decode($html7),'');
$pdf->Ln(40);
//firmas
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,5,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,95,210,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode($nombrer.' '.$apellidosr));
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));

$pdf->AddPage('P','Letter');
$pdf->Cell(50);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('DECLARACION DE INDEMNIDAD'));
$pdf->Ln(10);
$pdf->Cell(65);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,15,utf8_decode('DATOS DE IDENTIFICACIÓN'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$pdf->Cell(196,7,utf8_decode('Nombre del residente: '.$nombrer.' '.$apellidosr),1,1,'C');
$pdf->Cell(196,7,utf8_decode('Identificación: '.$tipodr.'      Numero: '.$cedular.'      Lugar de Expedición: '.$expedidor),1,1,'C');
$pdf->Ln(7);
$pdf->Cell(40);
$pdf->Cell(0,5,utf8_decode('1. DECLARACIÓN DE LA FUNDACIÓN JESÚS ES MI ROCA'));
$pdf->Ln(7);
$pdf->MultiCell(196,5,utf8_decode('a. No se hace responsable de ningún tipo de perjuicio material, ni daño alguno que ocasione la persona o cosa dentro y/o fuera de la institución.
b. No tendrá ninguna responsabilidad penal, civil, administrativa, laboral de ninguna naturaleza.'),1);
$pdf->Ln(7);
$pdf->Cell(60);
$pdf->Cell(0,10,utf8_decode('2. DECLARACIÓN DEL RESIDENTE'));
$pdf->Ln(10);
$pdf->MultiCell(196,5,utf8_decode('a. Declaro en el presente documento que exonero a la FUNDACIÓN JESÚS ES MI ROCA de responsabilidades penales o civiles.
b. Que la Institución no se hará responsable de cualquier posible accidente que ocasione en mí un daño permanente o transitorio, ni el deterioro de mi salud por causas naturales.
c. Que la FUNDACIÓN JESÚS ES MI ROCA no se hará responsable de mis fugas y de lo que posiblemente pueda ocasionarme dicha fuga. 
d. Que la FUNDACIÓN JESÚS ES MI ROCA no se hará responsable de un posible suicidio dentro o fuera de la institución.  
e. La FUNDACIÓN JESÚS ES MI ROCA no responderá por jóvenes que por su cuadro clínico presente síntomas de depresión o sufran de esta enfermedad y atenten contra su vida.
f. La FUNDACIÓN JESÚS ES MI ROCA no responderá por objetos de valor   de jóvenes que se ausenten da la fundación las prendas dejadas tales como ropa útiles de aseo y de más pertenencia la familia tendrá un plazo máximo de ocho días para buscar dichas pertenencias si no lo hace en este lapso de tiempo la fundación no se hará responsable de dichas pertenencias 
g. La colchoneta que ingresa a la fundación quedará donada a la FUNDACIÓN JESÚS ES MI ROCA.
h. Acudiente que tome la decisión de retirar al residente Del tratamiento, o se fugue, la Fundación no hará devolución de dineros pagados a la institución. (Numeral 19 Capitulo 12.3 NORMAS INTERNAS DE LOS PADRES DE FAMILIA Del Manual de Convivencia).'),1);
$pdf->Ln(30);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,200,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,115,200,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,75,230,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,175,230,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL ACUDIENTE'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->Ln(10);
$pdf->SetFont('Arial','',11);
$pdf->Cell(70);
$pdf->Cell(0,5,utf8_decode('3. DECLARACION FAMILIAR'));
$pdf->Ln(7);
$pdf->MultiCell(196,5,utf8_decode('a. Declaro que he entendido y acatado lo anterior expuesto, sin embargo, doy pleno consentimiento.
b. Acudiente o familiar: '.$nombreu.' '.$apellidou),1);
$pdf->Ln(20);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,45,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->Cell(5,10,utf8_decode('FIRMA: '));
$pdf->Cell(60,10);
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,100,45,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(50,10,utf8_decode('PARENTESCO: '.$parentescou));
$pdf->Cell(65,10,utf8_decode('No C.C'.' '.$docu.' de '.$expedidou));
$pdf->Ln(20);
$pdf->Cell(60);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,utf8_decode('CONSENTIMIENTO INFORMADO'));
$pdf->Ln(5);
$pdf->SetFont('Arial','',11);
$pdf->Cell(65);
$pdf->Cell(0,10,utf8_decode('4. DATOS DE IDENTIFICACIÓN'));
$pdf->Ln(7);
$pdf->Cell(196,7,utf8_decode('Nombre del usuario: '.$nombrer.' '.$apellidosr),1,1,'C');
$pdf->Cell(196,7,utf8_decode('Identificación: '.$tipodr.'      Numero: '.$cedular.'      Lugar de Expedición: '.$expedidor),1,1,'C');
$pdf->MultiCell(196,5,utf8_decode('Nombre Técnico del tratamiento que se va a implementar al usuario: Proceso de Rehabilitación a través de Tratamiento psicoterapéutico y talleres de formación espiritual para prevenir el consumo y ayuda profesional para reinsertarse de nuevo a la sociedad.'),1);
$pdf->Ln(7);
$pdf->Cell(65);
$pdf->Cell(0,10,utf8_decode('5. DECLARACIÓN DEL USUARIO'));
$pdf->Ln(7);
$pdf->MultiCell(196,5,utf8_decode('a. Me han explicado y he comprendido satisfactoriamente la naturaleza y el propósito del tratamiento ofrecido por la institución incluyendo las restricciones establecidas durante el proceso, reglamento interno riesgos y beneficios, así como alternativas de otros tratamientos. Soy consciente de que no existen garantías absolutas Del resultado Del tratamiento ya que depende de mí con la fuerza de voluntad y empeño que coloque en el tratamiento. Con la posibilidad de poderlo revocar cualquier momento.
b. Doy mi consentimiento para que se implemente el tratamiento descrito anteriormente y los procedimientos complementarios que sean necesarios y/o convenientes durante la ejecución del mismo a juicio de las personas que lo llevan a cabo.
c. En cualquier caso deseo que se me respeten mis derechos humanos y mis derechos como usuario, convicciones y la confidencialidad de la información que proporcione.
d. De aceptar algunos de estos puntos hágase constar: '),1);
$pdf->Ln(30);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,210,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,115,210,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,80,240,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,180,240,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL TUTOR LEGAL'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->Ln(10);
$pdf->Cell(60);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,utf8_decode('6. DECLARACIONES Y FIRMAS'));
$pdf->Ln(10);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,5,utf8_decode('a. Orientador responsable: '.$orientador));
$pdf->Ln(10);
$pdf->MultiCell(196,5,utf8_decode('He informado al usuario del propósito y naturaleza del tratamiento descrito anteriormente, de otras alternativas, posibles riesgos y beneficios, así como los resultados que se esperan.
'),0);
$pdf->Ln(30);
$pic3 = "firmas/$cedorientador.png";
if(file_exists($pic3)){
$pdf->Image($pic3,1,50,90,'C'); //valor x, valor y, ancho
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(55,10,utf8_decode('FIRMA DEL ORIENTADOR: '));
$pdf->Cell(65,10,utf8_decode('No C.C'.' '.$cedorientador));
$pdf->Ln(20);
$pdf->MultiCell(196,5,utf8_decode('b. Tutor legal o familiar.

Sé que el usuario en mención; ha sido considerado incapaz de tomar por sí mismo la decisión de aceptar o rechazar el tratamiento descrito anteriormente. El orientador me ha explicado de forma satisfactoria que es, como se hace y para qué sirve el tratamiento.  También me ha explicado sus riesgos y beneficios. He comprendido lo anterior perfectamente y por ello doy mi consentimiento para que el equipo de profesionales implemente el tratamiento bajo la asesoría del cuerpo administrativo de la FUNDACIÓN JESÚS ES MI ROCA.
 
c. Así mismo la afiliación a salud, gastos médicos, traslado a centros asistenciales, medicamentos y demás tratamientos en cuestión de salud, los gastos de los mismos correrán por cuenta del tutor legal o familiar. 

d. Dicha documentación debe ser autenticada ante la respectiva notaria local para su legalidad.

Firma Acudiente o familiar.'),0);
$pdf->Ln(30);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->Cell(5,10,utf8_decode('FIRMA: '));
$pdf->Cell(70,10);
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,100,225,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(50,10,utf8_decode('PARENTESCO: '.$parentescou));
$pdf->Ln(10);
$pdf->Cell(65,10,utf8_decode('No C.C'.' '.$docu.' de '.$expedidou));

$pdf->Output();
}
else {
header("Location:index.php");
}
?>