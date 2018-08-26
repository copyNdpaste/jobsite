<!doctype html>
<html>
<head>
<h1>결과</h1>
</head>
<body>

<?
	$com_name= $_POST["company_name"];
	$filter = [
		//'company_name' => '(주)렛유인'
		//'company_name' => $com_name
	];
	
	$options = [
	   'projection' => ['_id' => 0],
	];
	
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
	$query = new MongoDB\Driver\Query($filter, $options);
	$readPreference = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_PRIMARY);
	$cursor = $manager->executeQuery('projectdb.info', $query, $readPreference);
?>
<table border=1>
	<tr>
		<th>기업</th><th>제목</th><th>직무</th><th>지원자격1</th><th>지원자격2</th><th>지역</th><th>마감일</th><th>상세정보</th>
	</tr>
<?
	foreach($cursor as $document) {
?>
	<tr>
		<td><? echo $document -> company_name ?></td>
		<td><? echo $document -> title ?></td>
		<td><? foreach($document ->job as $job){
			echo $job." / ";
		} ?></td>
		<td><? echo $document -> achievement ?></td>
		<td><? echo $document -> career ?></td>
		<td><? echo $document -> area ?></td>
		<td><? echo $document -> deadline ?></td>
		<td><a href="<? echo $document -> company_info ?>">바로가기</td>
	</tr>
	<?}?>
	</table>
</body>
</html>
