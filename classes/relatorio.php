<?php
    require_once("fpdf/fpdf.php");
    require_once("../Model/DAO/usuariosDAO.php");
    require_once("../Model/DAO/perfisDAO.php");
    
    $myuser = new usuarios();
    $meuperfil = new perfisDAO();
    $myuserdao = new usuariosDAO($myuser);    
    
    $pdf = new fpdf("P","pt","A4");
	$pdf->AddPage();
	$pdf->SetFont('arial','B',18);
	$pdf->Cell(0,5,"Usuários cadastrados",0,1,'C');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(50);
	 
	//Cabeçalho da tabela 
	$pdf->SetFont('arial','B',14);
	$pdf->Cell(130,20,'Nome',1,0,"L");
	$pdf->Cell(200,20,'E-mail',1,0,"L");
	$pdf->Cell(130,20,'Perfil',1,1,"L");
	 
	//Linhas da tabela 
	$pdf->SetFont('arial','',12);
    foreach($myuserdao->load() as $usuarios){ 
		$pdf->Cell(130,20,$usuarios->getNome(),1,0,"L");
		$pdf->Cell(200,20,$usuarios->getEmail(),1,0,"L");
		$pdf->Cell(130,20,$meuperfil->find($usuarios->getPerfil())[0]->nome,1,1,"L");
	}
	$pdf->Output("relatorio.pdf","D");
?>