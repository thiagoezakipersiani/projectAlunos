<?php
define('FPDF_FONTPATH', 'font/');
require('./fpdf/fpdf.php');

//conexão com banco de dados
$host="localhost";
$user="root";
$pass="";
$banco="alunos_projeto";
$conexao=mysqli_connect($host,$user,$pass,$banco);

//pesquisar na tabela
$order='TIMESTAMPDIFF(YEAR, data_nascimento,NOW()) DESC';
$fields='*,TIMESTAMPDIFF(YEAR, data_nascimento,NOW()) as idade ';
$table='alunos';

$query='Select '.$fields.' from '.$table.' ORDER BY '.$order;

$busca = mysqli_query($conexao, $query);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(180,10,('Relatorio de Alunos'),0,0,"C");
$pdf->ln(); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50, 7,'Nome Completo',1,0,"C");
$pdf->Cell(65, 7,'Endereco',1,0,"C");
$pdf->Cell(40, 7,'Idade',1,0,"C");
$pdf->Cell(40, 7,'Renda Familiar R$',1,0,"C");
$pdf->ln(); //nenhum espaçamentos entre linhas


while ($resultado = mysqli_fetch_array($busca)) {

    $pdf->Cell(50, 7, $resultado['nome_completo'],1,0,"C");
    $pdf->Cell(65, 7, $resultado['endereco'],1,0,"C");
    $pdf->Cell(40, 7, $resultado['idade'],1,0,"C");
    $pdf->Cell(40, 7, $resultado['renda_familiar'],1,0,"C");
    $pdf->Ln();
    
}
$pdf->Output();
?>