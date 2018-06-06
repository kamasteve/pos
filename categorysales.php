<?ob_start();
//require_once('menu.php');
require_once ('mysql.php');
require_once('phpgraphlib.php');

$graph=new PHPGraphLib(900,400);
$dataArray=Array();
$s="SELECT  sum(total_p) AS sales,category AS month
FROM sales
 inner join products on products.p_name=sales.p_name

WHERE day(date)=day(NOW())
and year(date)=year(NOW())
GROUP BY category order by  sales limit 0,10";
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
$graph->setTitle('Top Ten Biggest Grossing Categories Today');
$graph->setupYAxis(10, 'blue');
$graph->setupXAxis(05);
$graph->setGrid(true);
$graph->setLegend(true);
$graph->setTitleLocation('left');
$graph->setTitleColor('blue');
$graph->setLegendOutlineColor('red');
$graph->setLegendTitle('Sales');
$graph->setXValuesHorizontal(true);
$graph->createGraph();
?>
