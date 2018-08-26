<!doctype html>
<html>
<head>
	<style>
	@font-face{
			font-family: BMHANNA_11yrs;
			src: url(BMHANNA_11yrs_ttf.ttf)
			}
	</style>
</head>
<body style="padding-left: 0px">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/devicons/css/devicons.min.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/resume.min.css" rel="stylesheet">
<!--===============================================================================================-->	

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<?php
	$career = $_POST["career"];
	$filter = [
		'career' => $career
	];
	
	$options = [
	   'projection' => ['_id' => 0],
	];
	
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
	$query = new MongoDB\Driver\Query($filter, $options);
	$readPreference = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_PRIMARY);
	$cursor = $manager->executeQuery('projectdb.info', $query, $readPreference);
?>
<div class="table100 ver2 m-b-110">
<div class="table100-head">
	<table>
		<thead>
		<tr class="row100 head">
			<th class="cell100 column1">기업</th>
			<th class="cell100 column2">제목</th>
			<th class="cell100 column3">직무</th>
			<th class="cell100 column4">지원자격</th>
			<th class="cell100 column5">지역</th>
			<th class="cell100 column6">마감일</th>
			<th class="cell100 column7">상세정보</th>
		</tr>
		</thead>
	</table>
</div>
	<?
		foreach($cursor as $document) {
	?>
	<div class="table100-body js-pscroll">
		<table>
		<tbody>
			<tr class="row100 body">
				<td class="cell100 column1"><? echo $document -> company_name ?></td>
				<td class="cell100 column2"><? echo $document -> title ?></td>
				<td class="cell100 column3"><? foreach($document ->job as $job){
					echo $job." / ";
				} ?></td>
				<td class="cell100 column4"><? echo $document -> achievement .' / '. $document -> career?></td>
				<!--<td><? echo $document -> career ?></td>-->
				<td class="cell100 column5"><? echo $document -> area ?></td>
				<td class="cell100 column6"><? echo $document -> deadline ?></td>
				<td class="cell100 column7"><a target="_blank" href="<? echo $document -> company_info ?>">바로가기</td>
			</tr>
		<?}?>
		</tbody>
	</table>
</div>

</body>
</html>