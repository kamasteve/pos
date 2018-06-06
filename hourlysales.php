<?ob_start();
//require_once('menu.php');
require_once ('mysql.php');
require_once('phpgraphlib.php');

$graph=new PHPGraphLib(900,400);
$dataArray=Array();
$s="SELECT  sum(total_p) AS sales,hour(time)AS month
FROM sales
WHERE month(date)=month(NOW())
GROUP BY hour(time)";
$sql=mysqli_query($dbc,$s);
if($sql){
while($row=mysqli_fetch_assoc($sql)){
$district=$row['month'];
$count=$row['sales'];
$dataArray[$district]=$count;
}
}

$graph->addData($dataArray);

$graph->setBarOutlineColor("black");
$graph->setBarColor('Green', 'Green');
$graph->setTitle('Cumulative Totals Based On Hours For This Month');
$graph->setupYAxis(10, 'blue');
$graph->setupXAxis(05,'red');
$graph->setGrid(true);
$graph->setLegend(true);
$graph->setTitleLocation('left');
$graph->setTitleColor('blue');
$graph->setLegendOutlineColor('red');
$graph->setLegendTitle('Sales');

$graph->setXValuesHorizontal(true);
$graph->createGraph();
?>
